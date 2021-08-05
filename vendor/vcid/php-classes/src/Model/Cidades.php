<?php

namespace vcinsidedigital\Model;

use vcinsidedigital\Model;
use vcinsidedigital\Request\Request;

class Cidades extends Model
{
    public static function listAll($estado)
    {
        $cidades = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/Cidades/getAllCidadesEstados/".$_ENV["id_empresa"]."/".$estado);

        if($cidades != false)return json_decode($cidades, true);
    }
}