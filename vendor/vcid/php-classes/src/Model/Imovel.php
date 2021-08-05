<?php

namespace vcinsidedigital\Model;


use vcinsidedigital\Model;
use vcinsidedigital\Request\Request;

class Imovel extends Model
{
    public static function listAll()
    {
        $imoveis = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/Imoveis/listAllImoveisDestaque/".$_ENV["id_empresa"]."/Venda");

        if($imoveis != false)return json_decode($imoveis, true);
    }

    public function addFavorites($url)
    {
       if(isset($_SESSION['favorites']))
       {
           array_push($_SESSION['favorites'], $url);
       }else
       {
           $favorites = array($url);

           $_SESSION['favorites'] = $favorites;
       }
    }

    public function removeFavorites($url)
    {
       if(isset($_SESSION['favorites']))
       {
            $array_favorites = $_SESSION['favorites'];
            foreach($array_favorites as $key=>$value)
            {
                if($array_favorites[$key] == $url)unset($array_favorites[$key]);
            }

          
          $_SESSION['favorites'] = $array_favorites;

          return count($_SESSION['favorites']);
       }
    }

    public function get($url_imovel)
    {
        $imovel = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/Imoveis/getImovel/".$_ENV["id_empresa"]."/".$url_imovel);

        if($imovel != false)return json_decode($imovel, true);
    }


    public static function getImovelCategorie($categorie)
    {
        $imoveis = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/Imoveis/getImoveisCategories/".$_ENV["id_empresa"]."/".$categorie);

        if($imoveis != false)return json_decode($imoveis, true);
    }

    public static function getImovelGaleria($id_imovel)
    {
        $galeria = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/Imoveis/getGaleria/".$_ENV["id_empresa"]."/".$id_imovel);

        if($galeria != null)return json_decode($galeria, true);
    }

    public function getResultadoBusca($dados)
    {
        $dados = json_encode($dados);
        $dados = base64_encode($dados);
        $imoveis_search = Request::get($_ENV['url_base']."/api/imobiliaria/".$_ENV['key']."/Imoveis/getResultadoBusca/".$_ENV["id_empresa"]."/".$dados);

        if($imoveis_search != false) return json_decode($imoveis_search, true);
    }

    public static function getFavorites()
    {
        if(isset($_SESSION['favorites']))
        {
            $imovel = new Imovel();
            $imoveis_favorites = array();
            foreach($_SESSION['favorites'] as $favorites)
            {
                $imoveis = $imovel->get($favorites);

                array_push($imoveis_favorites, $imoveis);
            }
            return $imoveis_favorites;
        }else
        {
            return [];
        }
    }
}