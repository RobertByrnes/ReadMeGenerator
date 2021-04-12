<?php
/**
 * @author Robert Byrnes
 * @created 08/04/2021
 **/

require __DIR__.'/../vendor/autoload.php';

/**
 * Uses PHP ReflectionClass to read a class, logging its structure and dependencies, and parsing
 * PHPDoc comments into a clean array.
 */
Class Mirror
{
    use CommentParser;

    /**
     * Object of stdClass to store data gathered from enquiry class.
     * 
     * @var object
     */
    public  $class;

    /**
     * Object of the ReflectionClass
     * 
     * @var object
     */
    protected  $reflection;

    /**
     * Class contructor
     *
     * @param  $className
     */
    public function __construct($className)
    {
        $this->class = new stdClass;
        $this->class->name = $className;
        $this->reflection = new ReflectionClass($this->class->name);
    }

    /**
     * Gethers data about the class.
     *
     * @return void
     */
    public function initialClassIdentification() : void
    {
        $this->class->callable = $this->reflection->isInstantiable();
        $this->class->typeCheck = $this->reflection->isTrait();
        $this->class->constuctor = $this->reflection->getConstructor();
        $this->class->fileName = $this->reflection->getFileName();  
        $this->class->methods = $this->reflection->getMethods();
        $this->class->constants = $this->reflection->getConstants();
        $this->class->parent = $this->reflection->getParentClass();
        $this->class->properties = $this->reflection->getProperties();
        $this->class->staticProperties = $this->reflection->getStaticProperties();
        $this->class->traitNames = $this->reflection->getTraitNames();
        $this->class->traits = $this->reflection->getTraits();
        $this->class->abstraction = $this->reflection->isAbstract();
    }

    /**
     * Gets the PHPDoc comments from the class.
     *
     * @return void
     */
    public function readComments() : void
    {
        if (empty($this->class->methods))
        {
            $this->class->methods = $this->reflection->getMethods();
        }
        $this->class->docComments = [];
        $this->class->docComments['class_comment'] = $this->reflection->getDocComment();
        foreach ($this->class->methods as $method)
        {
            $this->class->docComments[$method->name] = $this->reflection->getMethod($method->name)->getDocComment();
        }
    }

    /**
     * Uses the Trait CommentParser to parse the PHPDoc comments into an array.
     *
     * @return void
     */
    public function parseComments() : void
    {
        $this->class->parsedComments = [];
        $i=0;
        foreach ($this->class->docComments as $methodComment => $string)
        {
            $this->class->parsedComments[$i]['methodName'] = $methodComment;
            $commentElements = $this->extractFromComments($string);

            if (isset($commentElements['comments']))
            {
                $this->class->parsedComments[$i]['comments'] = $commentElements['comments'];
            }
            if (isset($commentElements['params']))
            {
                $this->class->parsedComments[$i]['params'] = $commentElements['params'];
            }
            if (isset($commentElements['return']))
            {
                $this->class->parsedComments[$i]['return'] = $commentElements['return'];
            }

            if ($this->class->parsedComments[$i]['methodName'] == 'class_comment')
            {
                $this->class->classComment = $this->class->parsedComments[$i];
                unset($this->class->parsedComments[$i]);
            }
            
            ++$i;
        }
        unset($this->class->docComments);
    }

    public function parseProperties()
    {
        # code...
    }

    /**
     * Helper function to pretty print all or selected properties of the study class object.
     *
     * @param boolean $property
     * @return void
     */
    public function tell($property=FALSE) : void
    {
        (!$property) ? $subject = $this->class : $subject = $this->class->$property;
        echo '<pre>'.__FILE__."\nLine ".__LINE__."\n".print_r($subject, true).'</pre>';
        exit;
    }
}