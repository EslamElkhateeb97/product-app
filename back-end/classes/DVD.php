<?php
class DVD extends Product {
    private $size;

    public function __construct($sku, $name, $price, $size) {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
        $this->type = "DVD";
    }

    public function save() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO products (sku, name, price, type, size) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsi", $this->sku, $this->name, $this->price, $this->type, $this->size);
        $stmt->execute();
    }

    public function getAttributes() {
        return "Size: " . $this->size . " MB";
    }
}
?>
