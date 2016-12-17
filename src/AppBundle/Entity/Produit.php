<?php

namespace AppBundle\Entity;

/**
 * Produit
 */
class Produit
{
    /**
     * @var string
     */
    private $numproduit;

    /**
     * @var string
     */
    private $nomproduit;

    /**
     * @var float
     */
    private $prix;

    /**
     * @var integer
     */
    private $qte;


    /**
     * Get numproduit
     *
     * @return string
     */
    public function getNumproduit()
    {
        return $this->numproduit;
    }

    /**
     * Set nomproduit
     *
     * @param string $nomproduit
     *
     * @return Produit
     */
    public function setNomproduit($nomproduit)
    {
        $this->nomproduit = $nomproduit;

        return $this;
    }

    /**
     * Get nomproduit
     *
     * @return string
     */
    public function getNomproduit()
    {
        return $this->nomproduit;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set qte
     *
     * @param integer $qte
     *
     * @return Produit
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return integer
     */
    public function getQte()
    {
        return $this->qte;
    }
    /**
     * @var boolean
     */
    private $visible;


    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Produit
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }
}
