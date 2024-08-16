<?php

class HashMap
{

    public array $hashMap = [];

    public function __construct()
    {
        $this->hashMap = [];
    }

    public function put($key, $value)
    {
        $this->hashMap[$key] = $value;
    }

    public function get($key)
    {
        return $this->hashMap[$key] ?? -1;
    }

    public function remove($key)
    {
        if (!$this->hashMap[$key]) {
            return -1;
        }
        $val = $this->hashMap[$key];
        unset($this->hashMap[$key]);
        return  $val;
    }

    public function printMap()
    {
        foreach ($this->hashMap as $key => $value) {
            echo "Key: $key , Value: {$value}\n";
        }
    }
}
