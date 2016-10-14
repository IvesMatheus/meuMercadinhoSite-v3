<?php
    /**
    * Classe que representa um cliente
    * @version 1
    * @author Ives Matheus
    */
    class Cliente
    {
        /**
        * Id do cliente
        */
        private $id;
        /**
        * Nome do cliente
        */
        private $nome;
        /**
        * Login do cliente no app
        */
        private $login;
        /**
        * Senhdo do cliente no app
        */
        private $senha;

        public function __construct()
        {
            $args = func_get_args();
            $num_args = func_num_args();

            if($num_args == 4)
            {
                $this->id = $args[0];
                $this->nome = $args[1];
                $this->login = $args[2];
                $this->senha = $args[3];
            }
            else if($num_args == 3)
            {
                $this->id = 0;
                $this->nome = $args[0];
                $this->login = $args[1];
                $this->senha = $args[2];
            }
            else
            {
                $this->id = 0;
                $this->nome = "";
                $this->login = "";
                $this->senha = "";
            }
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setNome($nome)
        {
            $this->nome = $nome;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function setLogin($login)
        {
            $this->login = $login;
        }

        public function getLogin()
        {
            return $this->login;
        }

        public function setSenha($senha)
        {
            $this->senha = $senha;
        }

        public function getSenha()
        {
            return $this->senha;
        }

        public function toArray()
        {
            return array('id'=>$this->id, 'nome'=>$this->nome, 'login'=>$this->login, 'senha'=>$this->senha);
        }
        /*
        public function __toString()
        {
            return $this->id."<br>".$this->nome."<br>".$this->login."<br>".$this->senha."<br>";
        }
        */
    }

?>
