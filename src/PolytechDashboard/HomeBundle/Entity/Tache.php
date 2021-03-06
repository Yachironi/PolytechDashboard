<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 *
 * @ORM\Table(name="Tache")
 * @ORM\Entity
 * 
 */
class Tache
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
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="text", nullable=true)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="idGestionnaire", type="integer", nullable=true)
     */
    private $idgestionnaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="idEtudiant", type="integer", nullable=true)
     */
    private $idetudiant;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="idResource", type="integer", nullable=true)
     */
    private $idresource;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dateCreation", type="text", nullable=true)
     */
    private $datecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="dateFin", type="text", nullable=true)
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="structure", type="text", nullable=true)
     */
    private $structure;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="importance", type="integer", nullable=true)
     */
    private $importance;

    /**
     * Set id
     *
     * @param int $id
     * @return Tache
     */
    public function setId($id)
    {
    	$this->id = $id;
    
    	return $this;
    }
    
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
     * Set type
     *
     * @param string $type
     * @return Tache
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Tache
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
     * Set idgestionnaire
     *
     * @param integer $idgestionnaire
     * @return Tache
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
     * Set idetudiant
     *
     * @param integer $idetudiant
     * @return Tache
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
     * Set idresource
     *
     * @param integer $idresource
     * @return Tache
     */
    public function setIdresource($idresource)
    {
    	$this->idresource = $idresource;
    
    	return $this;
    }
    
    /**
     * Get idresource
     *
     * @return integer
     */
    public function getIdresource()
    {
    	return $this->idresource;
    }
    
    /**
     * Set datecreation
     *
     * @param string $datecreation
     * @return Tache
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return string 
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datefin
     *
     * @param string $datefin
     * @return Tache
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return string 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set structure
     *
     * @param string $structure
     * @return Tache
     */
    public function setStructure($structure)
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * Get structure
     *
     * @return string 
     */
    public function getStructure()
    {
        return $this->structure;
    }
    
    /**
     * Set importance
     *
     * @param integer $importance
     * @return Tache
     */
    public function setImportance($importance)
    {
    	$this->importance = $importance;
    
    	return $this;
    }
    
    /**
     * Get importance
     *
     * @return integer
     */
    public function getImportance()
    {
    	return $this->importance;
    }
}
