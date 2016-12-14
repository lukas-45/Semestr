<?php
session_start();
include_once("Controller/control.class.php");
include_once("obsah/menu.inc.php");
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);

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


    $cont->Twig($menu, $obsah, $page);




