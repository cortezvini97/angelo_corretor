<?php

namespace vcinsidedigital\Model;

use Slim\Http\Response;
use vcinsidedigital\Model;
use vcinsidedigital\Request\Request;

class Estados extends Model
{
    public static function listAll()
    {
        $estados = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/Estados/getAllEstados/".$_ENV["id_empresa"]);

        if($estados != false) return json_decode($estados, true);
    }
}