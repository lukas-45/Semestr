<?php

/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 06.12.2016
 * Time: 13:33
 */
class Prispevky extends db_pdo
{
    public function LoadAllPrispevky()
    {
        $table_name = "clanky";
        $columns = "*";
        $where = array();
        //   $where[] = array("column" => "zkratka", "value" => "KIV/DB1", "symbol" => "=");

        $prispevky = $this->DBSelectAll($table_name, $columns, $where);
        return $prispevky;
    }


    public function InsertPrispevku($items){
        $table_name = "clanky";

        $insert = $this->DBInsert($table_name, $items);
        return $insert;
    }

    public function UpdatePrispevku($nazev, $autor, $nadpis){
        $table = "clanky";
        $update = $this->DBUpdateNazvu($table, $nazev, $autor, $nadpis);
        return $update;
    }

    public function UpdateClanku($clanek, $autor, $nadpis){
        $table = "clanky";
        $update = $this->DBUpdateClanku($table, $clanek, $autor, $nadpis);
        return $update;
    }

    public function UpdateSchvaleno($autor, $nadpis){
        $table_name = "clanky";

        $insert = $this->DBUpdateSchvaleno($table_name, $autor, $nadpis);
        return $insert;
    }

    public function DeletePrispevku($items){
        $table_name = "clanky";
        $delete = $this->DBDelete($table_name, $items, "LIMIT 1");
        return $delete;
    }

}