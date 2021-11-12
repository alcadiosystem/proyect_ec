<?php 
        class ConexionMySQLPHP {

		private $host ;
		private $baseDatos;
		private $usuario;
		private $password;


        public function __construct($host, $baseDatos,$usuario,$password) {

        	$this->host = $host;
        	$this->baseDatos = $baseDatos;
        	$this->usuario = $usuario;
        	$this->password = $password;


        }


        public function getConexion() {

        	try {
        	
        		$conexion = new PDO("mysql:host=".$this->host.
                                ";dbname=".$this->baseDatos,
                                $this->usuario,
                                $this->password
                                );


            } catch (PDOException $exception) {

            	echo "Error de conexión ". $exception->getMessage();

            }

        	return $conexion;


        }


	}


 ?>