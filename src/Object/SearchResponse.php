<?php

namespace App\Object;

use JMS\Serializer\Annotation\Type;
use Doctrine\Common\Collections\ArrayCollection;


class SearchResponse
{

    /**
     * @Type("integer")
     */
    private $id;

    /**
     * @Type("string")
     */
    private $nombre;

    /**
     * @Type("string")
     */
    private $descripcion;

    /**
     * BeerResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->nombre = $data['name'];
        $this->descripcion = $data['description'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }
}
