<?php
    include_once "../_model/Conexao.php";
    include_once "../_model/Imagem.php";
    include_once "CategoriaDAO.php";

    /**
    * Classe DAO de imagem que implementa métodos de CRUD e outras que meche no BD
    * @version 1
    * @author Ives Matheus
    */
    class ImagemDAO
    {
        public function __construct()
        {   }

        /**
        * Método que insere várias imagens no BD
        * @param array de Imagem
        * @return Verdadeiro ou Falso para caso de sucesso na inserção de dados
        * @version 1
        * @author Ives Matheus
        */
        public function inserir($imagens)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "INSERT INTO imagem(caminho, id_categoria) VALUES(:caminho, :id_categoria)";
                //$con->exec("set names utf8");
                $con->beginTransaction();

                foreach ($imagens as $key => $imagem)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("caminho", $imagem->getCaminho());
                    $stm->bindValue("id_categoria", $imagem->getCategoria()->getId());

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
        * Método que lista todas as imagem salvas no BD
        * @return array de Imagem
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
                $sql = "SELECT * FROM imagem";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $imagem = new Imagem();
                    $imagem->setId($row["id"]);
                    $imagem->setCaminho($row["caminho"]);
                    $imagem->setCategoria(CategoriaDAO::listarPorId(new Categoria($row["id_categoria"], "", "", "")));

                    $retorno[$i] = $imagem;
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
        * Método que lista uma imagem filtrada pelo seu id
        * @param $imagem obejto de Imagem contendo o id a ser filtrado
        * @return objeto de Imagem contendo os dados listados
        * @version 1
        * @author Ives Matheus
        */
        public static function listarPorId($imagem)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM imagem WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $imagem->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Imagem();
                    $retorno->setId($row["id"]);
                    $retorno->setCaminho($row["caminho"]);
                    $retorno->setCategoria(CategoriaDAO::listarPorId(new Categoria($row["id_categoria"], "", "", "")));
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
        * Método que lista uma imagem filtrada pela categoria
        * @param $categoria obejto de Categoria contendo o id a ser filtrado
        * @return array de Imagem contendo os dados listados
        * @version 1
        * @author Ives Matheus
        */
        public function listarPorCategoria($categoria)
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM imagem WHERE id_categoria = :id_categoria";

                $stm = $con->prepare($sql);
                $stm->bindValue("id_categoria", $categoria->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $imagem = new Imagem();
                    $imagem->setId($row["id"]);
                    $imagem->setCaminho($row["caminho"]);
                    $imagem->setCategoria(CategoriaDAO::listarPorId(new Categoria($row["id_categoria"], "", "", "")));

                    $retorno[$i] = $imagem;
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
        * Método que atualiza dados de várias imagens
        * @param $imagens array de Imagem
        * @return verdadeiro ou falso para caso de sucesso para atualização dos dados
        * @version 1
        * @author Ives Matheus
        */
        public function atualizar($imagens)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "UPDATE imagem SET caminho = :caminho, id_categoria = :id_categoria WHERE id = :id";
                //$con->exec("set names utf8");
                $con->beginTransaction();

                foreach ($imagens as $key => $imagem)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("id", $imagem->getId());
                    $stm->bindValue("caminho", $imagem->getCaminho());
                    $stm->bindValue("id_categoria", $imagem->getCategoria()->getId());

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
        * Método que exclui várias imagens do BD
        * @param $imagens array de Imagem
        * @return verdadeiro ou falso para caso de sucesso na atualização dos dados no BD
        * @version 1
        * @author Ives Matheus
        */
        public function excluir($imagens)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "DELETE FROM imagem WHERE id = :id";
                //$con->exec("set names utf8");
                $con->beginTransaction();

                foreach ($imagens as $key => $imagem)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("id", $imagem->getId());
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
