<?php

class Heap
{
    protected array $heapArr = [];

    protected int $heapIndex = 1;

    public function __construct()
    {
        $this->heapArr[0] = 0;
    }

    public function insert(int $val)
    {
        $this->heapArr[$this->heapIndex] = $val;
        $this->heapIndex++;
        if ($this->heapIndex >= 2) {
            $this->maxHeap();
        }
    }


    public function delete()
    {
        $n = $this->heapIndex - 1;
        $deletedValue = $this->heapArr[1];
        $this->heapArr[1] = $this->heapArr[$n];

        $i = 1;
        $j = $i * 2;

        while ($j < $n - 1) {

            if ($this->heapArr[$j + 1] > $this->heapArr[$j]) {
                $j += 1;
            }

            if ($this->heapArr[$i] < $this->heapArr[$j]) {

                $stemp = $this->heapArr[$i];
                $this->heapArr[$i] = $this->heapArr[$j];
                $this->heapArr[$j] = $stemp;
                $i = $j;
                $j *= 2;
            } else {
                break;
            }
        }

        $this->heapArr[$n] = $deletedValue;

        $this->heapIndex--;
    }

    public function maxHeap()
    {
        $i = $this->heapIndex - 1;
        $temp = $this->heapArr[$i];
        while ($i > 1 && $temp > $this->heapArr[($i / 2)]) {
            $this->heapArr[$i] =  $this->heapArr[($i / 2)];
            $i = floor($i / 2);
        }
        $this->heapArr[$i] = $temp;
    }

    public function sortHeap()
    {
        for ($i = 1; $i < count($this->heapArr) - 1; $i++) {
            $this->delete();
        }
    }
    public function printArr()
    {
        for ($i = 0; $i < count($this->heapArr); $i++) {
            echo $this->heapArr[$i] . ",";
        }
    }
}


$heap = new Heap();


$heap->insert(35);
$heap->insert(30);
$heap->insert(15);
$heap->insert(10);
$heap->insert(40);
$heap->insert(25);
$heap->insert(5);
$heap->printArr();
echo "\n After sort:\n";
$heap->sortHeap();
$heap->printArr();
