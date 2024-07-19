<?php
include_once "../commons/node.php";
include_once "../commons/queue.php";


class Graph
{
    public array $graph;

    public int $totalVertex;
    public Queue $queue;


    public function __construct(array $arr)
    {
        $this->graph = $arr;
        $this->queue = new Queue();
        $this->totalVertex = count($arr);
    }

    protected function fillArr(int $size): array
    {
        return array_fill(0, $size, 0);
    }

    public function perfromBFS(int $val): void
    {
        $path = "";
        $path .= $val . ",";

        $visitedVertex = $this->fillArr($this->totalVertex);

        $this->queue->enqueue(new Node(null, $val, null));

        while (!$this->queue->isEmpty()) {
            $val = $this->queue->dequeue()->val;
            for ($i = 1; $i < $this->totalVertex; $i++) {

                if ($this->graph[$val][$i] == 1 && $visitedVertex[$i] == 0) {
                    $path .= $i . ",";
                    $visitedVertex[$i] = 1;
                    $this->queue->enqueue(new Node(null, $i, null));
                }
            }
        }

        echo "BFS - Path:[" . $path . "]";
    }
}


//Graph Representation
$arr = [
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 1, 1, 0, 0, 0, 0],
    [0, 1, 0, 0, 1, 0, 0, 0],
    [0, 1, 0, 0, 1, 0, 0, 0],
    [0, 1, 0, 1, 0, 1, 0, 0],
    [0, 0, 1, 1, 0, 1, 1, 0],
    [0, 0, 0, 0, 0, 1, 0, 0],
    [0, 0, 0, 0, 0, 1, 0, 0],
];


$graph = new Graph($arr);

$graph->perfromBFS(1);

//BFS - Path:[1,2,3,1,4,5,6,]
