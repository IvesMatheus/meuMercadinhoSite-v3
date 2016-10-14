<?php
    /**
    * Classe que representa um item de uma compra
    * @version 1
    * @author Ives Matheus
    */
    class ItemPedido
    {
        /**
        * Compra a qual o produto pertence
        */
        private $compra;
        /**
        * Produto do item de compra
        */
        private $produto;
        /**
        * Quantidade do produto no item de compra
        */
        private $quantidade;

        public function __construct()
        {
            $args = func_get_args();
            $num_args = func_num_args();

            if($num_args == 3)
            {
                $this->compra = $args[0];
                $this->produto = $args[1];
                $this->quantidade = $args[2];
            }
            else
            {
                $this->compra = null;
                $this->produto = null;
                $this->quantidade = 0;
            }
        }

        public function setCompra($compra)
        {
            $this->compra = $compra;
        }

        public function getCompra()
        {
            return $this->compra;
        }

        public function setProduto($produto)
        {
            $this->produto = $produto;
        }

        public function getProduto()
        {
            return $this->produto;
        }

        public function setQuantidade($quantidade)
        {
            $this->quantidade = $quantidade;
        }

        public function getQuantidade()
        {
            return $this->quantidade;
        }

        public function toArray()
        {
            return array('pedido'=>$this->compra->toArray(), 'produto'=>$this->produto->toArray(), 'quantidade'=>$this->quantidade);
        }

        public function __toString()
        {
            return $this->compra."<br>".$this->produto."<br>".$this->quantidade."<br>";
        }

    }

?>
