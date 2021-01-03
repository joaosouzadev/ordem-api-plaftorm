<?php

namespace App\Repository;

use App\Entity\OrdemServico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrdemServico|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdemServico|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdemServico[]    findAll()
 * @method OrdemServico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdemServicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdemServico::class);
    }

    // /**
    //  * @return OrdemServico[] Returns an array of OrdemServico objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrdemServico
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
