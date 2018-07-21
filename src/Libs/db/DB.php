<?php
    namespace App\Libs\db;
    use \PDO;

    class DB{
        private static $_instance = null;
        private $pdo = null;
        private $query = null;

        private function __construct($pathToDatabase){
            if(file_exists($pathToDatabase)){
                $dns = sprintf('sqlite:%s', $pathToDatabase);
                $this->pdo = new PDO($dns, null, null);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }

        public static function initialize($pathToDatabase) {
            if(is_null(self::$_instance)) {
                self::$_instance = new DB($pathToDatabase);
            }

            return self::$_instance;
        }

        public function beginTransaction(){
            $this->pdo->beginTransaction();
        }

        public function commit(){
            $this->pdo->commit();
        }

        public function rollBack(){
            $this->pdo->rollBack();
        }

        public function query($sql, $params = []){
            try {
                if(count($params) > 0){
                    $this->query = $this->pdo->prepare($sql);
                    $this->query->execute($params);
                }else{
                    $this->query = $this->pdo->query($sql);
                }

                return $this;
            } catch (Exception $e) {
                return false;
            }
        }

        public function fetch(){
            return $this->query->fetchAll(PDO::FETCH_OBJ);
        }

        public function getLastInsertId(){
            return $this->pdo->lastInsertId();
        }
    }
