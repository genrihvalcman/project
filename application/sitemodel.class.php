<?php

class SiteModel extends ModelAbstract {

    function allSelect($table) {
        return $this->select("SELECT * FROM $table");
    }

    function whereAllSelect($table, $where, $data) {
        return $this->selectWhere("SELECT * FROM $table WHERE $where", $data);
    }

    function whereRowSelect($table, $where, $data) {
        return $this->selectRowWhere('SELECT * FROM '. $table . ' WHERE '. $where .'', $data);
    }
            
    function getCurrentPages($table, $data){
        return $this->selectRowWhere('SELECT * FROM '. $table . ' WHERE alias = ?', $data);
     }
     
     

}
