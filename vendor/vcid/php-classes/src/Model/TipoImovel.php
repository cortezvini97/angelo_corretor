<?php

namespace vcinsidedigital\Model;


use vcinsidedigital\Model;
use vcinsidedigital\Request\Request;

class TipoImovel extends Model
{
    public static function listAll()
    {
        $tipo_imoveis = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/TipoCategoria/getAllTipoImovel/".$_ENV["id_empresa"]);

        if($tipo_imoveis != false)return json_decode($tipo_imoveis, true);
    }

    public function listAllTipoImovelCategoria($categoria)
    {
		$tipo_imovel = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/TipoCategoria/getTipoImovelCategoria/".$_ENV["id_empresa"]."/".$categoria);
        if($tipo_imovel != false)return json_decode($tipo_imovel, true);
    }
    
}