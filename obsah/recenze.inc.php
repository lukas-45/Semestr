<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 05.12.2016
 * Time: 22:40
 */

    /**
     * stranka, kterou vidi pouze recenzenti
     * v tabulce vidi prispevky, ktere maji ohodnotit
     * v poslednim sloupecku maji uvedeno zda jiz ohodnotili prispevek
     */
    include_once("inc/db_pdo.class.php");
    include_once("inc/Prispevky.class.php");
    include_once("inc/hodnoceni.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");

    $hodnoceni = new hodnoceni();
    $hodnoceni->Connect();
    $prispevky = new Prispevky();
    $prispevky->Connect();
    $nacteni_recenze = $hodnoceni->LoadAllHodnoceni();
    $cont = new control();


    $uzivatel = $_SESSION['uzivatel'];
    echo "<div class=\"container\">
          <h2>Seznam příspěvků k hodnocení</h2>  
          <table class=\"table table-hover\">
            <thead>
              <tr>
                <th>Název</th>
                <th>hodnotit</th>
                <th>hodnoceno</th>
              </tr>
            </thead>
            <tbody>";
    if ($nacteni_recenze != null) {
        foreach ($nacteni_recenze as $nacteni_recenze) {
            if ($uzivatel["id_uzivatel"] == $nacteni_recenze["id_recenzenta"]) {
                $nacteni_prispevku = $prispevky->LoadAllPrispevky();
                    foreach ($nacteni_prispevku as $nacteni_prispevku) {
                        if ($nacteni_prispevku["id_clanky"] == $nacteni_recenze["clanky_id_clanky"]) {
                            echo "  <tr>
                            <td>$nacteni_prispevku[nazev]</td> 
                            <td><a href=  \"" . $cont->makeUrl('hodnotit;' . $nacteni_prispevku["nazev"] . ';' . $nacteni_prispevku["autor_id"]). "\"  style='color: green'  ><span class=\"glyphicon glyphicon-share-alt\"></span> přidat hodnocení </a></td>
                            <td>$nacteni_recenze[hodnoceno]</td> 
                            </tr>";
                         }
                        }
                }
            }
        }


        echo " </tbody>
          </table>
        </div>";


