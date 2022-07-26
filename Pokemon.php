<?php

class Pokemon {
    private $id;
    private $number;
    private $name;
    private $description;
    private $type1;
    private $type2;

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



//Getters and setters

    /**
     * Get the value of id
     */ 
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of number
     */ 
    public function getNumber() {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber($number) {
        if (is_int($number) < 800) {
        $this->number = $number;
        }
        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName() {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription() {
        if (is_string($description) && strlen($description) > 5 && strlen($description) > 1000) {
            $this->description = $description;
        }
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of type1
     */ 
    public function getType1() {
        return $this->type1;
    }

    /**
     * Set the value of type1
     *
     * @return  self
     */ 
    public function setType1($type1) {
        $this->type1 = $type1;

        return $this;
    }

    /**
     * Get the value of type2
     */ 
    public function getType2() {
        return $this->type2;
    }

    /**
     * Set the value of type2
     *
     * @return  self
     */ 
    public function setType2($type2) {
        $this->type2 = $type2;

        return $this;
    }
}