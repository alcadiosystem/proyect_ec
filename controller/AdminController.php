<?php

include "C:\\xampp\\htdocs\\proyect_ec\\controller/AuthController.php";

class AdminController
{

    private $con;
    private $session;
    private $auth;

    public function __construct()
    {        
        $this->auth = new AuthController();
        $this->con = $this->auth->getConexion();
    }

    public function getSession()
    {
        $data = $this->auth->getSession();
        if($data){
            if($data['rol'] != 1){
                echo "<script language=\"javascript\">
                    window.location.href=\"../../view/login/index.php\";
                    </script>";
            }else{
                return $data;
            }
        }else{
            echo "<script language=\"javascript\">
                window.location.href=\"../../view/login/index.php\";
                </script>";
        }
    }

    public function logout()
    {
        $this->auth->getLogout();
        $this->getSession();
    }

    //------------------------------------------------------------------------
    //SELECT
    //------------------------------------------------------------------------
    public function getTableEmpleado()
    {
        $query = "SELECT empleado.id AS ID, empleado.documento AS COD, empleado.nombre AS NOM, empleado.apellido AS APE, empleado.direccion AS DIR, empleado.telefono AS TEL, empleado.rol AS ROL, empleado.usuario AS US FROM empleado";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getListEmpleado()
    {
        $query = "SELECT empleado.id AS ID, empleado.nombre AS NOM, empleado.apellido AS APE FROM empleado";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getTableCliente()
    {
        $query = "SELECT cliente.id AS ID, cliente.nombre AS NOM,  cliente.apellido AS APE, cliente.documento AS DOC, empleado.nombre AS NOMV, empleado.apellido AS APEV FROM cliente INNER JOIN	empleado	ON cliente.vendedor = empleado.id";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getTableProducto()
    {
        $query = "SELECT producto.id AS ID, producto.codigo AS COD, producto.nombre AS NOM, producto.descripcion AS DES, producto.precio_c AS PC, producto.precio_v AS PV, producto.stock AS STO, producto.imagen AS IMG, categoria.nombre AS CT FROM producto INNER JOIN categoria ON  producto.categoria = categoria.id";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getTableCategoria()
    {
        $query = "SELECT id AS ID, nombre AS NOM FROM categoria";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getTableProductoByID($id)
    {
        $query = "SELECT `id` AS ID, `codigo` AS COD, `nombre` AS NOM, `descripcion` AS DES, `precio_c` AS PC, `precio_v` AS PV, `stock` AS STO, `categoria` AS CT, `imagen` AS IMG FROM `producto` WHERE id=?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetch();        
    }

    public function getTableCategoriaById($datos)
    {
        $query = "SELECT id AS ID, nombre AS NOM FROM categoria WHERE id=?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$datos->id);
        $stmt->execute();
        $data = array('response' => true, 'Men'=>$stmt->fetch());
        return json_encode($data);
    }

    public function getTableEmpleadoById($datos)
    {
        $query = "SELECT empleado.id AS ID, empleado.documento AS COD, empleado.nombre AS NOM, empleado.apellido AS APE, empleado.direccion AS DIR, empleado.telefono AS TEL, empleado.rol AS ROL, empleado.usuario AS US, empleado.contrasena AS PASS FROM empleado WHERE empleado.id=?";
        $stmt = $this->con->prepare($query);        
        $stmt->bindParam(1,$datos->id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getTableClienteById($id)
    {        
        $query = "SELECT cliente.id AS ID, cliente.nombre AS NOM,  cliente.apellido AS APE, cliente.documento AS DOC, empleado.nombre AS NOMV, empleado.apellido AS APEV, empleado.id AS IDV FROM cliente INNER JOIN	empleado	ON cliente.vendedor = empleado.id WHERE cliente.id=?";
        $stmt = $this->con->prepare($query);        
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetch();
    }

    //------------------------------------------------------------------------
    //INSERT
    //------------------------------------------------------------------------
    public function setCategoria($datos)
    {

        if($datos->id > 0){
            $sql = "UPDATE categoria SET nombre=? WHERE id=?";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(1,$datos->nombre);
            $stmt->bindParam(2,$datos->id);
        }else{
            $sql = "INSERT INTO categoria VALUES(null,?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(1,$datos->nombre);
        }
        if ($stmt ->execute()) {
    
            $data = array('response' => true, 'Men'=>'Datos registrados correctamente');
            return json_encode($data);
    
        } else {
    
            $error = $stmt->errorInfo();
            $data = array('response' => false, 'Men'=>'Se presento un error ==> '.$error);
            return json_encode($data);   
        }
    }

    public function setProducto($datos)
    {
        if($datos->id > 0){
            $sql = "UPDATE `producto` SET `codigo`=?,`nombre`=?,`descripcion`=?,`precio_c`=?,`precio_v`=?,`stock`=?,`categoria`=?,`imagen`=? WHERE id=?";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(1,$datos->codigo);
            $stmt->bindParam(2,$datos->nombre);
            $stmt->bindParam(3,$datos->descripcion);
            $stmt->bindParam(4,$datos->precC);
            $stmt->bindParam(5,$datos->precV);
            $stmt->bindParam(6,$datos->stock);
            $stmt->bindParam(7,$datos->categoria);
            $stmt->bindParam(8,$datos->img);
            $stmt->bindParam(9,$datos->id);            
        }else{
            $sql = "INSERT INTO `producto`(`codigo`, `nombre`, `descripcion`, `precio_c`, `precio_v`, `stock`, `categoria`, `imagen`) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(1,$datos->codigo);
            $stmt->bindParam(2,$datos->nombre);
            $stmt->bindParam(3,$datos->descripcion);
            $stmt->bindParam(4,$datos->precC);
            $stmt->bindParam(5,$datos->precV);
            $stmt->bindParam(6,$datos->stock);
            $stmt->bindParam(7,$datos->categoria);
            $stmt->bindParam(8,$datos->img);            
        }

        if ($stmt ->execute()) {
    
            $data = array('response' => true, 'Men'=>'Datos registrados correctamente');
            return json_encode($data);
    
        } else {
    
            $error = $stmt->errorInfo();
            $data = array('response' => false, 'Men'=>'Se presento un error ==> '.$error);
            return json_encode($data);   
        }
    }

    public function setEmpleado($datos)
    {
        if($datos->id > 0){
            $sql = "UPDATE `proyecto`.`empleado` SET `documento` = ?, `nombre` = ?, `apellido` = ?, `direccion` = ?, `telefono` = ?, `rol` = ?, `usuario` = ?, `contrasena` = ? WHERE `id` = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(1,$datos->documento);
            $stmt->bindParam(2,$datos->nombre);
            $stmt->bindParam(3,$datos->apellido);
            $stmt->bindParam(4,$datos->direccion);
            $stmt->bindParam(5,$datos->telefono);
            $stmt->bindParam(6,$datos->rol);
            $stmt->bindParam(7,$datos->usuario);
            $stmt->bindParam(8,$datos->pass);
            $stmt->bindParam(9,$datos->id);            
        }else{
            $sql = "INSERT INTO `proyecto`.`empleado` ( `documento`, `nombre`, `apellido`, `direccion`, `telefono`, `rol`, `usuario`, `contrasena`) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(1,$datos->documento);
            $stmt->bindParam(2,$datos->nombre);
            $stmt->bindParam(3,$datos->apellido);
            $stmt->bindParam(4,$datos->direccion);
            $stmt->bindParam(5,$datos->telefono);
            $stmt->bindParam(6,$datos->rol);
            $stmt->bindParam(7,$datos->usuario);
            $stmt->bindParam(8,$datos->pass);
        }

        if ($stmt ->execute()) {
    
            $data = array('response' => true, 'Men'=>'Datos registrados correctamente');
            return json_encode($data);
    
        } else {
    
            $error = $stmt->errorInfo();
            $data = array('response' => false, 'Men'=>'Se presento un error ==> '.$error);
            return json_encode($data);   
        }
    }

    public function setCliente($datos)
    {
        if($datos->id > 0){
            $sql = "UPDATE `proyecto`.`cliente` SET `nombre` = ?, `apellido` = ?, `documento` = ?, `vendedor` = ? WHERE `id` = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(1,$datos->nombre);
            $stmt->bindParam(2,$datos->apellido);
            $stmt->bindParam(3,$datos->documento);
            $stmt->bindParam(4,$datos->vendedor);
            $stmt->bindParam(5,$datos->id);
        }else{
            $sql = "INSERT INTO `proyecto`.`cliente` ( `nombre`, `apellido`, `documento`, `vendedor`) VALUES (?,?,?,?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(1,$datos->nombre);
            $stmt->bindParam(2,$datos->apellido);
            $stmt->bindParam(3,$datos->documento);
            $stmt->bindParam(4,$datos->vendedor);
        }

        if ($stmt ->execute()) {
    
            $data = array('response' => true, 'Men'=>'Datos registrados correctamente');
            return json_encode($data);
    
        } else {
    
            $error = $stmt->errorInfo();
            $data = array('response' => false, 'Men'=>'Se presento un error ==> '.$error);
            return json_encode($data);   
        }
    }

    //------------------------------------------------------------------------
    //DELETE
    //------------------------------------------------------------------------
    public function deleteCategoria($data)
    {
        $sql="DELETE FROM categoria WHERE id=?";
        $stmt = $this->con->prepare($sql);
        $stmt -> bindParam(1,$data->id );
        if ($stmt ->execute()) {
    
            $data = array('response' => true, 'Men'=>'Datos eliminados correctamente');
            return json_encode($data);
    
        } else {
    
            $error = $stmt->errorInfo();
            $data = array('response' => false, 'Men'=>'Se presento un error ==> '.$error);
            return json_encode($data);   
        }
    }

    public function deleteProducto($id)
    {
        $sql="DELETE FROM producto WHERE id=?";
        $stmt = $this->con->prepare($sql);
        $stmt -> bindParam(1,$id );
        if ($stmt ->execute()) {
            $data = array('response' => true, 'Men'=>'Datos eliminados correctamente');
            return json_encode($data);    
        } else {
    
            $error = $stmt->errorInfo();
            $data = array('response' => false, 'Men'=>'Se presento un error ==> '.$error);
            return json_encode($data);   
        }
    }

    public function deleteEmpleado($id)
    {
        $sql="DELETE FROM empleado WHERE id=?";
        $stmt = $this->con->prepare($sql);
        $stmt -> bindParam(1,$id );
        if ($stmt ->execute()) {
            $data = array('response' => true, 'Men'=>'Datos eliminados correctamente');
            return json_encode($data);    
        } else {
    
            $error = $stmt->errorInfo();
            $data = array('response' => false, 'Men'=>'Se presento un error ==> '.$error);
            return json_encode($data);   
        }
    }

    public function deleteClient($id)
    {
        $sql="DELETE FROM cliente WHERE id=?";
        $stmt = $this->con->prepare($sql);
        $stmt -> bindParam(1,$id );
        if ($stmt ->execute()) {
            $data = array('response' => true, 'Men'=>'Datos eliminados correctamente');
            return json_encode($data);    
        } else {
    
            $error = $stmt->errorInfo();
            $data = array('response' => false, 'Men'=>'Se presento un error ==> '.$error);
            return json_encode($data);   
        }
    }
}

