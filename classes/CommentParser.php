<?php
 /**
 * @author Robert Byrnes
 * @created 08/04/2021
 **/

require __DIR__.'/../vendor/autoload.php';

/**
 * Parses PHPDoc style comments into an array.
 */
Trait CommentParser
{
    /**
     * The return data structure.
     * 
     * @var array
     */
    public array $commentArray;

    /**
     * Main function called from classes using this Trait. Returns parsed PHPDoc comments as an array.
     *
     * @param string $docComment
     * @return array
     */
    public function getParsedComments(string $docComment) : array
    {
        $this->commentArray = explode('@', $docComment);
        $this->commentArray = $this->parseDescription();
        return $this->commentArray;
    }

    /**
     * Cleans strings removing '*' and '/' from the comment, as well
     * as excess whitespace.
     *
     * @return array
     */
    public function parseDescription() : array
    {
        $tempArray1 = [];
        foreach ($this->commentArray as $key => &$stringToSearch)
        {
            if(empty($stringToSearch))
            {
                $stringToSearch = 'Uncommented';
            }
            $tempArray1[$key] = str_replace("*", "", $stringToSearch);
        }
        $tempArray2 = [];
        foreach ($tempArray1 as $key => $stringToSearch)
        {
            $tempArray2[$key] = trim(str_replace("/", "", $stringToSearch));
        }
        return $tempArray2;
    }
}