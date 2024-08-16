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

class DoubleSidedNode
{
    public ?DoubleSidedNode $next;
    public int $val;
    public ?DoubleSidedNode $prev;

    public function __construct(
        DoubleSidedNode $next = null,
        int $val = null,
        DoubleSidedNode $prev = null,
    ) {
        $this->next = $next;
        $this->val = $val;
        $this->prev = $prev;
    }

    public function __toString()
    {
        return "Cur ID: " . spl_object_id($this) . " | Prev :" . ($this->prev ? spl_object_id($this->prev) : 0) . "| val: " . $this->val . "| Next: " . ($this->next ? spl_object_id($this->next) : 0);
    }
}
