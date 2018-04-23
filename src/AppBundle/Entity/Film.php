<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File ;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FilmRepository")
 */

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Film
{
    /**
     * @Groups({"film"})
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"film"})
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @Groups({"film"})
     * @ORM\Column(type="time", nullable=true)
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @Groups({"film"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @Groups({"film"})
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $budget;

    /**
     * @Groups({"film"})
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $montantRecette;

    /**
     * @Groups({"film"})
     *
     * @ORM\ManyToMany(targetEntity="Categorie", cascade={"persist"})
     */
    private $categorie;

    /**
     * @Groups({"film"})
     *
     * @ORM\Column(type="boolean")
     */
    private $aucinema;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Cinema", cascade={"persist"})
     *
     */
    private $filmjoue;


    /**
     * @Groups({"film"})
     *
     *
     * @ORM\ManyToMany(targetEntity="Personnage", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, nullable=true)
     */
    private $personnages;

    /**
     * @Groups({"film"})
     *
     * @ORM\ManyToOne(targetEntity="Realisateur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $realisateur;

    /**
     * @Groups({"film"})
     *
     * @ORM\Column(type="boolean" , nullable=true)
     */
    private $featured;


    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    // ...

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param int $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        if (is_string($date)) {
            $date = \DateTime::createFromFormat("d/m/Y", $date);
        }
        if (!$date) {
            $date = null;
        }
        $this->date = $date;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $description;

    /**
     * @return int
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param int $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    /**
     * @return int
     */
    public function getMontantRecette()
    {
        return $this->montantRecette;
    }

    /**
     * @param int $montantRecette
     */
    public function setMontantRecette($montantRecette)
    {
        $this->montantRecette = $montantRecette;
    }

    /**
     * @return Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param Categorie $categorie
     */
    public function setCategorie(Categorie $categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return ArrayCollection
     */
    public function getPersonnages()
    {
        return $this->personnages;
    }

    /**
     * @param Personnage $personnage
     */
    public function addPersonnage(Personnage $personnage){
        $this->personnages[] = $personnage;
    }

    /**
     * @param Personnage $personnage
     */
    public function removePersonnage(Personnage $personnage){
        $this->personnages->removeElement($personnage);
    }

    /**
     * @return Realisateur
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * @param Realisateur $realisateur
     */
    public function setRealisateur(Realisateur $realisateur)
    {
        $this->realisateur = $realisateur;
    }

    /**
     * @param ArrayCollection $personnages
     */
    public function setPersonnages($personnages)
    {
        $this->personnages = $personnages;
    }

    public function __toString()
    {
        return $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personnages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->filmjoue = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categorie = new  \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Set aucinema
     *
     * @param boolean $aucinema
     *
     * @return Film
     */
    public function setAucinema($aucinema)
    {
        $this->aucinema = $aucinema;

        return $this;
    }

    /**
     * Get aucinema
     *
     * @return boolean
     */
    public function getAucinema()
    {
        return $this->aucinema;
    }


    /**
     * Set $featured
     *
     * @param boolean $$featured
     *
     * @return Film
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get $featured
     *
     * @return boolean
     */
    public function getFeature()
    {
        return $this->featured;
    }

    /**
     * Set filmjoue
     *
     * @param \AppBundle\Entity\Cinema $filmjoue
     *
     * @return Film
     */
    public function setFilmjoue(\AppBundle\Entity\Cinema $filmjoue)
    {
        $this->filmjoue = $filmjoue;

        return $this;
    }

    /**
     * Get filmjoue
     *
     * @return \AppBundle\Entity\Cinema
     */
    public function getFilmjoue()
    {
        return $this->filmjoue;
    }
}
