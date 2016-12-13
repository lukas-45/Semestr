<?php
session_start();
include_once("Controller/control.class.php");
include_once("obsah/menu.inc.php");
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
/*function makeUrl($page) {
    $parts = explode(';',$page);
    $subpage = isset($parts[1])? '&subpage=' . $parts[1] : '';
    $param = isset($parts[2])? '&param=' . $parts[2] : '';

    return 'index.php?page=' . $parts[0] . $subpage . $param;
}
*///print_r(parse_url(getPage()));

// prihlaseni uzivatele

function phpWrapperFromFile($filename)
{
    ob_start();

    if (file_exists($filename) && !is_dir($filename))
    {
        include($filename);
    }

    // nacte to z outputu
    $obsah = ob_get_clean();
    return $obsah;
}
$page = @$_REQUEST["page"];
$subpage = @$_REQUEST["subpage"];
//default je uvod
if ($page == ""){
    $page = "uvod";
}




//echo "page je: $page ";

    // volba obsahu pro stranku
    if ($page == "uvod")
        $filename = "obsah/uvod.inc.php";
    else if ($page == "kontakt")
        $filename = "obsah/kontakt.inc.php";
    else if ($page == "registrace")
        $filename = "obsah/registrace.inc.php";
    else if ($page == "prihlaseni")
        $filename = "obsah/prihlaseni.inc.php";
    else if($page == "odhlaseni")
            $filename = "obsah/odhlaseni.php";
    else if($page == "uzivatel")
             $filename = "obsah/uzivatel.inc.php";
    else if($page == "administrace")
        $filename = "obsah/administrace.inc.php";
    else if($page == "recenze")
        $filename = "obsah/recenze.inc.php";
    else if($page == "prispevky")
        $filename = "obsah/prispevky.inc.php";
    else if($page == "pridat")
        $filename = "obsah/pridani_k_recenzi.inc.php";
    else if($page == "mojeprispevky")
        $filename = "obsah/moje_prispevky.inc.php";
    else if ($page == "odstraneni")
        $filename = "obsah/odstraneni_prispevku.inc.php";
    else if ($page == "odstraneni_admin")
        $filename = "obsah/odstraneni_admin.inc.php";
    else if ($page == "schvalit")
        $filename = "obsah/schvaleni.inc.php";
    else if ($page == "hodnotit")
        $filename = "obsah/hodnotit.inc.php";
    else if ($page == "pdf")
        $filename = "obsah/otevritPDF.php";
    else if ($page == "401")
        $filename = "obsah/401.inc.php";
    else
        $filename = "obsah/404.inc.php";

    // $obsah = file_get_contents($filename);
    $obsah = phpWrapperFromFile($filename);
    //echo $obsah;

    // seznam vsech moznych stranek
    $pages = array();
    $pages["uvod"] = "Uvod";
    $pages["kontakt"] = "Kontakt";
    $pages["registrace"] = "Registrace";
    $pages["prihlaseni"] = "Prihlaseni";
    $pages["nadpis"] = $page;



// Twig stahnout z githubu - klidne staci zip a dat do slozky twig-master
// kontrolu provedete dle umisteni souboru Autoloader.php, ktery prikladam pro kontrolu
$cont = new control();
/*// nacist twig - kopie z dokumentace
require_once ROOT . 'twig-master/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
// cesta k adresari se sablonama - od index.php
$loader = new Twig_Loader_Filesystem(ROOT . 'sablony');
$twig = new Twig_Environment($loader); // takhle je to bez cache
$makeUrl = new Twig_SimpleFunction('makeUrl', 'makeUrl');
$twig->addFunction($makeUrl);
$template = $twig->loadTemplate('sablona1.twig');
// nacist danou sablonu z adresare
//$template = $twig->loadTemplate('sablona1.twig');
*/






$cont->Twig($menu, $obsah, $page);


/*
// render vrati data pro vypis nebo display je vypise
// v poli jsou data pro vlozeni do sablony
$template_params = array();
$template_params["menu"] = $menu;
$template_params["obsah"] = $obsah;
$template_params["nadpis"] = $page;
echo $template->render($template_params);
*/

/*if(getPage() == ''){
    echo $twig->render('uvod.twig',['menu' => $template_params]);
}
else if(getPage() == 'uvod'){
    echo $twig->render('uvod.twig',['menu' => $template_params]);
}
else if(getPage() == 'konference'){
    echo $twig->render('konference.twig',['menu' => $template_params]);
}
else if(getPage() == 'registrace') {
    echo $twig->render('registrace.twig',['menu' => $template_params]);
}
else {
    echo $twig->render('404.twig',['menu' => $template_params]);
}
*/


