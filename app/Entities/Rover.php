<?php


namespace App\Entities;


use CodeIgniter\Entity;

class Rover extends Entity
{
    protected $attributes = [
        'id' => null,
        'name' => null,
        'plateau_id' => null,
        'x' => null,
        'y' => null,
        'heading' => null,
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
        $this->attributes['id']= $id;

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
    public function getPlateauId()
    {
        return $this->attributes['plateau_id'];
    }

    /**
     * @param $plateauId
     * @return $this
     */
    public function setPlateauId($plateauId): self
    {
        $this->attributes['plateau_id'] = $plateauId;

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

    /**
     * @return mixed
     */
    public function getHeading()
    {
        return $this->attributes['heading'];
    }

    /**
     * @param $heading
     * @return $this
     */
    public function setHeading($heading): self
    {
        $this->attributes['heading'] = $heading;

        return $this;
    }




}