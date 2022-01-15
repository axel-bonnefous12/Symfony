<?php

namespace App\DataFixtures;

use App\Entity\Artists;
use App\Entity\Bands;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BandsFixtures extends Fixture
{
    public const BAND_1 = 'band1';
    public const BAND_2 = 'band2';

    public function load(ObjectManager $manager): void
    {
        $band1 = new Bands();
        $band1->setName('E Street Band')
            ->setPicture('../src/img/e_street_band.jpg')
            ->setKind('Rock')
            ->setYearCreation(1972)
            ->addArtist($this->getReference(ArtistsFixtures::ARTIST_1));

        $manager->persist($band1);

        $band2 = new Bands();
        $band2->setName('The Beatles')
            ->setPicture('../src/img/the_beatles.jpg')
            ->setKind('Rock')
            ->setYearCreation(1964)
            ->addArtist($this->getReference(ArtistsFixtures::ARTIST_2))
            ->addArtist($this->getReference(ArtistsFixtures::ARTIST_3))
            ->addArtist($this->getReference(ArtistsFixtures::ARTIST_4))
            ->addArtist($this->getReference(ArtistsFixtures::ARTIST_5));

        $manager->persist($band2);



        /*
        * La méthode flush sauvegarde toutes les entités marquées pour la sauvegarde avec persist.
        * C’est lors du flush que les requêtes SQL sont lancées.
        */
        $manager->flush();

        $this->addReference(self::BAND_1, $band1);
        $this->addReference(self::BAND_2, $band2);
    }
}
