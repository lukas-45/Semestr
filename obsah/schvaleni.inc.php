<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 09.12.2016
 * Time: 20:54
 */
    include_once("inc/db_pdo.class.php");
    include_once("inc/Prispevky.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");


    $prispevky = new Prispevky();
    $prispevky->Connect();

    $cont = new control();
    $subpage = @$_REQUEST["subpage"];

    $param = @$_REQUEST["param"];
    $schvalit = $prispevky->UpdateSchvaleno($param, $subpage);
    header('Location: ' . $cont->makeUrl('administrace'));
