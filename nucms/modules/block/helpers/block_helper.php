<?php

if (!function_exists('traverseStructure')) {

    /**
     * Parse array content for get the blocks ids
     * 
     * @param object $iterator
     * @param array $blocks
     */
    function traverseStructure($iterator, &$blocks)
    {
        while ($iterator->valid()) {
            if ($iterator->hasChildren()) {
                traverseStructure($iterator->getChildren(), $blocks);
            } else {
                $copyArray = $iterator->getArrayCopy();
                if (isset($copyArray['moduleType']) && !isset($blocks[$copyArray['id']])) {
                    $blocks[$copyArray['id']] = $copyArray['id'];
                }
            }

            $iterator->next();
        }
    }
}