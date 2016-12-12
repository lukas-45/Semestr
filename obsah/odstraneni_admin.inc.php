<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 07.12.2016
 * Time: 12:52
 */
    include_once("inc/db_pdo.class.php");
    include_once("inc/Prispevky.class.php");
    include_once("inc/hodnoceni.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");


    $prispevky = new Prispevky();
    $prispevky->Connect();
    $nacteni_prispevku = $prispevky->LoadAllPrispevky();
    $uzivatel = $_SESSION['uzivatel'];

    $recenze = new hodnoceni();
    $recenze->Connect();
    $recenze_all = $recenze->LoadAllHodnoceni();


//echo "parametr: $param";
    $cont = new control();
    $subpage = @$_REQUEST["subpage"];
    if ($nacteni_prispevku != null) {

        foreach ($nacteni_prispevku as $nacteni_prispevku) {
            if ($nacteni_prispevku["nazev"] == $subpage) {
                $param = @$_REQUEST["param"];
                if ($nacteni_prispevku["autor_id"] == $param) {
                    if ($recenze_all != null) {
                        foreach ($recenze_all as $recenze_all) {
                            if ($recenze_all["clanky_id_clanky"] == $nacteni_prispevku["id_clanky"]) {
                                $array[] = array("column" => "clanky_id_clanky", "value" => $nacteni_prispevku["id_clanky"], "symbol" => "=");

                                $smazani = $recenze->DeleteHodnoceni($array);

                            }
                        }
                    }
                    $arr[] = array("column" => "id_clanky", "value" => $nacteni_prispevku["id_clanky"], "symbol" => "=");
                    $smazat = $prispevky->DeletePrispevku($arr);
                    header('Location: ' . $cont->makeUrl("administrace"));

                }
            }
        }
    }