<?php

class QueueNode
{
    public ?Node $data;
    public ?QueueNode $next;
    public function __construct(Node $val=null)
    {
        $this->data = $val;
        $this->next = null;
    }
}

class Queue
{
    public ?QueueNode $front;
    public ?QueueNode $rear;

    public function __construct()
    {
        $this->front = null;
        $this->rear = null;
    }

    public function enqueue(Node $x): self
    {
        $newQueueNode = new QueueNode($x);

        if (!$this->front) {
            $this->front = $newQueueNode;
            $this->rear = $this->front;
            return $this;
        }

        $this->rear->next = $newQueueNode;
        $this->rear = $this->rear->next;
        return $this;
    }

    public function dequeue(): Node
    {
        if (!$this->front) {
            return new Node();
        }

        $val = $this->front->data;
        $this->front = $this->front->next;

        return $val;
    }

    public function isEmpty(): bool
    {
        return $this->front == null;
    }

    public function first(): int
    {
        return $this->isEmpty() ? -1 : $this->front->data;
    }
    public function last(): int
    {
        return $this->isEmpty() ? -1 : $this->rear->data;
    }
}
