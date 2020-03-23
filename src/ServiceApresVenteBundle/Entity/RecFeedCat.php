<?php

namespace ServiceApresVenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecFeedCat
 *
 * @ORM\Table(name="rec_feed_cat")
 * @ORM\Entity
 */
class RecFeedCat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cat", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @return int
     */
    public function getIdCat()
    {
        return $this->idCat;
    }

    /**
     * @param int $idCat
     */
    public function setIdCat($idCat)
    {
        $this->idCat = $idCat;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }



}

