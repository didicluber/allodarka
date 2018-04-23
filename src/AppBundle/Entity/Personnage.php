<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Personnage
 *
 * @ORM\Table(name="personnage")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonnageRepository")
 */
class Personnage
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
     *
     * @ORM\Column(type="string")
     */
    private $nomPerso;

    /**
     * @Groups({"film"})
     *
     * @ORM\ManyToOne(targetEntity="Acteur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $acteur;


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
    public function getNomPerso()
    {
        return $this->nomPerso;
    }

    /**
     * @param string $nomPerso
     */
    public function setNomPerso($nomPerso)
    {
        $this->nomPerso = $nomPerso;
    }

    /**
     * @return Acteur
     */
    public function getActeur()
    {
        return $this->acteur;
    }

    /**
     * @param Acteur $acteur
     */
    public function setActeur(Acteur $acteur)
    {
        $this->acteur = $acteur;
    }

    public function __toString()
    {
        return $this->nomPerso;
    }
}
