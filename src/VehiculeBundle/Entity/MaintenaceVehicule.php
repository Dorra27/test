<?php

namespace VehiculeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MaintenaceVehicule
 *
 * @ORM\Table(name="maintenace_vehicule")
 * @ORM\Entity
 */
class MaintenaceVehicule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nature", type="string", length=255, nullable=true)
     */
    private $nature;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="cout", type="integer", nullable=true)
     */
    private $cout;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=255, nullable=false)
     */
    private $matricule;


}

