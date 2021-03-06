<?php
    // nacteni souboru
    include_once("inc/db_pdo.class.php");
    include_once("inc/DBUzivatele.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");

    /**
     * stranka s formularem pro registrace
     * umoznuje uzivateli se zaregistrovat
     * kotroluje zda uzivatelske jmeno uz neexistuje
     * nebo zda neexistuje email
     * a kotroluje shodnost obou hesel
     */
if(isset($_POST["login-btn"])) {
    $newUzivatel = new DBUzivatele();
    $newUzivatel->Connect();
    $items = array();
    $items["jmeno"] = strip_tags($_POST["txt_uname"]);
    $items["prijmeni"] = strip_tags($_POST["txt_usurname"]);
    $items["email"] = strip_tags($_POST['txt_umail']);
    $items["heslo"] = strip_tags($_POST['txt_upass']);
    $item = strip_tags($_POST['txt_upass2']);
    $items["uzivatelske_jmeno"] = strip_tags($_POST['txt_unick']);

    $nick = new DBUzivatele();
    $nick->Connect();
    $nicky_uzivatelu = $nick->LoadNickEmailUzivatele();

    $uLength = strlen($items["uzivatelske_jmeno"]);

    $pLength = strlen($items["heslo"]);
    $bool = true;
    if ($uLength < 5 || $uLength > 15) {
        echo "<div class=\"alert alert-danger alert-dismissable fade in\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                <strong>Chyba!</strong> Uživatel nebyl vytvořen, uživatelské jméno \"". $items["uzivatelske_jmeno"]."\" nesplňuje podmínky.
                    Délka uživatelského jména musí být od 5 do 15 znaků.
                 </div>";
        $bool = false;
    }

    if ($pLength < 6) {

        echo "<div class=\"alert alert-danger alert-dismissable fade in\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                <strong>Chyba!</strong> Uživatel nebyl vytvořen, uživatelské heslo nesplňuje podmínky.
                    Délka uživatelského hesla musí být minimálně 6 znaků.
                 </div>";
        $bool = false;

    }
    if ($nicky_uzivatelu != null)
    {
        foreach($nicky_uzivatelu as $nick)
        {
             if( $nick["uzivatelske_jmeno"] == $items["uzivatelske_jmeno"]){
                echo "<div class=\"alert alert-danger alert-dismissable fade in\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                <strong>Chyba!</strong> Uživatel nebyl vytvořen, uživatelské jméno \"". $items["uzivatelske_jmeno"]."\" už někdo používá.
                 </div>";
                $bool = false;
             }
              if( $nick["email"] == $items["email"]){
                echo "<div class=\"alert alert-danger alert-dismissable fade in\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                <strong>Chyba!</strong> Uživatel nebyl vytvořen, e-mail \"". $items["email"]."\" už někdo používá.
                 </div>";
                $bool = false;
            }
            }
    }
    if($items["heslo"]==$item && $bool == true)
    {
        $novy = $newUzivatel->InsertUzivatele($items);
        echo "<div class=\"alert alert-success alert-dismissable fade in\">
    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
    <strong>Úspěšné dokončení!</strong> Uživatel byl úspěšně vytvořen.
  </div>";
    }
    else if($bool == true){
        echo "<div class=\"alert alert-danger alert-dismissable fade in\">
    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
    <strong>Chyba!</strong> Uživatel nebyl vytvořen, hesla se neshodovala.
  </div>";
    }

}
echo "<form class=\"form-horizontal\" action=\"\" method=\"POST\">
        <fieldset>
            <div id=\"legend\">
                <legend class=blog-post-title\">Registrace</legend>

            </div>
            <div class=\"control-group\">
                <!-- Username -->
                <label class=\"control-label\"  for=\"txt_unick\">Uživatelské jméno**</label>
                <div class=\"controls\">
                    <input type=\"text\" id=\"login-form-username\" name=\"txt_unick\" placeholder=\"\" class=\"input-xlarge\" required>
                    <p class=\"help-block\">Uživatelské jméno, které budete používat při přihlašování</p>
                </div>
            </div>

            <div class=\"control-group\">
                <!-- Krestni jmeno-->
                <label class=\"control-label\"  for=\"txt_uname\">Křestní jméno**</label>
                <div class=\"controls\">
                    <input type=\"text\" id=\"login-form-name\" name=\"txt_uname\" placeholder=\"\" class=\"input-xlarge\" required>
                    <p class=\"help-block\">Zadejte Vaše křestní jméno</p>
                </div>
            </div>

            <div class=\"control-group\">
                <!-- Prijmeni -->
                <label class=\"control-label\"  for=\"txt_usurname\">Příjmení**</label>
                <div class=\"controls\">
                    <input type=\"text\" id=\"login-form-surname\" name=\"txt_usurname\" placeholder=\"\" class=\"input-xlarge\" required>
                    <p class=\"help-block\">Zadejte Vaše příjmení</p>
                </div>
            </div>

            <div class=\"control-group\">
                <!-- E-mail -->
                <label class=\"control-label\" for=\"txt_umail\">E-mail**</label>
                <div class=\"controls\">
                    <input type=\"email\" id=\"login-form-email\" name=\"txt_umail\" placeholder=\"\" class=\"input-xlarge\" required>
                    <p class=\"help-block\">Napište e-mail</p>
                </div>
            </div>

            <div class=\"control-group\">
                <!-- Password-->
                <label class=\"control-label\" for=\"txt_upass\">Heslo**</label>
                <div class=\"controls\">
                    <input type=\"password\" id=\"password\" name=\"txt_upass\" placeholder=\"\" class=\"input-xlarge\" required>
                    <p class=\"help-block\">Zadejte heslo</p>
                </div>
            </div>

            <div class=\"control-group\">
                <!-- Password -->
                <label class=\"control-label\"  for=\"txt_upass2\">Heslo (Potvrzovací)**</label>
                <div class=\"controls\">
                    <input type=\"password\" id=\"login-form-heslo2\" name=\"txt_upass2\" placeholder=\"\" class=\"input-xlarge\" required>
                    <p class=\"help-block\">Potvrzení hesla</p>
                </div>
            </div>
            <input type=\"hidden\" name=\"heslo\" id=\"passh\">
            <div>
                <p style='color: red'>Textová pole označená ** jsou povinná</p>
            </div>

            <div class=\"control-group\">
                <!-- Button -->
                <div class=\"controls\">
                    <button  class=\"btn btn-success\" id=\"login-btn\" name=\"login-btn\">Registrovat</button>
                </div>
            </div>
        </fieldset>
    </form>";
