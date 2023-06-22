<?php

namespace App\Repository;

use App\Entity\CdbRecipesFeatured;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CdbRecipesFeatured>
 *
 * @method CdbRecipesFeatured|null find($id, $lockMode = null, $lockVersion = null)
 * @method CdbRecipesFeatured|null findOneBy(array $criteria, array $orderBy = null)
 * @method CdbRecipesFeatured[]    findAll()
 * @method CdbRecipesFeatured[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CdbRecipesFeaturedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CdbRecipesFeatured::class);
    }

    public function save(CdbRecipesFeatured $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CdbRecipesFeatured $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CdbRecipesFeatured[] Returns an array of CdbRecipesFeatured objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CdbRecipesFeatured
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
