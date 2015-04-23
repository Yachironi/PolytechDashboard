<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tachegestionnaire
 *
 * @ORM\Table(name="TacheGestionnaire")
 * @ORM\Entity
 */
class Tachegestionnaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTache", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idtache;

    /**
     * @var integer
     *
     * @ORM\Column(name="idGestionnaire", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idgestionnaire;    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="idEtudiant", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idetudiant;
    
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="text", nullable=true)
     */
    private $status;

    
    
    /**
     * Set idtache
     *
     * @param integer $idtache
     * @return Tacheetudiant
     */
    public function setIdtache($idtache)
    {
        $this->idtache = $idtache;

        return $this;
    }

    /**
     * Get idtache
     *
     * @return integer 
     */
    public function getIdtache()
    {
        return $this->idtache;
    }

    /**
     * Set idetudiant
     *
     * @param integer $idetudiant
     * @return Tacheetudiant
     */
    public function setIdetudiant($idetudiant)
    {
    	$this->idetudiant = $idetudiant;
    
    	return $this;
    }
    
    /**
     * Get idetudiant
     *
     * @return integer
     */
    public function getIdetudiant()
    {
    	return $this->idetudiant;
    }
    
    /**
     * Set idgestionnaire
     *
     * @param integer $idgestionnaire
     * @return Tachegestionnaire
     */
    public function setIdgestionnaire($idgestionnaire)
    {
    	$this->idgestionnaire = $idgestionnaire;
    
    	return $this;
    }
    
    /**
     * Get idgestionnaire
     *
     * @return integer
     */
    public function getIdgestionnaire()
    {
    	return $this->idgestionnaire;
    }
    
    /**
     * Set status
     *
     * @param string $status
     * @return Tacheetudiant
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
