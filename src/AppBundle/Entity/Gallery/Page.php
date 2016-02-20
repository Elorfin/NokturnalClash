<?php

namespace AppBundle\Entity\Gallery;

use Doctrine\ORM\Mapping as ORM;
use Elorfin\ResourceBundle\Entity\Image;

/**
 * Page of a Gallery
 *
 * @ORM\Table(name="gallery_page")
 * @ORM\Entity
 */
class Page
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
     * @var AppBundle\Entity\Gallery\Gallery
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gallery\Gallery", inversedBy="pages")
     */
    protected $gallery;

    /**
     * Primary photo of the Page
     * @var \Elorfin\ResourceBundle\Entity\Image
     *
     * @ORM\OneToOne(targetEntity="Elorfin\ResourceBundle\Entity\Image", orphanRemoval=true)
     * @ORM\JoinColumn(name="photo_primary_id", referencedColumnName="id")
     */
    protected $photoPrimary;

    /**
     * Secondary photo of the Page
     * @var \Elorfin\ResourceBundle\Entity\Image
     *
     * @ORM\OneToOne(targetEntity="Elorfin\ResourceBundle\Entity\Image", orphanRemoval=true)
     * @ORM\JoinColumn(name="photo_secondary_id", referencedColumnName="id", nullable=true)
     */
    protected $photoSecondary;

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Gallery
     * @return AppBundle\Entity\Gallery\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set Gallery
     * @param Gallery $gallery
     * @return $this
     */
    public function setGallery(Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get primary photo
     * @return \Elorfin\ResourceBundle\Entity\Image
     */
    public function getPhotoPrimary()
    {
        return $this->photoPrimary;
    }

    /**
     * Set primary photo
     * @param \Elorfin\ResourceBundle\Entity\Image $photoPrimary
     * @return $this
     */
    public function setPhotoPrimary(Image $photoPrimary)
    {
        $this->photoPrimary = $photoPrimary;

        return $this;
    }

    /**
     * Get secondary photo
     * @return \Elorfin\ResourceBundle\Entity\Image
     */
    public function getPhotoSecondary()
    {
        return $this->photoSecondary;
    }

    /**
     * Set secondary photo
     * @param \Elorfin\ResourceBundle\Entity\Image $photoSecondary
     * @return $this
     */
    public function setPhotoSecondary(Image $photoSecondary)
    {
        $this->photoSecondary = $photoSecondary;

        return $this;
    }
}
