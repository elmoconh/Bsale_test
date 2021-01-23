// VARIABLES
const carrito = document.querySelector('#carrito');
const productos = document.querySelector('#lista-productos');
const listaProductos = document.querySelector('#lista-carrito tbody');
const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');


// ESCUCHADORES
cargarEventLisenerteners();

function cargarEventLisenerteners() {
    // Dispara cuando se presiona en agregar carrito
    productos.addEventListener('click', comprarProducto);
    // Cuando se elimina un producto del carrito
    carrito.addEventListener('click', eliminarProducto);
    // Al vaciar carrito
    vaciarCarritoBtn.addEventListener('click', vaciarCarrito);
    // Al cargar el documento, mostrar Local Storage
    document.addEventListener('DOMContentLoaded', leerLocalStorage);
}


// FUNCIONES
// Función que agrega el producto al carrito
function comprarProducto(e) {
    e.preventDefault();
    // Delegation para agregar-carrito
    if(e.target.classList.contains('agregar-carrito')) {
        const producto = e.target.parentElement.parentElement;
        // Enviamos el producto seleccionado para tomar sus datos
        leerDatosProducto(producto);
    }
}

// Leer los datos del producto
function leerDatosProducto(producto) {
    const infoProducto = {
        imagen: producto.querySelector('img').src,
        titulo: producto.querySelector('h4').textContent,
        precio: producto.querySelector('.precio span').textContent,
        id: producto.querySelector('a').getAttribute('data-id')
    }
    console.log(typeof( infoProducto));
    insertarCarrito(infoProducto);

}

// Muestra el producto seleccionado en el carrito
function insertarCarrito(producto) {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <img src="${producto.imagen}" width=100>
        </td>
        <td>${producto.titulo}</td>
        <td>${producto.precio}</td>
        <td>
            <a href="#" class="borrar-producto" data-id=${producto.id}> X</a>
        </td>
    `;

    listaProductos.appendChild(row);
    guardarProductoLocalStorage(producto);

}

// Eliminar el producto del carrito en el DOM
function eliminarProducto(e) {
    e.preventDefault();

    let producto,
        productoId;
    if(e.target.classList.contains('borrar-producto')) {
        e.target.parentElement.parentElement.remove();
        producto = e.target.parentElement.parentElement;
        productoId = producto.querySelector('a').getAttribute('data-id');
    }
    eliminarProductoLocalStorage(productoId);
}

// Elimina todos los productos del carrito en el DOM
function vaciarCarrito() {
    // forma lenta
    // listaProductos.innerHTML = '';
    // forma rápida(recomendada)
    while(listaProductos.firstChild) {
        listaProductos.removeChild(listaProductos.firstChild);
    }
    // Vaciar Local Storage
    vaciarLocalStorage();

    return false;
}

// Almacena los productos en el Local Storage
function guardarProductoLocalStorage(producto) {
    let productos;
    // Toma el valor de un arreglo con datos de Local Storage o vacío
    productos = obtenerProductosLocalStorage();
    // el producto seleccionado se agrega al arreglo
    productos.push(producto);

    localStorage.setItem('productos', JSON.stringify(productos));
}

// Comprobar si hay elementos en Local Storage
function obtenerProductosLocalStorage() {
    let productosLs;
    // comprobamos si hay algo en el Local Storage
    if(localStorage.getItem('productos') === null) {
        productosLs = [];
    } else {
        productosLs = JSON.parse(localStorage.getItem('productos'));
    }
    return productosLs;
}

// Imprime los productos de Local Storage en el carrito
function leerLocalStorage() {
    let productosLs

    productosLs = obtenerProductosLocalStorage();

    productosLs.forEach(function(producto){
        // construir el template
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>
            <img src="${producto.imagen}" width=100>
        </td>
        <td>${producto.titulo}</td>
        <td>${producto.precio}</td>
        <td>
            <a href="#" class="borrar-producto" data-id=${producto.id}> X</a>
        </td>
    `;

        listaProductos.appendChild(row);
    })
}

// Eliminar producto por el Id en Local Storage
function eliminarProductoLocalStorage(producto) {
    let productosLs;
    //obtenemos el arreglo de productos
    productosLs = obtenerProductosLocalStorage();
    // iteramos comparando el Id de producto borrado conlos del LS
    productosLs.forEach(function(productoLs, index) {
        if(productoLs.id === producto) {
            productosLs.splice(index, 1);
        }
    });
    // Añadimos el arreglo actual a Local Storage
    localStorage.setItem('productos', JSON.stringify(productosLs));
}

// Eliminar todos los productos de Local Storage;
function vaciarLocalStorage() {
    localStorage.clear();
}