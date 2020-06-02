<?php

namespace BlogBundle\Repository;
use MyBundle\Entity\Blog;
use Doctrine\ORM\Query;

class BlogRepository extends \Doctrine\ORM\EntityRepository
{
    public function findEntitiesByString($str)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p 
        FROM MyBundle:Blog p
        WHERE p.sujet LIKE :str'

            )->setParameter('str', '%'.$str.'%')->getResult();
    }


}