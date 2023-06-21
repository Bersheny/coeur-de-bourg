<?php

namespace App\Repository;

use App\Entity\CdbRecipes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CdbRecipes>
 *
 * @method CdbRecipes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CdbRecipes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CdbRecipes[]    findAll()
 * @method CdbRecipes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CdbRecipesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CdbRecipes::class);
    }

    public function save(CdbRecipes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CdbRecipes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CdbRecipes[] Returns an array of CdbRecipes objects
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

//    public function findOneBySomeField($value): ?CdbRecipes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
