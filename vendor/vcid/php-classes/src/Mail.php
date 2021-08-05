<?php

namespace vcinsidedigital;

use Rain\Tpl;
use vcinsidedigital\Config;

class Mail
{
    
    public function __construct($dadosmsg ,$templateName, $data = array())
    {
        
        $config = [
            "tpl_dir"=>$_SERVER["DOCUMENT_ROOT"]."/templates/mail/",
            "cache_dir"=>$_SERVER["DOCUMENT_ROOT"]."/cache/",
            "debug"=>false
        ];
        
        
        Tpl::configure( $config );
        
        $tpl = new Tpl();
        
        foreach ($data as $key => $value)
        {
            $tpl->assign($key, $value);
        }
        
        
        $html = $tpl->draw($templateName, true);
        
        $this->send($dadosmsg, $html);
        
    }
    
    public function send($dados, $html)
    {
        $email_contato = $_ENV['email'];
	    $header .= "Content-type: text/html; charset=utf-8\r\n";
        mail($email_contato, $dados["Assunto"], $html, $header, "-r"."contato@angelocorretor.com.br");
    }
}