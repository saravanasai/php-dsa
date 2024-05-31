<?php
include_once "./queue.php";
include_once "./node.php";

class BinaryTree
{

    public ?Node $rootNode;
    public ?Queue $queue;

    public function __construct()
    {
        $this->rootNode = null;
        $this->queue = new Queue();
    }


    protected function getLeftNodeData(Node $parentNode)
    {
        $leftChildValue = (int)readline("Enter the left child of:" . $parentNode->val . "\n");

        if ($leftChildValue != -1) {
            $leftNode = new Node(null, $leftChildValue, null);
            $parentNode->left = $leftNode;
            $this->queue->enqueue($leftNode);
        }
    }


    protected function getRightNodeData(Node $parentNode)
    {
        $rightChildValue = (int)readline("Enter the right child of:" . $parentNode->val . "\n");

        if ($rightChildValue != -1) {
            $rightNode = new Node(null, $rightChildValue, null);
            $parentNode->right = $rightNode;
            $this->queue->enqueue($rightNode);
        }
    }


    public function getData()
    {
        $rootNodeValue = (int)readline("Enter the root node value:" . "\n");

        $this->rootNode = new Node(null, $rootNodeValue, null);

        $this->queue->enqueue($this->rootNode);

        while (!$this->queue->isEmpty()) {
            $parentNode = $this->queue->dequeue();
            // left child inserting
            $this->getLeftNodeData($parentNode);
            // right child inserting
            $this->getRightNodeData($parentNode);
        }
    }

    public function preOrderTraversal(Node $node = null)
    {
        if ($node) {
            echo $node->val . ",";
            $this->preOrderTraversal($node->left);
            $this->preOrderTraversal($node->right);
        }
    }

    public function inOrderTraversal(Node $node = null)
    {
        if ($node) {
            $this->inOrderTraversal($node->left);
            echo $node->val . ",";
            $this->inOrderTraversal($node->right);
        }
    }

    public function postOrderTraversal(Node $node = null)
    {
        if ($node) {
            $this->postOrderTraversal($node->left);
            $this->postOrderTraversal($node->right);
            echo $node->val . ",";
        }
    }
}


$tree = new BinaryTree();

$tree->getData();
echo "Pre Order : Traversal:\n";
$tree->preOrderTraversal($tree->rootNode);
echo "\n In Order : Traversal:\n";
$tree->inOrderTraversal($tree->rootNode);
echo "\n Post Order : Traversal:\n";
$tree->postOrderTraversal($tree->rootNode);