<?php

include_once 'config/Database.php';

class MenuItem {
    private $id;
    private $name;
    private $description;
    private $price;

    public function __construct($id, $name, $description, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public static function getMenuItems($conn) {
        $query = "SELECT * FROM menu_items";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $items = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items[] = new MenuItem($row['id'], $row['name'], $row['description'], $row['price']);
        }

        return $items;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }
}
