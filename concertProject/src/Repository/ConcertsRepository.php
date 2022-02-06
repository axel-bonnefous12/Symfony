<?php

namespace App\Repository;

use App\Entity\Concerts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Concerts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Concerts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Concerts[]    findAll()
 * @method Concerts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcertsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Concerts::class);
    }

    /**
    * @return Concerts[] Returns an array of Concerts objects
    */

    public function findDateWhereDateHigheThanToday()
    {
        return $this->createQueryBuilder('C')
                    ->andWhere('C.begin > CURRENT_DATE()')
                    ->getQuery()
                    ->getResult();
    }



}
