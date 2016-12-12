<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 05.12.2016
 * Time: 22:40
 */

    include_once("inc/db_pdo.class.php");
    include_once("inc/Prispevky.class.php");
    include_once("inc/hodnoceni.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");

    $cont = new control();

    $count = 0;
    $uzivatele = new DBUzivatele();
    $uzivatele->Connect();
    $autori = $uzivatele->LoadAutoriUzivatele();
    $uzivatel = $_SESSION['uzivatel'];
    $recenzenti = $uzivatele->LoadRecenzentiUzivatele();


    if ($autori != null) {
        foreach ($autori as $autori) {
            $prispevky = new Prispevky();
            $prispevky->Connect();
            $nacteni_prispevku = $prispevky->LoadAllPrispevky();
            echo "<div class=\"container\">
          <h2>Seznam příspěvků autora: $autori[jmeno] $autori[prijmeni]</h2>  
          <table class=\"table table-hover\">
            <thead>
              <tr>
                <th>Název</th>
                <th>Autor</th>
                <th>Přiřadit</th>
                <th>Schváleno</th>
                <th>Hodnocení</th>
                <th>Vymazat</th>
              </tr>
            </thead>
            <tbody>";
            if ($nacteni_prispevku != null) {
                foreach ($nacteni_prispevku as $nacteni_prispevku) {
                    if ($autori["id_uzivatel"] == $nacteni_prispevku["autor_id"]) {
                        echo "  <tr>
                            <td>$nacteni_prispevku[nazev]</td>
                            <td>$autori[jmeno] $autori[prijmeni]</td>    
                            <td><a href=  \"" . $cont->makeUrl('pridat;' . $nacteni_prispevku["nazev"] . ';' . $autori["id_uzivatel"]) . "\"  style='color: green'  ><span class=\"glyphicon glyphicon-share-alt\"></span> přidat uživateli </a></td>
                            <td><a href=  \"" . $cont->makeUrl('schvalit;' . $nacteni_prispevku["nazev"] . ';' . $autori["id_uzivatel"]) . "\"   ><span class=\"glyphicon glyphicon-ok\"></span> $nacteni_prispevku[schvaleno] </a></td>";
                        $prumer = 0;
                        $count = 0;
                        $hodnoceni = new hodnoceni();
                        $hodnoceni->Connect();
                        $nacteni_hodnoceni = $hodnoceni->LoadAllHodnoceni();
                        if ($nacteni_hodnoceni != null) {
                            foreach ($nacteni_hodnoceni as $nacteni_hodnoceni) {
                                if(($nacteni_prispevku["id_clanky"] == $nacteni_hodnoceni["clanky_id_clanky"])){
                                    if($nacteni_hodnoceni["body1"] != null){
                                        $count++;
                                        $prumer = $prumer + (($nacteni_hodnoceni["body1"]+$nacteni_hodnoceni["body2"]+$nacteni_hodnoceni["body3"])/3);


                                    }

                                }
                            }
                        }
                        if($count > 2) {
                            $prumer = round($prumer/$count,2);
                            echo " <td>$prumer</td>";
                        }
                        else{

                            echo " <td>Nehodnoceno</td>";
                        }
                        echo  "<td><a data-confirm=\"Are you sure?\" data-method=\"delete\" href= \"" . $cont->makeUrl('odstraneni_admin;' . $nacteni_prispevku["nazev"] . ';' . $autori["id_uzivatel"]) . "\"   rel=\"nofollow\" style='color: red'  ><span class=\"glyphicon glyphicon-remove-sign\"></span> smazat</a></td>
                            </tr>";



                    }
                }


                echo " </tbody>
          </table>
        </div>";
            }
        }
    }


if ($recenzenti != null) {
    foreach ($recenzenti as $recenzenti) {
        $prispevky = new Prispevky();
        $prispevky->Connect();
        $nacteni_prispevku = $prispevky->LoadAllPrispevky();

        echo "<div class=\"container\">
          <h2>Seznam hodnocení od recenzenta: $recenzenti[jmeno] $recenzenti[prijmeni]</h2>  
          <table class=\"table table-hover\">
            <thead>
              <tr>
                <th>Název</th>
                <th>Autor</th>
                <th>Originalita</th>
                <th>Téma</th>
                <th>Kvalita</th>
                <th>Průměrná známka</th>
              </tr>
            </thead>
            <tbody>";
        if ($nacteni_prispevku != null) {
            foreach ($nacteni_prispevku as $nacteni_prispevku) {
                $hodnoceni = new hodnoceni();
                $hodnoceni->Connect();
                $nacteni_hodnoceni = $hodnoceni->LoadAllHodnoceni();
                if ($nacteni_hodnoceni != null) {
                    foreach ($nacteni_hodnoceni as $nacteni_hodnoceni) {
                        if(($recenzenti["id_uzivatel"] == $nacteni_hodnoceni["id_recenzenta"]) && ($nacteni_prispevku["id_clanky"] == $nacteni_hodnoceni["clanky_id_clanky"])){

                            if($nacteni_hodnoceni["body1"] != null){
                                $prumer = round(($nacteni_hodnoceni["body1"]+$nacteni_hodnoceni["body2"]+$nacteni_hodnoceni["body3"])/3,2);
                                echo "  <tr>
                                <td>$nacteni_prispevku[nazev]</td>
                                <td>$autori[jmeno] $autori[prijmeni]</td>    
                                <td>$nacteni_hodnoceni[body1]</td>
                                <td>$nacteni_hodnoceni[body2]</td>
                                <td>$nacteni_hodnoceni[body3]</td>
                                <td><strong>$prumer</strong></td>
                                </tr>";
                            }

                        }
                    }
                }
            }






       echo " </tbody>
          </table>
        </div>";
}
        }
    }






