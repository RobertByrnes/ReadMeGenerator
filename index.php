<?php

require __DIR__.'/vendor/autoload.php';

class RequestHandler extends Db2Php
{
    public Smarty $smarty;
    public Mirror $reflector;

    /**
     * @throws SmartyException
     */
    public function __construct()
    {
        PARENT::__construct();
        new TemplateEngine;
        $this->smarty = TemplateEngine::$smarty;
        $this->httpRequests($_REQUEST);
    }

    /**
     * @throws SmartyException
     */
    public function httpRequests($request)
    {
        if (!isset($request['page']))   $request['page'] = NULL;
        if (!isset($request['action'])) $request['action'] = NULL;

        switch ($request['page'])
        {
            case 'classpanel':   $this->buildClassPanel($request);  break;
            default:             $this->mainPage();                 break;
        }
    }

    /**
     * @throws SmartyException
     */
    public function buildClassPanel($request) : void
    {
        $this->reflector = new Mirror($request['class']);
        $this->reflector->initialClassIdentification();
        $this->reflector->readComments();
        $this->reflector->passCommentsToParser();
        $this->reflector->passPropertiesToParser();
        $this->smarty->assign('className', $this->reflector->class->name);
        $this->smarty->assign('classComment', $this->reflector->classComment);
        $this->smarty->assign('docComments', $this->reflector->class->parsedComments);
        $this->smarty->assign('properties', $this->reflector->class->classProperties);
        $this->smarty->assign('parent', $this->reflector->class->parent);
        $this->smarty->display('main/header.tpl');
        $this->smarty->display('classpanel.tpl');
        $this->smarty->display('main/footer.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function mainPage()
    {
        $this->smarty->assign('classes', $this->classList);
        $this->smarty->display('main/header.tpl');
        $this->smarty->display('main.tpl');
        $this->smarty->display('main/footer.tpl');
    }
}
new RequestHandler;