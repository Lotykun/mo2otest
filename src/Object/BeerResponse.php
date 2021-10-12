<?php

namespace App\Object;

use JMS\Serializer\Annotation\Type;
use Doctrine\Common\Collections\ArrayCollection;


class BeerResponse
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
     * @Type("string")
     */
    private $imagen;

    /**
     * @Type("string")
     */
    private $slogan;

    /**
     * @Type("date")
     */
    private $fechaCreacion;

    /**
     * BeerResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->nombre = $data['name'];
        $this->descripcion = $data['description'];
        $this->imagen = $data['image_url'];
        $this->slogan = $data['tagline'];
        $this->fechaCreacion = $data['first_brewed'];
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

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen): void
    {
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * @param mixed $slogan
     */
    public function setSlogan($slogan): void
    {
        $this->slogan = $slogan;
    }

    /**
     * @return mixed
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param mixed $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion): void
    {
        $this->fechaCreacion = $fechaCreacion;
    }
}
