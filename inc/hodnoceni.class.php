<?php

/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 08.12.2016
 * Time: 17:40
 */

/**
 * Class hodnoceni
 * trida hodnoceni, ktera dedi od db_pdo.class.php
 */
class hodnoceni extends db_pdo
{
    /**
     * nacte vsechny hodnoceni od recenzentu
     * @return mixed
     */
    public function LoadAllHodnoceni()
    {
        $table_name = "hodnoceni";
        $columns = "*";
        $where = array();
        //   $where[] = array("column" => "zkratka", "value" => "KIV/DB1", "symbol" => "=");

        $prispevky = $this->DBSelectAll($table_name, $columns, $where);
        return $prispevky;
    }

    /**
     * vlozi do DB nove hodnoceni od recenzenta
     * @param $items
     * @return mixed
     */
    public function InsertHodnoceni($items){
        $table_name = "hodnoceni";

        $insert = $this->DBInsert($table_name, $items);
        return $insert;
    }

    /**
     * aktualizuje hodnoceni
     * @param $uzivatel
     * @param $clanek
     * @param $body1
     * @param $body2
     * @param $body3
     * @param $recenzent
     */
    public function UpdateHodnoceni($uzivatel, $clanek, $body1, $body2, $body3, $recenzent){
        $table_name = "hodnoceni";

        $insert = $this->DBUpdateHodnoceni($table_name, $uzivatel, $clanek, $body1, $body2, $body3, $recenzent);
        return $insert;
    }

    /**
     * smaze hodnoceni
     * @param $items
     */
    public function DeleteHodnoceni($items){
        $table_name = "hodnoceni";
        $delete = $this->DBDelete($table_name, $items, "LIMIT 1");
        return $delete;
    }
}