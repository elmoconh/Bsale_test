

<!-- Nav -->
<div style="background-color:white; width:100%; height:100px">
  <nav class="navbar navbar-inverse bg-inverse fixed-top bg-faded">
      <div class="row" >
            <div class="col">
              <button id="modal" type="button" class="btn btn-primary">Carrito (<span class="total-count"></span>)</button>
              <button class="btn btn-success" data-toggle="modal" data-target="#modalForm"> Ver carrito </button>
              <button class="clear-cart btn btn-danger" onclick="deleteItems()">Limpiar</button>
            </div> 
          </div>
  </nav>
</div>
<!-- Button to trigger modal -->



<!-- Main -->


        <?php
        $img = "";
        $total = 0;
        if($data['products']){
            foreach($data['products'] as $product){
                $total = (1-($product['discount']/100)) * $product['price'];
            ?>


              <?php

                if($product['url_image']==''){

                     $img ='<img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap" width = 250 height= 250>';
              
                } else {
                  $img ='<img class="card-img-top" src="'.$product['url_image'].'" alt="Card image cap" width = 250 height= 250>';
                }

                    echo '<div class="product-item">'.
                            $img.
                            '<div class="product-name">'.utf8_encode($product['name'] ).'</div>'.
                            '<div class="price">$<span>'.$product['price']. '</span></div>'.
                            '<div class="discount"><span>'.$product['discount']. '</span>%</div>'.
                            '<div class="final-price">$<span>'.$total. '</span></div>'.
                          						'<input type="text" class="product-quantity" name="quantity" value="1" size="2" />'.
                                      '<input type="submit" value="Add to Cart" class="add-to-cart" onClick="addToCart(this)" />'.
                
                        '</div>';
                
           
          }
        }
      ?>


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

    this.insertCart(cartItem);
    $('.price-cart').html(cartItem.price);
    $('.quantity-cart').html(cartItem.quantity);

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
  array = [];
  console.log('delete cart: '+ array.length);
  this.totalCount();
  totalPrice();
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
  $('.item-cart').html(cart);
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

function insertCart(element){
  console.log('element: '+ element);
  var row ='';
  row = `
    <td>${element.productName}</td>
    <td>${element.price}</td>
    <td>${element.quantity}</td>
    <td>${element.img}</td>
  `;
  console.log('row: '+ row);
  cart.push(row);

}




</script>

<style>


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
    text-align: center;
}

</style>


<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <span class="item-cart"></span>
            total: <span class="total-cart"></span>
            <!-- Modal Footer -->
        </div>
    </div>
</div>