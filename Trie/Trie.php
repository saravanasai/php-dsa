<?php
class TrieNode
{
    public array $map;
    public bool $flag;

    public function __construct()
    {
        $this->map = [];
        $this->flag = false;
    }
}

class Trie
{
    public TrieNode $rootNode;
    private array $asciiValues  = [
        "a" => 0,
        "b" => 1,
        "c" => 2,
        "d" => 3,
        "e" => 4,
        "f" => 5,
        "g" => 6,
        "h" => 7,
        "i" => 8,
        "j" => 9,
        "k" => 10,
        "l" => 11,
        "m" => 12,
        "n" => 13,
        "o" => 14,
        "p" => 15,
        "q" => 16,
        "r" => 17,
        "s" => 18,
        "t" => 19,
        "u" => 20,
        "v" => 21,
        "w" => 22,
        "x" => 23,
        "y" => 24,
        "z" => 25
    ];

    public function __construct()
    {
        $this->rootNode = new TrieNode();
    }
    public function insert(string $str): void
    {
        $str = $this->toLowerCase($str);

        $trieNode = $this->rootNode;
        foreach (mb_str_split($str) as $char) {
            $asciiValue = $this->asciiValues[$char];
            if (!isset($trieNode->map[$asciiValue])) {
                $trieNode->map[$asciiValue] = new TrieNode();
                $trieNode = $trieNode->map[$asciiValue];
            } else {
                $trieNode = $trieNode->map[$asciiValue];
            }
        }
        $trieNode->flag = true;
    }

    public function search(string $str): bool
    {
        $str = $this->toLowerCase($str);
        $trieNode = $this->rootNode;
        foreach (mb_str_split($str) as $char) {
            $asciiValue = $this->asciiValues[$char];
            if (!isset($trieNode->map[$asciiValue])) {
                return false;
            }
            $trieNode = $trieNode->map[$asciiValue];
        }

        return $trieNode->flag;
    }
    public function toLowerCase(string $str): string
    {
        return strtolower($str);
    }

    public function startsWith(string $str): bool
    {
        $str = $this->toLowerCase($str);
        $trieNode = $this->rootNode;
        foreach (mb_str_split($str) as $char) {
            $asciiValue = $this->asciiValues[$char];
            if (!isset($trieNode->map[$asciiValue])) {
                $trieNode = null;
                break;
            }
            $trieNode = $trieNode->map[$asciiValue];
        }
        return $trieNode != null;;
    }
}


$seIndex = new Trie();

$seIndex->insert("app");
$seIndex->insert("apple");
$seIndex->insert("ram");
$start = $seIndex->startsWith("app");
$start = $seIndex->startsWith("an");


echo "okok";
