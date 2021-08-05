<?php

namespace vcinsidedigital;

use Dotenv\Dotenv;

class Config
{
    public function __construct()
    {
       $file = "..";

       $env = Dotenv::createImmutable($file);

       $dados_config = $env->load();

      

    }
}