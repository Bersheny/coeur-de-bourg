<?php

namespace App\Repository;

use App\Entity\CdbPartners;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CdbPartners>
 *
 * @method CdbPartners|null find($id, $lockMode = null, $lockVersion = null)
 * @method CdbPartners|null findOneBy(array $criteria, array $orderBy = null)
 * @method CdbPartners[]    findAll()
 * @method CdbPartners[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CdbPartnersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CdbPartners::class);
    }

    public function save(CdbPartners $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CdbPartners $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CdbPartners[] Returns an array of CdbPartners objects
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

//    public function findOneBySomeField($value): ?CdbPartners
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
