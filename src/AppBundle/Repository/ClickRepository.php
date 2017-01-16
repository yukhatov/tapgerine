<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 14.01.17
 * Time: 16:38
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Config\Definition\Exception\Exception;

class ClickRepository extends EntityRepository
{
    public function findHighestId()
    {
        $id =  $this->createQueryBuilder('c')
            ->select('MAX(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $id ? $id : 0;
    }

    public function findOneByKey($key)
    {
        $query = $this->createQueryBuilder('c')
            ->where("CONCAT(c.referrer, c.param1) = :key");

        $query->setParameter('key', $key);

        return $query->getQuery()
            ->getOneOrNullResult();
    }
}