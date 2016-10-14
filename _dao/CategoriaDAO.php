<?php
    include_once "../_model/Conexao.php";
    include_once "../_model/Categoria.php";

    /**
    * Classe DAO de categoria que implementa métodos de CRUD e outras que meche no BD
    * @version 1
    * @author Ives Matheus
    */
    class CategoriaDAO
    {
        public function __construct()
        {   }

        /**
        * Método que insere várias categorias no BD
        * @param $categorias array de categoria
        * @return true ou false para caso de sucesso da inserção de dados
        * @version 1
        * @author Ives Matheus
        */
        public function inserir($categorias)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "INSERT INTO categoria(nome, descricao, imagem) VALUES(:nome, :descricao, :imagem)";
                //$con->exec("set names utf8");
                $con->beginTransaction();

                foreach ($categorias as $key => $categoria)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("nome", $categoria->getNome());
                    $stm->bindValue("descricao", $categoria->getDescricao());
                    $stm->bindValue("imagem", $categoria->getImagem());

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
        * Método que lista todos as categorias no BD
        * @return array contendo todas as categorias do BD
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
                $sql = "SELECT * FROM categoria";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $categoria = new Categoria();
                    $categoria->setId($row["id"]);
                    $categoria->setNome($row["nome"]);
                    $categoria->setDescricao($row["descricao"]);
                    $categoria->setImagem($row["imagem"]);

                    $retorno[$i] = $categoria;
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
        * Método que procura uma categoria filtrada pelo seu id no BD
        * @param $categoria objeto contendo o id
        * @return retorna uma categoria resultado da consulta ou null caso não exista
        * @version 2
        * @author Ives Matheus
        */
        public static function listarPorId($categoria)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM categoria WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $categoria->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Categoria();
                    $retorno->setId($row["id"]);
                    $retorno->setNome($row["nome"]);
                    $retorno->setDescricao($row["descricao"]);
                    $retorno->setImagem($row["imagem"]);
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
        * Método que atualiza várias categorias no BD
        * @param $categorias array de categoria
        * @return true ou false para caso de sucesso na atualização de dados
        * @version 1
        * @author Ives Matheus
        */
        public function atualizar($categorias)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "UPDATE categoria SET nome = :nome, descricao = :descricao, imagem = :imagem WHERE id = :id";
                $con->beginTransaction();

                foreach ($categorias as $key => $categoria)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("id", $categoria->getId());
                    $stm->bindValue("nome", $categoria->getNome());
                    $stm->bindValue("descricao", $categoria->getDescricao());
                    $stm->bindValue("imagem", $categoria->getImagem());

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
        * Método que exclui várias categorias
        * @param $categorias array de categoria
        * @return true ou false para caso de sucesso na exclusão de dados
        * @version 1
        * @author Ives Matheus
        */
        public function excluir($categorias)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "DELETE FROM categoria WHERE id = :id";
                $con->beginTransaction();

                foreach ($categorias as $key => $categoria)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("id", $categoria->getId());
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
