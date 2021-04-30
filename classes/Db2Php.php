<?php

require __DIR__.'/../vendor/autoload.php';

Class Db2Php extends DataConnection
{
    public array $classList;

    public function __construct()
    {
        PARENT::__construct();
        $this->getClassList();
    }

    private function getClassList()
    {
        $this->classList = $this->preparedQueryMany("SELECT class_name FROM php_files_complete WHERE class_name !=:className", array('className' => ''));
    }
}