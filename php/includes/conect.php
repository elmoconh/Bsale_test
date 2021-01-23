<?php 
 //función de conexión a la base de datos 

function connection(){
    $host = 'mdb-test.c6vunyturrl6.us-west-1.rds.amazonaws.com';
    $db_name= 'bsale_test';
    $username='bsale_test';
    $password='bsale_test';

    $conn = new PDO ("mysql:host={$host};dbname={$db_name}", $username, $password);

    return $conn;
}

//Verifico que se conecte correctamemte a la base de datos que me entregaron
/*if(connection()){
    echo "Se conecta Correctamente";
}*/

?>