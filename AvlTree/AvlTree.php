<?php

include_once "../commons/node.php";
include_once "../commons/queue.php";

class AvlTree
{
    public ?Node $rootNode;
    public ?Queue $levelQueue;

    public function __construct()
    {
        $this->rootNode = null;
        $this->levelQueue = new Queue();
    }

    public function treeHeight(Node $fromNode = null): int
    {
        $x = 0;
        $y = 0;

        if ($fromNode) {
            $x = $this->treeHeight($fromNode->left);
            $y = $this->treeHeight($fromNode->right);
            return $x > $y ? $x + 1 : $y + 1;
        }

        return $x + $y;
    }

    public function insert(int $val): Node
    {

        if (!$this->rootNode) {

            $this->rootNode = new Node(null, $val, null);

            return $this->rootNode;
        }

        return $this->insertNode($val, $this->rootNode);
    }


    public function insertNode(int $val, Node|null $node): Node
    {
        if (!$node) {
            return new Node(null, $val, null,0);
        }

        if ($node->val < $val) {
            $node->left = $this->insertNode($val, $node->left);
        } elseif ($node->val > $val) {
            $node->right = $this->insertNode($val, $node->right);
        }
        
        $node->height = $this->treeHeight($node);
        return $node;
    }



    public function levelOrderTraversal(Node $node = null): void
    {
        if (!$node) {
            return;
        }

        while ($node) {
            echo "Node Value :" . $node->val . "|height :" . $node->height . "\n";

            if ($node->left) {
                $this->levelQueue->enqueue($node->left);
            }
            if ($node->right) {
                $this->levelQueue->enqueue($node->right);
            }

            $node = !$this->levelQueue->isEmpty() ? $this->levelQueue->dequeue() : null;
        }
    }
}


$avlTree = new AvlTree();

$avlTree->insert(50);
$avlTree->insert(60);
$avlTree->insert(40);
$avlTree->insert(55);
$avlTree->insert(35);
$avlTree->insert(38);
$avlTree->insert(88);
$avlTree->insert(90);
$avlTree->insert(83);
echo "\n height of tree :" . $avlTree->treeHeight($avlTree->rootNode) . "\n";
$avlTree->levelOrderTraversal($avlTree->rootNode);
