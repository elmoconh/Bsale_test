<?php 
include("./php/conect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bsale Test</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    </head>
<body>
<!--<div class="principal">
    <ul>
        <li>BSale Test</li>
        <li><a href=”#”> Tienda</a></li>
        <li>
            <span class="icon"><i class="fa fa-search"></i></span>
            <input type="sea rch" id="search" placeholder="Búsqueda" />
        </li>

        <li>
            <a href=”#”>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
        </li>
      
    </ul>
</div>
<div class="two columns u-pull-right">
                <ul>
                    <li class="submenu">
                            <img src="img/cart.png" id="img-carrito">
                            <div id="carrito">
                                    
                                    <table id="lista-productos" class="u-full-width">
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
</div>-->


<header id="header" class="header">
    <div class="container">
        <div class="row">
            <div class="four columns">
                <img src="img/logo.jpg" id="logo">
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




<select name="users" onchange="showUser(this.value)">
    <option value="">Filtrar:</option>
    <?php 
    $conn = connection();
    $query = "SELECT * FROM  category";
    foreach ($conn->query($query) as $row){
    echo "<option value=".$row['id'] .">".$row['name']."</option>"; 
    }
    ?>

</select>

<br>


<div id='lista-cursos' class='container'>

<div class='row'>
    <div class="four columns">
<?php
//$query = "SELECT * FROM  product inner join category on product.category = category.id";
$query = "SELECT * FROM  product order by discount desc";
foreach ($conn->query($query) as $row){
 ?>
 
         <div class='card'>

<?php
        if($row['url_image']){

            echo "<img src='".$row['url_image']."' class='imagen-curso u-full-width'>";
        }else{
            echo "<img src='https://www.hongshen.cl/wp-content/uploads/2016/07/no-disponible.png' class='imagen-curso u-full-width'>";
        }

?>
<div class='info-card'>
                <h4> <?php echo $row['name']?></h4>
                <p><?php echo $row['category']?></p>
                <p class='precio'> <?php echo $row['discount']?>"%  <span class='u-pull-right '>$ <?php echo $row['price']; ?></span></p>
                <a  class='u-full-width button-primary button input agregar-carrito' id='buton' data-id="<?php $row['id']?>" >Agregar Al Carrito</a>
</div>    

<?php
}
?>

</div>  
</div>
</div>


<script src="js/app.js"></script>



</body>
</html>