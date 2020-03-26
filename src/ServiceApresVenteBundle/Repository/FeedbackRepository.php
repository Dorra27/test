<?php

namespace ServiceApresVenteBundle\Repository;

/**
 * FeedbackRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FeedbackRepository extends \Doctrine\ORM\EntityRepository
{

    public function getCategorie($annonce_id){
        return $this->getEntityManager()
            ->createQuery(
                "SELECT c, u.username
       FROM AppBundle:Commentaireannonce c
       JOIN c.user u
       WHERE c.annonce = :id"
            )
            ->setParameter('id', $annonce_id)
            ->getArrayResult();
    }

}
