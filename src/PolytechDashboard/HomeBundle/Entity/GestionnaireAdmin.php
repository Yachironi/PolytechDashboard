<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gestionnaireadmin
 *
 * @ORM\Table(name="GestionnaireAdmin")
 * @ORM\Entity
 */
class GestionnaireAdmin
{
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
     * @ORM\Column(name="idFormation", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idformation;



    /**
     * Set idgestionnaire
     *
     * @param integer $idgestionnaire
     * @return Gestionnaireformation
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
     * Set idformation
     *
     * @param integer $idformation
     * @return Gestionnaireformation
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
