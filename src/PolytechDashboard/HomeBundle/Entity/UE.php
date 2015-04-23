<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ue
 *
 * @ORM\Table(name="UE")
 * @ORM\Entity
 */
class UE
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
     * @ORM\Column(name="nom", type="text", nullable=true)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="idFormation", type="integer", nullable=true)
     */
    private $idformation;

    /**
     * @var integer
     *
     * @ORM\Column(name="Coeff", type="integer", nullable=true)
     */
    private $coeff;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="ECTS", type="integer", nullable=true)
     */
    private $ects;

    /**
     * @var integer
     *
     * @ORM\Column(name="Semestre", type="integer", nullable=true)
     */
    private $semestre;

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
     * Get ects
     *
     * @return integer
     */
    public function getEcts()
    {
    	return $this->ects;
    }
    
    /**
     * Get semestre
     *
     * @return integer
     */
    public function getSemestre()
    {
    	return $this->semestre;
    }
    
    /**
     * Set nom
     *
     * @param string $nom
     * @return Ue
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set idformation
     *
     * @param integer $idformation
     * @return Ue
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
     * Set coeff
     *
     * @param integer $coeff
     * @return Ue
     */
    public function setCoeff($coeff)
    {
        $this->coeff = $coeff;

        return $this;
    }

    /**
     * Get coeff
     *
     * @return integer 
     */
    public function getCoeff()
    {
        return $this->coeff;
    }
}
