<?php
    /**
    * Classe que representa uma compra
    * @version 1
    * @author Ives Matheus
    */
    class Pedido
    {
        /**
        * Id da compra
        */
        private $id;
        /**
        * Valor total da compra
        */
        private $total;
        /**
        * Troco da compra (caso feita via dinheiro)
        */
        private $troco;
        /**
        * Forma de pagamento da compra (0 - dinheiro; 1 - cartao)
        */
        private $forma_pagamento;
        /**
        * Cliente que fez a compra
        */
        private $cliente;
        /**
        * Ponto de entrega da compra (caso a compra seja entregue)
        */
        private $ponto_entrega;
        /**
        * Hora da busca da compra no mercado (caso a compra não seja entrega)
        */
        private $hora_busca;
        /**
        * Booleano indicando se vai ser entregue ou não
        */
        private $entrega;
        /**
        * Descrição do motivo que a compra foi cancelada pelo mercado (caso a compra seja cancelada)
        */
        private $desc_canc;
        /**
        * Status da compra
        */
        private $status;

        private $mercado;

        public static $DINHEIRO = 0;
        public static $CARTAO = 1;

        public static $PEDIDO_FEITO = 0;
        public static $PEDIDO_LIBERADO = 1;
        public static $PEDIDO_FINALIZADO = 2;
        public static $PEDIDO_INCOMPLETO = 3;
        public static $PEDIDO_CANCELADO = 4;

        public function __construct()
        {
            $args = func_get_args();
            $num_args = func_num_args();

            if($num_args == 11)
            {
                $this->id = $args[0];
                $this->total = $args[1];
                $this->troco = $args[2];
                $this->forma_pagamento = $args[3];
                $this->cliente = $args[4];
                $this->ponto_entrega = $args[5];
                $this->hora_busca = $args[6];
                $this->entrega = $args[7];
                $this->desc_canc = $args[8];
                $this->status = $args[9];
                $this->mercado = $args[10];
            }
            else if($num_args == 10)
            {
                $this->id = 0;
                $this->total = $args[0];
                $this->troco = $args[1];
                $this->forma_pagamento = $args[2];
                $this->cliente = $args[3];
                $this->ponto_entrega = $args[4];
                $this->hora_busca = $args[5];
                $this->entrega = $args[6];
                $this->desc_canc = $args[7];
                $this->status = $args[8];
                $this->mercado = $args[9];
            }
            else
            {
                $this->id = 0;
                $this->total = 0;
                $this->troco = 0;
                $this->forma_pagamento = 0;
                $this->cliente = null;
                $this->ponto_entrega = null;
                $this->hora_busca = 0;
                $this->entrega = false;
                $this->desc_canc = "";
                $this->status = 0;
                $this->mercado = null;
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

        public function setTotal($total)
        {
            $this->total = $total;
        }

        public function getTotal()
        {
            return $this->total;
        }

        public function setTroco($troco)
        {
            $this->troco = $troco;
        }

        public function getTroco()
        {
            return $this->troco;
        }

        public function setFormaPagamento($forma_pagamento)
        {
            $this->forma_pagamento = $forma_pagamento;
        }

        public function getFormaPagamento()
        {
            return $this->forma_pagamento;
        }

        public function setCliente($cliente)
        {
            $this->cliente = $cliente;
        }

        public function getCliente()
        {
            return $this->cliente;
        }

        public function setPontoEntrega($ponto_entrega)
        {
            $this->ponto_entrega = $ponto_entrega;
        }

        public function getPontoEntrega()
        {
            return $this->ponto_entrega;
        }

        public function setHoraBusca($hora_busca)
        {
            $this->hora_busca = $hora_busca;
        }

        public function getHoraBusca()
        {
            return $this->hora_busca;
        }

        public function setEntrega($entrega)
        {
            $this->entrega;
        }

        public function getEntrega()
        {
            return $this->entrega;
        }

        public function setDescCanc($desc_canc)
        {
            $this->desc_canc = $desc_canc;
        }

        public function getDescCanc()
        {
            return $this->desc_canc;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setMercado($mercado)
        {
            $this->mercado = $mercado;
        }

        public function getMercado()
        {
            return $this->mercado;
        }

        public function toArray()
        {
            return array('id'=>$this->id, 'total'=>$this->total, 'troco'=>$this->troco, 'forma_pagamento'=>$this->forma_pagamento, 'cliente'=>$this->cliente->toArray(), 'ponto_entrega'=>$this->ponto_entrega->toArray(), 'hora_busca'=>$this->hora_busca, 'entrega'=>$this->entrega, 'desc_canc'=>$this->desc_canc, 'status'=>$this->status, 'mercado'=>$this->mercado->toArray());
        }

        public function __toString()
        {
            return $this->id."<br>".$this->total."<br>".$this->troco."<br>".$this->forma_pagamento."<br>".$this->cliente."<br>".$this->ponto_entrega."<br>".$this->hora_busca."<br>".$this->entrega."<br>".$this->desc_canc."<br>".$this->status."<br>";
        }
    }
?>
