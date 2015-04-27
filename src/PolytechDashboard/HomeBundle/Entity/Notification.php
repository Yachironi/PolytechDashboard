<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * Notification
 *
 * @ORM\Table(name="Notification")
 * @ORM\Entity
 */
class Notification
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=true)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="integer", nullable=true)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $valeur;

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
     * @ORM\Column(name="categorie", type="integer", nullable=true)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categorie;
    
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $status;
    
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
     * Get valeur
     *
     * @return string
     */
    public function getValeur()
    {
    	return $this->valeur;
    }
    
    /**
     * Set idetudiant
     *
     * @param integer $idetudiant
     * @return Etudiantcours
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
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
    	return $this->categorie;
    }
    
    /**
     * Get status
     * @return string
     */
    public function getStatus()
    {
    	return $this->status;
    }

}
