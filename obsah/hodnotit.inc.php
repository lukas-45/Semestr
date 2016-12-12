<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 09.12.2016
 * Time: 22:42
 */
    include_once("inc/db_pdo.class.php");
    include_once("inc/Prispevky.class.php");
    include_once("inc/hodnoceni.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");



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
    $recenzent = $_SESSION['uzivatel'];

    if ($nacteni_prispevku != null) {
        foreach ($nacteni_prispevku as $nacteni_prispevku) {
            if ($nacteni_prispevku["nazev"] == $subpage) {
                if ($nacteni_prispevku["autor_id"] == $param) {

                    if(isset($_POST["submit_hodnot"])) {

                        $items = array();
                        $items["body1"] = strip_tags($_POST["vyberO"]);
                        $items["body2"] = strip_tags($_POST["vyberT"]);
                        $items["body3"] = strip_tags($_POST["vyberK"]);
                        if($hodnoceni != null) {
                            foreach ($hodnoceni as $hodnoceni) {
                                if($hodnoceni["id_recenzenta"] == $recenzent["id_uzivatel"]){
                                    $pridej_hodnoceni = $all_hodnoceni->UpdateHodnoceni($nacteni_prispevku["autor_id"], $nacteni_prispevku["id_clanky"], $items["body1"], $items["body2"], $items["body3"], $hodnoceni["id_recenzenta"]);
                                    header('Location: '. $cont->makeUrl("recenze"));
                                }


                            }
                        }

                }




                echo "  
                           <h2 class=\"featurette - heading\">Přidání hodnocení k článku</h2>
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
            <label for=\"exampleSelect1\">Originalita: </label>
             
            <select class=\"form-control\" id=\"vyberO\" name=\"vyberO\">";

            for($i = 1; $i < 6; $i++) {
                echo " <option>$i</option>";
            }
            echo "</select>
            
                                  </div>";
            echo "<div class=\"form-group\">
            <label for=\"exampleSelect2\">Téma: </label>
             
            <select class=\"form-control\" id=\"vyberT\" name=\"vyberT\">";

            for($i = 1; $i < 6; $i++) {
                echo " <option>$i</option>";
            }
            echo "</select>
            
                                  </div>";
              echo "<div class=\"form-group\">
                        <label for=\"exampleSelect3\">Kvalita: </label>
                         
                        <select class=\"form-control\" id=\"vyberK\" name=\"vyberK\">";

            for($i = 1; $i < 6; $i++) {
                echo " <option>$i</option>";
            }
            echo "</select>

                      </div>";

              echo "  <div class=\"form-group\">
                        <!-- Button -->
                       
           
                            <button type=\"submit\" id = \"submit_hodnot\" name = \"submit_hodnot\" class=\"btn btn-primary pull-left\">Hodnotit</button>                          
                        
                    </div>
                    </div>
                    </form>";


