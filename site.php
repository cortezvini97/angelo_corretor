<?php

use vcinsidedigital\Config;
use vcinsidedigital\ConfigSite;
use vcinsidedigital\Model\Bairros;
use vcinsidedigital\Model\Cidades;
use vcinsidedigital\Model\Contato;
use vcinsidedigital\Model\Estados;
use vcinsidedigital\Model\Imovel;
use vcinsidedigital\Model\TipoImovel;
use vcinsidedigital\Page;

$app->get('/', function()
{
    ConfigSite::getConfigSite();

    $estados = Estados::listAll();
    $tipo_imoveis = TipoImovel::listAll();

    $imoveis_destaque = Imovel::listAll();

    $page = new Page();
    $page->setTemplate("index", [
        "estados"=>$estados,
        "tipoimoveis"=>$tipo_imoveis,
        "imoveis_destaque"=>$imoveis_destaque,
		"count_destaques"=>count($imoveis_destaque),
        "count_favorites"=>(isset($_SESSION['favorites'])) ? count($_SESSION['favorites']) : 0
    ]);
});


$app->get('/empreendimento', function()
{
    ConfigSite::getConfigSite();
    $imoveis_emprendimentos = Imovel::getImovelCategorie("empreendimentos");

    $estados = Estados::listAll();
    $tipo_imoveis = TipoImovel::listAll();

    $page = new Page();
    $page->setTemplate("empreendimento",[
        "estados"=>$estados,
        "tipoimoveis"=>$tipo_imoveis,
        "imoveis_emprendimentos"=>$imoveis_emprendimentos,
        "count_imoveis"=>count($imoveis_emprendimentos),
        "count_favorites"=>(isset($_SESSION['favorites'])) ? count($_SESSION['favorites']) : 0
    ]);
});


$app->get('/loteamento', function()
{
    ConfigSite::getConfigSite();
    $loteamentos = Imovel::getImovelCategorie("loteamentos");

    $estados = Estados::listAll();
    $tipo_imoveis = TipoImovel::listAll();

    $page = new Page();
    $page->setTemplate("loteamento",[
        "estados"=>$estados,
        "tipoimoveis"=>$tipo_imoveis,
        "loteamentos"=>$loteamentos,
        "count_imoveis"=>count($loteamentos),
        "count_favorites"=>(isset($_SESSION['favorites'])) ? count($_SESSION['favorites']) : 0
    ]);
});


$app->get('/imoveis', function()
{
    ConfigSite::getConfigSite();
    $imoveis = Imovel::getImovelCategorie("imóveis");
    
    $estados = Estados::listAll();
    $tipo_imoveis = TipoImovel::listAll();

    $page = new Page();
    $page->setTemplate("imoveis",[
        "estados"=>$estados,
        "tipoimoveis"=>$tipo_imoveis,
        "imoveis"=>$imoveis,
        "count_imoveis"=>count($imoveis),
        "count_favorites"=>(isset($_SESSION['favorites'])) ? count($_SESSION['favorites']) : 0
    ]);
});


$app->get('/imoveisfavorites', function()
{
    ConfigSite::getConfigSite();
    $favoritos = Imovel::getFavorites();
    
    $estados = Estados::listAll();
    $tipo_imoveis = TipoImovel::listAll();

    $page = new Page();
    $page->setTemplate("favorites", [
        "estados"=>$estados,
        "tipoimoveis"=>$tipo_imoveis,
        "favoritos"=>$favoritos,
        "count_favorites"=>(isset($_SESSION['favorites'])) ? count($_SESSION['favorites']) : 0
    ]);
});

$app->get('/imovel/:url', function($url)
{
    ConfigSite::getConfigSite();
    $imoveis = new Imovel();
    $imovel = $imoveis->get($url);

    $estados = Estados::listAll();
    $tipo_imoveis = TipoImovel::listAll();

    $galeria = Imovel::getImovelGaleria($imovel['id']);

    $bairros = new Bairros();
    $bairro = $bairros->getBairroPorNome($imovel['Bairro']);

    $page = new Page();
    $page->setTemplate("imovel", [
        "estados"=>$estados,
        "imovel"=>$imovel,
        "bairro"=>$bairro,
        "galeria"=>$galeria,
        "tipoimoveis"=>$tipo_imoveis,
        "count_favorites"=>(isset($_SESSION['favorites'])) ? count($_SESSION['favorites']) : 0
    ]);

});


$app->post("/addFavorites", function()
{
    ConfigSite::getConfigSite();
    $url = $_POST['url'];
    
    $imoveis = new Imovel();
    $imoveis->addFavorites($url);

    die(json_encode(["count"=>count($_SESSION['favorites'])]));
});

$app->post("/removeFavorites", function()
{
    ConfigSite::getConfigSite();
    $url = $_POST['url'];

    $imoveis = new Imovel();
    $favorites = $imoveis->removeFavorites($url);


    die(json_encode(["count"=>$favorites]));
});


$app->get('/resultadoBusca', function()
{
    ConfigSite::getConfigSite();

    $imoveis = new Imovel();
	$get_resultado = $imoveis->getResultadoBusca($_GET);

    $estados = Estados::listAll();
    $tipo_imoveis = TipoImovel::listAll();


    $page = new Page();
    $page->setTemplate('resultado_busca',[
        "estados"=>$estados,
        "imoveis_busca"=>$get_resultado,
        "tipoimoveis"=>$tipo_imoveis,
        "count_imoveis"=>count($get_resultado),
        "count_favorites"=>(isset($_SESSION['favorites'])) ? count($_SESSION['favorites']) : 0
    ]);

});

$app->get('/contato', function()
{
    $page = new Page();
    $page->setTemplate("contato",[
        "count_favorites"=>(isset($_SESSION['favorites'])) ? count($_SESSION['favorites']) : 0
    ]);
});


$app->post('/contato', function()
{
    $contato = new Contato();
    $contato->setData($_POST);
	$contato->sendMailMsg();
    $contato->sendWhatsappMsg();
});


$app->post('/getCidade', function()
{
    
    ConfigSite::getConfigSite();
    $cidades = Cidades::listAll($_POST['estado']);

    die(json_encode($cidades));
});

$app->post('/getBairros', function()
{
    ConfigSite::getConfigSite();
    $bairros = Bairros::listAll($_POST['cidade']);
    die(json_encode($bairros));
});


$app->get('/redirect', function()
{
    if(isset($_SESSION['url']))
    {
        $page = new Page([
            "header"=>false,
            "footer"=>false
        ]);
        $page->setTemplate("redirect", [
            "redirect"=>$_SESSION['url']
        ]);
    }else
    {
        header("Location: /");
        exit;
    }
});

$app->get('/sessiondestroy', function()
{
    unset($_SESSION['url']);
    die(json_encode(["destroi"=>true]));
});