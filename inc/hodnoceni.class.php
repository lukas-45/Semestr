<?php

/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 08.12.2016
 * Time: 17:40
 */
class hodnoceni extends db_pdo
{
    public function LoadAllHodnoceni()
    {
        $table_name = "hodnoceni";
        $columns = "*";
        $where = array();
        //   $where[] = array("column" => "zkratka", "value" => "KIV/DB1", "symbol" => "=");

        $prispevky = $this->DBSelectAll($table_name, $columns, $where);
        return $prispevky;
    }

    public function InsertHodnoceni($items){
        $table_name = "hodnoceni";

        $insert = $this->DBInsert($table_name, $items);
        return $insert;
    }

    public function UpdateHodnoceni($uzivatel, $clanek, $body1, $body2, $body3, $recenzent){
        $table_name = "hodnoceni";

        $insert = $this->DBUpdateHodnoceni($table_name, $uzivatel, $clanek, $body1, $body2, $body3, $recenzent);
        return $insert;
    }

    public function DeleteHodnoceni($items){
        $table_name = "hodnoceni";
        $delete = $this->DBDelete($table_name, $items, "LIMIT 1");
        return $delete;
    }
}