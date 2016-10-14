<?php
    /**
    * Classe que representa um mercado
    * @version 1
    * @author Ives Matheus
    */
    class Mercado
    {
        /**
        * Id do mercado
        */
        private $id;
        /**
        * Nome do mercado
        */
        private $nome;
        /**
        * Rua do endereço do mercado
        */
        private $rua;
        /**
        * Bairro do endereço do mercado
        */
        private $bairro;
        /**
        * Número do endereço do mercado
        */
        private $numero;
        /**
        * Complemento do endereço do mercado
        */
        private $complemento;
        /**
        * Código do mercado (código único de busca)
        */
        private $codigo;
        /**
        * Latitude do mercado no gps
        */
        private $latitude;
        /**
        * Longitude do mercado no gps
        */
        private $longitude;
        /**
        * Para mercados que possuem entrega: hora de início das entregas
        * Para mercados que não possuem entrega: hora em que o mercado abre
        */
        private $hora_abertura;
        /**
        * Para mercados que possuem entrega: hora em que o mercado para de fazer entregas
        * Para mercados que não possuem entrega: hora em que o mercado fecha
        */
        private $hora_fechamento;
        /**
        * Imagem representativa do mercado
        */
        private $logo;
        /**
        * Booleano que diz se o mercado possui serviço de entrega ou não
        */
        private $servico_entrega;
        /**
        * Taxa de entrega do mercado
        */
        private $taxa_entrega;
        /**
        * Valor mínimo de compra para o mercado fazer entrega (Para os que possuem o serviço)
        */
        private $vmc;
        /**
        * Login do mercado no site
        */
        private $login;
        /**
        * Senha do mercado no site
        */
        private $senha;

        public function __construct()
        {
            $args = func_get_args();
            $num_args = func_num_args();

            if($num_args == 17)
            {
                $this->id = $args[0];
                $this->nome = $args[1];
                $this->rua = $args[2];
                $this->bairro = $args[3];
                $this->numero = $args[4];
                $this->complemento = $args[5];
                $this->codigo = $args[6];
                $this->latitude = $args[7];
                $this->longitude = $args[8];
                $this->hora_abertura = $args[9];
                $this->hora_fechamento = $args[10];
                $this->logo = $args[11];
                $this->servico_entrega = $args[12];
                $this->taxa_entrega = $args[13];
                $this->vmc = $args[14];
                $this->login = $args[15];
                $this->senha = $args[16];
            }
            else if($num_args == 16)
            {
                $this->id = 0;
                $this->nome = $args[0];
                $this->rua = $args[1];
                $this->bairro = $args[2];
                $this->numero = $args[3];
                $this->complemento = $args[4];
                $this->codigo = $args[5];
                $this->latitude = $args[6];
                $this->longitude = $args[7];
                $this->hora_abertura = $args[8];
                $this->hora_fechamento = $args[9];
                $this->logo = $args[10];
                $this->servico_entrega = $args[11];
                $this->taxa_entrega = $args[12];
                $this->vmc = $args[13];
                $this->login = $args[14];
                $this->senha = $args[15];
            }
            else
            {
                $this->id = 0;
                $this->nome = "";
                $this->rua = "";
                $this->bairro = "";
                $this->numero = 0;
                $this->complemento = "";
                $this->codigo = "";
                $this->latitude = 0;
                $this->longitude = 0;
                $this->hora_abertura = 0;
                $this->hora_fechamento = 0;
                $this->logo = "";
                $this->servico_entrega = false;
                $this->taxa_entrega = 0;
                $this->vmc = 0;
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

        public function setNome($nome)
        {
            $this->nome = $nome;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function setRua($rua)
        {
            $this->rua = $rua;
        }

        public function getRua()
        {
            return $this->rua;
        }

        public function setBairro($bairro)
        {
            $this->bairro = $bairro;
        }

        public function getBairro()
        {
            return $this->bairro;
        }

        public function setNumero($numero)
        {
            $this->numero = $numero;
        }

        public function getNumero()
        {
            return $this->numero;
        }

        public function setComplemento($complemento)
        {
            $this->complemento = $complemento;
        }

        public function getComplemento()
        {
            return $this->complemento;
        }

        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }

        public function getCodigo()
        {
            return $this->codigo;
        }

        public function setLatitude($latitude)
        {
            $this->latitude = $latitude;
        }

        public function getLatitude()
        {
            return $this->latitude;
        }

        public function setLongitude($longitude)
        {
            $this->longitude = $longitude;
        }

        public function getLongitude()
        {
            return $this->longitude;
        }

        public function setHoraAbertura($hora_abertura)
        {
            $this->hora_abertura = $hora_abertura;
        }

        public function getHoraAbertura()
        {
            return $this->hora_abertura;
        }

        public function setHoraFechamento($hora_fechamento)
        {
            $this->hora_fechamento = $hora_fechamento;
        }

        public function getHoraFechamento()
        {
            return $this->hora_fechamento;
        }

        public function setLogo($logo)
        {
            $this->logo = $logo;
        }

        public function getLogo()
        {
            return $this->logo;
        }

        public function setServicoEntrega($servico_entrega)
        {
            $this->servico_entrega = $servico_entrega;
        }

        public function getServicoEntrega()
        {
            return $this->servico_entrega;
        }

        public function setTaxaEntrega($taxa_entrega)
        {
            $this->taxa_entrega = $taxa_entrega;
        }

        public function getTaxaEntrega()
        {
            return $this->taxa_entrega;
        }

        public function setVmc($vmc)
        {
            $this->vmc =$vmc;
        }

        public function getVmc()
        {
            return $this->vmc;
        }

        public function setLogin($login)
        {
            $this->login = $login;
        }

        public function getLogin()
        {
            return $this->login;
        }

        public function setSenha($senha)
        {
            $this->senha = $senha;
        }

        public function getSenha()
        {
            return $this->senha;
        }

        public function toArray()
        {
            return array('id'=>$this->id,
                        'nome'=>$this->nome,
                        'rua'=>$this->rua,
                        'numero'=>$this->numero,
                        'bairro'=>$this->bairro,
                        'complemento'=>$this->complemento,
                        'codigo'=>$this->codigo,
                        'latitude'=>$this->latitude,
                        'longitude'=>$this->longitude,
                        'hora_abertura'=>$this->hora_abertura,
                        'hora_fechamento'=>$this->hora_fechamento,
                        'logo'=>$this->logo,
                        'servico_entrega'=>$this->servico_entrega,
                        'taxa_entrega'=>$this->taxa_entrega,
                        'vmc'=>$this->vmc,
                        'login'=>$this->login,
                        'senha'=>$this->senha);
        }

        public function __toString()
        {
            return $this->id."<br>".$this->nome."<br>".$this->rua."<br>".$this->bairro."<br>".$this->numero."<br>".$this->complemento."<br>".$this->codigo."<br>".$this->latitude."<br>".$this->longitude."<br>".$this->hora_abertura."<br>".$this->hora_fechamento."<br>".$this->logo."<br>".$this->servico_entrega."<br>".$this->taxa_entrega."<br>".$this->vmc."<br>".$this->login."<br>".$this->senha."<br>";
        }
    }
?>
