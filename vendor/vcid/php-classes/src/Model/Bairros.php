<?php

namespace vcinsidedigital\Model;

use vcinsidedigital\Model;
use vcinsidedigital\Request\Request;


class Bairros extends Model
{
    public static function listAll($cidade)
    {

        $cidade = urlencode($cidade);

        $bairros = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/Bairros/getBairrosPorCidade/".$_ENV["id_empresa"]."/".$cidade);

        if($bairros != false) return json_decode($bairros, true);
    }

    public function getBairroPorNome($nome)
    {
        $bairro = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/Bairros/getBairroName/".$_ENV["id_empresa"]."/".$nome);

        if($bairro != false)return json_decode($bairro, true);
    }
}