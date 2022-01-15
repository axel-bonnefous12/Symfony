<?php

namespace App\DataFixtures;

use App\Entity\Bands;
use App\Entity\Concerts;
use App\Entity\Organisations;
use App\Entity\Rooms;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $concert1 = new Concerts();
        $concert1->setBegin(\DateTime::createFromFormat("d/m/Y", '26/02/2022'))
                ->setEnd(\DateTime::createFromFormat("d/m/Y", '01/03/2022'))
                ->setRoom($this->getReference(RoomsFixtures::ROOM_1))
                ->setOrganisation($this->getReference(OrganisationsFixtures::ORGANISATION_1))
                ->setBand($this->getReference(BandsFixtures::BAND_1));
        $manager->persist($concert1);

        $concert2 = new Concerts();
        $concert2->setBegin(\DateTime::createFromFormat("d/m/Y", '02/02/2022'))
            ->setEnd(\DateTime::createFromFormat("d/m/Y", '05/02/2022'))
            ->setRoom($this->getReference(RoomsFixtures::ROOM_2))
            ->setOrganisation($this->getReference(OrganisationsFixtures::ORGANISATION_1))
            ->setBand($this->getReference(BandsFixtures::BAND_2));
        $manager->persist($concert2);

        /*
        * La méthode flush sauvegarde toutes les entités marquées pour la sauvegarde avec persist.
        * C’est lors du flush que les requêtes SQL sont lancées.
        */
        $manager->flush();

    }
        public function getDependencies()
        {
            return array(
                RoomsFixtures::class,
                OrganisationsFixtures::class,
                BandsFixtures::class,
            );
        }

}
