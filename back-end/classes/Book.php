<?php
class Book extends Product {
    private $weight;

    public function __construct($sku, $name, $price, $weight) {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
        $this->type = "Book";
    }

    public function save() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO products (sku, name, price, type, weight) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsd", $this->sku, $this->name, $this->price, $this->type, $this->weight);
        $stmt->execute();
    }

    public function getAttributes() {
        return "Weight: " . $this->weight . " Kg";
    }
}
?>
