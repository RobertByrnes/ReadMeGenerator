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
    public $commentArray;

    /**
     * A var to pass the class comment back to Mirror class.
     * 
     * @var array
     */
    public array $classComment;

    /**
     * Main function called from classes using this Trait. Returns parsed PHPDoc comments as an array.
     *
     * @param string $docComment
     * @return array
     */
    public function extractFromComments($docComment) : array
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
        return $this->sortElements($tempArray2);
    }

    /**
     * Further sorts through the doc comments string to extract discrete comment/param/return.
     *
     * @param array $elementsArray
     * @return array
     */
    public function sortElements($elementsArray) : array
    {
        foreach ($elementsArray as $element => $value)
        {
            switch (TRUE)
            {
                case (preg_match('/class_comment/', $element)):
                    $distinctElements['class_comment'][] = $element;
                    break;
                case (preg_match('/param /', $value) && !preg_match('/parameter/', $value)):
                    $trimmedValue = preg_replace('/param /', '', $value);
                    $distinctElements['params'][] = $trimmedValue;
                    break;
                case (preg_match('/return /', $value) && !preg_match('/returns/', $value)):
                    $trimmedValue = preg_replace('/return /', '', $value);
                    $distinctElements['return'][] = $trimmedValue;
                    break;
                default:
                    $distinctElements['comments'][] = $value;
            }
        }
        return $distinctElements;
    }

    /**
     * Uses the Trait CommentParser to parse the PHPDoc comments into an array.
     *
     * @return array
     */
    public function parseComments($docComments) : array
    {
        $parsedComments = [];
        $i=0;
        foreach ($docComments as $methodComment => $string)
        {
            $parsedComments[$i]['methodName'] = $methodComment;
            $commentElements = $this->extractFromComments($string);

            if (isset($commentElements['comments']))
            {
                $parsedComments[$i]['comments'] = $commentElements['comments'];
            }
            if (isset($commentElements['params']))
            {
                $parsedComments[$i]['params'] = $commentElements['params'];
            }
            if (isset($commentElements['return']))
            {
                $parsedComments[$i]['return'] = $commentElements['return'];
            }

            if ($parsedComments[$i]['methodName'] == 'class_comment')
            {
                $this->classComment = $parsedComments[$i];
                unset($parsedComments[$i]);
            }
            
            ++$i;
        }
        return $parsedComments;
    }
}