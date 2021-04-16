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
    public object $class;

    /**
     * Object of the ReflectionClass
     * 
     * @var object
     */
    protected object $reflection;

    /**
     * Class contructor
     *
     * @param string $className
     */
    public function __construct(string $className)
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

    public function passCommentsToParser() : void
    {
        $this->class->parsedComments = $this->parseComments($this->class->docComments);
        unset($this->class->docComments);
    }

    public function passPropertiesToParser() : void
    {
        $this->class->propertyComments = [];
        foreach ($this->class->properties as $property)
        {
            $this->class->propertyComments[$property->name] = $this->reflection->getProperty($property->name)->getDocComment();
        }
        $this->class->classProperties = $this->parseComments($this->class->propertyComments);
        unset($this->class->properties);
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