<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PolytechDashboard\HomeBundle\Entity\CoursRepository")
 */
class Cours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCours", type="string", length=255)
     */
    private $nomCours;

    /**
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="integer")
     */
    private $coefficient;

    /**
     * @var integer
     *
     * @ORM\Column(name="idFormation", type="integer")
     */
    private $idFormation;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUE", type="integer")
     */
    private $idUE;


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
     * Set nomCours
     *
     * @param string $nomCours
     * @return Cours
     */
    public function setNomCours($nomCours)
    {
        $this->nomCours = $nomCours;

        return $this;
    }

    /**
     * Get nomCours
     *
     * @return string 
     */
    public function getNomCours()
    {
        return $this->nomCours;
    }

    /**
     * Set coefficient
     *
     * @param integer $coefficient
     * @return Cours
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    /**
     * Get coefficient
     *
     * @return integer 
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * Set idFormation
     *
     * @param integer $idFormation
     * @return Cours
     */
    public function setIdFormation($idFormation)
    {
        $this->idFormation = $idFormation;

        return $this;
    }

    /**
     * Get idFormation
     *
     * @return integer 
     */
    public function getIdFormation()
    {
        return $this->idFormation;
    }

    /**
     * Set idUE
     *
     * @param integer $idUE
     * @return Cours
     */
    public function setIdUE($idUE)
    {
        $this->idUE = $idUE;

        return $this;
    }

    /**
     * Get idUE
     *
     * @return integer 
     */
    public function getIdUE()
    {
        return $this->idUE;
    }
}
