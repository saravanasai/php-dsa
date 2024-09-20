<?php
class Set
{

    protected array $set;
    protected array $map;

    public function __construct(array $values = [])
    {
        $this->set = [];
        $this->map = [];


        $this->createSet($values);
    }

    private function has(mixed $val): bool
    {
        return isset($this->map[$val]) ? true : false;
    }

    private  function createSet(array $values = [])
    {
        foreach ($values as  $value) {
            $this->push($value);
            $this->sortSet();
        }
    }

    public function push(mixed $val): void
    {
        if ($this->has($val)) {
            return;
        }
        $this->map[$val] = 1;
        $this->set[] = $val;
        $this->sortSet();
    }

    public function remove(mixed $val): void
    {
        $key = array_search($val, $this->set);
        if ($key !== false) {
            unset($this->set[$key]);
        }
        $tempArr = array_values($this->set);
        $this->set = [];
        $this->set = $tempArr;
        unset($this->map[$val]);
    }

    public function sortSet(): void
    {
        asort($this->set);
    }
    public function printSet()
    {

        $values = "";
        foreach ($this->set as $key => $value) {
            $values .= "key:" . $key . "|" . $value . ",";
        }

        $values .= "\n";
        echo $values;
    }

    public function min()
    {
        return $this->set[count($this->set) - 1];
    }
    public function max()
    {
        return $this->set[0];
    }
}


$set = new Set();

$set->push(10);
$set->push(5);
$set->push(10);
$set->push(5);
$set->push(2);
$set->remove(2);
echo $set->max();

$set->push(50);
$set->push(20);
$set->push(25);
$set->remove(20);

$set->printSet();