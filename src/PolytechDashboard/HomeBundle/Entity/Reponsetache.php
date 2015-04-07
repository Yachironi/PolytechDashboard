<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponsetache
 *
 * @ORM\Table(name="ReponseTache")
 * @ORM\Entity
 */
class Reponsetache
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
     * @ORM\Column(name="donnee", type="text", nullable=true)
     */
    private $donnee;

    /**
     * @var integer
     *
     * @ORM\Column(name="idEtudiant", type="integer", nullable=true)
     */
    private $idetudiant;

    /**
     * @var integer
     *
     * @ORM\Column(name="idTache", type="integer", nullable=true)
     */
    private $idtache;

    /**
     * @var integer
     *
     * @ORM\Column(name="idGestionnaire", type="integer", nullable=true)
     */
    private $idgestionnaire;



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
     * Set donnee
     *
     * @param string $donnee
     * @return Reponsetache
     */
    public function setDonnee($donnee)
    {
        $this->donnee = $donnee;

        return $this;
    }

    /**
     * Get donnee
     *
     * @return string 
     */
    public function getDonnee()
    {
        return $this->donnee;
    }

    /**
     * Set idetudiant
     *
     * @param integer $idetudiant
     * @return Reponsetache
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
     * Set idtache
     *
     * @param integer $idtache
     * @return Reponsetache
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
     * Set idgestionnaire
     *
     * @param integer $idgestionnaire
     * @return Reponsetache
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
}
