<?php

namespace App\Repository;

use App\Entity\ConnectedDevice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConnectedDevice>
 *
 * @method ConnectedDevice|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConnectedDevice|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConnectedDevice[]    findAll()
 * @method ConnectedDevice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnectedDeviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConnectedDevice::class);
    }

    //    /**
    //     * @return ConnectedDevice[] Returns an array of ConnectedDevice objects
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

    //    public function findOneBySomeField($value): ?ConnectedDevice
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
