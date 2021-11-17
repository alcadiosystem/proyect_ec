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
        $query = "SELECT producto.id AS ID, producto.codigo AS COD, 	producto.nombre AS NOM, 	producto.precio_v AS PV, 	producto.stock AS ST FROM	producto WHERE producto.id = ?";
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
        return $stmt;
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

    public function removeCartProduct($id)
    {
        return $this->auth->removeCartProduct($id);
    }

    public function getClienteByVendedor($id)
    {
        $query = "SELECT cliente.id AS ID_C, cliente.nombre AS NOM, cliente.apellido AS APE	FROM cliente INNER JOIN	empleado ON	cliente.vendedor = empleado.id WHERE empleado.id =?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function setFinVenta($id_ve,$id_ca,$id_us)
    {
            $sql = "INSERT INTO `proyecto`.`venta` ( `id_cart_p`, `id_client`, `id_ven`) VALUES (?,?,?)";
            $stmt = $this->con->prepare($sql);            
            $stmt->bindParam(1,$id_ca);
            $stmt->bindParam(2,$id_us);
            $stmt->bindParam(3,$id_ve);

            $result = $stmt->execute();
            $state;

            if($result){
                $cartP = $this->getListProductByIDCat($id_ca)->fetchAll();
                foreach($cartP as $d){
                    $st = $d['STO'];
                    $product = $this->getProductoByID($d['ID']);

                    $descount = $product['STO'] - $st;

                    $this->dicrementProduct($d['ID'],$descount);
                }
                $this->auth->deleteSessionData();
                $data = array('error' => false, 'Men'=>'Venta realizada');
                return json_encode($data);
            }else{
                $data = array('error' => true, 'Men'=>'No se pudo realizar la venta');
                return json_encode($data);
            }
    }

    public function dicrementProduct($id,$stock)
    {
        $sql = "UPDATE `producto` SET `stock`=? WHERE id=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(1,$stock);
        $stmt->bindParam(9,$id);
        return $stmt->execute();
    }

    public function getProductoByID($id)
    {
        $query = "SELECT `id` AS ID, `stock` AS STO FROM `producto` WHERE id=?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetch();        
    }
}
