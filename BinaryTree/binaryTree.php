<?php
include_once "../commons/node.php";
include_once "../commons/queue.php";

class BinaryTree
{

    public ?Node $rootNode;
    public ?Queue $levelQueue;

    public function __construct()
    {
        $this->rootNode = null;
        $this->levelQueue = new Queue();
    }

    public function insert(int $val): void
    {
        $newNode = new Node(null, $val, null);
        $tempNode = $this->rootNode;

        if (!$this->rootNode) {
            $this->rootNode = $newNode;
            return;
        }

        if ($newNode->val < $tempNode->val) {

            if (!$tempNode->left) {
                $tempNode->left = $newNode;
            } else {
                $this->insertNode($tempNode->left, $newNode);
            }
        } else {
            if (!$tempNode->right) {
                $tempNode->right = $newNode;
            } else {
                $this->insertNode($tempNode->right, $newNode);
            }
        }
    }

    private function insertNode(Node $node, Node $newNode): void
    {
        if ($newNode->val < $node->val) {
            if (!$node->left) {
                $node->left = $newNode;
            } else {
                $this->insertNode($node->left, $newNode);
            }
        } else {
            if (!$node->right) {
                $node->right = $newNode;
            } else {
                $this->insertNode($node->right, $newNode);
            }
        }
    }

    public function search(int $val): int
    {
        $tempNode = $this->rootNode;

        if (!$tempNode) {
            return -1;
        }

        if ($tempNode->val == $val) {
            return $val;
        }

        if ($val < $tempNode->val) {
            return $this->searchRecursive($tempNode->left, $val);
        } else {
            return $this->searchRecursive($tempNode->right, $val);
        }
    }

    private function searchRecursive(Node $node = null, int $val): int
    {
        if (!$node) {
            return -1;
        }

        if ($node->val == $val) {
            return $val;
        }

        if ($val < $node->val) {
            return $this->searchRecursive($node->left, $val);
        } else {
            return $this->searchRecursive($node->right, $val);
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
}

$binaryTree = new BinaryTree();

$binaryTree->insert(50);
$binaryTree->insert(20);
$binaryTree->insert(30);
$binaryTree->insert(10);
$binaryTree->insert(60);
$binaryTree->insert(100);
$binaryTree->insert(90);
$binaryTree->levelOrderTraversal($binaryTree->rootNode);
echo "\nSearching for val[10]:\t" . $binaryTree->search(10);
echo "\nSearching for val[90]:\t" . $binaryTree->search(90);
