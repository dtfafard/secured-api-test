<?php

namespace App\Repository;

use App\Entity\ServerType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ServerType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServerType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServerType[]    findAll()
 * @method ServerType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServerTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ServerType::class);
    }

    // /**
    //  * @return ServerType[] Returns an array of ServerType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServerType
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
