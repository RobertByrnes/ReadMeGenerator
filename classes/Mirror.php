<?php

require __DIR__.'/../vendor/autoload.php';

Class Mirror
{
    protected object $class;

    protected object $reflection;

    public function __construct(string $className)
    {
        $this->class = new stdClass;
        $this->class->name = $className;
        $this->reflection = new ReflectionClass($this->class->name);
    }

    public function initialClassIdentification()
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

    public function readComments()
    {
        $commentator = $this->reflection = new ReflectionClass($this->class->name);
        var_dump($commentator->getDocComment());
    }

    public function tell()
    {
        echo '<pre>'.__FILE__."\nLine ".__LINE__."\n".print_r($this->class, true).'</pre>';
        exit;
    }
}