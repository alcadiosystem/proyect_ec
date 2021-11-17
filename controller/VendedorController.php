<?php

include "C:\\xampp\\htdocs\\proyect_ec\\controller/AuthController.php";

class VendedorController
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
            if($data['rol'] != 2){
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

    public function getAllVentas($id)
    {
        $query = "SELECT venta.fech AS FECH, cliente.nombre AS NOMC, cliente.apellido AS APEC, 	empleado.id AS ID_E, 	venta.id_v AS IDV, COUNT(cartproduct.id_pr) AS COUNT_P, SUM(cartproduct.total) AS SUN_a,cartproduct.id_cart AS ID_CART FROM	venta	INNER JOIN	cliente	ON 		venta.id_client = cliente.id	INNER JOIN	cartproduct	ON 	venta.id_cart_p = cartproduct.id_cart	INNER JOIN	empleado ON venta.id_ven = empleado.id AND cliente.vendedor = empleado.id WHERE empleado.id =?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProductVenta($id)
    {
        $query = "SELECT cartproduct.stock AS ST, cartproduct.total AS TOT,	producto.codigo AS COD, 	producto.nombre AS NOM, 	producto.precio_v AS PV, categoria.nombre AS CAT FROM	cartproduct	INNER JOIN	producto	ON 		cartproduct.id_pr = producto.id	INNER JOIN	categoria ON 		producto.categoria = categoria.id WHERE	cartproduct.id_cart =?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTableCliente()
    {
        $query = "SELECT cliente.id AS ID, cliente.nombre AS NOM,  cliente.apellido AS APE, cliente.documento AS DOC, empleado.nombre AS NOMV, empleado.apellido AS APEV FROM cliente INNER JOIN	empleado	ON cliente.vendedor = empleado.id WHERE empleado.id = 11";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}
