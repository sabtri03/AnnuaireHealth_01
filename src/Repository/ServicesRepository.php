<?php

namespace App\Repository;

use App\Entity\Services;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Services|null find($id, $lockMode = null, $lockVersion = null)
 * @method Services|null findOneBy(array $criteria, array $orderBy = null)
 * @method Services[]    findAll()
 * @method Services[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Services::class);
    }

//    /**
//     * @return Services[] Returns an array of Services objects
//     */
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
    public function findOneBySomeField($value): ?Services
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param $search
     * @return Services[]
     */
    public function findByNom($search): array
    {
        $qb = $this->createQueryBuilder('s');
           // $qb->addCriteria($qb);
            $qb->andWhere(
                $qb->expr()->like( 's.nom', ':nom' )
            );
            $qb->setParameter('nom',"%".$search."%" );

        $query = $qb->getQuery();
        //$results = $query->getResult();
        return $query->execute();
    }






    /*  public function findByNom($search)
      {
          $qb = $this->createQueryBuilder('s');
          //$qb->addCriteria($qb);
          $qb->andWhere(
          $qb->expr()->like( 's.nom', ':nom' )
          );
          $qb->setParameter( 'nom',"%".$search."%" );

          $query = $qb->getQuery();
          //$results = $query->getResult();
          return $query->execute();
      }
*/
}
