<?php

/**
 * Class DBUzivatele
 * trida, ktera dedi od db_pdo.class.php
 */
class DBUzivatele extends db_pdo
{
    /**
     * Nacte vsechny uzivatele
     * @return mixed
     */
    public function LoadAllUzivatele()
    {
        $table_name = "uzivatel";
        $columns = "*";
        $where = array();
     //   $where[] = array("column" => "zkratka", "value" => "KIV/DB1", "symbol" => "=");
        
        $uzivatele = $this->DBSelectAll($table_name, $columns, $where);
        return $uzivatele;
    }

    /***
     * nacte všechny uzivatele, kteri jsou autory
     * @return mixed
     */
    public function LoadAutoriUzivatele()
    {
        $table_name = "uzivatel";
        $columns = "*";
        //$where = array();
        $where[] = array("column" => "prava", "value" => "1", "symbol" => "=");

        $uzivatele = $this->DBSelectAll($table_name, $columns, $where);
        return $uzivatele;
    }

    /**
     * nacte vsechny uzivatele, kteri jsou recenzenty
     * @return mixed
     */
    public function LoadRecenzentiUzivatele()
    {
        $table_name = "uzivatel";
        $columns = "*";
        //$where = array();
        $where[] = array("column" => "prava", "value" => "2", "symbol" => "=");

        $uzivatele = $this->DBSelectAll($table_name, $columns, $where);
        return $uzivatele;
    }

    /**
     * nacte vsechny uzivatele, ale vybere pouze sloupecky uzivatelske_jmeno a email
     * @return mixed
     */
    public function LoadNickEmailUzivatele()
    {
        $table_name = "uzivatel";
        $columns = "uzivatelske_jmeno, email";
        $where = array();
        //   $where[] = array("column" => "zkratka", "value" => "KIV/DB1", "symbol" => "=");

        $uzivatele = $this->DBSelectAll($table_name, $columns, $where);
        return $uzivatele;
    }

    /**
     * vlozi noveho uzivatele do DB
     * @param $items
     * @return mixed
     */
    public function InsertUzivatele($items){
        $table_name = "uzivatel";

        $insert = $this->DBInsert($table_name, $items);
        return $insert;
    }
}