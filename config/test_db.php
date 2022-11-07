<?php 

require_once "./conect.php";
 
class TestConnection 
{
    private $db;
    private $products;

    public function __construct(){
        $this->db = Connection::connection();
        $this->products = array();
    }

    public function get_products(){
        $sql = "SELECT * FROM product";
        $result = $this->db->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $this->products[] = $row;
        }
        print_r ($this->products);
        return $this->products;
    }



}

echo "test";
$test = new TestConnection();
$test->get_products();

?>