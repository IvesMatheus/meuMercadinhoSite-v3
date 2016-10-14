<?php
    include_once "../_model/Conexao.php";
    include_once "../_model/Produto.php";
    include_once "MercadoDAO.php";
    include_once "CategoriaDAO.php";
    include_once "ImagemDAO.php";

    /**
    * Classe DAO de produto que implementa métodos de CRUD e outras que meche no BD
    * @version 3
    * @author Ives Matheus
    */
    class ProdutoDAO
    {
        public function __construct()
        {   }

        /**
        * Método que inseri vários produtos no BD
        * @param $produtos array de Produto
        * @return Verdadeiro ou falso para caso de sucesso na inserção de dados
        * @version 2
        * @author Ives Matheus
        */
        public function inserir($produtos)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "INSERT INTO produto(nome, peso, validade, quantidade, preco, id_categoria, descricao, id_mercado, id_imagem) VALUES(:nome, :peso, :validade, :quantidade, :preco, :id_categoria, :descricao, :id_mercado, :id_imagem)";
                //$con->exec("set names utf8");
                $con->beginTransaction();

                foreach ($produtos as $key => $produto)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("nome", $produto->getNome());
                    $stm->bindValue("peso", $produto->getPeso());
                    $stm->bindValue("validade", $produto->getValidade());
                    $stm->bindValue("quantidade", $produto->getQuantidade());
                    $stm->bindValue("preco", $produto->getPreco());
                    $stm->bindValue("id_categoria", $produto->getCategoria()->getId());
                    $stm->bindValue("descricao", $produto->getDescricao());
                    $stm->bindValue("id_mercado", $produto->getMercado()->getId());
                    $stm->bindValue("id_imagem", $produto->getImagem()->getId());

                    $stm->execute();
                }

                $retorno = $con->commit();
            }
            catch (PDOException $e)
            {
                // $retorno = $con->rollBack();
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que lista todos os produtos do BD
        * @return array de Produto
        * @version 2
        * @author Ives Matheus
        */
        public function listar()
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM produto";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $produto = new Produto();

                    $produto->setId($row["id"]);
                    $produto->setNome($row["nome"]);
                    $produto->setPeso($row["peso"]);
                    $produto->setValidade($row["validade"]);
                    $produto->setQuantidade($row["quantidade"]);
                    $produto->setPreco($row["preco"]);
                    $produto->setCategoria(CategoriaDAO::listarPorId(new Categoria($row["id_categoria"], "", "", "")));
                    $produto->setDescricao($row["descricao"]);
                    $produto->setMercado(MercadoDAO::listarPorId(new Mercado($row["id_mercado"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")));
                    $produto->setImagem(ImagemDAO::listarPorId(new Imagem($row["id_imagem"], "", null)));

                    $retorno[$i] = $produto;
                    $i++;
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que lista todos os produtos pelo seu id
        * @param $produto objeto de Produto contendo o id a ser filtrado
        * @return objeto de Produto
        * @version 3
        * @author Ives Matheus
        */
        public static function listarPorId($produto)
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM produto WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $produto->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $produto = new Produto();

                    $produto->setId($row["id"]);
                    $produto->setNome($row["nome"]);
                    $produto->setPeso($row["peso"]);
                    $produto->setValidade($row["validade"]);
                    $produto->setQuantidade($row["quantidade"]);
                    $produto->setPreco($row["preco"]);
                    $produto->setCategoria(CategoriaDAO::listarPorId(new Categoria($row["id_categoria"], "", "", "")));
                    $produto->setDescricao($row["descricao"]);
                    $produto->setMercado(MercadoDAO::listarPorId(new Mercado($row["id_mercado"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")));
                    $produto->setImagem(ImagemDAO::listarPorId(new Imagem($row["id_imagem"], "", null)));

                    $retorno[$i] = $produto;
                    $i++;
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que lista todos os produtos pelo seu nome
        * @param $produto objeto de Produto contendo o nome a ser filtrado
        * @return objeto de Produto
        * @version 1
        * @author Ives Matheus
        */
        public static function listarPorNome($produto)
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM produto WHERE nome = :nome AND id_mercado = :id_mercado";

                $stm = $con->prepare($sql);
                $stm->bindValue("nome", $produto->getNome());
                $stm->bindValue("id_mercado", $produto->getMercado()->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $produto = new Produto();

                    $produto->setId($row["id"]);
                    $produto->setNome($row["nome"]);
                    $produto->setPeso($row["peso"]);
                    $produto->setValidade($row["validade"]);
                    $produto->setQuantidade($row["quantidade"]);
                    $produto->setPreco($row["preco"]);
                    $produto->setCategoria(CategoriaDAO::listarPorId(new Categoria($row["id_categoria"], "", "", "")));
                    $produto->setDescricao($row["descricao"]);
                    $produto->setMercado(MercadoDAO::listarPorId(new Mercado($row["id_mercado"], "", "", "", "", "", "", "", "", "", "", "", "", "", "")));
                    $produto->setImagem(ImagemDAO::listarPorId(new Imagem($row["id_imagem"], "", null)));

                    $retorno[$i] = $produto;
                    $i++;
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }


        /**
        * Método que lista todos os produtos de um mercado
        * @param $mercado objeto de Mercado contendo o id a ser filtrado
        * @return array de Produto
        * @version 1
        * @author Ives Matheus
        */
        public function listarPorMercado($mercado)
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM produto WHERE id_mercado = :id_mercado";

                $stm = $con->prepare($sql);
                $stm->bindValue("id_mercado", $mercado->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $produto = new Produto();

                    $produto->setId($row["id"]);
                    $produto->setNome($row["nome"]);
                    $produto->setPeso($row["peso"]);
                    $produto->setValidade($row["validade"]);
                    $produto->setQuantidade($row["quantidade"]);
                    $produto->setPreco($row["preco"]);
                    $produto->setCategoria(CategoriaDAO::listarPorId(new Categoria($row["id_categoria"], "", "", "")));
                    $produto->setDescricao($row["descricao"]);
                    $produto->setMercado(MercadoDAO::listarPorId(new Mercado($row["id_mercado"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")));
                    $produto->setImagem(ImagemDAO::listarPorId(new Imagem($row["id_imagem"], "", null)));

                    $retorno[$i] = $produto;
                    $i++;
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que lista todos os produtos de uma categoria
        * @param $categoria objeto de Categoria contendo o id a ser filtrado
        * @return array de Produto
        * @version 1
        * @author Ives Matheus
        */
        public function listarPorCategoria($categoria, $mercado)
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM produto WHERE id_categoria = :id_categoria AND id_mercado = :id_mercado";

                $stm = $con->prepare($sql);
                $stm->bindValue("id_categoria", $categoria->getId());
                $stm->bindValue("id_mercado", $mercado->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $produto = new Produto();

                    $produto->setId($row["id"]);
                    $produto->setNome($row["nome"]);
                    $produto->setPeso($row["peso"]);
                    $produto->setValidade($row["validade"]);
                    $produto->setQuantidade($row["quantidade"]);
                    $produto->setPreco($row["preco"]);
                    $produto->setCategoria(CategoriaDAO::listarPorId(new Categoria($row["id_categoria"], "", "", "")));
                    $produto->setDescricao($row["descricao"]);
                    $produto->setMercado(MercadoDAO::listarPorId(new Mercado($row["id_mercado"], "", "", "", "", "", "", "", "", "", "", "", "", "", "")));
                    $produto->setImagem(ImagemDAO::listarPorId(new Imagem($row["id_imagem"], "", null)));

                    $retorno[$i] = $produto;
                    $i++;
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que atualiza vários produtos
        * @param $produtos array de Produto
        * @return Verdadeiro ou falso para caso de sucesso na atualização dos dados
        * @version 2
        * @author Ives Matheus
        */
        public function atualizar($produtos)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "UPDATE produto SET nome = :nome, peso = :peso, validade = :validade, quantidade = :quantidade, preco = :preco, id_categoria = :id_categoria, descricao = :descricao, id_mercado = :id_mercado, id_imagem = :id_imagem WHERE id = :id";
                //$con->exec("set names utf8");
                $con->beginTransaction();

                foreach ($produtos as $key => $produto)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("id", $produto->getId());
                    $stm->bindValue("nome", $produto->getNome());
                    $stm->bindValue("peso", $produto->getPeso());
                    $stm->bindValue("validade", $produto->getValidade());
                    $stm->bindValue("quantidade", $produto->getQuantidade());
                    $stm->bindValue("preco", $produto->getPreco());
                    $stm->bindValue("id_categoria", $produto->getCategoria()->getId());
                    $stm->bindValue("descricao", $produto->getDescricao());
                    $stm->bindValue("id_mercado", $produto->getMercado()->getId());
                    $stm->bindValue("id_imagem", $produto->getImagem()->getId());

                    $stm->execute();
                }

                $retorno = $con->commit();
            }
            catch (PDOException $e)
            {
                $retorno = $con->rollBack();
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que exclui vários produtos do BD
        * @param $produtos array de Produto
        * @return Verdadeiro ou falso para caso de sucesso na exclusão dos dados
        * @version 2
        * @author Ives Matheus
        */
        public function excluir($produtos)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "DELETE FROM produto WHERE id = :id";
                //$con->exec("set names utf8");
                $con->beginTransaction();

                foreach ($produtos as $key => $produto)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("id", $produto->getId());
                    $stm->execute();
                }

                $retorno = $con->commit();
            }
            catch (PDOException $e)
            {
                $retorno = $con->rollBack();
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }
    }
?>
