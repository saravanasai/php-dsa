<?php

class Queue
{
    public SplQueue $q;

    public function __construct()
    {
        $this->q = new SplQueue();
    }

    public function push(mixed $val)
    {
        $this->q->push($val);
    }

    public function pop()
    {
        $this->q->pop();
    }

    public function top() : mixed {
        return $this->q->top();
    }

    public function isEmpty() : bool {
        return $this->q->isEmpty();
    }
}

$queue = new Queue();

$queue->push(5);
$queue->push(10);
$queue->push(8);
$queue->pop();
echo "Top:".$queue->top()."\n";
