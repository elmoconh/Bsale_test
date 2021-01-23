<?php 

include("./conect.php");

$conn = connection();
$query = "SELECT * FROM  product";
foreach ($conn->query($query) as $row){
    echo "<option value=".$row['id'] .">".$row['name']."</option>"; 
}


$query = "SELECT * FROM  category";
$stmt = $conn->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



$json = json_encode($results);
echo $json;






?>