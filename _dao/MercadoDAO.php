<?php
    include_once "../_model/Conexao.php";
    include_once "../_model/Mercado.php";

    /**
    * Classe DAO de mercado que implementa métodos de CRUD e outras que meche no BD
    * @version 2
    * @author Ives Matheus
    */
    class MercadoDAO
    {
        public function __construct()
        {   }

        /**
        * Método que insere um mercado no BD
        * @param $mercado objeto de mercado contendo os dados a serem salvos no BD
        * @return true ou false para caso de sucesso da inserção de dados
        * @version 2
        * @author Ives Matheus
        */
        public function inserir($mercado)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "INSERT INTO mercado(nome, rua, bairro, numero, complemento, codigo, latitude, longitude, hora_abertura, hora_fechamento, logo, servico_entrega, taxa_entrega, vmc, login, senha) VALUES(:nome, :rua, :bairro, :numero, :complemento, :codigo, :latitude, :longitude, :hora_abertura, :hora_fechamento, :logo, :servico_entrega, :taxa_entrega, :vmc, :login, :senha)";

                $stm = $con->prepare($sql);
                $stm->bindValue("nome", $mercado->getNome());
                $stm->bindValue("rua", $mercado->getRua());
                $stm->bindValue("bairro", $mercado->getBairro());
                $stm->bindValue("numero", $mercado->getNumero());
                $stm->bindValue("complemento", $mercado->getComplemento());
                $stm->bindValue("codigo", $mercado->getCodigo());
                $stm->bindValue("latitude", $mercado->getLatitude());
                $stm->bindValue("longitude", $mercado->getLongitude());
                $stm->bindValue("hora_abertura", $mercado->getHoraAbertura());
                $stm->bindValue("hora_fechamento", $mercado->getHoraFechamento());
                $stm->bindValue("logo", $mercado->getLogo());
                $stm->bindValue("servico_entrega", $mercado->getServicoEntrega());
                $stm->bindValue("taxa_entrega", $mercado->getTaxaEntrega());
                $stm->bindValue("vmc", $mercado->getVmc());
                $stm->bindValue("login", $mercado->getLogin());
                $stm->bindValue("senha", $mercado->getSenha());

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
        * Método que lista todos os mercados do BD
        * @return array de Mercado
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
                $sql = "SELECT * FROM mercado";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $mercado = new Mercado();

                    $mercado->setId($row["id"]);
                    $mercado->setNome($row["nome"]);
                    $mercado->setRua($row["rua"]);
                    $mercado->setBairro($row["bairro"]);
                    $mercado->setNumero($row["numero"]);
                    $mercado->setComplemento($row["complemento"]);
                    $mercado->setCodigo($row["codigo"]);
                    $mercado->setLatitude($row["latitude"]);
                    $mercado->setLongitude($row["longitude"]);
                    $mercado->setHoraAbertura($row["hora_abertura"]);
                    $mercado->setHoraFechamento($row["hora_fechamento"]);
                    $mercado->setLogo($row["logo"]);
                    $mercado->setServicoEntrega($row["servico_entrega"]);
                    $mercado->setTaxaEntrega($row["taxa_entrega"]);
                    $mercado->setVmc($row["vmc"]);
                    $mercado->setLogin($row["login"]);
                    $mercado->setSenha($row["senha"]);

                    $retorno[$i] = $mercado;
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
        * Métood que retorna um mercado listado pelo ID
        * @param $mercado objeto de Mercado contendo o id
        * @return objeto de Mercado com os dados listados
        * @version 3
        * @author Ives Matheus
        */
        public static function listarPorId($mercado)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM mercado WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $mercado->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Mercado();

                    $retorno->setId($row["id"]);
                    $retorno->setNome($row["nome"]);
                    $retorno->setRua($row["rua"]);
                    $retorno->setBairro($row["bairro"]);
                    $retorno->setNumero($row["numero"]);
                    $retorno->setComplemento($row["complemento"]);
                    $retorno->setCodigo($row["codigo"]);
                    $retorno->setLatitude($row["latitude"]);
                    $retorno->setLongitude($row["longitude"]);
                    $retorno->setHoraAbertura($row["hora_abertura"]);
                    $retorno->setHoraFechamento($row["hora_fechamento"]);
                    $retorno->setLogo($row["logo"]);
                    $retorno->setServicoEntrega($row["servico_entrega"]);
                    $mercado->setTaxaEntrega($row["taxa_entrega"]);
                    $retorno->setVmc($row["vmc"]);
                    $retorno->setLogin($row["login"]);
                    $retorno->setSenha($row["senha"]);
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
        * Métood que retorna um mercado listado pelo código
        * @param $mercado objeto de Mercado contendo o codigo
        * @return objeto de Mercado com os dados listados
        * @version 3
        * @author Ives Matheus
        */
        public function listarPorCodigo($mercado)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM mercado WHERE codigo = :codigo";

                $stm = $con->prepare($sql);
                $stm->bindValue("codigo", $mercado->getCodigo());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Mercado();

                    $retorno->setId($row["id"]);
                    $retorno->setNome($row["nome"]);
                    $retorno->setRua($row["rua"]);
                    $retorno->setBairro($row["bairro"]);
                    $retorno->setNumero($row["numero"]);
                    $retorno->setComplemento($row["complemento"]);
                    $retorno->setCodigo($row["codigo"]);
                    $retorno->setLatitude($row["latitude"]);
                    $retorno->setLongitude($row["longitude"]);
                    $retorno->setHoraAbertura($row["hora_abertura"]);
                    $retorno->setHoraFechamento($row["hora_fechamento"]);
                    $retorno->setLogo($row["logo"]);
                    $retorno->setServicoEntrega($row["servico_entrega"]);
                    $retorno->setTaxaEntrega($row["taxa_entrega"]);
                    $retorno->setVmc($row["vmc"]);
                    $retorno->setLogin($row["login"]);
                    $retorno->setSenha($row["senha"]);
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

        public function verificaLogin($mercado)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM mercado WHERE login = :login AND senha = :senha";

                $stm = $con->prepare($sql);
                $stm->bindValue("login", $mercado->getLogin());
                $stm->bindValue("senha", $mercado->getSenha());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Mercado();

                    $retorno->setId($row["id"]);
                    $retorno->setNome($row["nome"]);
                    $retorno->setRua($row["rua"]);
                    $retorno->setBairro($row["bairro"]);
                    $retorno->setNumero($row["numero"]);
                    $retorno->setComplemento($row["complemento"]);
                    $retorno->setCodigo($row["codigo"]);
                    $retorno->setLatitude($row["latitude"]);
                    $retorno->setLongitude($row["longitude"]);
                    $retorno->setHoraAbertura($row["hora_abertura"]);
                    $retorno->setHoraFechamento($row["hora_fechamento"]);
                    $retorno->setLogo($row["logo"]);
                    $retorno->setServicoEntrega($row["servico_entrega"]);
                    $retorno->setTaxaEntrega($row["taxa_entrega"]);
                    $retorno->setVmc($row["vmc"]);
                    $retorno->setLogin($row["login"]);
                    $retorno->setSenha($row["senha"]);
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
        * Método que atualiza os dados de um mercado que possue o id passado
        * @param $mercado objeto de Mercado contendo o id que será usado no filtro e os novos dados do mercado
        * @return verdadeiro ou falso para caso de sucesso na atualização dos dados
        * @version 2
        * @author Ives Matheus
        */
        public function atualizar($mercado)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "UPDATE mercado SET nome = :nome, rua = :rua, bairro = :bairro, numero = :numero, complemento = :complemento, codigo = :codigo, latitude = :latitude, longitude = :longitude, hora_abertura = :hora_abertura, hora_fechamento = :hora_fechamento, logo = :logo, servico_entrega = :servico_entrega, taxa_entrega = :taxa_entrega, vmc = :vmc, login = :login, senha = :senha WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $mercado->getId());
                $stm->bindValue("nome", $mercado->getNome());
                $stm->bindValue("rua", $mercado->getRua());
                $stm->bindValue("bairro", $mercado->getBairro());
                $stm->bindValue("numero", $mercado->getNumero());
                $stm->bindValue("complemento", $mercado->getComplemento());
                $stm->bindValue("codigo", $mercado->getCodigo());
                $stm->bindValue("latitude", $mercado->getLatitude());
                $stm->bindValue("longitude", $mercado->getLongitude());
                $stm->bindValue("hora_abertura", $mercado->getHoraAbertura());
                $stm->bindValue("hora_fechamento", $mercado->getHoraFechamento());
                $stm->bindValue("logo", $mercado->getLogo());
                $stm->bindValue("servico_entrega", $mercado->getServicoEntrega() == 1 ? true : false);
                $stm->bindValue("taxa_entrega", $mercado->getTaxaEntrega());
                $stm->bindValue("vmc", $mercado->getVmc());
                $stm->bindValue("login", $mercado->getLogin());
                $stm->bindValue("senha", $mercado->getSenha());

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
        * Método que exclui um mercado do BD
        * @param $mercado objeto contendo o id do mercado a ser excluído
        * @return verdadeiro ou falso para caso de sucesso de exclusão
        * @version 2
        * @author Ives Matheus
        */
        public function excluir($mercado)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "DELETE FROM mercado WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $mercado->getId());
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
    }

?>
