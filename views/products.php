

<!-- Nav -->
<div style="background-color:white; width:100%; height:100px">
  <nav class="navbar navbar-inverse bg-inverse fixed-top bg-faded">
      <div class="row" >
            <div class="col">
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm">Carrito (<span class="total-count"></span>)</button>
              <button class="btn btn-success" data-toggle="modal" data-target="#modalForm"> Ver carrito </button>
  
            </div> 
          </div>
  </nav>
</div>
<!-- Button to trigger modal -->


<!-- Main -->
<div class ='container'>

        <?php
        $img = "";
        $total = 0;
        if($data['products']){
            foreach($data['products'] as $product){
                $total = (1-($product['discount']/100)) * $product['price'];
            ?>


              <?php

                if($product['url_image']==''){

                     $img ='<img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap" width= 250 height= 250>';
              
                } else {
                  $img ='<img class="card-img-top" src="'.$product['url_image'].'" alt="Card image cap" width= 250 height= 250>';
                }

                    echo '<div class="product-item">'.
                            $img.
                            '<div class="product-name">'.utf8_encode($product['name'] ).'</div>'.
                            '<div class="price">$<span>'.$product['price']. '</span></div>'.
                            '<div class="discount"><span>'.$product['discount']. '</span>%</div>'.
                            '<div class="final-price">$<span>'.$total. '</span></div>'.
                            '<div class="row padded">'.
                          						'Cantidad: <input type="number" class="product-quantity" name="quantity" value="1" min=1 max=100 size="2"/> <br>' .

                                      '<input type="submit" value="Agregar al carro" class="btn btn-primary" onClick="addToCart(this)" />'.
                            '</div>'.
                        '</div>';
                
           
          }
        }
      ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
var btn = document.getElementById('modal');
var obj = {};
array = [];
cart=[];

function addToCart(element){
    var productParent = $(element).closest('div.product-item');  
    var price = $(productParent).find('.final-price span').text();
	  var productName = $(productParent).find('.product-name').text();
	  var quantity = $(productParent).find('.product-quantity').val();
    var img = $(productParent).find('.card-img-top').attr('src');
    const cartItem = {
		        productName: productName,
		        price: price,
		        quantity: quantity,
            img: img
	        };
    var cartItemJSON = JSON.stringify(cartItem);
    var cartArray = new Array();
  
	  cartArray.push(cartItemJSON);

	  var cartJSON = JSON.stringify(cartArray);
	  sessionStorage.setItem('shopping-cart', cartJSON);  
    var cart = JSON.parse(sessionStorage.getItem('shopping-cart'));
    

    array.push(cart);

    this.totalCount();
    this.totalPrice(cartItem.price, cartItem.quantity);
}

function deleteItems(){

  sessionStorage.removeItem('shopping-cart');
  location.reload();
}

function totalCount(){
  var cart = JSON.parse(sessionStorage.getItem('shopping-cart'));
  var totalItems = array.length;
  $('.total-count').html(totalItems);
}

function totalPrice(price, quantity){
  var item = [];

  var total = price * quantity;
  var cart = JSON.parse(sessionStorage.getItem('shopping-cart'));
  var totalPrice = 0;
  if (array.length > 0) {
    for (var i = 0; i < array.length; i++) {
      totalPrice = totalPrice + total;
    }
  }else{
    totalPrice = 0;
  }

   
  $('.total-cart').html(totalPrice);
  tableGenerate();
  
}

function showModal(){
  array = JSON.parse(sessionStorage.getItem('shopping-cart'));
  console.log('array: '+ array.length);
  if(array.length > 0){
    $('#myModal').modal('show');
  }else{
    alert('No hay productos en el carrito');
  }
  
}

function tableGenerate(){
  console.log('recibo: '+ array.length);
  const newTable = document.createElement("table");
  newTable.setAttribute("id", "table");
  //newTable.innerHTML = "";
  for(element in  array){
    var item = array[element];
    var itemJSON = JSON.parse(item);
    var row = '<tr><td><img src="'+itemJSON.img+'" width= 50 height= 50></td><td>'+itemJSON.productName+'</td><td>'+itemJSON.quantity+'</td><td>$'+itemJSON.price+'</td></tr>';
    newTable.innerHTML += row;
  }

  document.getElementById("table").appendChild(newTable);

}

</script>

<style>
body {
  background-color: #f1f1f1;
}

input {
  border: 1px solid #ccc;
  border-radius: 3px;
  padding: 5px;
  width: 50px;

}

 .container{
  width: 100%;
  margin: 0 auto;
  padding: 0 20px;
  display: flex;
  flex-wrap: wrap;
 }


#shopping-cart {
	margin: 40px;
}


.product-item {
	float: left;
	background: #ffffff;
	margin: 30px 30px 0px 0px;
	border: #E0E0E0 1px solid;
	padding: 10px 10px 20px 10px;
  line-height: 30px;
  width: 300px;
  text-align: center;
}
.card_img_top{
  width: 250px;
  height: 250px;
}

.right{
    width: 50%;
    align-self: center;
}
.left{
    width: 50%;
    align-self: center;
}

.row{
    display: flex;
    flex-direction: row;
    justify-content: left;
    padding: 10px;

}

#table{
  width: 100%;
  margin: 0 auto;
  padding: 0 20px;
  display: flex;
  flex-wrap: wrap;
}

th, td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
</style>


<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <table>            
              

            <thead><th>Imagen</th><th>Producto</th><th>Cantidad</th> <th>Precio</th></thead>
            </table>
                        <div id="table"></div>


            <h4>Total:<span class="total-cart"></span></h4>

            <!-- Modal Footer -->
            <button class="clear-cart btn btn-danger" onclick="deleteItems()">Limpiar carrito</button>
        </div>
        
    </div>
</div>