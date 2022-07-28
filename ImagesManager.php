<?php

require ("./Image.php");

class ImagesManager {
    private $db;


    public function __construct() {
        $dbName = "pokedex-studi";
        $port = 3306;
        $username = "root";
        $password = "root";
        try {
            $this ->db = new PDO("mysql:host=localhost;dbname=$dbName;port=$port",$username,$password);
        } catch(PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function create (Image $image) {
        $req = $this ->db ->prepare("INSERT INTO `image` (name, path) VALUES(:name, :path)");

        $req->bindValue(':name', $image->getName(), PDO::PARAM_STR);
        $req->bindValue(':path', $image->getPath(), PDO::PARAM_STR);
    
        $req ->execute();
    }

    public function get(int $id) {
        $req = $this->db->prepare("SELECT * FROM `image` WHERE `id` = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $data = $req->fetch();
        $paths = new Image($data);
        return $paths;
        
    }
    

    public function update(Image $image) {
        $req  = $this->db->prepare("UPDATE `image` SET name = :name, path = :path");
        $req->bindValue(':name', $image->getName(), PDO::PARAM_STR);
        $req->bindValue(":path", $image->getPath(), PDO::PARAM_STR);


        $req ->execute();
    }

    public function delete(int $id) {
        $req  = $this->db->prepare("DELETE FROM `image` WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req ->execute();

    }
}