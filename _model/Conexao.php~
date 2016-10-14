<?php

    /**
    * Classe de conexão com o banco de dados
    * @author IvesMatheus
    */
    class Conexao
    {
        /**
        * Instância de uma conexão aberta com o banco de dados
        */
        public static $con;
        public static $host = "localhost";
        public static $dbname = "meuMercadinho";
        public static $usuario = "root";
        public static $senha = "karllab";

        private function __construct()
        {  }

        public static function getConexao()
        {
            if (!isset(self::$con))
            {
                self::$con = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname, 'root', 'karllab', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$con->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            }

            return self::$con;
        }
    }

?>
