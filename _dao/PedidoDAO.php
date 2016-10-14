<?php

    include_once "../_model/Conexao.php";
    include_once "ClienteDAO.php";
    include_once "MercadoDAO.php";
    include_once "PontoEntregaDAO.php";
    include_once "../_model/Pedido.php";

    /**
    * Classe DAO de pedido que implementa métodos de CRUD e outras que meche no BD
    * @version 2
    * @author Ives Matheus
    */
    class PedidoDAO
    {
        public function __construct()
        {   }

        /**
        * Método que inseri um pedido no BD
        * @param $pedido objeto de Pedido contendo dados a serem inseridos
        * @return verdadeiro ou falso para caso de sucesso na inserção de dados
        * @version 1
        * @author Ives Matheus
        */
        public function inserir($pedido)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "INSERT INTO pedido(total, troco, forma_pagamento, id_cliente, id_ponto_entrega, hora_busca, entrega, desc_canc, status, id_mercado) VALUES(:total, :troco, :forma_pagamento, :id_cliente, :id_ponto_entrega, :hora_busca, :entrega, :desc_canc, :status, :id_mercado)";

                $stm = $con->prepare($sql);
                $stm->bindValue("total", $pedido->getTotal());
                $stm->bindValue("troco", $pedido->getTroco());
                $stm->bindValue("forma_pagamento", $pedido->getFormaPagamento());
                $stm->bindValue("id_cliente", $pedido->getCliente()->getId());
                //VERIFICA SE HÁ PONTO DE ENTREGA NO PEDIDO
                $pe = ($pedido->getEntrega()) ? $pedido->getPontoEntrega()->getId() : null;
                $stm->bindValue("id_ponto_entrega", $pe);
                $stm->bindValue("hora_busca", $pedido->getHoraBusca());
                $stm->bindValue("entrega", $pedido->getEntrega());
                $stm->bindValue("desc_canc", $pedido->getDescCanc());
                $stm->bindValue("status", $pedido->getStatus());
                $stm->bindValue("id_mercado", $pedido->getMercado()->getId());

                $retorno = $stm->execute();
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que lista todos os pedidos do BD
        * @return array de Pedido
        * @version 1
        * @author Ives Matheus
        */
        public function listar()
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM pedido";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $pedido = new Pedido();
                    $pedido->setId($row["id"]);
                    $pedido->setTotal($row["total"]);
                    $pedido->setTroco($row["troco"]);
                    $pedido->setFormaPagamento($row["forma_pagamento"]);
                    $pedido->setCliente(ClienteDAO::listarPorId(new Cliente($row["id_cliente"], "", "", "")));

                    $pe = ($row["id_ponto_entrega"] != null) ? PontoEntrega::listarPorId(new PontoEntrega($row["id_ponto_entrega"], "", "", "", "", "", null)) : new PontoEntrega();

                    $pedido->setPontoEntrega($pe);
                    $pedido->setHoraBusca($row["hora_busca"]);
                    $pedido->setEntrega($row["entrega"]);
                    $pedido->setDescCanc($row["desc_canc"]);
                    $pedido->setStatus($row["status"]);
                    $mercado = new Mercado();
                    $mercado->setId($row["id_mercado"]);
                    $pedido->setMercado(MercadoDAO::listarPorId($mercado));

                    $retorno[$i] = $pedido;
                    $i++;
                }
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que procuta pedido pelo id
        * @param pedido contendo o id
        * @return pedido
        * @version 1
        * @author Ives Matheus
        */
        public static function listarPorId($pedido)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM pedido WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $pedido->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Pedido();
                    $retorno->setId($row["id"]);
                    $retorno->setTotal($row["total"]);
                    $retorno->setTroco($row["troco"]);
                    $retorno->setFormaPagamento($row["forma_pagamento"]);
                    $retorno->setCliente(ClienteDAO::listarPorId(new Cliente($row["id_cliente"], "", "", "")));

                    $pe = ($row["id_ponto_entrega"] != null) ? PontoEntrega::listarPorId(new PontoEntrega($row["id_ponto_entrega"], "", "", "", "", "", null)) : new PontoEntrega();

                    $retorno->setPontoEntrega($pe);
                    $retorno->setHoraBusca($row["hora_busca"]);
                    $retorno->setEntrega($row["entrega"]);
                    $retorno->setDescCanc($row["desc_canc"]);
                    $retorno->setStatus($row["status"]);
                    $mercado = new Mercado();
                    $mercado->setId($row["id_mercado"]);
                    $retorno->setMercado(MercadoDAO::listarPorId($mercado));
                }
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que retorna último id
        * @return pedido contendo o último id
        * @version 1
        * @author Ives Matheus
        */
        public static function ultimoId()
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM pedido ORDER BY id DESC";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Pedido();
                    $retorno->setId($row["id"]);
                    $retorno->setCliente(ClienteDAO::listarPorId(new Cliente($row["id_cliente"], "", "", "")));

                    $pe = ($row["id_ponto_entrega"] != null) ? PontoEntrega::listarPorId(new PontoEntrega($row["id_ponto_entrega"], "", "", "", "", "", null)) : new PontoEntrega();

                    $mercado = new Mercado();
                    $mercado->setId($row["id_mercado"]);
                    $retorno->setMercado($mercado);

                    $retorno->setPontoEntrega($pe);
                }
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que lista todos os pedidos do BD
        * @return array de Pedido
        * @version 1
        * @author Ives Matheus
        */
        public function listarPorCliente($cliente)
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM pedido WHERE id_cliente = :id_cliente ORDER BY id DESC";

                $stm = $con->prepare($sql);
                $stm->bindValue("id_cliente", $cliente->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $pedido = new Pedido();
                    $pedido->setId($row["id"]);
                    $pedido->setTotal($row["total"]);
                    $pedido->setTroco($row["troco"]);
                    $pedido->setFormaPagamento($row["forma_pagamento"]);
                    $pedido->setCliente(ClienteDAO::listarPorId(new Cliente($row["id_cliente"], "", "", "")));

                    $pe = ($row["id_ponto_entrega"] != null) ? PontoEntrega::listarPorId(new PontoEntrega($row["id_ponto_entrega"], "", "", "", "", "", null)) : new PontoEntrega();

                    $pedido->setPontoEntrega($pe);
                    $pedido->setHoraBusca($row["hora_busca"]);
                    $pedido->setEntrega($row["entrega"]);
                    $pedido->setDescCanc($row["desc_canc"]);
                    $pedido->setStatus($row["status"]);
                    $mercado = new Mercado();
                    $mercado->setId($row["id_mercado"]);
                    $pedido->setMercado(MercadoDAO::listarPorId($mercado));

                    $retorno[$i] = $pedido;
                    $i++;
                }
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que lista todos os pedidos de um mercado
        * @param $mercado objeto de Mercado
        * @return array de Pedido
        * @version 1
        * @author Ives Matheus
        */
        public function listarPorCliente($mercado)
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM pedido WHERE id_mercado = :id_mercado";

                $stm = $con->prepare($sql);
                $stm->bindValue("id_mercado", $mercado->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $pedido = new Pedido();
                    $pedido->setId($row["id"]);
                    $pedido->setTotal($row["total"]);
                    $pedido->setTroco($row["troco"]);
                    $pedido->setFormaPagamento($row["forma_pagamento"]);
                    $cliente = new Cliente($row["id_cliente"], "", "", "", "");
                    $pedido->setCliente(ClienteDAO::listarPorId($cliente));
                    $ponto_entrega = new PontoEntrega();
                    $ponto_entrega->setCliente($cliente);
                    $pe = ($row["entrega"]) ? PontoEntrega::listarPorId(new PontoEntrega($row["id_ponto_entrega"], "", "", "", "", "", null)) : $ponto_entrega;

                    $pedido->setPontoEntrega($pe);
                    $pedido->setHoraBusca($row["hora_busca"]);
                    $pedido->setEntrega($row["entrega"]);
                    $pedido->setDescCanc($row["desc_canc"]);
                    $pedido->setStatus($row["status"]);
                    $mercado = new Mercado();
                    $mercado->setId($row["id_mercado"]);
                    $pedido->setMercado(MercadoDAO::listarPorId($mercado));

                    $retorno[$i] = $pedido;
                    $i++;
                }
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }
    }

?>
