<?php

class DBUzivatele extends db_pdo
{
    public function LoadAllUzivatele()
    {
        $table_name = "uzivatel";
        $columns = "*";
        $where = array();
     //   $where[] = array("column" => "zkratka", "value" => "KIV/DB1", "symbol" => "=");
        
        $uzivatele = $this->DBSelectAll($table_name, $columns, $where);
        return $uzivatele;
    }
    public function LoadAutoriUzivatele()
    {
        $table_name = "uzivatel";
        $columns = "*";
        //$where = array();
        $where[] = array("column" => "prava", "value" => "1", "symbol" => "=");

        $uzivatele = $this->DBSelectAll($table_name, $columns, $where);
        return $uzivatele;
    }
    public function LoadRecenzentiUzivatele()
    {
        $table_name = "uzivatel";
        $columns = "*";
        //$where = array();
        $where[] = array("column" => "prava", "value" => "2", "symbol" => "=");

        $uzivatele = $this->DBSelectAll($table_name, $columns, $where);
        return $uzivatele;
    }
    public function LoadNickEmailUzivatele()
    {
        $table_name = "uzivatel";
        $columns = "uzivatelske_jmeno, email";
        $where = array();
        //   $where[] = array("column" => "zkratka", "value" => "KIV/DB1", "symbol" => "=");

        $uzivatele = $this->DBSelectAll($table_name, $columns, $where);
        return $uzivatele;
    }
    public function InsertUzivatele($items){
        $table_name = "uzivatel";

        $insert = $this->DBInsert($table_name, $items);
        return $insert;
    }
}