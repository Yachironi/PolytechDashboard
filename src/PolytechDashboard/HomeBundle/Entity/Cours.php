<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="Cours")
 * @ORM\Entity
 */
class Cours
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
     * @ORM\Column(name="nomCours", type="text", nullable=true)
     */
    private $nomcours;

    /**
     * @var integer
     *
     * @ORM\Column(name="idFormation", type="integer", nullable=true)
     */
    private $idformation;

    /**
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="integer", nullable=true)
     */
    private $coefficient;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUE", type="integer", nullable=true)
     */
    private $idue;



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
     * Set nomcours
     *
     * @param string $nomcours
     * @return Cours
     */
    public function setNomcours($nomcours)
    {
        $this->nomcours = $nomcours;

        return $this;
    }

    /**
     * Get nomcours
     *
     * @return string 
     */
    public function getNomcours()
    {
        return $this->nomcours;
    }

    /**
     * Set idformation
     *
     * @param integer $idformation
     * @return Cours
     */
    public function setIdformation($idformation)
    {
        $this->idformation = $idformation;

        return $this;
    }

    /**
     * Get idformation
     *
     * @return integer 
     */
    public function getIdformation()
    {
        return $this->idformation;
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
     * Set idue
     *
     * @param integer $idue
     * @return Cours
     */
    public function setIdue($idue)
    {
        $this->idue = $idue;

        return $this;
    }

    /**
     * Get idue
     *
     * @return integer 
     */
    public function getIdue()
    {
        return $this->idue;
    }
}
