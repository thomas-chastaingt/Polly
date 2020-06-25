<?php

namespace App\Repository;

use App\Entity\PollAnswers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PollAnswers|null find($id, $lockMode = null, $lockVersion = null)
 * @method PollAnswers|null findOneBy(array $criteria, array $orderBy = null)
 * @method PollAnswers[]    findAll()
 * @method PollAnswers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PollAnswersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PollAnswers::class);
    }

    public function countByNumberAnswers()
    {
        $query = $this->createQueryBuilder('pa')
                      ->select('p.title', 'p.hide', 'COUNT(p.title) as numberAnswers')
                      ->join('pa.poll', 'p')
                      ->groupBy('p.title')
                      ->orderBy('COUNT(p.title)', 'DESC')
            
            ;
        
        return $query->getQuery()->getArrayResult();
    }

    // /**
    //  * @return PollAnswers[] Returns an array of PollAnswers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PollAnswers
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
