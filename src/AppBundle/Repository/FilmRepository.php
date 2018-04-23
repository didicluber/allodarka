<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use AppBundle\Entity\Film;
/**
 * FilmRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmRepository extends \Doctrine\ORM\EntityRepository
{


    public function findFilmByPerso($id_perso)
    {
        $result = $this->createQueryBuilder('film')
            ->join('film.personnages', 'personnage')
            ->join('personnage.acteur', 'acteur')
            ->join('film.realisateur', 'realisateur')
            ->join('film.categorie', 'categorie')
            ->addSelect('personnage')
            ->addSelect('acteur')
            ->addSelect('realisateur')
            ->addSelect('categorie')
            ->where('personnage.id = :id')
            ->setParameter('id', $id_perso)
            ->getQuery()
            ->getArrayResult()
        ;
        return $result;
    }
}