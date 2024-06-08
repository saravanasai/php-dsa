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

    public function height(Node $fromNode = null): int
    {
        $x = 0;
        $y = 0;

        if ($fromNode) {
            $x = $this->height($fromNode->left);
            $y = $this->height($fromNode->right);
            return $x > $y ? $x + 1 : $y + 1;
        }

        return $x + $y;
    }

    private function inPre(Node $node): Node
    {

        while ($node && $node->right) {
            $node = $node->right;
        }

        return $node;
    }

    private function inSuc(Node $node): Node
    {

        while ($node && $node->left) {
            $node = $node->left;
        }

        return $node;
    }
    public function delete(int $val, Node $node = null): Node|null
    {

        if (!$node) {
            return null;
        }

        if ($val < $node->val) {
            $node->left = $this->delete($val, $node->left);
        } else if ($val > $node->val) {
            $node->right = $this->delete($val, $node->right);
        }

        if ($val == $node->val) {
            // handling no child senario leaf node
            if (!$node->left && !$node->right) {
                return null;
            }

            if ($this->height($node->left) > $this->height($node->right)) {

                $preNode = $this->inPre($node->left);
                $node->val = $preNode->val;
                $node->left = $this->delete($preNode->val, $node->left);
            } else {
                $preNode = $this->inSuc($node->right);
                $node->val = $preNode->val;
                $node->right = $this->delete($preNode->val, $node->right);
            }
        }
        return $node;
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

$binaryTree->insert(12);
$binaryTree->insert(6);
$binaryTree->insert(20);
$binaryTree->insert(3);
$binaryTree->insert(8);
$binaryTree->insert(16);
$binaryTree->insert(40);
$binaryTree->insert(2);
$binaryTree->insert(4);
echo "\n Height of binary tree:" . $binaryTree->height($binaryTree->rootNode) . "\n";
$binaryTree->levelOrderTraversal($binaryTree->rootNode);
echo "\nSearching for val[10]:\t" . $binaryTree->search(10) . "\n";
echo "\nSearching for val[90]:\t" . $binaryTree->search(90) . "\n";
$binaryTree->delete(6, $binaryTree->rootNode);
echo "\n Height of binary tree:" . $binaryTree->height($binaryTree->rootNode) . "\n";
$binaryTree->levelOrderTraversal($binaryTree->rootNode);
