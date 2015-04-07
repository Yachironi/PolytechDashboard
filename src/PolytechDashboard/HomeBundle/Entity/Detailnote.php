<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detailnote
 *
 * @ORM\Table(name="DetailNote")
 * @ORM\Entity
 */
class Detailnote
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
     * @ORM\Column(name="idCours", type="integer", nullable=true)
     */
    private $idcours;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;

    /**
     * @var integer
     *
     * @ORM\Column(name="pourcentage", type="integer", nullable=true)
     */
    private $pourcentage;



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
     * Set idcours
     *
     * @param integer $idcours
     * @return Detailnote
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

    /**
     * Set detail
     *
     * @param string $detail
     * @return Detailnote
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string 
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set pourcentage
     *
     * @param integer $pourcentage
     * @return Detailnote
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    /**
     * Get pourcentage
     *
     * @return integer 
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }
}
