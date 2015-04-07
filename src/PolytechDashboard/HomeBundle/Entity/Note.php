<?php

namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="Note")
 * @ORM\Entity
 */
class Note
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
     * @ORM\Column(name="idDetailNote", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $iddetailnote;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $note;



    /**
     * Set idetudiant
     *
     * @param integer $idetudiant
     * @return Note
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
     * Set iddetailnote
     *
     * @param integer $iddetailnote
     * @return Note
     */
    public function setIddetailnote($iddetailnote)
    {
        $this->iddetailnote = $iddetailnote;

        return $this;
    }

    /**
     * Get iddetailnote
     *
     * @return integer 
     */
    public function getIddetailnote()
    {
        return $this->iddetailnote;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Note
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }
}
