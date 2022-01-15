<?php

namespace App\DataFixtures;

use App\Entity\Organisations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganisationsFixtures extends Fixture
{
    public const ORGANISATION_1 = 'organisation1';

    public function load(ObjectManager $manager): void
    {
        $organisation1 = new Organisations();
        $organisation1->setName('Berthomieu')
                    ->setFirstName('Rose');

        /* La méthode persist indique à Doctrine que l’entité devra être sauvegardée. */
        $manager->persist($organisation1);



        /*
        * La méthode flush sauvegarde toutes les entités marquées pour la sauvegarde avec persist.
        * C’est lors du flush que les requêtes SQL sont lancées.
        */
        $manager->flush();

        $this->addReference(self::ORGANISATION_1, $organisation1);
    }
}
