<?php

namespace AppBundle\Repository;

use AppBundle\Entity\About;
use Doctrine\ORM\EntityRepository;

class AboutRepository extends EntityRepository
{
    /**
     * Get Record
     * About consist on an Unique record, so we don't need any parameters to retrieve it
     */
    public function findOne()
    {
        $result = null;

        $entities = $this->findAll();
        if (!empty($entities) && !empty($entities[0])) {
            $result = $entities[0];
        }

        return $result ?: new About();
    }
}