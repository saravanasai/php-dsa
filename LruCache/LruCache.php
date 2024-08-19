<?php
class Node
{
    public int $key;
    public int $value;
    public function __construct(int $key, int $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}

class DoubleEndedNode
{
    public ?DoubleEndedNode $prev = null;
    public ?DoubleEndedNode $next = null;
    public Node $var;
    public function __construct($prev = null, Node $var, $next = null)
    {
        $this->prev = $prev;
        $this->next = $next;
        $this->var = $var;
    }
}

class CacheList
{
    public ?DoubleEndedNode $head = null;
    public ?DoubleEndedNode $tail = null;

    public function __construct()
    {
        $this->head = new DoubleEndedNode(null, new Node(-1, -1), null);
        $this->tail = new DoubleEndedNode($this->head, new Node(-1, -1), null);
        $this->head->next = $this->tail;
    }

    public function addNodeInFront(DoubleEndedNode $node)
    {
        $node->next = $this->head->next;
        $node->prev = $this->head;
        $this->head->next = $node;
        $node->next->prev = $node;
        return $node;
    }

    public function evict(): DoubleEndedNode
    {
        $node = $this->tail->prev;
        $node->prev->next = $this->tail;
        $this->tail->prev = $node->prev;
        $node->prev = null;
        return $node;
    }

    public function removeNode(DoubleEndedNode $node)
    {
        if ($node->prev != null && $node->next != null) {
            $node->prev->next = $node->next;
            $node->next->prev = $node->prev;
        }

        return $node;
    }

    public function printList()
    {
        $current = $this->head->next;
        while ($current !== $this->tail) {
            echo "Key: " . $current->var->key . ", Value: " . $current->var->value . "\n";
            $current = $current->next;
        }
    }
}

class Map
{
    public array $map;
    public function __construct()
    {
        $this->map = [];
    }

    public function get(int $key)
    {
        if (isset($this->map[$key])) {
            return $this->map[$key];
        }
        return -1;
    }

    public function has(int $key): bool
    {
        return isset($this->map[$key]);
    }

    public function put(int $key, DoubleEndedNode $node)
    {
        $this->map[$key] = $node;
    }

    public function count()
    {
        return count($this->map);
    }

    public function remove(int $key)
    {
        unset($this->map[$key]);
    }

    public function printMap()
    {
        foreach ($this->map as $key => $value) {
            echo "Key: $key, Value: " . $value->var->value . "\n";
        }
    }
}



class LRUCache
{
    public Map $map;
    public CacheList $cacheList;
    public int $capacity;

    /**
     * @param Integer $capacity
     */
    function __construct($capacity)
    {
        $this->map = new Map();
        $this->cacheList = new CacheList();
        $this->capacity = $capacity;
    }

    public function get(int $key)
    {
        if (!$this->map->has($key)) {
            return -1;
        }

        $node = $this->map->get($key);
        $this->cacheList->removeNode($node);
        $this->cacheList->addNodeInFront($node);
        return $node->var->value;
    }

    public function put($key, $value)
    {
        if ($this->map->count() == $this->capacity && !$this->map->has($key)) {
            $node = $this->cacheList->evict();
            $this->map->remove($node->var->key);
        }

        if ($this->map->has($key)) {
            $node = $this->map->get($key);
            $node->var->value = $value;
            $this->cacheList->removeNode($node);
            $this->cacheList->addNodeInFront($node);
        } else {
            $node = new DoubleEndedNode(null, new Node($key, $value), null);
            $this->cacheList->addNodeInFront($node);
            $this->map->put($key, $node);
        }
    }
}



$lruCache = new LruCache(2);
