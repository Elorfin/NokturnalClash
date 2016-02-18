<?php

namespace AppBundle\Entity\Blog;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * About
 *
 * @ORM\Table(name="blog_post")
 * @ORM\Entity()
 */
class Post
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
     * Content text
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     * @Gedmo\Translatable
     */
    protected $content;

    /**
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     *
     * @Gedmo\Locale
     */
    protected $locale;

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
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}

