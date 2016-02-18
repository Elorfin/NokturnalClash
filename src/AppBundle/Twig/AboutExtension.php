<?php

namespace AppBundle\Twig;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Provides access to the About data
 */
class AboutExtension extends \Twig_Extension
{
    /**
     * Object Manager
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $om;

    /**
     * About Entity
     * @var \AppBundle\Entity\About
     */
    protected $about;

    /**
     * Class constructor
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function getName()
    {
        return 'about_extension';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_about',   array($this, 'getAbout')),
        );
    }

    public function getAbout()
    {
        if (empty($this->about)) {
            // Load About Entity if it's not already done
            $this->about = $this->om->getRepository('AppBundle:About')->findOne();
        }

        return $this->about;
    }
}
