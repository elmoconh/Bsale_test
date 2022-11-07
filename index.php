<meta charset="UTF-8"/>
<link rel="stylesheet" href="./views/style.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<?php 
//include("./php/conect.php");

require_once "./config/conect.php";
require_once "./config/config.php";
require_once "./controllers/Products.php";
require_once "./core/routes.php";


if(isset($_GET['c'])){
		
    $controlador = cargarControlador($_GET['c']);
    
    if(isset($_GET['a'])){
        if(isset($_GET['id'])){
            cargarAccion($controlador, $_GET['a'], $_GET['id']);
            } else {
            cargarAccion($controlador, $_GET['a']);
        }
        } else {
        cargarAccion($controlador, METODO_PRINCIPAL);
    }
    
    } else {
    
    $controlador = cargarControlador(CONTROL_PRINCIPAL);
    $accionTmp = METODO_PRINCIPAL;
    $controlador->$accionTmp();
}

?>
