<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 05.12.2016
 * Time: 13:01
 */
    /**
     * stranka ktera vypise informace o prihlasenem uzivateli
     */
    if(isset($_SESSION['uzivatel'])) {
        $jmeno = $_SESSION['uzivatel'];
        if($jmeno['prava'] == 3)
        {
            $prava = "admin";
        }
        else if($jmeno['prava'] == 2)
        {
            $prava = "recenzent";
        }
        else if($jmeno['prava'] == 1)
        {
            $prava = "autor";
        }
        else
        {
            $prava = "";
        }
       echo" <div class=\"container\">
      <table class=\"table\">
        <thead>
         <CAPTION><EM>Informace o uživateli</EM></CAPTION>
            <TR><TH>Jméno<TD>$jmeno[jmeno]</TR></TH>
            <TR><TH>Příjmení<TD>$jmeno[prijmeni]</TR></TH>
            <TR><TH>E-mail<TD>$jmeno[email]</TR></TH>
            <TR><TH>Uživatelské jméno<TD>$jmeno[uzivatelske_jmeno]</TR></TH>
            <TR><TH>Oprávnění<TD>$prava</TR></TH>
        </tbody>
      </table>";

}