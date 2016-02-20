<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Gallery\Gallery;

/**
 * Initializes Gallery information
 */
class LoadGalleryData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $galleries = [
            [
                'en' => 'CONCERT',
                'fr' => 'CONCERT'
            ], [
                'en' => 'FILM PHOTOGRAPHY',
                'fr' => 'FILM PHOTOGRAPHIE'
            ], [
                'en' => 'HOSPITAL',
                'fr' => 'HÔPITAL'
            ], [
                'en' => 'INDUSTRIAL',
                'fr' => 'INDUSTRIEL'
            ], [
                'en' => 'NATURE MORTE',
                'fr' => 'NATURE MORTE'
            ], [
                'en' => 'PERSONALITY',
                'fr' => 'PERSONNEL'
            ], [
                'en' => 'TOTALITARIAN',
                'fr' => 'TOTALITAIRE'
            ], [
                'en' => 'TRAVEL',
                'fr' => 'VOYAGE'
            ]
        ];

        // Get translator
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        foreach ($galleries as $gallery) {
            $entity = new Gallery();

            $entity->setName($gallery['en']);

            $repository->translate($entity, 'name', 'fr', $gallery['fr']);

            $manager->persist($entity);
        }

        $manager->flush();
    }
}