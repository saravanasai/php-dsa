<?php
class Node
{
    public ?Node $left;
    public int $val;

    public ?Node $right;

    public function __construct(
        Node $left = null,
        int $val = null,
        Node $right = null
    ) {

        $this->left = $left;
        $this->val = $val;
        $this->right = $right;
    }
}
