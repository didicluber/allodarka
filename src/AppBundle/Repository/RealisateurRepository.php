<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use AppBundle\Entity\Realisateur;
/**
 * RealisateurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RealisateurRepository extends \Doctrine\ORM\EntityRepository
{


    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('r')
            ->where('r.something = :value')->setParameter('value', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}