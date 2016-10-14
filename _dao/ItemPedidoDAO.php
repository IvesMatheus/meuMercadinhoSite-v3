<?php

    include_once "../_model/Conexao.php";
    include_once "../_model/ItemPedido.php";
    include_once "PedidoDAO.php";
    include_once "ProdutoDAO.php";

    /**
    * Classe DAO de item de pedido que implementa métodos de CRUD e outras que meche no BD
    * @version 1
    * @author Ives Matheus
    */
    class ItemPedidoDAO
    {
        public function __construct()
        {   }

        /**
        * Método que inseri um array de item de pedido no BD
        * @param $itemPedidos array de objetos de ItemPedido contendo dados a serem inseridos
        * @return verdadeiro ou falso para caso de sucesso na inserção de dados
        * @version 1
        * @author Ives Matheus
        */
        public function inserir($itemPedidos)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "INSERT INTO item_pedido(id_compra, id_produto, quantidade) VALUES(:id_compra, :id_produto, :quantidade)";

                $con->beginTransaction();

                foreach ($itemPedidos as $key => $itemPedido)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("id_compra", $itemPedido->getCompra()->getId());
                    $stm->bindValue("id_produto", $itemPedido->getProduto()->getId());
                    $stm->bindValue("quantidade", $itemPedido->getQuantidade());

                    $stm->execute();
                }

                $retorno = $con->commit();
            }
            catch (PDOException $e)
            {
                $con->rollBack();
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que lista todos os itens de pedidos do BD
        * @return array de ItemPedido
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
                $sql = "SELECT * FROM item_pedido";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $itemPedido = new ItemPedido();
                    $pedido = new Pedido();
                    $pedido->setId($row["id_compra"]);
                    $itemPedido->setCompra(Pedido::listarPorId($pedido));
                    $produto = new Produto();
                    $produto->setId($row["id_produto"]);
                    $itemPedido->setProduto(Produto::listarPorId($produto));
                    $itemPedido->setQuantidade($row["quantidade"]);

                    $retorno[$i] = $itemPedido;
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
        * Método que procuta item de pedido pelo id
        * @param item pedido contendo o id
        * @return item pedido
        * @version 1
        * @author Ives Matheus
        */
        public static function listarPorId($itempedido)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM item_pedido WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $itemPedido->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new ItemPedido();
                    $pedido = new Pedido();
                    $pedido->setId($row["id_compra"]);
                    $retorno->setCompra(Pedido::listarPorId($pedido));
                    $produto = new Produto();
                    $produto->setId($row["id_produto"]);
                    $retorno->setProduto(Produto::listarPorId($produto));
                    $retorno->setQuantidade($row["quantidade"]);
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
