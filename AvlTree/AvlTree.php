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

    public function nodeHeight(Node|null $node = null): int
    {
        $hl = $node->left ? $node->left->height : 0;
        $hr = $node->right ? $node->right->height : 0;
        return $hl > $hr ? $hl + 1 : $hr + 1;
    }

    public function balanceFactor(Node|null $node): int
    {

        $hl = $node?->left ? $node->left->height : 0;
        $hr = $node?->right ? $node->right->height : 0;
        return $hl - $hr;
    }

    public function LL_Rotation(Node $node): Node
    {
        $imbNodeLeft = $node->left;
        $imbNodeLeftRight = $imbNodeLeft->right;

        $imbNodeLeft->right = $node;
        $node->left = $imbNodeLeftRight;

        $node->height = $this->nodeHeight($node);
        $imbNodeLeft->height = $this->nodeHeight($imbNodeLeft);


        if ($node == $this->rootNode) {
            $this->rootNode = $imbNodeLeft;
        }


        return $imbNodeLeft;
    }

    public function LR_Rotation(Node $node): Node
    {

        return $node;
    }

    public function RR_Rotation(Node $node): Node
    {

        return $node;
    }

    public function RL_Rotation(Node $node): Node
    {

        return $node;
    }
    public function insert(int $val): Node
    {

        if (!$this->rootNode) {

            $this->rootNode = $this->insertNode($val, null);

            return $this->rootNode;
        }

        return $this->insertNode($val, $this->rootNode);
    }


    public function insertNode(int $val, Node|null $node): Node
    {
        if (!$node) {
            return new Node(null, $val, null);
        }

        if ($node->val > $val) {
            $node->left = $this->insertNode($val, $node->left);
        } else {
            $node->right = $this->insertNode($val, $node->right);
        }

        $node->height = $this->nodeHeight($node);


        if ($this->balanceFactor($node) == 2 && $this->balanceFactor($node->left) == 1) {

            return $this->LL_Rotation($node);
        } elseif ($this->balanceFactor($node) == 2 && $this->balanceFactor($node->left) == -1) {

            return $this->LR_Rotation($node);
        } elseif ($this->balanceFactor($node) == -2 && $this->balanceFactor($node->right) == -1) {

            return $this->RR_Rotation($node);
        } elseif ($this->balanceFactor($node) == -2 && $this->balanceFactor($node->right) == 1) {

            return $this->RL_Rotation($node);
        }

        return $node;
    }


    public function printNode(Node|null $node): string
    {
        if (!$node) {
            return "";
        }

        return "Node Value :" . $node->val . "| left :" . $node->left?->val . "| Right :" . $node->right?->val;
    }

    public function levelOrderTraversal(Node $node = null, bool $withLeftRight = false): void
    {
        if (!$node) {
            return;
        }

        while ($node) {

            if (!$withLeftRight) {
                echo "Node Value :" . $node->val . "| height :" . $node->height . "\n";
            } else {
                echo $this->printNode($node) . "\n";
            }

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
$avlTree->insert(35);
$avlTree->insert(34);
$avlTree->insert(33);
$avlTree->insert(32);

$avlTree->levelOrderTraversal($avlTree->rootNode);
