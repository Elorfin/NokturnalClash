<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\About;

/**
 * Initializes About information
 */
class LoadAboutData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $entity = new About();

        $entity->setEmail('contact@nokturnalclash.fr');
        $entity->setFacebook('https://www.facebook.com/pages/Nokturnal-Clash/1584187778470745');
        $entity->setInstagram('https://instagram.com/nokturnalclash/');
        $entity->setFlickr('https://www.flickr.com/photos/nokturnalclash/');
        $entity->setLiveJournal('http://nokturnalclash.livejournal.com/');

        // Get presentation from HTML file
        $presentationPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

        // Set up translated text for default locale (en)
        $entity->setPresentation(file_get_contents($presentationPath . 'presentation-en.html'));

        // Add translation for fr locale
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        $repository->translate($entity, 'presentation', 'fr', file_get_contents($presentationPath . 'presentation-fr.html'));

        $manager->persist($entity);
        $manager->flush();
    }
}