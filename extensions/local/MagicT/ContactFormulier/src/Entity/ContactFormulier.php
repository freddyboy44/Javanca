<?php

namespace Bolt\Extension\MagicT\ContactFormulier\Entity;

class ContactFormulier {

	
	protected $Naam;
    protected $Email;
    protected $Telefoon;
    protected $Vraag;
    protected $Categorie;


   

    /**
     * Gets the value of Naam.
     *
     * @return mixed
     */
    public function getNaam()
    {
        return $this->Naam;
    }

    /**
     * Sets the value of Naam.
     *
     * @param mixed $Naam the naam
     *
     * @return self
     */
    public function setNaam($Naam)
    {
        $this->Naam = $Naam;

        return $this;
    }

    /**
     * Gets the value of Email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Sets the value of Email.
     *
     * @param mixed $Email the email
     *
     * @return self
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * Gets the value of Telefoon.
     *
     * @return mixed
     */
    public function getTelefoon()
    {
        return $this->Telefoon;
    }

    /**
     * Sets the value of Telefoon.
     *
     * @param mixed $Telefoon the telefoon
     *
     * @return self
     */
    public function setTelefoon($Telefoon)
    {
        $this->Telefoon = $Telefoon;

        return $this;
    }

    /**
     * Gets the value of Vraag.
     *
     * @return mixed
     */
    public function getVraag()
    {
        return $this->Vraag;
    }

    /**
     * Sets the value of Vraag.
     *
     * @param mixed $Vraag the vraag
     *
     * @return self
     */
    public function setVraag($Vraag)
    {
        $this->Vraag = $Vraag;

        return $this;
    }

    /**
     * Gets the value of Categorie.
     *
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->Categorie;
    }

    /**
     * Sets the value of Categorie.
     *
     * @param mixed $Categorie the categorie
     *
     * @return self
     */
    public function setCategorie($Categorie)
    {
        $this->Categorie = $Categorie;

        return $this;
    }
}