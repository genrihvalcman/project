<?php

 class ModelAbstract extends DataBase {
     
      private static $instance;
      
    function __construct() {
        DataBase::connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->pdo = self::$pdoConnect;
        
   }

    private function __clone() {
        
    }
    
    public static function getInstance(){
  	if(self::$instance === null)
  	  self::$instance = new self;
 	  return self::$instance;
  }


    //запрос на удаление    
    public function delete($sql, $data = array()) {
        $result = $this->countRow($this->query($sql, $data));
        return $result;
    }
    
    //запрос на удаление    
    public function columnMetaTable($sql) {
        $result = $this->columnMeta($this->query($sql));
        return $result;
    }

    //запрос на обнавление данных     
    public function update($sql, $data = array()) {
        $result = $this->countRow($this->query($sql, $data));
        return $result;
    }

    //запрос на выборку одной строки по критериям 
    public function selectRowWhere($sql, $data = array()) {
        $result = $this->fetch($this->query($sql, $data));
        return $result;
    }

    //запрос на выборку всех полей по критериям 
    public function selectWhere($sql, $data = array()) {
        $result = $this->fetch_all($this->query($sql, $data));
        return $result;
    }

    //запрос на выборку всех полей.  возвращает массив, индексированный именами столбцов результирующего набора
    public function select($sql) {
        $result = $this->fetch_all($this->query($sql));
        return $result;
    }
    
    //запрос на выборку всех полей. возвращает массив, индексированный именами столбцов результирующего набора, а также их номерами (начиная с 0)
    public function selectBoth($sql) {
        $result = $this->fetch_both($this->query($sql));
        return $result;
    }

    //запрос на выборку одной строки
    public function selectRow($sql) {
        $result = $this->fetch($this->query($sql));
        return $result;
    }

    //запрос на добавление данных в базу  
    public function insert($table, $data) {
        $result = $this->countRow($this->insertQuery($table, $data));
        return $result;
    }

    // запрос на обнавление данных таблицы массивом данных (чтобы не писать кучу всего 
    // просто кидаем массив пост или гет и скрипт сам все сделат) 
    // на $whereData нужен отдельны массив с данными типа $arr = array( 'name' => 'val' ) 
    // $where указываем в таком виде WHERE name = :val
    // пример PDOQuery::updateArr('user', array('login' =>'9'), 'id = :id', array('id'=>'2'));
    public function updateArr($table, $data, $where, $whereData) {
        $result = $this->countRow($this->updateQuery($table, $data, $where, $whereData));
        return $result;
    }
    
   public function getSitePages(){
        return $this->fetch_all($this->query('SELECT * FROM '. TBLE_SITE_PAGES . ''));
  }

}
