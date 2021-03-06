<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gestionnaireautre
 *
 * @ORM\Table(name="GestionnaireAutre")
 * @ORM\Entity
 */
class GestionnaireAutre
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
     * @var string
     *
     * @ORM\Column(name="autre", type="text", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $autre;



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
     * Set autre
     *
     * @param string $autre
     * @return Gestionnaireautre
     */
    public function setAutre($autre)
    {
        $this->autre = $autre;

        return $this;
    }

    /**
     * Get autre
     *
     * @return string 
     */
    public function getAutre()
    {
        return $this->autre;
    }
}
