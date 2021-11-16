<?php

$get;

if(isset($_GET['id'])){
    $get = $_GET['id'];
}else{
    echo "<script language=\"javascript\">
            window.location.href=\"index.php\";
            </script>";
}

include '../controller/VentaController.php';
$controller = new VentaController();
$session = $controller->getSession();
$listP = $controller->getListProductByIDCat($get);
$listC = $controller->getListCategoria();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles_admin.css">
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
                        <a class="nav-link" href="index.php">Home </a>
                    </li>                    
                </ul> 
            </div>
            <div class="mt-2 mt-md-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Carrito</a>
                    </li>
                    <li class="nav-item">
                        <?php 
                        if($session){                        
                        ?>
                          <a class="nav-link" href="#"><?php echo $session['NOM'];?></a>
                        <?php
                        }else{
                        ?>
                        <a class="nav-link" href="../view/login/index.php">Login</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                      <?php 
                        if($session){                        
                        ?>
                          <form id="frm_logout" name="frm_logout" action="../../service/serviceAuth.php"  method="post">
                            <input type="hidden" name="txtOp" value="1">
                            <a class="nav-link" onclick="logout()" href="#">Salir</a>
                          </form>
                        <?php
                        }
                        ?>
                    </li>                  
                </ul> 
            </div>
        </div>
    </nav>
    
    <!--CONTAINER-->
    <div class="container">        
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Categorias</div>
                    <ul class="list-group list-group-flush">
                        <?php
                          foreach($listC as $c){                          
                        ?>
                            <li class="list-group-item"><a href="cat.php?id=<?php echo $c['ID'];?>"><?php echo $c['NOM'];?></a></li>
                        <?php
                          }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-8">
                <?php
                  foreach($listP as $p){
                ?>
                  <div class="card mb-3">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="<?php echo $p['IMG'];?>" alt="..." height="200px" width="200px">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $p['NOM'];?></h5>
                          <p class="card-text"><?php echo $p['DES'];?></p>
                        </div>
                        <div class="card-footer d-flex"><a href="#" onclick="modal_add_cart_idex(<?php echo $p['ID'];?>)" class="btn btn-primary">Agregar al carrito</a> <a href="http://localhost/proyect_ec/view/details.html" class="btn btn-info ml-auto">Detalles</a></div>
                      </div>
                    </div>
                  </div>
                <?php
                  }
                ?>              
            </div>
        </div>
    </div>
    
    
    <!--MODAL PRODUCTO-->
    <div class="modal fade" id="modal_c">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar al carrito de compras</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_p">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Vender producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

      <script src="../assets/js/jquery-3.6.0.min.js"></script>
      <script src="../assets/js/bootstrap.min.js"></script>            
    <script src="../assets/js/main.js"></script>
</body>
</html>