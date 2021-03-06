<?php

namespace App\Repository;

use App\Entity\Visiteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Visiteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visiteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visiteur[]    findAll()
 * @method Visiteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visiteur::class);
    }
    
    public function SeConnecter($login, $mdp) {
            $queryBuilder = $this->_em->createQueryBuilder()
            ->select('v')
            ->from(Visiteur::class, 'v')
            ->where('v.login = :login')
            ->andWhere('v.mdp = :mdp')
            ->setParameter('login',$login)
            ->setParameter('mdp', $mdp);

           $result =  $queryBuilder->getQuery()->getResult();

        return $result;
    }

     public function getLeVisiteur($id)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('v')
            ->from(Visiteur::class, 'v')
            ->where('v.id = :id')
            ->setParameter('id', $id);
        $query = $qb->getQuery();
        $result = $query->getOneOrNullResult();
        return $result;
    }
    
    // /**
    //  * @return Visiteur[] Returns an array of Visiteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Visiteur
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
