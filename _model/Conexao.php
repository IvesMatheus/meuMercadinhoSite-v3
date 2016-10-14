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
        public static $dbname = "emarketdb";
        public static $usuario = "emarket";
        public static $senha = "emarket3082*";

        private function __construct()
        {  }

        public static function getConexao()
        {
            if (!isset(self::$con))
            {
                self::$con = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname, 'emarket', 'emarket3082*', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$con->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            }

            return self::$con;
        }
    }

?>
