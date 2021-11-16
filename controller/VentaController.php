<?php

include "C:\\xampp\\htdocs\\proyect_ec\\controller/AuthController.php";

class VentaController
{

    private $con;
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
            return $data;
        }else{
            return $data;
        }
    }

    public function getProductForCart($id)
    {
        $query = "SELECT	producto.id AS ID, 	producto.codigo AS COD, 	producto.nombre AS NOM, 	producto.precio_v AS PV, 	producto.stock AS ST FROM	producto WHERE producto.id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetch(); 
    }

    public function getCartProduct()
    {
        $isCart = $this->auth->isCartProduct();
        if($isCart){
            return $this->auth->getCartProduct();
        }else{
            return false;
        }
    }

    public function getListProduct()
    {
        $query = "SELECT producto.id AS ID, producto.codigo AS COD, producto.nombre AS NOM, producto.descripcion AS DES, producto.precio_c AS PC, producto.precio_v AS PV, producto.stock AS STO, producto.imagen AS IMG, categoria.nombre AS CT FROM producto INNER JOIN categoria ON  producto.categoria = categoria.id";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getListProductByIDCat($id)
    {
        $query = "SELECT producto.id AS ID, producto.codigo AS COD, producto.nombre AS NOM, producto.descripcion AS DES, producto.precio_c AS PC, producto.precio_v AS PV, producto.stock AS STO, producto.imagen AS IMG, categoria.nombre AS CT FROM producto INNER JOIN categoria ON  producto.categoria = categoria.id WHERE categoria.id =?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $id;
    }

    public function getListCategoria()
    {
        $query = "SELECT id AS ID, nombre AS NOM FROM categoria";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function setProductToCart($data)
    {
        return $this->auth->setProductCart($data);
    }
}
