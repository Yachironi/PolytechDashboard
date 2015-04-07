<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="Formation")
 * @ORM\Entity
 */
class Formation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="text", nullable=true)
     */
    private $specialite;

    /**
     * @var integer
     *
     * @ORM\Column(name="anneeEtude", type="integer", nullable=true)
     */
    private $anneeetude;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="text", nullable=true)
     */
    private $type;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set specialite
     *
     * @param string $specialite
     * @return Formation
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return string 
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set anneeetude
     *
     * @param integer $anneeetude
     * @return Formation
     */
    public function setAnneeetude($anneeetude)
    {
        $this->anneeetude = $anneeetude;

        return $this;
    }

    /**
     * Get anneeetude
     *
     * @return integer 
     */
    public function getAnneeetude()
    {
        return $this->anneeetude;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Formation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}
