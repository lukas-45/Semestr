<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 05.12.2016
 * Time: 23:19
 */
include_once("inc/db_pdo.class.php");
include_once("inc/Prispevky.class.php");
include_once("inc/settings.inc.php");
include_once("inc/functions.inc.php");

$cont = new control();

$prispevky = new Prispevky();
$prispevky->Connect();
$nacteni_prispevku = $prispevky->LoadAllPrispevky();
$uzivatel = $_SESSION['uzivatel'];


$update = "update";


echo "<div class=\"container\">
  <h2>Seznam příspěvků autora: $uzivatel[jmeno] $uzivatel[prijmeni]</h2>  
  <table class=\"table table-hover\">
    <thead>
      <tr>
        <th>Název</th>
        <th>Autor</th>
        <th>Upravit</th>
        <th>Vymazat</th>
      </tr>
    </thead>
    <tbody>";
    if ($nacteni_prispevku != null) {
    foreach ($nacteni_prispevku as $nacteni_prispevku) {
        if ($uzivatel["id_uzivatel"]  == $nacteni_prispevku["autor_id"]) {
            echo "  <tr>
                    <td>$nacteni_prispevku[nazev]</td>
                    <td>$uzivatel[jmeno] $uzivatel[prijmeni]</td>
                    <td><a href= \"". $cont->makeUrl('prispevky;'.$nacteni_prispevku["nazev"])."\"  style='color: green'  ><span class=\"glyphicon glyphicon-pencil\"></span> upravit</a></td>
                    <td><a data-confirm=\"Are you sure?\" data-method=\"delete\" href= \"". $cont->makeUrl('odstraneni;'.$nacteni_prispevku["nazev"])."\"   rel=\"nofollow\" style='color: red'  ><span class=\"glyphicon glyphicon-remove-sign\"></span> smazat</a></td>
                    </tr>";
            }

        }
}
     

   echo" </tbody>
  </table>
</div>";