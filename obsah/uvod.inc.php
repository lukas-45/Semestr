<?php

    include_once("inc/db_pdo.class.php");
    include_once("inc/Prispevky.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");

    $prispevky = new Prispevky();
    $prispevky->Connect();
    $nacteni_prispevku = $prispevky->LoadAllPrispevky();
    $count = 0;
    $cont = new control();


if ($nacteni_prispevku != null) {
    foreach ($nacteni_prispevku as $nacteni_prispevku) {
        if ($nacteni_prispevku["schvaleno"] == "ANO") {
            echo " <hr class=\"featurette-divider\">

            <div class=\"row featurette\">";
            if($count % 2 == 0){
               echo "<div class=\"col-md-7\">";
            }
            else {
                echo"<div class=\"col-md-7 col-md-push-5\">";
            }


                echo  "<h2 class=\"featurette-heading\">$nacteni_prispevku[nazev] </h2>
                    <p class=\"lead\">$nacteni_prispevku[abstrakt]</p>";
            $file = 'public/pdf/'.$nacteni_prispevku["id_clanky"].".pdf";
            if(file_exists($file)) {
                echo "<a href=\"". $cont->makeUrl('pdf;'.$nacteni_prispevku["id_clanky"])."\">Priloha_$nacteni_prispevku[id_clanky].pdf</a>";

            }

              echo "</div>";
            if($count % 2 == 0){
                echo "<div class=\"col-md-5\">";
            }
            else {
                echo "<div class=\"col-md-5 col-md-pull-7\">";
            }

                echo" <img class=\"featurette-image img-responsive center-block\" src=\"public/picture/user1.png\" width=\"170\" height=\"170\">
                </div>
            </div>";
            $count++;

        }
        }
    }

echo"   <hr class=\"featurette-divider\">";