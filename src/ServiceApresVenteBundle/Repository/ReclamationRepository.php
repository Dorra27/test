<?php

namespace ServiceApresVenteBundle\Repository;

/**
 * ReclamationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReclamationRepository extends \Doctrine\ORM\EntityRepository
{
    public function findallReclamationydate(\DateTime $now){

            $now = new \DateTime();

            $from = new \DateTime($now->format('Y-m-d') . ' 00:00:00');
            $to = new \DateTime($now->format('Y-m-d').'23.59.59');

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('e.date')
            ->from('ServiceApresVenteBundle:Reclamation','e')
            ->where('e.date BETWEEN :from AND :to')
            ->setParameter('from',$from)
            ->setParameter('to',$to);

        $result = $qb->getQuery()->getResult();
        return $result;
    }
    public  function calculerTotalReclamation(){

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('count(f.description)');
        $qb->from('ServiceApresVenteBundle:Reclamation','f');

        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

    /***
    */
public function confirmer($id)
{


    $qb = $this->_em->createQueryBuilder();

    $q = $qb->update('ServiceApresVenteBundle:Reclamation', 'r')
        //update DemandeSponsoring p set p.etat=1 where p.id=$id
        //
        ->set('r.etat', '?1')
        ->where('r.idRec = ?2')
        ->setParameter(1, "1")
        ->setParameter(2, $id)
        ->getQuery();
    return $q->getResult();
    }




    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM ServiceApresVenteBundle:Reclamation e
                WHERE e.objet LIKE :str'
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
