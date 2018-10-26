<?php
    namespace App\Libs\db;

    class Sqlite extends DB{
        public function __construct($params){
            $pathToDatabase = ROOT_PATH.$params['path'];
            if(file_exists($pathToDatabase)){
                $args = [
                    'dns'       => sprintf('sqlite:%s', $pathToDatabase),
                    'user'      => null,
                    'password'  => null
                ];
                parent::__construct($args);
            }
        }
    }
