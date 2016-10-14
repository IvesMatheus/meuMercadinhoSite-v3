<?php
    /**
    * Classe que representa um ponto de entrega
    * @version 1
    * @author Ives Matheus
    */
    class PontoEntrega
    {
        /**
        * Id do ponto de entrega
        */
        private $id;
        /**
        * Nome(tag) do ponto de entrega
        */
        private $nome;
        /**
        * Rua do endereço do ponto de entrega
        */
        private $rua;
        /**
        * Bairro do endereço do ponto de entrega
        */
        private $bairro;
        /**
        * Número do endereço do ponto de entrega
        */
        private $numero;
        /**
        * Complemento do endereço do ponto de entrega
        */
        private $complemento;
        /**
        * Cliente do ponto de entrega
        */
        private $cliente;

        public function __construct()
        {
            $args = func_get_args();
            $num_args = func_num_args();

            if($num_args == 7)
            {
                $this->id = $args[0];
                $this->nome = $args[1];
                $this->rua = $args[2];
                $this->bairro = $args[3];
                $this->numero = $args[4];
                $this->complemento = $args[5];
                $this->cliente = $args[6];
            }
            else if($num_args == 6)
            {
                $this->id = 0;
                $this->nome = $args[0];
                $this->rua = $args[1];
                $this->bairro = $args[2];
                $this->numero = $args[3];
                $this->complemento = $args[4];
                $this->cliente = $args[5];
            }
            else
            {
                $this->id = 0;
                $this->nome = "";
                $this->rua = "";
                $this->bairro = "";
                $this->numero = 0;
                $this->cep = "00.000-000";
                $this->complemento = "";
                $this->cliente = null;
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

        public function setRua($rua)
        {
            $this->rua = $rua;
        }

        public function getRua()
        {
            return $this->rua;
        }

        public function setBairro($bairro)
        {
            $this->bairro = $bairro;
        }

        public function getBairro()
        {
            return $this->bairro;
        }

        public function setNumer($numero)
        {
            $this->numero = $numero;
        }

        public function getNumero()
        {
            return $this->numero;
        }

        public function setComplemento($complemento)
        {
            $this->complemento = $complemento;
        }

        public function getComplemento()
        {
            return $this->complemento;
        }

        public function setCliente($cliente)
        {
            $this->cliente = $cliente;
        }

        public function getCliente()
        {
            return $this->cliente;
        }

        public function toArray()
        {
            return array('id'=>$this->id, 'nome'=>$this->nome, 'rua'=>$this->rua, 'numero'=>$this->numero, 'bairro'=>$this->bairro, 'complemento'=>$this->complemento, 'cliente'=>$this->cliente->toArray());
        }

        /*
        public function __toString()
        {
            return $this->id."<br>".$this->nome."<br>".$this->rua."<br>".$this->bairro."<br>".$this->numero."<br>".$this->complemento."<br>".$this->cliente."<br>";
        }
        */
    }
?>
