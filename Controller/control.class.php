<?php

/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 01.12.2016
 * Time: 23:30
 */
global $subpage;
global $items;
class control
{
    protected $twig = null;

    public function Twig($menu, $obsah, $page)
    {
        // Twig stahnout z githubu - klidne staci zip a dat do slozky twig-master
// kontrolu provedete dle umisteni souboru Autoloader.php, ktery prikladam pro kontrolu

// nacist twig - kopie z dokumentace
        require_once ROOT . 'twig-master/lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
// cesta k adresari se sablonama - od index.php
        $loader = new Twig_Loader_Filesystem(ROOT . 'sablony');
        $this->twig = new Twig_Environment($loader);
        $this->twig->addGlobal('prihlasen', '$prihlasen');
        $makeUrl = new Twig_SimpleFunction('makeUrl', [$this, 'makeUrl']);
        $this->twig->addFunction($makeUrl);
        $template = $this->twig->loadTemplate('sablona1.twig');

// nacist danou sablonu z adresare
//$template = $twig->loadTemplate('sablona1.twig');

// render vrati data pro vypis nebo display je vypise
// v poli jsou data pro vlozeni do sablony
        $template_params = array();
        $template_params["menu"] = $menu;
        $template_params["obsah"] = $obsah;
        $template_params["nadpis"] = $page;
        echo $template->render($template_params);
    }


    public function makeUrl($page)
    {
        $parts = explode(';', $page);
        $subpage = isset($parts[1]) ? '&subpage=' . $parts[1] : '';
        $param = isset($parts[2]) ? '&param=' . $parts[2] : '';

        return 'index.php?page=' . $parts[0] . $subpage . $param;
    }


}