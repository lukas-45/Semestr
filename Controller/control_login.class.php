<?php

/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 04.12.2016
 * Time: 23:02
 */

/**
 * Class control_login
 * Kontroler pro prihlaseni
 */
class control_login
{
    public $items = null;
    public $login = null;
    public $prihlaseny_uzivatel = null;
    public $vypis;
    public $prihlasen = false;
    public $kontrola_prihlaseni;

    /**
     * vrati url
     * @return mixed
     */
    public function getPage()
    {
        if (isset($_REQUEST["page"])) {
            $pageURL = @$_REQUEST["page"];
        }
        return @$pageURL;
    }

    /**
     * kontroluje zda je prihlaseni v poradku
     */
    public function getSign()
    {
        if (isset($_POST["submit"])) {
            $this->login = new DBUzivatele();
            $this->login->Connect();
            $this->items["uzivatelske_jmeno"] = strip_tags($_POST['user']);
            $this->items["email"] = strip_tags($_POST["user"]);
            $this->items["heslo"] = strip_tags($_POST['password']);

            $login_uziv = $this->login->LoadAllUzivatele();

            $bool = true;

            if ($login_uziv != null) {
                foreach ($login_uziv as $this->login) {
                    if ($this->login["uzivatelske_jmeno"] == $this->items["uzivatelske_jmeno"] || $this->login["email"] == $this->items["email"]) {
                        if ($this->login["heslo"] == $this->items["heslo"]) {
                            $_SESSION['uzivatel'] = $this->login;
                            $this->prihlaseny_uzivatel = $this->login;
                            $this->vypis = 1;
                            $control = new control();

                            header('Location: '.$control->makeUrl('uvod'));

                            $bool = false;
                        } else {
                            $this->vypis = 2;

                            $bool = false;

                        }

                    }

                }
            }
            if ($bool == true) {
                $this->vypis = 3;


            }

        }


    }

    /**
     * funkce pro vypis alertu, podle uspesneho/neuspesneho prihlaseni
     */
    function getVypis(){
        if($this->vypis==1){
            echo "<div id=\"loginbox\"  class=\"mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3\"> 
                    <div class=\"alert alert-success alert-dismissable fade in\">
                    <a href=\"\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Úspěšné dokončení!</strong> Uživatel byl přihlášen
                    </div>
                    </div>";
            $this->prihlasen = true;

        }
        else if($this->vypis==2){
            echo "<div id=\"loginbox\" class=\"mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3\"> 
                    <div class=\"alert alert-danger alert-dismissable fade in\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Chyba!</strong> Špatné heslo.
                    </div>
                    </div>";
            $this->prihlasen = false;
        }
        else if($this->vypis==3) {
            echo "<div id=\"loginbox\" class=\"mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3\"> 
              <div class=\"alert alert-danger alert-dismissable fade in\">
              <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
              <strong>Chyba!</strong> Špatné uživatelské jméno/email a heslo.
              </div>
              </div>";
            $this->prihlasen = false;
        }
    }
}