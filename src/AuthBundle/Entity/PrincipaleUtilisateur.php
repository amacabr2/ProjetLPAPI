<?php

namespace AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrincipaleUtilisateur
 *
 * @ORM\Table(name="principale_utilisateur", indexes={@ORM\Index(name="principale_utilisateur_id_service", columns={"principale_utilisateur_id_service"})})
 * @ORM\Entity
 */
class PrincipaleUtilisateur
{
    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_id_operation", type="string", length=12, nullable=false)
     */
    private $idOperation;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_id_service", type="string", length=32, nullable=false)
     */
    private $idService;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_cle_cookie", type="string", length=32, nullable=false)
     */
    private $cleCookie;

    /**
     * @var integer
     *
     * @ORM\Column(name="principale_utilisateur_cle_cookie_limite", type="integer", nullable=true)
     */
    private $cleCookieLimite;

    /**
     * @var integer
     *
     * @ORM\Column(name="principale_utilisateur_etape", type="integer", nullable=false)
     */
    private $etape;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="principale_utilisateur_date_inscription", type="date", nullable=false)
     */
    private $dateInscription = '0000-00-00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="principale_utilisateur_tutelle", type="boolean", nullable=false)
     */
    private $tutelle;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_pseudo", type="string", length=125, nullable=false)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_mdp", type="string", length=32, nullable=false)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_civilite", type="string", nullable=false)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="principale_utilisateur_date_naissance", type="date", nullable=false)
     */
    private $dateNaissance = '0000-00-00';

    /**
     * @var integer
     *
     * @ORM\Column(name="principale_utilisateur_num_voie", type="integer", nullable=false)
     */
    private $numVoie;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var integer
     *
     * @ORM\Column(name="principale_utilisateur_zip", type="integer", nullable=false)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_ville", type="string", length=50, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_pays", type="string", length=50, nullable=false)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_email", type="string", length=125, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_tel", type="string", length=32, nullable=false)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_tel_fixe", type="string", length=32, nullable=false)
     */
    private $telFixe;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_tel_portable", type="string", length=32, nullable=false)
     */
    private $telPortable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="principale_utilisateur_newsletter", type="boolean", nullable=false)
     */
    private $newsletter;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="principale_utilisateur_newsletter_date", type="date", nullable=false)
     */
    private $newsletterDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="principale_utilisateur_courrier", type="boolean", nullable=false)
     */
    private $courrier;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_lg", type="string", length=2, nullable=false)
     */
    private $lg;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_image", type="string", length=50, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_presentation", type="text", length=65535, nullable=false)
     */
    private $presentation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="principale_utilisateur_actif", type="boolean", nullable=false)
     */
    private $actif;

    /**
     * @var boolean
     *
     * @ORM\Column(name="principale_utilisateur_autorisation", type="boolean", nullable=false)
     */
    private $autorisation = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="principale_utilisateur_permis_valide", type="boolean", nullable=false)
     */
    private $permisValide = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="principale_utilisateur_date_permis", type="date", nullable=false)
     */
    private $datePermis = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_fichier_permis", type="string", length=50, nullable=false)
     */
    private $fichierPermis;

    /**
     * @var string
     *
     * @ORM\Column(name="principale_utilisateur_href_rss", type="string", length=255, nullable=false)
     */
    private $hrefRss;

    /**
     * @var integer
     *
     * @ORM\Column(name="principale_utilisateur_fkid_droits", type="integer", nullable=false)
     */
    private $fkidDroits;

    /**
     * @var integer
     *
     * @ORM\Column(name="principale_utilisateur_fkid_statut", type="integer", nullable=false)
     */
    private $fkidStatut;

    /**
     * @var integer
     *
     * @ORM\Column(name="principale_utilisateur_fkid_contact", type="integer", nullable=false)
     */
    private $fkidContact;

    /**
     * @var integer
     *
     * @ORM\Column(name="principale_utilisateur_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set idOperation
     *
     * @param string $idOperation
     *
     * @return PrincipaleUtilisateur
     */
    public function setIdOperation($idOperation)
    {
        $this->idOperation = $idOperation;

        return $this;
    }

    /**
     * Get idOperation
     *
     * @return string
     */
    public function getIdOperation()
    {
        return $this->idOperation;
    }

    /**
     * Set idService
     *
     * @param string $idService
     *
     * @return PrincipaleUtilisateur
     */
    public function setIdService($idService)
    {
        $this->idService = $idService;

        return $this;
    }

    /**
     * Get idService
     *
     * @return string
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * Set cleCookie
     *
     * @param string $cleCookie
     *
     * @return PrincipaleUtilisateur
     */
    public function setCleCookie($cleCookie)
    {
        $this->cleCookie = $cleCookie;

        return $this;
    }

    /**
     * Get cleCookie
     *
     * @return string
     */
    public function getCleCookie()
    {
        return $this->cleCookie;
    }

    /**
     * Set cleCookieLimite
     *
     * @param integer $cleCookieLimite
     *
     * @return PrincipaleUtilisateur
     */
    public function setCleCookieLimite($cleCookieLimite)
    {
        $this->cleCookieLimite = $cleCookieLimite;

        return $this;
    }

    /**
     * Get cleCookieLimite
     *
     * @return integer
     */
    public function getCleCookieLimite()
    {
        return $this->cleCookieLimite;
    }

    /**
     * Set etape
     *
     * @param integer $etape
     *
     * @return PrincipaleUtilisateur
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get etape
     *
     * @return integer
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return PrincipaleUtilisateur
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set tutelle
     *
     * @param boolean $tutelle
     *
     * @return PrincipaleUtilisateur
     */
    public function setTutelle($tutelle)
    {
        $this->tutelle = $tutelle;

        return $this;
    }

    /**
     * Get tutelle
     *
     * @return boolean
     */
    public function getTutelle()
    {
        return $this->tutelle;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return PrincipaleUtilisateur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return PrincipaleUtilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return PrincipaleUtilisateur
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return PrincipaleUtilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return PrincipaleUtilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return PrincipaleUtilisateur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set numVoie
     *
     * @param integer $numVoie
     *
     * @return PrincipaleUtilisateur
     */
    public function setNumVoie($numVoie)
    {
        $this->numVoie = $numVoie;

        return $this;
    }

    /**
     * Get numVoie
     *
     * @return integer
     */
    public function getNumVoie()
    {
        return $this->numVoie;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return PrincipaleUtilisateur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set zip
     *
     * @param integer $zip
     *
     * @return PrincipaleUtilisateur
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return integer
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return PrincipaleUtilisateur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return PrincipaleUtilisateur
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return PrincipaleUtilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return PrincipaleUtilisateur
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     *
     * @return PrincipaleUtilisateur
     */
    public function setTelFixe($telFixe)
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    /**
     * Get telFixe
     *
     * @return string
     */
    public function getTelFixe()
    {
        return $this->telFixe;
    }

    /**
     * Set telPortable
     *
     * @param string $telPortable
     *
     * @return PrincipaleUtilisateur
     */
    public function setTelPortable($telPortable)
    {
        $this->telPortable = $telPortable;

        return $this;
    }

    /**
     * Get telPortable
     *
     * @return string
     */
    public function getTelPortable()
    {
        return $this->telPortable;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return PrincipaleUtilisateur
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set newsletterDate
     *
     * @param \DateTime $newsletterDate
     *
     * @return PrincipaleUtilisateur
     */
    public function setNewsletterDate($newsletterDate)
    {
        $this->newsletterDate = $newsletterDate;

        return $this;
    }

    /**
     * Get newsletterDate
     *
     * @return \DateTime
     */
    public function getNewsletterDate()
    {
        return $this->newsletterDate;
    }

    /**
     * Set courrier
     *
     * @param boolean $courrier
     *
     * @return PrincipaleUtilisateur
     */
    public function setCourrier($courrier)
    {
        $this->courrier = $courrier;

        return $this;
    }

    /**
     * Get courrier
     *
     * @return boolean
     */
    public function getCourrier()
    {
        return $this->courrier;
    }

    /**
     * Set lg
     *
     * @param string $lg
     *
     * @return PrincipaleUtilisateur
     */
    public function setLg($lg)
    {
        $this->lg = $lg;

        return $this;
    }

    /**
     * Get lg
     *
     * @return string
     */
    public function getLg()
    {
        return $this->lg;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return PrincipaleUtilisateur
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return PrincipaleUtilisateur
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return PrincipaleUtilisateur
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set autorisation
     *
     * @param boolean $autorisation
     *
     * @return PrincipaleUtilisateur
     */
    public function setAutorisation($autorisation)
    {
        $this->autorisation = $autorisation;

        return $this;
    }

    /**
     * Get autorisation
     *
     * @return boolean
     */
    public function getAutorisation()
    {
        return $this->autorisation;
    }

    /**
     * Set permisValide
     *
     * @param boolean $permisValide
     *
     * @return PrincipaleUtilisateur
     */
    public function setPermisValide($permisValide)
    {
        $this->permisValide = $permisValide;

        return $this;
    }

    /**
     * Get permisValide
     *
     * @return boolean
     */
    public function getPermisValide()
    {
        return $this->permisValide;
    }

    /**
     * Set datePermis
     *
     * @param \DateTime $datePermis
     *
     * @return PrincipaleUtilisateur
     */
    public function setDatePermis($datePermis)
    {
        $this->datePermis = $datePermis;

        return $this;
    }

    /**
     * Get datePermis
     *
     * @return \DateTime
     */
    public function getDatePermis()
    {
        return $this->datePermis;
    }

    /**
     * Set fichierPermis
     *
     * @param string $fichierPermis
     *
     * @return PrincipaleUtilisateur
     */
    public function setFichierPermis($fichierPermis)
    {
        $this->fichierPermis = $fichierPermis;

        return $this;
    }

    /**
     * Get fichierPermis
     *
     * @return string
     */
    public function getFichierPermis()
    {
        return $this->fichierPermis;
    }

    /**
     * Set hrefRss
     *
     * @param string $hrefRss
     *
     * @return PrincipaleUtilisateur
     */
    public function setHrefRss($hrefRss)
    {
        $this->hrefRss = $hrefRss;

        return $this;
    }

    /**
     * Get hrefRss
     *
     * @return string
     */
    public function getHrefRss()
    {
        return $this->hrefRss;
    }

    /**
     * Set fkidDroits
     *
     * @param integer $fkidDroits
     *
     * @return PrincipaleUtilisateur
     */
    public function setFkidDroits($fkidDroits)
    {
        $this->fkidDroits = $fkidDroits;

        return $this;
    }

    /**
     * Get fkidDroits
     *
     * @return integer
     */
    public function getFkidDroits()
    {
        return $this->fkidDroits;
    }

    /**
     * Set fkidStatut
     *
     * @param integer $fkidStatut
     *
     * @return PrincipaleUtilisateur
     */
    public function setFkidStatut($fkidStatut)
    {
        $this->fkidStatut = $fkidStatut;

        return $this;
    }

    /**
     * Get fkidStatut
     *
     * @return integer
     */
    public function getFkidStatut()
    {
        return $this->fkidStatut;
    }

    /**
     * Set fkidContact
     *
     * @param integer $fkidContact
     *
     * @return PrincipaleUtilisateur
     */
    public function setFkidContact($fkidContact)
    {
        $this->fkidContact = $fkidContact;

        return $this;
    }

    /**
     * Get fkidContact
     *
     * @return integer
     */
    public function getFkidContact()
    {
        return $this->fkidContact;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
