<?php

namespace LivraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison")
 * @ORM\Entity
 */
class Livraison
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_livraison", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_depart", type="string", length=100, nullable=false)
     */
    private $adresseDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_arrive", type="string", length=100, nullable=false)
     */
    private $adresseArrive;

    /**
     * @var integer
     *
     * @ORM\Column(name="distance", type="integer", nullable=true)
     */
    private $distance;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_produit", type="string", length=100, nullable=true)
     */
    private $photoProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="fragile", type="string", length=100, nullable=true)
     */
    private $fragile;

    /**
     * @var integer
     *
     * @ORM\Column(name="poids", type="integer", nullable=true)
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=100, nullable=true)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="date_reception", type="string", length=100, nullable=true)
     */
    private $dateReception;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_magasin", type="integer", nullable=true)
     */
    private $idMagasin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_commande", type="integer", nullable=true)
     */
    private $idCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_emp", type="integer", nullable=true)
     */
    private $idEmp;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=500, nullable=true)
     */
    private $matricule;


}

