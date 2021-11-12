<?php
    include '../conexion/ConexionMySQLPHP.php';

    class ControladorEmpleado {

        private $tabla ="empleados";
        private $conexion;

        public function __construct(){
            $conexionMySQL = new ConexionMySQLPHP("localhost", "proyecto", "root", "");
            $this->conexion= $conexionMySQL->getConexion();
        }

        public function guardar($datos){
            
            $sql = "Select 1 From $this->tabla Where identificacion=?";

            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $datos->identificacion);
            $sentencia->execute();

            $numeroRegistros=$sentencia->rowCount();

            if($numeroRegistros > 0){
				
                $sql="Update $this->tabla  Set nombres=?, apellidos=?, nombreUsuario=?, direccion=?, telefono=?, clave=?, rol=? Where identificacion=?";

                $stmt = $this->conexion -> prepare($sql);
                $stmt -> bindParam(1,$datos->nombres );
                $stmt -> bindParam(2,$datos->apellidos );
                $stmt -> bindParam(3,$datos->nombreUsuario );
                $stmt -> bindParam(4,$datos->direccion );
                $stmt -> bindParam(5,$datos->telefono );
                $stmt -> bindParam(6,$datos->clave );
                $stmt -> bindParam(7,$datos->rol );
                $stmt -> bindParam(8,$datos->identificacion );

            }else{

                $sql="Insert Into $this->tabla Values(?,?,?,?,?,?,?,?)";
                $stmt = $this->conexion -> prepare($sql);
                $stmt -> bindParam(1,$datos->identificacion );
                $stmt -> bindParam(2,$datos->nombres );
                $stmt -> bindParam(3,$datos->apellidos );
                $stmt -> bindParam(4,$datos->nombreUsuario );
                $stmt -> bindParam(5,$datos->direccion );
                $stmt -> bindParam(6,$datos->telefono );
                $stmt -> bindParam(7,$datos->clave );
                $stmt -> bindParam(8,$datos->rol );

            }

            if ($stmt ->execute()) {

                return true;

            } else {

                
                echo var_dump("hola".$datos);
                echo $datos->identificacion;
                echo var_dump($stmt->errorInfo());
                return false;    
            }          

            

        }


        public function eliminar($datos) {

            $sql="Delete from $this->tabla Where identificacion=? ";
            $stmt = $this->conexion -> prepare($sql);
            $stmt -> bindParam(1,$datos->identificacion );
            return $stmt ->execute();

        }


        public function listar() {

            $sql="Select * from $this->tabla ";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->execute();
            return $stmt;

        }

    }    
?>