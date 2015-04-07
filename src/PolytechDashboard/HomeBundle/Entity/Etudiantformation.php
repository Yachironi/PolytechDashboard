<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etudiantformation
 *
 * @ORM\Table(name="EtudiantFormation")
 * @ORM\Entity
 */
class Etudiantformation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEtudiant", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idetudiant;

    /**
     * @var integer
     *
     * @ORM\Column(name="idFormation", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idformation;



    /**
     * Set idetudiant
     *
     * @param integer $idetudiant
     * @return Etudiantformation
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
     * Set idformation
     *
     * @param integer $idformation
     * @return Etudiantformation
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
}
