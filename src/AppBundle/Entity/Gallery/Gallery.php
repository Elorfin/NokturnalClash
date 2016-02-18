<?php

namespace AppBundle\Entity\Gallery;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Gallery
 *
 * @ORM\Table(name="gallery")
 * @ORM\Entity
 */
class Gallery
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Gallery\Gallery", mappedBy="gallery", orphanRemoval=true)
     */
    protected $pages;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Pages
     * @return ArrayCollection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Add a Page to the Gallery
     * @param Page $page
     * @return $this
     */
    public function addPage(Page $page)
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);

            $page->setGallery($this);
        }

        return $this;
    }

    /**
     * Remove a Page from the Gallery
     * @param Page $page
     * @return $this
     */
    public function removePage(Page $page)
    {
        if ($this->pages->contains($page)) {
            $this->pages->removeElement($page);

            $page->setGallery(null);
        }

        return $this;
    }
}