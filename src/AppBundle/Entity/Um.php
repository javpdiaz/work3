<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Insumo;
/**
 * Um
 *
 * @ORM\Table(name="um")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UmRepository")
 */
class Um
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="um", type="string", length=10, unique=true)
     */
    private $um;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Insumo", mappedBy="um")
     */
    protected $insumos;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    public function __construct()
    {
        $this->insumos = new ArrayCollection();
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Um
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set um
     *
     * @param string $um
     *
     * @return Um
     */
    public function setUm($um)
    {
        $this->um = $um;

        return $this;
    }

    /**
     * Get um
     *
     * @return string
     */
    public function getUm()
    {
        return $this->um;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Um
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getInsumos()
    {
        return $this->insumos;
    }

    /**
     * @param mixed $insumos
     * @return Um
     */
    public function setInsumos($insumos)
    {
        $this->insumos = $insumos;
        return $this;
    }

    

    /**
     * Add insumo
     *
     * @param Insumo $insumo
     *
     * @return Um
     */
    public function addInsumo(Insumo $insumo)
    {
        $this->insumos[] = $insumo;

        return $this;
    }

    /**
     * Remove insumo
     *
     * @param Insumo $insumo
     */
    public function removeInsumo(Insumo $insumo)
    {
        $this->insumos->removeElement($insumo);
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return Um
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    function __toString()
    {
        return $this->um;
    }


}
