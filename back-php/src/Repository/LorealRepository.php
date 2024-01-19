<?php

namespace App\Repository;

use App\Entity\Loreal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Loreal>
 *
 * @method Loreal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loreal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loreal[]    findAll()
 * @method Loreal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LorealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loreal::class);
    }
    public function findLikeName(string $name): array
    {
        $result = [];

        if (!empty($name)) {
            $result = $this->createQueryBuilder('l')
                ->andWhere('l.nameProduct LIKE :name')
                ->setParameter('name', '%' . $name . '%')
                ->orderBy('l.nameProduct', 'ASC')
                ->setMaxResults(5)
                ->getQuery()
                ->getResult();
        }
        return $result;
    }
//    /**
//     * @return Loreal[] Returns an array of Loreal objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Loreal
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
