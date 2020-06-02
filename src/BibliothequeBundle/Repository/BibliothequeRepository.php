<?php

namespace BibliothequeBundle\Repository;
use MyBundle\Entity\Livre;
use Doctrine\ORM\Query;

class BibliothequeRepository extends \Doctrine\ORM\EntityRepository
{
public function findEntitiesByString($str)
{
    return $this->getEntityManager()
        ->createQuery('SELECT p 
        FROM MyBundle:Livre p
        WHERE p.nomlivre LIKE :str'

        )->setParameter('str', '%'.$str.'%')->getResult();
}
public function findCommande($user)
{
    $query=$this->getEntityManager()
        ->createQuery("select m from MyBundle:Commande m WHERE m.idUser='$user'");
    return $query->getResult();
}

    public function findLogByID($id){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT c.idlivre,c.nomlivre,c.prixlivre,u.idcommande,u.datecommande
                            FROM MyBundle:Commande u JOIN MyBundle:Livre c WITH u.idlivre = c.idlivre
                            WHERE  u.idUser='$id'
                            ");
        if(count($query->getArrayResult()) > 0) return $query->getResult();
        return null;
    }
    public function findProfile($id){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT c.nom,c.prenom,c.email
                            FROM MyBundle:User c WHERE  c.id='$id'
                            ");
        if(count($query->getArrayResult()) > 0) return $query->getResult();
        return null;
    }
    public function findByUsername($p){

        $query=$this->getEntityManager()->createQuery("SELECT m from MyBundle:User m where m.username like :x")
            ->setParameter('x','%'.$p.'%');
        return $query->getResult();

    }

}