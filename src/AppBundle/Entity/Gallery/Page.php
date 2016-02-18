<?php

namespace AppBundle\Entity\Gallery;

use Doctrine\ORM\Mapping as ORM;

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
}