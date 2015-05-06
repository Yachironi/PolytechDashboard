<?php
namespace PolytechDashboard\HomeBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Resource
 *
 * @ORM\Table(name="Resource")
 * @ORM\Entity
 */
class Resource
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	public $id;

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank
	 */
	public $name;


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
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Set nom
	 *
	 * @param string $nom
	 */
	public function setNom($nom)
	{
		$this->name = $nom;
	
		return $this;
	}
	

	public function getAbsolutePath()
	{
		return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
	}

	public function getWebPath()
	{
		return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
	}

	protected function getUploadRootDir()
	{
		// le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
		return __DIR__.'/../../../web/'.$this->getUploadDir();
	}

	protected function getUploadDir()
	{
		// on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
		// le document/image dans la vue.
		return 'upload/';
	}
	
	public function upload()
	{
		// la propriété « file » peut être vide si le champ n'est pas requis
		if (null === $this->file) {
			return;
		}
	
		// utilisez le nom de fichier original ici mais
		// vous devriez « l'assainir » pour au moins éviter
		// quelconques problèmes de sécurité
	
		// la méthode « move » prend comme arguments le répertoire cible et
		// le nom de fichier cible où le fichier doit être déplacé
		$this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
	
		// définit la propriété « path » comme étant le nom de fichier où vous
		// avez stocké le fichier
		$this->path = $this->file->getClientOriginalName();
	
		// « nettoie » la propriété « file » comme vous n'en aurez plus besoin
		$this->file = null;
	}
}