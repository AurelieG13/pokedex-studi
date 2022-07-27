<?php

class Type {
    private $id;
    private $name;
    private $color;


    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    
    
    public function getId() {
        return $this->id;
    }

    
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    
    public function getName(){
        return $this->name;
    }

    
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    
    public function getColor() {
        return $this->color;
    }


    public function setColor($color) {
        $this->color = $color;

        return $this;
    }
}