<?php
include_once "../commons/queue.php";
include_once "../commons/node.php";

class Tree
{

    public ?Node $rootNode;
    public ?Queue $queue;
    public ?Queue $levelQueue;

    public function __construct()
    {
        $this->rootNode = null;
        $this->queue = new Queue();
        $this->levelQueue = new Queue();
    }

    protected function insertLeftNode(Node $parentNode, int $value): void
    {
        if ($value != -1) {
            $leftNode = new Node(null, $value, null);
            $parentNode->left = $leftNode;
            $this->queue->enqueue($leftNode);
        }
    }

    protected function insertRightNode(Node $parentNode, int $value): void
    {
        if ($value != -1) {
            $rightNode = new Node(null, $value, null);
            $parentNode->right = $rightNode;
            $this->queue->enqueue($rightNode);
        }
    }
    protected function getLeftNodeData(Node $parentNode): void
    {
        $leftChildValue = (int) readline("Enter the left child of:" . $parentNode->val . "\n");

        if ($leftChildValue != -1) {
            $leftNode = new Node(null, $leftChildValue, null);
            $parentNode->left = $leftNode;
            $this->queue->enqueue($leftNode);
        }
    }


    protected function getRightNodeData(Node $parentNode): void
    {
        $rightChildValue = (int) readline("Enter the right child of:" . $parentNode->val . "\n");

        if ($rightChildValue != -1) {
            $rightNode = new Node(null, $rightChildValue, null);
            $parentNode->right = $rightNode;
            $this->queue->enqueue($rightNode);
        }
    }

    public function generateTreefromGivenArr(array $arr): void
    {

        $length = count($arr);
        for ($i = 0; $i < $length; $i++) {

            if ($i === 0) {
                $this->rootNode = new Node(null, $arr[$i], null);
                $this->queue->enqueue($this->rootNode);
                continue;
            }

            while (!$this->queue->isEmpty()) {
                $parentNode = $this->queue->dequeue();
                // left child inserting
                $this->insertLeftNode($parentNode, $arr[$i]);
                $i++;
                // right child inserting
                $this->insertRightNode($parentNode, $arr[$i]);
                $i++;
            }
        }
    }

    public function getData(): void
    {
        $rootNodeValue = (int) readline("Enter the root node value:" . "\n");

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

    public function preOrderTraversal(Node $node = null): void
    {
        if ($node) {
            echo $node->val . ",";
            $this->preOrderTraversal($node->left);
            $this->preOrderTraversal($node->right);
        }
    }

    public function inOrderTraversal(Node $node = null): void
    {
        if ($node) {
            $this->inOrderTraversal($node->left);
            echo $node->val . ",";
            $this->inOrderTraversal($node->right);
        }
    }

    public function postOrderTraversal(Node $node = null): void
    {
        if ($node) {
            $this->postOrderTraversal($node->left);
            $this->postOrderTraversal($node->right);
            echo $node->val . ",";
        }
    }

    public function levelOrderTraversal(Node $node = null): void
    {
        if (!$node) {
            return;
        }

        while ($node) {
            echo $node->val . ",";

            if ($node->left) {
                $this->levelQueue->enqueue($node->left);
            }
            if ($node->right) {
                $this->levelQueue->enqueue($node->right);
            }

            $node = !$this->levelQueue->isEmpty() ? $this->levelQueue->dequeue() : null;
        }
    }
    public function countNode(Node $node = null): int
    {
        $x = 0;
        $y = 0;
        if ($node) {
            $x = $this->countNode($node->left);
            $y = $this->countNode($node->right);
            return $x + $y + 1;
        }

        return 0;
    }

    public function countLeafNode(Node $node = null, int $leadNodeCount = 0): int
    {
        if ($node) {
            if ($node->left == null && $node->right == null) {
                $leadNodeCount++;
            }
            $leadNodeCount = $this->countLeafNode($node->left, $leadNodeCount);
            $leadNodeCount = $this->countLeafNode($node->right, $leadNodeCount);
            return $leadNodeCount;
        }

        return $leadNodeCount;
    }

    public function treeHeight(Node $node = null): int
    {
        $x = 0;
        $y = 0;
        if ($node) {
            $x = $this->treeHeight($node->left);
            $y = $this->treeHeight($node->right);
            return $x > $y ? $x + 1 : $y + 1;
        }

        return 0;
    }
}


$tree = new Tree();

$tree->generateTreefromGivenArr([12, 6, 3, 7, 11, 9, 10, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1]);
echo "Pre Order : Traversal:\n";
$tree->preOrderTraversal($tree->rootNode);
echo "\nIn Order : Traversal:\n";
$tree->inOrderTraversal($tree->rootNode);
echo "\nPost Order : Traversal:\n";
$tree->postOrderTraversal($tree->rootNode);
echo "\n Lever Order : Traversal:\n";
$tree->levelOrderTraversal($tree->rootNode);
echo "\nNode Count :" . $tree->countNode($tree->rootNode);
echo "\nTree height :" . $tree->treeHeight($tree->rootNode);
echo "\n Leafnode count :" . $tree->countLeafNode($tree->rootNode);
