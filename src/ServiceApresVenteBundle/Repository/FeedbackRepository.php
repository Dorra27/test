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
    public  function calculerTotalFeedback(){

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('count(f.description)');
        $qb->from('ServiceApresVenteBundle:Feedback','f');

        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;


    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
                FROM ServiceApresVenteBundle:Feedback f
                WHERE f.datefeedback LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }




//    public function getFeedbackByUser($id_feedback){
//        return $this->getEntityManager()
//            ->createQuery(
//                "SELECT f, u.username
//       FROM ServicesApresVenteBundle:Feedback
//       JOIN c.user u
//       WHERE c.feedback = :id"
//            )
//            ->setParameter('id', $id_feedback)
//            ->getArrayResult();
//    }

//    public function getFeedbackById() {
//        $query = $this->getEntityManager()
//            ->createQuery(
//            'SELECT p
//       FROM ServicesApresVenteBundle:Feedback  f'
//
//        );
//
//        $products = $query->getResult();
//        return $query;
//    }

}
