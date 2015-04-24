<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gestionnairecours
 *
 * @ORM\Table(name="GestionnaireCours")
 * @ORM\Entity
 */
class GestionnaireCours
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
     * @ORM\Column(name="idCours", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idcours;



    /**
     * Set idgestionnaire
     *
     * @param integer $idgestionnaire
     * @return Gestionnairecours
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
     * Set idcours
     *
     * @param integer $idcours
     * @return Gestionnairecours
     */
    public function setIdcours($idcours)
    {
        $this->idcours = $idcours;

        return $this;
    }

    /**
     * Get idcours
     *
     * @return integer 
     */
    public function getIdcours()
    {
        return $this->idcours;
    }
}
