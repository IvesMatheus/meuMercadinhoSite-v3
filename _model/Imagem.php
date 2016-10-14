<?php
    /**
    * Classe que representa uma imagem
    * @version 1
    * @author Ives Matheus
    */
    class Imagem
    {
        /**
        * Id da imagem;
        */
        private $id;
        /**
        * Caminho da imagem no servidor
        */
        private $caminho;
        /**
        * Categoria de produto a qual a imagem representa
        */
        private $categoira;

        public function __construct()
        {
            $args = func_get_args();
            $num_args = func_num_args();

            if($num_args == 3)
            {
                $this->id = $args[0];
                $this->caminho = $args[1];
                $this->categoria = $args[2];
            }
            else if($num_args == 2)
            {
                $this->id = 0;
                $this->caminho = $args[0];
                $this->categoria = $args[1];
            }
            else
            {
                $this->id = 0;
                $this->caminho = "";
                $this->categoria = null;
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

        public function setCaminho($caminho)
        {
            $this->caminho = $caminho;
        }

        public function getCaminho()
        {
            return $this->caminho;
        }

        public function setCategoria($categoria)
        {
            $this->categoria = $categoria;
        }

        public function getCategoria()
        {
            return $this->categoria;
        }

        public function toArray()
        {
            return array('id'=>$this->id, 'caminho'=>$this->caminho, 'categoia'=>$this->categoria->toArray());
        }

        public function __toString()
        {
            return $this->id."<br>".$this->caminho."<br>".$this->categoria."<br>";
        }
    }
?>
