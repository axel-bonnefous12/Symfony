<?php

namespace App\DataFixtures;

use App\Entity\Rooms;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoomsFixtures extends Fixture
{
    public const ROOM_1 = 'room1';
    public const ROOM_2 = 'room2';

    public function load(ObjectManager $manager): void
    {
        $room1 = new Rooms();
        $room1->setName('Big place concert')
                ->setCapacity(550)
                ->setAddress('Place de la comédie');
        $manager->persist($room1);

        $room2 = new Rooms();
        $room2->setName('Little place concert')
            ->setCapacity(80)
            ->setAddress('Place de Gare Saint Roch');
        $manager->persist($room2);


        /*
        * La méthode flush sauvegarde toutes les entités marquées pour la sauvegarde avec persist.
        * C’est lors du flush que les requêtes SQL sont lancées.
        */
        $manager->flush();

        $this->addReference(self::ROOM_1, $room1);
        $this->addReference(self::ROOM_2, $room2);
    }
}
