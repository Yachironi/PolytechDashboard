<?php
namespace PolytechDashboard\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="Evenement")
 * @ORM\Entity
 */
class Evenement
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
	 * @ORM\Column(name="titre", type="text", nullable=true)
	 */
	private $titre;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="dateAjout", type="string", nullable=true)
	 */
	private $dateAjout;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="dateEvenement", type="string", nullable=true)
	 */
	private $dateEvenement;
	
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
	 * Set id
	 *
	 * @param integer $id
	 * @return Evenement
	 */
	public function setId($id)
	{
		$this->id = $id;
	
		return $this;
	}
	
	/**
	 * Get titre
	 *
	 * @return string
	 */
	public function getTitre()
	{
		return $this->titre;
	}
	
	/**
	 * Set titre
	 *
	 * @param string $titre
	 * @return Evenement
	 */
	public function setTitre($titre)
	{
		$this->titre = $titre;
	
		return $this;
	}
	
	/**
	 * Get dateAjout
	 *
	 * @return string
	 */
	public function getDateAjout()
	{
		return $this->dateAjout;
	}
	
	/**
	 * Set dateAjout
	 *
	 * @param string $dateAjout
	 * @return Evenement
	 */
	public function setDateAjout($dateAjout)
	{
		$this->dateAjout = $dateAjout;
	
		return $this;
	}
	
	/**
	 * Get dateEvenement
	 *
	 * @return string
	 */
	public function getDateEvenement()
	{
		return $this->dateEvenement;
	}
	
	/**
	 * Set dateEvenement
	 *
	 * @param string $titre
	 * @return Evenement
	 */
	public function setDateEvenement($dateE)
	{
		$this->dateEvenement = $dateE;
	
		return $this;
	}
	
}