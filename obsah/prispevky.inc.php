<?php
include_once("inc/db_pdo.class.php");
include_once("inc/Prispevky.class.php");
include_once("inc/settings.inc.php");
include_once("inc/functions.inc.php");
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 05.12.2016
 * Time: 22:40
 */
$prispevky = new Prispevky();
$prispevky->Connect();
$nacteni_prispevku = $prispevky->LoadAllPrispevky();
$uzivatel = $_SESSION['uzivatel'];
$cont = new control();
$subpage = @$_REQUEST["subpage"];




    if(isset($_POST["prispevek"])) {
    $newPrispevek = new Prispevky();
    $newPrispevek->Connect();
    $uzivatel = $_SESSION['uzivatel'];
    $items = array();
    $items["nazev"] = $_POST["name"];
    $items["abstrakt"] = $_POST["abstract"];
    $items["autor_id"] = $uzivatel['id_uzivatel'];
        $file = array();
        $file = $_FILES['file1'];

      //  echo '<pre>';
     //  print_r($_FILES);
       // print_r($_POST);
    $nacteni_prispevku = $newPrispevek->LoadAllPrispevky();
    $pLength = strlen($items["nazev"]);


        $bool = true;
        if ($nacteni_prispevku != null) {
            foreach ($nacteni_prispevku as $nacteni_prispevku) {
                if ($nacteni_prispevku["nazev"] == $items["nazev"] && $nacteni_prispevku["autor_id"] == $items["autor_id"]) {

                    if($subpage == $nacteni_prispevku["nazev"]) {

                    }
                    else
                    {
                        echo "<div class=\"alert alert-danger alert-dismissable fade in\">
                      <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                      <strong>Chyba!</strong> Název příspěvku se shoduje s názvem Vámi již vytvořeného příspěvku.
                      </div>";
                        $bool = false;}

                }

            }
        }
        if ($pLength < 2) {

            echo "<div class=\"alert alert-danger alert-dismissable fade in\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                <strong>Chyba!</strong> Název příspěvku musí mít alespoň dva znaky.
                 </div>";
            $bool = false;

        }
        else if ($bool)
        {
            if(isset($subpage)){
                $novy = $newPrispevek->UpdateClanku($items["abstrakt"], $items["autor_id"],$subpage);
                $novy2 = $newPrispevek->UpdatePrispevku($items["nazev"], $items["autor_id"],$subpage);
                $nacteni_prispevku = $newPrispevek->LoadAllPrispevky();
                if ($nacteni_prispevku != null) {
                    foreach ($nacteni_prispevku as $nacteni_prispevku) {
                        if($items["nazev"] == $nacteni_prispevku["nazev"] && $items["autor_id"] == $nacteni_prispevku["autor_id"]){
                            if($_FILES["file1"]["tmp_name"]!=null) {
                                move_uploaded_file($_FILES["file1"]["tmp_name"], "public/pdf/" . $_FILES["file1"]["name"]);
                                rename("public/pdf/" .$_FILES["file1"]["name"], "public/pdf/" .$nacteni_prispevku["id_clanky"].".pdf");
                            }
                        }
                    }
                    }


               // $cont->makeUrl('odstraneni;'.$items["nazev"]);
               // header('Location: '.$cont->makeUrl('odstraneni;'.$nacteni_prispevku["nazev"]));
                header('Location: '.$cont->makeUrl('mojeprispevky'));
                echo "<div class=\"alert alert-success alert-dismissable fade in\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                <strong>Úspěšné dokončení!</strong> Příspěvek byl úspěšně upraven.
                </div>";
            }
            else {


                $novy = $newPrispevek->InsertPrispevku($items);
                if($_FILES["file1"]["tmp_name"]!=null) {
                    move_uploaded_file($_FILES["file1"]["tmp_name"], "public/pdf/" . $_FILES["file1"]["name"]);
                    rename("public/pdf/" .$_FILES["file1"]["name"], "public/pdf/" .$novy.".pdf");
                }
                echo "<div class=\"alert alert-success alert-dismissable fade in\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                <strong>Úspěšné dokončení!</strong> Příspěvek byl úspěšně vytvořen.
                </div>";
            }

        }


}
        if(isset($subpage)){
            echo "<div class=\"container\">
            <h3>Úprava příspěvku</h3>
          <form method='post'  enctype=\"multipart/form-data\">
           <div class=\"form-group\">
            <label for=\"exampleInputEmail1\">Název příspěvku **</label>
            <input type=\"text\" class=\"form-control\" id=\"exampleInputText\" name='name'  value=\"$subpage\"placeholder=\"Název\" required>
          </div>
          <div class=\"form-group\">
            <label for=\"exampleTextarea\">Upravení příspěvku **</label>";
        $subpage = @$_REQUEST["subpage"];
    $updatePrispevek = new Prispevky();
    $updatePrispevek->Connect();
    $uzivatel = $_SESSION['uzivatel'];
    $aktualizovany = $updatePrispevek->LoadAllPrispevky();
            if ($aktualizovany != null) {
                foreach ($aktualizovany as $aktualizovany) {
                    if ($aktualizovany["nazev"] == $subpage) {
                        if ($aktualizovany["autor_id"] == $uzivatel['id_uzivatel']) {
                            echo "<textarea class=\"form-control\" id=\"exampleTextarea\" rows=\"3\"  name='abstract' required>$aktualizovany[abstrakt]</textarea>";
                        }
                    }
                }
            }

          echo "</div>
          <div class=\"form-group\">
            <label for=\"exampleInputFile\">Přiložit soubor</label>
            <input type=\"file\" name='file1' class=\"form-control-file\" id=\"exampleInputFile\" aria-describedby=\"fileHelp\"  >
            <small id=\"fileHelp\" class=\"form-text text-muted\">Zde můžete přidat pdf soubor</small>
          </div>
          <div>
               <p style='color: red'>Textová pole označená ** jsou povinná</p>
          </div>
          <button type=\"submit\" name = \"prispevek\" class=\"btn btn-primary\">Upravit</button>
        </form>
        </div>";

    }
    else{
        echo "<div class=\"container\">
        <h3>Vytvoření příspěvku</h3>
        <form method='post'  enctype=\"multipart/form-data\">
        <div class=\"form-group\">
        <label for=\"exampleInputEmail1\">Název příspěvku **</label>
        <input type=\"text\" class=\"form-control\" id=\"exampleInputText\" name='name'  placeholder=\"Název\" required>
      </div>
      <div class=\"form-group\">
        <label for=\"exampleTextarea\">Nový příspěvek **</label>
        <textarea class=\"form-control\" id=\"exampleTextarea\" rows=\"3\" name='abstract' required></textarea>
      </div>
      <div class=\"form-group\">
        <label for=\"exampleInputFile\">Přiložit soubor</label>
        <input type=\"file\" class=\"form-control-file\" name='file1' id=\"exampleInputFile\" aria-describedby=\"fileHelp\">
        <small id=\"fileHelp\" class=\"form-text text-muted\">Zde můžete přidat pdf soubor</small>
      </div>
      <div>
           <p style='color: red'>Textová pole označená ** jsou povinná</p>
      </div>
      <button type=\"submit\" name = \"prispevek\" class=\"btn btn-primary\">Vytvořit</button>
    </form>
    </div>";
}

