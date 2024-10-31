<?php 

class TrieNode {
    public $children = [];
    public $is_word = false;

    public function __construct() {
        $this->children = [];
        $this->is_word = false;
    }
}

class WordDictionary {
    private $root;
    /**
     */
    function __construct() {
        $this->root = new TrieNode();
    }
  
    /**
     * @param String $word
     * @return NULL
     */
    function addWord($word) {
        $node = $this->root;

        // Iterate over each character in the word
        for ($i = 0; $i < strlen($word); $i++) {
            $char = $word[$i];

            // If the character is not present in the current node's children, create a new node for it
            if (!array_key_exists($char, $node->children)) {
                $node->children[$char] = new TrieNode();
            }
            // Move to the next node corresponding to the current character
            $node = $node->children[$char];
        }
        // Mark the current node as a word
        $node->is_word = true;
    }

    public function searchHelper($word, $node) {
        /**
         * Recursive DFS helper function to search for a word in the Trie.
         */
        // Base case: if the word is empty, check if the current node is a word
        if (strlen($word) === 0) {
            return $node->is_word;
        }

        $char = $word[0];

        // If the current character is a dot, check all the children for a match
        if ($char === ".") {
            foreach ($node->children as $childNode) {
                if ($this->searchHelper(substr($word, 1), $childNode)) {
                    return true;
                }
            }
            return false;
        }
        // If the current character is a specific character, check that specific child for a match
        else if (array_key_exists($char, $node->children)) {
            return $this->searchHelper(substr($word, 1), $node->children[$char]);
        }
        // If the current character is not in the children, there is no match
        else {
            return false;
        }
    }
  
    /**
     * @param String $word
     * @return Boolean
     */
    function search($word) {
        // Start the search from the root of the Trie
        return $this->searchHelper($word, $this->root);
    }
}

