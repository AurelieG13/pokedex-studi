<?php

class PokemonsManager {
    private $db;


    public function __construct() {
        $dbName = "pokedex-studi"
        $port = 3306;
        $username = "root";
        $password = "root";
        try {
            $this->$db = new PDO("mysql:host=localhost;dbname=$dbName;port=$port;username=$username;password=$password");
        } catch(PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function create (Pokemon $Pokemon) {
        $req = $this ->db ->prepare("INSERT INTO `pokemon` (number, name, description, type1, type2) VALUES(:number, :name, :description, :type1, :type2)");

        $req->bindValue(':number', $pokemon->getNumber(), PDO::PARAM_INT);
        $req->bindValue(':name', $pokemon->getName(), PDO::PARAM_STR);
        $req->bindValue(':description', $pokemon->getDescription(), PDO::PARAM_STR);
        $req->bindValue(':type1', $pokemon->getType1(), PDO::PARAM_INT);
        $req->bindValue(':type2', $pokemon->getType2(), PDO::PARAM_INT);

        $req ->execute();
    }

    public function get(int $id) {
        $req = $this->db->prepare("SELECT * FROM `pokemon` WHERE `id` = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $data = $req->fetch();
        $pokemon = new Pokemon($data);
        return $pokemon;
        
    }

    public function getAll(Type $var = null) {
        $pokemons = [];
        $req = $this->db->query("SELECT * FROM `pokemon` WHERE name LIKE :input ORDER BY number");
        $req->bindValue(':input', $input, PDO::PARAM_STR);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $pokemon =  new Pokemon($data);
            $pokemons [] = $pokemon;
        }
        return $pokemons;
    }

    public function getAllByString(string $input) {

    }

    public function getAllByType(string $input) {
       /*(if ($input instanceof Type) {
        #code
        }*/
    }

    public function update($Pokemon) {
        
    }

    public function delete(int $id) {
    }
}