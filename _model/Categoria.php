<?php
    /**
    * Classe que representa uma categoria
    * @version 1
    * @author Ives Matheus
    */
    class Categoria
    {
        /**
        * Id da categoria
        */
        private $id;
        /**
        * Nome da categoria
        */
        private $nome;
        /**
        * Descricao da categoria
        */
        private $descricao;
        /**
        * Caminho da imagem no servidor que representa a categoria
        */
        private $imagem;

        public function __construct()
        {
            $args = func_get_args();
            $num_args = func_num_args();

            if($num_args == 4)
            {
                $this->id = $args[0];
                $this->nome = $args[1];
                $this->descricao = $args[2];
                $this->imagem = $args[3];
            }
            else if($num_args == 3)
            {
                $this->id = 0;
                $this->nome = $args[0];
                $this->descricao = $args[1];
                $this->imagem = $args[2];
            }
            else
            {
                $this->id = 0;
                $this->nome = "";
                $this->descricao = "";
                $this->imagem = "";
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

        public function setDescricao($descricao)
        {
            $this->descricao = $descricao;
        }

        public function getDescricao()
        {
            return $this->descricao;
        }

        public function setImagem($imagem)
        {
            $this->imagem = $imagem;
        }

        public function getImagem()
        {
            return $this->imagem;
        }

        public function toArray()
        {
            return array('id'=>$this->id, 'nome'=>$this->nome, 'descricao'=>$this->descricao, 'imagem'=>$this->imagem);
        }

        public function __toString()
        {
            return $this->id."<br>".$this->nome."<br>".$this->descricao."<br>".$this->imagem;
        }
    }
?>
