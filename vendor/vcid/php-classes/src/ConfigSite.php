<?php

namespace vcinsidedigital;


use vcinsidedigital\Config;
use vcinsidedigital\Page;

class ConfigSite
{
	public static function getConfigSite()
	{

		$config =$_ENV['online'];

		if($config == "false")
		{
			$pagina = new Page([
				'header'=>false,
				'footer'=>false
			]);
			$pagina->setTemplate('erro');
			exit;
		}
	}
	
}	