<?php

    include_once "../_model/Conexao.php";
    include_once "ClienteDAO.php";
    include_once "../_model/PontoEntrega.php";

    /**
    * Classe DAO de cliente que implementa métodos de CRUD e outras que meche no BD
    * @version 2
    * @author Ives Matheus
    */
    class PontoEntregaDAO
    {
        public function __construct()
        {   }

        /**
        * Método que inseri um cliente no BD
        * @param $cliente objeto de Clinete contendo dados a serem inseridos
        * @return verdadeiro ou falso para caso de sucesso na inserção de dados
        * @version 1
        * @author Ives Matheus
        */
        public function inserir($pontoEntrega)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "INSERT INTO ponto_entrega(nome, rua, numero, bairro, complemento, id_cliente) VALUES(:nome, :rua, :numero, :bairro, :complemento, :id_cliente)";

                $stm = $con->prepare($sql);
                $stm->bindValue("nome", $pontoEntrega->getNome());
                $stm->bindValue("rua", $pontoEntrega->getRua());
                $stm->bindValue("numero", $pontoEntrega->getNumero());
                $stm->bindValue("bairro", $pontoEntrega->getBairro());
                $stm->bindValue("complemento", $pontoEntrega->getComplemento());
                $stm->bindValue("id_cliente", $pontoEntrega->getCliente()->getId());

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
        * Método que lista todos os clientes do BD
        * @return array de Cliente
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
                $sql = "SELECT * FROM ponto_entrega";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $pontoEntrega = new pontoEntrega();
                    $pontoEntrega->setId($row["id"]);
                    $pontoEntrega->setNome($row["nome"]);
                    $pontoEntrega->setRua($row["rua"]);
                    $pontoEntrega->setBairro($row["bairro"]);
                    $pontoEntrega->setNumero($row["numero"]);
                    $pontoEntrega->setComplemento($row["complemento"]);
                    $pontoEntrega->setCliente(ClienteDAO::listPorId(new Cliente($row["id_cliente"], "", "", "")));

                    $retorno[$i] = $pontoEntrega;
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
        * Método que procura ponto de entrega pelo id
        * @param pedido contendo o id a ser filtrado
        * @return pedido
        * @version 1
        * @author Ives Matheus
        */
        public static function listarPorId($pontoEntrega)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM ponto_entrega WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $pontoEntrega->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new pontoEntrega();
                    $retorno->setId($row["id"]);
                    $retorno->setNome($row["nome"]);
                    $retorno->setRua($row["rua"]);
                    $retorno->setBairro($row["bairro"]);
                    $retorno->setNumero($row["numero"]);
                    $retorno->setComplemento($row["complemento"]);
                    $retorno->setCliente(ClienteDAO::listPorId(new Cliente($row["id_cliente"], "", "", "")));
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
        * Método que lista todos os clientes do BD
        * @return array de Cliente
        * @version 1
        * @author Ives Matheus
        */
        public function ultimoId()
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT id FROM ponto_entrega ORDER BY id DESC";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new pontoEntrega();
                    $retorno->setId($row["id"]);
                    $retorno->setCliente(new Cliente('', '', ''));
                    break;
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

        //ATUALIZAR DEPOIS

        /**
        * Método que lista um cliente filtrado pelo id
        * @param $cliente objeto de Cliente contendo o id a ser filtrado
        * @return objeto de Cliente contedo os dados listados
        * @version 2
        * @author Ives Matheus
        *//*
        public static function listarPorId($cliente)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM cliente WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $cliente->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Cliente();
                    $retorno->setId($row["id"]);
                    $retorno->setNome($row["nome"]);
                    $retorno->setLogin($row["login"]);
                    $retorno->setSenha($row["senha"]);
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
        * Método que verifica login
        * @param $cliente objeto de Cliente contendo os dados de login e senha
        * @return objeto de Cliente
        * @version 1
        * @author Ives Matheus
        *//*
        public function login($cliente)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM cliente WHERE login = :login AND senha = :senha";

                $stm = $con->prepare($sql);
                $stm->bindValue("login", $cliente->getLogin());
                $stm->bindValue("senha", $cliente->getSenha());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Cliente();
                    $retorno->setId($row["id"]);
                    $retorno->setNome($row["nome"]);
                    $retorno->setLogin($row["login"]);
                    $retorno->setSenha($row["senha"]);
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
        * Método que atualiza os dados de um cliente no BD
        * @param $cliente objeto de Cliente contendo os dados a serem atualizados e o id do cliente que vai atualizar
        * @return verdadeiro ou falso para caso de sucesso na atualização dos dados
        * @version 1
        * @author Ives Matheus
        *//*
        public function atualizar($cliente)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "UPDATE cliente SET nome = :nome, login = :login, senha = :senha WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $cliente->getId());
                $stm->bindValue("nome", $cliente->getNome());
                $stm->bindValue("login", $cliente->getLogin());
                $stm->bindValue("senha", $cliente->getSenha());

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
        * Método que exclui um cliente do BD
        * @param $cliente objeto de Cliente contendo o id do cliente a ser excluído
        * @return verdadeiro ou falso para caso de sucesso na exclusão de um cliente no BD
        * @version 1
        * @author Ives Matheus
        *//*
        public function excluir($cliente)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "DELETE FROM cliente WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $cliente->getId());
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
        }*/
    }

?>
