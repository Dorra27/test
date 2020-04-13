<?php

namespace VehiculeBundle\Repository;

use Doctrine\ORM\EntityRepository;
class VehiculeRepository extends EntityRepository
{
    public function myFindVehiculebymatricule()
    {
        $ql=$this->getEntityManager()->createQuery("select v from VehiculeBundle:Vehicule v where v.matricule='155tun1444' ");
        return $query= $ql->getResult();
    }

}
?>