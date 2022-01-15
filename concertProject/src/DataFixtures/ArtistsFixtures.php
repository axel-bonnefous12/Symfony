<?php

namespace App\DataFixtures;

use App\Entity\Artists;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistsFixtures extends Fixture
{
    public const ARTIST_1 = 'artist1';
    public const ARTIST_2 = 'artist2';
    public const ARTIST_3 = 'artist3';
    public const ARTIST_4 = 'artist4';
    public const ARTIST_5 = 'artist5';

    public function load(ObjectManager $manager): void
    {
        $artist1 = new Artists();
        $artist1->setName('Springsteen')
                ->setFirstName('Bruce');
        $manager->persist($artist1);

        $artist2 = new Artists();
        $artist2->setName('Lennon')
            ->setFirstName('John');
        $manager->persist($artist2);

        $artist3 = new Artists();
        $artist3->setName('McCartney')
            ->setFirstName('Paul');
        $manager->persist($artist3);

        $artist4 = new Artists();
        $artist4->setName('Harrison')
            ->setFirstName('George');
        $manager->persist($artist4);

        $artist5 = new Artists();
        $artist5->setName('Starr')
            ->setFirstName('Ringo');
        $manager->persist($artist5);



        /*
        * La méthode flush sauvegarde toutes les entités marquées pour la sauvegarde avec persist.
        * C’est lors du flush que les requêtes SQL sont lancées.
        */
        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference(self::ARTIST_1, $artist1);
        $this->addReference(self::ARTIST_2, $artist2);
        $this->addReference(self::ARTIST_3, $artist3);
        $this->addReference(self::ARTIST_4, $artist4);
        $this->addReference(self::ARTIST_5, $artist5);


    }
}
