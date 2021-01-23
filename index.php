<?php 
include("./php/conect.php");

?>

<!DOCTYPE html>
<html lang>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bsale Test</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    </head>
<body>



<header id="header" class="header">
    <div class="container">
        <div class="row">
            <div class="four columns">
                <img src="https://dojiw2m9tvv09.cloudfront.net/4/8/img-logos-logo-bsale-naranjo.png?1437" id="logo">
            </div>
            <div class="two columns u-pull-right">
                <ul>
                    <li class="submenu">
                            <img src="img/cart.png" id="img-carrito">
                            <div id="carrito">
                                    
                                    <table id="lista-carrito" class="u-full-width">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>

                                    <a href="#" id="vaciar-carrito" class="button u-full-width">Vaciar Carrito</a>
                            </div>
                    </li>
                </ul>
            </div>
        </div> 
    </div>
    </header>

<br>




<select name="users" onchange="showUser(this.value)" >
    <option value="">Filtrar:</option>
    <?php 
    $conn = connection();
    $query = "SELECT * FROM  category";
    foreach ($conn->query($query) as $row){
    echo "<option value=".$row['id'] .">".$row['name']."</option>"; 
    }
    ?>

</select>


<div id='lista-productos' class='container'>
<?php
//$query = "SELECT * FROM  product inner join category on product.category = category.id where category.name ='pisco'";
$query = "SELECT * FROM  product order by discount desc";
foreach ($conn->query($query) as $row){
 ?>
         <div class='card'>
            <?php
                    if($row['url_image']){

                        echo "<img src='".$row['url_image']."' alt='Nature' class='responsive  u-full-width'>";
                    }else{
                        echo "<img src='https://www.hongshen.cl/wp-content/uploads/2016/07/no-disponible.png'  class='imagen-curso u-full-width'>";
                    }
            ?>
            <div class='info-card'>
            <h4> <?php  echo $row['name']?></h4>

              <p class='precio'> <?php echo "Descuento: ".$row['discount']?>%    <br><span class='u-pull-left '>$ <?php echo $row['price']; ?></span></p>
              <a  class='u-full-width button-primary button input agregar-carrito' id='buton' data-id="<?php $row['id']?>" >Agregar Al Carrito</a>
            </div>
        </div>
  
<?php

}
?>


</div>


<footer id="footer" class="footer">
        <div class="container">
            <div class="row">
                    <div class="four columns">
                            <nav id="principal" class="menu">
                                <a class="enlace" href="#">Para tu Negocio</a>
                                <a class="enlace" href="#">Conviertete en Instructor</a>
                                <a class="enlace" href="#">Aplicaciones Móviles</a>
                                <a class="enlace" href="#">Soporte</a>
                                <a class="enlace" href="#">Temas</a>
                            </nav>
                    </div>
                    <div class="four columns">
                            <nav id="secundaria" class="menu">
                                <a class="enlace" href="#">¿Quienes Somos?</a>
                                <a class="enlace" href="#">Empleo</a>
                                <a class="enlace" href="#">Blog</a>
                            </nav>
                    </div>
            </div>
        </div>
    </footer>
<script src="js/app.js"></script>



</body>
</html>