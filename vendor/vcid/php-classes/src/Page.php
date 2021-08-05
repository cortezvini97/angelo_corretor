<?php

namespace vcinsidedigital;

use Rain\Tpl;

class Page
{
    private $template;
    private $options = [];
    private $default = [
        "header"=>true,
        "footer"=>true,
        "data"=>[]
    ];

    public function __construct($opts = array(), $tpl_dir = '/templates/')
    {
        $this->options = array_merge($this->default, $opts);

        $config = array(
            "tpl_dir"=>$_SERVER["DOCUMENT_ROOT"].$tpl_dir,
            "cache_dir" =>  $_SERVER["DOCUMENT_ROOT"]."/cache/",
            "debug"=>false
        );

        Tpl::configure($config);

        $this->template = new Tpl();
        $this->setData($this->options["data"]);
        if($this->options["header"] === true)$this->template->draw("header");
    }

    public function setData($data = array())
    {
        foreach($data as $key => $value)
        {
            $this->template->assign($key, $value);
        }
    }

    public function setTemplate($name, $data = array(), $returnHtml = false)
    {
        $this->setData($data);
        return $this->template->draw($name, $returnHtml);
    }

    public function __destruct()
    {
        if($this->options['footer'] == true)$this->template->draw("footer");
    }
}