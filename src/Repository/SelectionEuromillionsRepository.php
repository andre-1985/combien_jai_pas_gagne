<?php

namespace App\Repository;

use App\Entity\SelectionEuromillions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SelectionEuromillions>
 *
 * @method SelectionEuromillions|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelectionEuromillions|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelectionEuromillions[]    findAll()
 * @method SelectionEuromillions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectionEuromillionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectionEuromillions::class);
    }

    public function save(SelectionEuromillions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SelectionEuromillions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SelectionEuromillions[] Returns an array of SelectionEuromillions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SelectionEuromillions
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
