<?php


namespace App\Entities;


use CodeIgniter\Entity;

class Plateau extends Entity
{

    protected $attributes = [
        'id' => null,
        'name' => null,
        'x' => null,
        'y' => null,
    ];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->attributes['id'];
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id): self
    {
        $this->attributes['id'] = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->attributes['name'];
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name): self
    {
        $this->attributes['name'] = $name;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->attributes['x'];
    }

    /**
     * @param $x
     * @return $this
     */
    public function setX($x): self
    {
        $this->attributes['x'] = $x;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->attributes['y'];
    }

    /**
     * @param $y
     * @return $this
     */
    public function setY($y): self
    {
        $this->attributes['y'] = $y;

        return $this;
    }

}