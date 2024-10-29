<?php
class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length) {
        parent::__construct($sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
        $this->type = "Furniture";
    }

    public function save() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO products (sku, name, price, type, height, width, length) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsddd", $this->sku, $this->name, $this->price, $this->type, $this->height, $this->width, $this->length);
        $stmt->execute();
    }

    public function getAttributes() {
        return "Dimensions: " . $this->height . "x" . $this->width . "x" . $this->length;
    }
}
?>
