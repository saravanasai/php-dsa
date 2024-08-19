<?php
include_once "../commons/node.php";
include_once "../HashMap/HashMap.php";


class DoublyLinkedList
{
    public ?DoubleSidedNode $head;
    public ?DoubleSidedNode $tail;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
    }

    public function insert(int $data): DoubleSidedNode
    {
        if ($this->head === null) {
            $this->head = new DoubleSidedNode(null, $data, null);
            $this->tail = $this->head;
            return $this->head;
        }

        return $this->insertNode($this->head, $data);
    }

    public function removeNode(DoubleSidedNode $node): ?DoubleSidedNode
    {
        if ($this->head === null) {
            return null; // Handle the case where the list is empty
        }

        // Check if it's the head node
        if ($node->prev === null) {
            $this->head = $node->next;
            if ($this->head !== null) {
                $this->head->prev = null;
            }
        }

        // Check if it's the tail node
        if ($node->next === null) {
            $this->tail = $node->prev;
            if ($this->tail !== null) {
                $this->tail->next = null;
            }
        }

        // Handle removal of a middle node
        if ($node->prev !== null && $node->next !== null) {
            $node->prev->next = $node->next;
            $node->next->prev = $node->prev;
        }

        return $node;
    }

    private function insertNode(DoubleSidedNode $node, int $data): DoubleSidedNode
    {
        if ($node->next == null) {
            $node->next = new DoubleSidedNode(null, $data, $node);
            $this->tail = $node->next;
            return $node->next;
        }

        return $this->insertNode($node->next, $data);
    }

    public function printList(): void
    {
        $node = $this->head;
        while ($node !== null) {
            $this->printNode($node);
            $node = $node->next;
        }
    }

    public function printReverseList(): void
    {
        $node = $this->tail;
        while ($node !== null) {
            $this->printNode($node);
            $node = $node->prev;
        }
    }

    private function printNode(DoubleSidedNode $node): void
    {
        echo $node->val . "\n";
    }
}



$list = new DoublyLinkedList();

$map = new HashMap();

$map->put(1, $list->insert(1));
$map->put(2, $list->insert(2));
$map->put(3, $list->insert(3));
$node = $map->get(3);

$list->removeNode($node);
$list->printList();
