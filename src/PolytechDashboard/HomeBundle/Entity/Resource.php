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
		// le chemin absolu du r�pertoire o� les documents upload�s doivent �tre sauvegard�s
		return __DIR__.'/../../../web/'.$this->getUploadDir();
	}

	protected function getUploadDir()
	{
		// on se d�barrasse de � __DIR__ � afin de ne pas avoir de probl�me lorsqu'on affiche
		// le document/image dans la vue.
		return 'upload/';
	}
	
	public function upload()
	{
		// la propri�t� � file � peut �tre vide si le champ n'est pas requis
		if (null === $this->file) {
			return;
		}
	
		// utilisez le nom de fichier original ici mais
		// vous devriez � l'assainir � pour au moins �viter
		// quelconques probl�mes de s�curit�
	
		// la m�thode � move � prend comme arguments le r�pertoire cible et
		// le nom de fichier cible o� le fichier doit �tre d�plac�
		$this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
	
		// d�finit la propri�t� � path � comme �tant le nom de fichier o� vous
		// avez stock� le fichier
		$this->path = $this->file->getClientOriginalName();
	
		// � nettoie � la propri�t� � file � comme vous n'en aurez plus besoin
		$this->file = null;
	}
}