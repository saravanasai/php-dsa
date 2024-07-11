<?php
include_once "../commons/node.php";

class DoublyLinkedListStack
{
    public ?Node $rear;
    public ?Node $front;

    public int $nodeCount;
    public function __construct()
    {
        $this->front = null;
        $this->rear = null;
        $this->nodeCount = 0;
    }

    public function increseNodeCount(): int
    {
        $this->nodeCount += 1;
        return $this->nodeCount;
    }

    public function decreseNodeCount(): int
    {
        $this->nodeCount -= 1;
        return $this->nodeCount;
    }

    public function push(int $val)
    {
        $newNode = new Node(null, $val, null);

        if ($this->front == null) {
            $this->front = $newNode;
            $this->rear = $newNode;
        } else {
            $prevNode = $this->rear;
            $newNode->left = $prevNode;
            $this->rear->right = $newNode;
            $this->rear = $newNode;
        }

        $this->increseNodeCount();
    }

    public function pop(): Node|null
    {
        if ($this->isEmpty()) {
            return null;
        }

        $popedNode = $this->rear;

        $this->rear = $popedNode->left ?? null;
        if ($this->rear) {
            $this->rear->right = null;
        } else {
            $this->front = null;
        }

        $this->decreseNodeCount();
        return $popedNode;
    }
    public function top():int
    {

        if ($this->isEmpty()) {
            return -1;
        }

        return $this->rear->val;
    }
    public function isEmpty(): bool
    {
        return $this->nodeCount == 0;
    }

    public function clearStack(): void
    {
        $this->front = null;
        $this->rear = null;
    }
    public function printStack(Node $node = null): int
    {
        if (!$node) {
            return -1;
        }

        echo "\n Node : val =" . $node?->val .
            "| Node left val :" . $node?->left?->val .
            "| Node right val:" . $node?->right?->val . "\n";

        return $this->printStack($node->right);
    }

    public function printNode(Node $node = null): Node|null
    {
        if (!$node) {
            return null;
        }

        echo "\n Node : val =" . $node?->val .
            "| Node left val :" . $node?->left?->val .
            "| Node right val:" . $node?->right?->val . "\n";

        return $node;
    }
}


$stack = new DoublyLinkedListStack();

$stack->push(10);
$stack->push(20);
$stack->push(50);

$stack->pop();
echo "\ntop " . $stack->top();
$stack->printStack($stack->front);
