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
     * @var float
     *
     * @ORM\Column(name="CoursH", type="float", nullable=true)
     */
    private $coursH;
    
    /**
     * @var float
     *
     * @ORM\Column(name="CTDH", type="float", nullable=true)
     */
    private $cTdH;
    
    /**
     * @var float
     *
     * @ORM\Column(name="TDH", type="float", nullable=true)
     */
    private $tdH;
    
    /**
     * @var float
     *
     * @ORM\Column(name="TPH", type="float", nullable=true)
     */
    private $tpH;
    
    /**
     * @var float
     *
     * @ORM\Column(name="ProjetH", type="float", nullable=true)
     */
    private $projetH;
    
    /**
     * @var float
     *
     * @ORM\Column(name="StageH", type="float", nullable=true)
     */
    private $stageH;
    
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
     * Get coursH
     *
     * @return float
     */
    public function getCoursH()
    {
    	return $this->coursH;
    }
    
    /**
     * Get cTdH
     *
     * @return float
     */
    public function getCTDH()
    {
    	return $this->cTdH;
    }
    
    /**
     * Get tdH
     *
     * @return float
     */
    public function getTDH()
    {
    	return $this->tdH;
    }
    /**
     * Get tpH
     *
     * @return float
     */
    public function getTPH()
    {
    	return $this->tpH;
    }
    /**
     * Get projetH
     *
     * @return float
     */
    public function getProjetH()
    {
    	return $this->projetH;
    }
    /**
     * Get stageH
     *
     * @return float
     */
    public function getStageH()
    {
    	return $this->stageH;
    }
    
    /**
     * Set coursH
     *
     * @param string $coursh
     * @return Cours
     */
    public function setNomcours($coursh)
    {
    	$this->coursH = $coursh;
    
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
