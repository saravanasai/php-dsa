<?php
class Node
{
    public ?Node $left;
    public int $val;
    public int $height;
    public ?Node $right;

    public function __construct(
        Node $left = null,
        int $val = null,
        Node $right = null,
        int $height = 1,
    ) {

        $this->left = $left;
        $this->val = $val;
        $this->height = $height;
        $this->right = $right;
    }
}
