<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 02.12.2016
 * Time: 14:01
 */

    /**
     * menu
     */
    include_once("inc/db_pdo.class.php");
    include_once("inc/DBUzivatele.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");
    include_once("Controller/control_login.class.php");

    $cont = new control();
    $cont_login = new control_login();

        $page = @$_REQUEST["page"];
        $cont_login->getSign();
        //zjisti opravneni prihlaseneho uzivatele
        if(isset($_SESSION['uzivatel'])) {

            $jmeno = $_SESSION['uzivatel'];
            if($jmeno['prava'] == 3)
            {
                $prava = "admin";
            }
            else if($jmeno['prava'] == 2)
            {
                $prava = "recenzent";
            }
            else if($jmeno['prava'] == 1)
            {
                $prava = "autor";
            }
            else
            {
                $prava = "";
            }
            //vypise menu a zjisti zda na zadane url ma uzivatel pravo
            $menu = "<nav class=\"navbar navbar-inverse\">
        <div class=\"container-fluid\">
            
        
            
            <div class=\"navbar-header\">
                <a class=\"navbar-brand\" href=\"". $cont->makeUrl('uvod')."\">Konference</a>
            </div>
            <ul class=\"nav navbar-nav\">
                <li class = \"blog-nav-item\"><a href=\"". $cont->makeUrl('uvod')."\">Úvod</a></li>
                <li class = \"blog-nav-item\"><a href=\"". $cont->makeUrl('kontakt')."\">Kontakt</a></li>";
                if($jmeno['prava'] == 3){
                    if(($page == 'recenze') || ($page == 'mojeprispevky') || ($page == 'prispevky') || ($page == 'prihlaseni') || ($page == 'registrace')) {
                        header('Location: '.$cont->makeUrl("401"));
                    }
                  $menu .= "<li class = \"blog-nav-item\"><a href=\"". $cont->makeUrl('administrace')."\">Administrace</a></li>";
                }
                else if($jmeno['prava'] == 2){
                    if(($page == 'administrace') || ($page == 'mojeprispevky') || ($page == 'prispevky') || ($page == 'registrace') || ($page == 'prihlaseni')) {
                        header('Location: '.$cont->makeUrl("401"));
                    }
                    $menu .= "<li class = \"blog-nav-item\"><a href=\"". $cont->makeUrl('recenze')."\">Recenze</a></li>";

                }
                else if($jmeno['prava'] == 1){
                    if(($page == 'administrace') || ($page == 'recenze') || ($page == 'prihlaseni') || ($page == 'registrace')) {
                        header('Location: '.$cont->makeUrl("401"));
                    }
                    $menu .= "<li class = \"blog-nav-item\"><a href=\"". $cont->makeUrl('mojeprispevky')."\">Moje příspěvky</a></li>";
                    $menu .= "<li class = \"blog-nav-item\"><a href=\"". $cont->makeUrl('prispevky')."\">Vytvoření příspěvku</a></li>";

                }
                    $menu .= "</ul>";
                    $menu .= " <ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"". $cont->makeUrl('uzivatel')."\"><span class=\"glyphicon glyphicon-user\"></span> $jmeno[jmeno] $jmeno[prijmeni] ($prava) </a></li>
                    <li id = \"mySign\"><a href=\"". $cont->makeUrl('odhlaseni')."\"><span class=\" glyphicon glyphicon-off\"></span> Odhlásit</a></li>
    
            </ul>";
        }


            else{

                if(($page!='uvod') && ($page!='konference') && ($page!='registrace') && ($page!='prihlaseni')) {
                    if(($page == 'administrace') || ($page == 'recenze') || ($page == 'mojeprispevky') || ($page == 'prispevky')) {
                        header('Location: '.$cont->makeUrl("401"));
                    }

                }
                $menu = "<nav class=\"navbar navbar-inverse\">
                         <div class=\"container-fluid\">
            
        
            
            <div class=\"navbar-header\">
                <a class=\"navbar-brand\" href=\"". $cont->makeUrl('uvod')."\">Konference</a>
            </div>
            <ul class=\"nav navbar-nav\">
                <li class = \"blog-nav-item\"><a href=\"". $cont->makeUrl('uvod')."\">Úvod</a></li>
                <li class = \"blog-nav-item\"><a href=\"". $cont->makeUrl('kontakt')."\">Kontakt</a></li>
                </ul>";
                $menu .= " <ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"". $cont->makeUrl('registrace')."\"><span class=\"glyphicon glyphicon-user\"></span> Registrace </a></li>
                <li id = \"mySign\"><a href=\"". $cont->makeUrl('prihlaseni')."\"><span class=\"glyphicon glyphicon-log-in\"></span> Přihlášení</a></li>
    
            </ul>";
        }
        $menu .="</div>
    </nav>";


