<?php
include '../../controller/AdminController.php';
$controller = new AdminController();
$empleado = $controller->getTableEmpleado()->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/normalize.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/datatables.min.css">
    <link rel="stylesheet" href="../../assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/css/all.css">
    <link rel="stylesheet" href="../../assets/css/styles_admin.css">
    <title>Document</title>
</head>
<body>
    
    <!--BANNER-->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">        
        <a class="navbar-brand" href="#">Mi Tienda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="container">                
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Configuracion</a>
                    </li>
                </ul> 
            </div>
            <div class="mt-2 mt-md-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Salir</a>
                    </li>                    
                </ul> 
            </div>
        </div>
    </nav>

    <!--Container-->
    <div class="container">
        <div class="card">
            <div class="card-header d-flex">
                <h5>Listado de los empleados</h5>
                <a id="btnAddEmp" href="#" class="btn btn-primary ml-auto">Agregar</a>                            
            </div>            
            <div class="card-body">                
                <table id="tabled" class="table table-default display">
                    <thead>
                        <tr>                            
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Rol</th>
                            <th>Usuario</th>
                            <th>Opciones</th>                                           
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            foreach($empleado as $p){
                                echo '<tr>';
                                    echo '<td>' .$p['COD'].'</td>';
                                    echo '<td>' .$p['NOM'].'</td>';
                                    echo '<td>' .$p['APE'].'</td>';
                                    echo '<td>' .$p['DIR'].'</td>';
                                    echo '<td>' .$p['TEL'].'</td>';
                                    echo '<td>' .$p['ROL'].'</td>';
                                    echo '<td>' .$p['US'].'</td>';
                        ?>                                    
                                    <td>
                                    <a href="#" onclick="btn_prod_up('<?php echo $p['ID'];?>')" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                    -
                                    <a href="#" onclick="btn_prod_del('<?php echo $p['ID'];?>')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                        <?php
                                echo '</tr>';
                            }
                        ?>                                    
                    </tbody>
                </table>
            </div>            
        </div>
    </div>  

    <!--MODAL PRODUCTO-->
    <div class="modal fade" id="modal_p">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro/Actualizacion de un empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../service/serviceProducto.php" id="reg_new_prod" name="reg_new_prod" method="post">
                    
                    <input type="hidden" name="dato" id="dato" value="2">
                    <input type="hidden" name="_id_" id="_id_" value="-1">

                    <div class="form-group">
                        <label for="txtDoc">Documento</label>
                        <input type="number" class="form-control" id="txtDoc" name="txtDoc">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtNom">Nombre</label>
                            <input type="text" class="form-control" id="txtNom" name="txtNom">                            
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtAPE">Apellido</label>
                            <input type="text" class="form-control" id="txtAPE" name="txtAPE">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDirec">Direccion</label>
                        <input type="text" class="form-control" id="txtDirec" name="txtDirec">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtTel">Telefono</label>
                            <input type="text" class="form-control" id="txtTel" name="txtTel">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="slRol">Rol</label>
                            <select class="form-control" name="slCat" id="slRol">
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtUS">Usuario</label>
                            <input type="text" class="form-control" id="txtUS" name="txtUS">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtPass">Contraseña</label>
                            <input type="password" class="form-control" id="txtPass" name="txtPass">
                        </div>
                    </div>                    
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
            </div>
        </div>
    </div>    

    <div class="modal fade" id="modal_del_p">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="id_reg_c">Eliminar registros</h5>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../service/serviceProducto.php" name="delete_pro" id="delete_pro" method="post">
                    <input type="hidden" name="_id_" id="_id" value="-1">                    
                    <input type="hidden" name="dato" id="dato" value="4">                    
                    <h3>Se eliminarán todos los datos asociados a este registro.</h3>
                    <h2>¿Desea continuar?</h2>
                    <button type="submit"class="btn btn-danger">Si</button>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../assets/js/admin.js"></script>
</body>
</html>