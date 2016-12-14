<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 08.12.2016
 * Time: 16:39
 */
    include_once("inc/db_pdo.class.php");
    include_once("inc/Prispevky.class.php");
    include_once("inc/hodnoceni.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");

    /**
     * umoznuje adminovi pridat prispevky recenzetovi,
     * recenzenta vybere a odesle mu dany prispevek
     */

    $prispevky = new Prispevky();
    $prispevky->Connect();
    $nacteni_prispevku = $prispevky->LoadAllPrispevky();

    $all_hodnoceni = new hodnoceni();
    $all_hodnoceni->Connect();
    $hodnoceni = $all_hodnoceni->LoadAllHodnoceni();

    $uzivatel = new DBUzivatele();
    $uzivatel->Connect();
    $uzivatele = $uzivatel->LoadAllUzivatele();


    $cont = new control();
    $subpage = @$_REQUEST["subpage"];
    $param = @$_REQUEST["param"];


    if ($nacteni_prispevku != null) {
        foreach ($nacteni_prispevku as $nacteni_prispevku) {
            if ($nacteni_prispevku["nazev"] == $subpage) {
                if ($nacteni_prispevku["autor_id"] == $param) {

                    if(isset($_POST["submit_pridat"])) {

                        $items = array();
                        $items["uzivatel_id_uzivatel"] = $param;
                        $items["clanky_id_clanky"] = $nacteni_prispevku["id_clanky"];
                        if ($uzivatele != null) {
                            foreach ($uzivatele as $uzivatele) {
                                $jmeno = $uzivatele["jmeno"].' '. $uzivatele["prijmeni"];
                                if ($jmeno == strip_tags($_POST["vyber"])) {
                                    $items["id_recenzenta"] = $uzivatele["id_uzivatel"];
                                }
                            }
                        }
                        $pridej = $all_hodnoceni->InsertHodnoceni($items);
                        header('Location: '. $cont->makeUrl("administrace"));
                    }




                    echo "  
                           <h2 class=\"featurette - heading\">Přidání článku recenzentovi</h2>
                           <hr class=\"featurette-divider\">
                           <div class=\"row featurette\">
                            <div class=\"col-md-7\">
                                
                               <h3 class=\"featurette-heading\">$nacteni_prispevku[nazev]</h3>
                               <p class=\"lead\">$nacteni_prispevku[abstrakt]</p>
                               </div>
                            </div>";



                  //  header('Location: ' . $cont->makeUrl("mojeprispevky"));

                }
            }
        }
    }
        echo "<form action=\"\" method=\"POST\"> 
                <div class=\"col-xs-3\">
                <div class=\"form-group\">
            <label for=\"exampleSelect1\">Přidat článek recenzentovi: </label>
             
            <select class=\"form-control\" id=\"vyber\" name=\"vyber\">";

        if ($uzivatele != null) {
            foreach ($uzivatele as $uzivatele) {
                if ($uzivatele["prava"] == 2) {
                    echo " 
                    <option>$uzivatele[jmeno] $uzivatele[prijmeni]</option>";

                }
            }
        }
                echo "</select>
                      </div>

                    <div class=\"form-group\">
                        <!-- Button -->
                       
           
                            <button type=\"submit\" id = \"submit_pridat\" name = \"submit_pridat\" class=\"btn btn-primary pull-left\">Přidat uživateli</button>                          
                        
                    </div>
                    </div>
                    </form>";
