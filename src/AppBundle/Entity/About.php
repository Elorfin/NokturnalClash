<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * About
 *
 * @ORM\Table(name="about")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AboutRepository")
 */
class About
{
    /**
     * Unique identifier
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Presentation text
     * @var string
     *
     * @ORM\Column(name="presentation", type="text")
     * @Gedmo\Translatable
     */
    protected $presentation;

    /**
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     *
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Url()
     */
    protected $facebook;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Url()
     */
    protected $instagram;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Url()
     */
    protected $flickr;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Url()
     */
    protected $liveJournal;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set presentation
     * @param string $presentation
     * @return About
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     * @param  string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get facebook url
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set facebook url
     * @param  string $facebook
     * @return $this
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get instagram url
     * @return string
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set instagram url
     * @param  string $instagram
     * @return $this
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get flickr url
     * @return string
     */
    public function getFlickr()
    {
        return $this->flickr;
    }

    /**
     * Set flickr url
     * @param  string $flickr
     * @return $this
     */
    public function setFlickr($flickr)
    {
        $this->flickr = $flickr;

        return $this;
    }

    /**
     * Get LiveJournal url
     * @return string
     */
    public function getLiveJournal()
    {
        return $this->liveJournal;
    }

    /**
     * Set LiveJournal url
     * @param $liveJournal
     * @return $this
     */
    public function setLiveJournal($liveJournal)
    {
        $this->liveJournal = $liveJournal;

        return $this;
    }
}

