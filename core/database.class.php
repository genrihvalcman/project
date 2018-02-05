<?php

abstract class DataBase {

    protected $pdo;
    static $pdoConnect = null;

    //Конектимся к базе
    public static function connect($db_host, $db_user, $db_password, $db_name) {
        if (self::$pdoConnect === null) {
            try {
                self::$pdoConnect = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
				self::$pdoConnect->exec('SET NAMES utf8');
            } catch (PDOException $e) {
                echo 'Хьюстон, у нас проблемы. Подключение не удалось: ' . $e->getMessage();
            }
        }
        return self::$pdoConnect;
    }

    //Обработка запроса к базе
    protected function query($sql, $data = array() ) {
        
        if (!$this->pdo) {
            return false;
        }
        $state = $this->pdo->prepare($sql);
        $state->execute($data);
        $error = $state->errorInfo();
        if ($error[2]) {
            echo 'Хьюстон, у нас проблемы. ' . $error[2];
        }
        return $state;
    }

    //Возвращает кол-во затрунутых строк
    protected function countRow($state) {
        $countRow = $state->rowCount();
        return $countRow;
    }
    
    //Возвращает пля таблицы 
    protected function columnMeta($state) {
        $сolumnMeta = $state->getColumnMeta(0);
        return $сolumnMeta;
    }

    //Возвращает полный массив данных
    protected function fetch_all($state) {
        $result = $state->fetchAll(PDO::FETCH_ASSOC);
        $result = $this->checkArrayQuery($result);
        return $result;
    }
    
    protected function fetch_both($state) {
        $result = $state->fetchAll(PDO::FETCH_BOTH);
        $result = $this->checkArrayQuery($result);
        return $result;
    }

    //Возвращает только одну строку
    protected function fetch($state) {
        $result = $state->fetch(PDO::FETCH_ASSOC);
        $result = $this->checkArrayQuery($result);
        return $result;
    }

    //Проверка на пустоту массива
    protected function checkArrayQuery($result) {
        if (empty($result)) {
            return null;
        }
        return $result;
    }

    //Подготовка и отправка на выполнения запроса INSERT (добавление новой записи)
    protected function insertQuery($table, $data = array()) {
        $cols = $newData = array();
        foreach ($data as $col => $value) {
            if ($value !== null) {
                $cols[] = $col;
                $values[] = ':' . $col;
                $newData[$col] = $value;
            }
        }
        return $this->query('INSERT INTO ' . $table . ' (' . implode(',', $cols) . ') VALUES (' . implode(",", $values) . ')', $newData);
    }

    //Подготовка и отправка на выполнения запроса UPDATE (обновление данных)
    protected function updateQuery($table, $data, $where, $whereData) {
        $newData = array();
        $set;
        foreach ($data as $col => $value) {
            if ($value !== null) {
                $newData[$col] = $value;
                $set .= '`' . $col . '` = :' . $col . ',';
            }
        }
        $set = chop($set, ' ,');
        $readyData = array_merge($newData, $whereData);
        return $this->query('UPDATE ' . $table . ' SET ' . $set . ' WHERE ' . $where . ' ', $readyData);
    }

}
