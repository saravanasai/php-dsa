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
        // swap first to last & reduce heapIndex
        $temp = $this->heapArr[1];
        $this->heapArr[1] = $this->heapArr[$this->heapIndex - 1];
        $this->heapArr[$this->heapIndex - 1] = $temp;
        $this->heapIndex--;

        // Adjusting a heap based on new root element
        $i = 1;
        while ($i < $this->heapIndex && $i * 2 <  $this->heapIndex &&  $i * 2 + 1 <  $this->heapIndex) {

            $leftChild = $this->heapArr[($i * 2)];
            $rightChild = $this->heapArr[($i * 2) + 1];

            if ($leftChild > $rightChild) {
                $sTemp = $this->heapArr[($i * 2)];
                $this->heapArr[($i * 2)] = $this->heapArr[$i];
                $this->heapArr[$i] = $sTemp;
                $i *= 2;
            } else {
                $sTemp = $this->heapArr[($i * 2) + 1];
                $this->heapArr[($i * 2) + 1] = $this->heapArr[$i];
                $this->heapArr[$i] = $sTemp;
                $i *= 2 + 1;
            }
        }
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
        for ($i =  $this->heapIndex - 1; $i > 0; $i--) {
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

$heap->insert(5);
$heap->insert(20);
$heap->insert(90);
$heap->insert(100);
$heap->sortHeap();
$heap->printArr();
