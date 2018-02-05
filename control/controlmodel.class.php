<?php

class ControlModel extends ModelAbstract {

    function allSelect($table) {
        return $this->select("SELECT * FROM $table");
    }
    
    function allSelectField($field, $table) {
        return $this->select("SELECT $field FROM $table");
    }
    
    function deleltWhere($table, $where, $data) {
        return $this->delete("DELETE FROM $table WHERE $where", $data);
    }
    
    function nameFields($table) {
        return $this->columnMetaTable("SELECT * FROM $table");
    }
        
    function allSelectWhere($table, $where, $data) {
        return $this->selectWhere("SELECT * FROM $table WHERE $where", $data);
    }
    
    function rowSelectWhere($table, $where, $data) {
        return $this->selectRowWhere("SELECT * FROM $table WHERE $where", $data);
    }
    
    function rowSelectFieldWhere($field, $table, $where, $data) {
        return $this->selectRowWhere("SELECT $field FROM $table WHERE $where", $data);
    }
    
    function allSelectFieldWhere($field, $table, $where, $data) {
        return $this->selectWhere("SELECT $field FROM $table WHERE $where", $data);
    }
    
    
    function updateData($table, $set, $where, $data) {
        return $this->update("UPDATE $table SET $set WHERE $where", $data);   
    }
    
    function deleteData($table, $where, $data) {
        return $this->update("DELETE FROM $table WHERE $where", $data);   
    }
            
    function selectUser($data) {
        return $this->selectRowWhere("SELECT user_login, user_pass FROM fmw_control_user WHERE user_login = ? LIMIT 1", $data);
    }
    
     function selectCheckUser($data) {
        return $this->selectRowWhere("SELECT * FROM fmw_control_user, fmw_user_role WHERE fmw_control_user.type_user = fmw_user_role.id AND user_hash = ? LIMIT 1", $data);
    }
    
    function updateHashUser($data){
        return $this->update("UPDATE fmw_control_user set user_hash = ? where user_login = ?", $data);
    }
    
    function whereAllSelect($table, $where, $data) {
        return $this->selectWhere("SELECT * FROM $table WHERE $where", $data);
    }
    
   

}
