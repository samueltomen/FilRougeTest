<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Projets;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 6; $i++) {
            # code...
            $projet = new Projets();
            $projet
                ->setTitle($this->faker->sentence(5))
                ->setDescription($this->faker->text(200))
                ->setImage($this->faker->imageUrl(640,480,'children', true));
            $manager->persist($projet);
        }

        $manager->flush();
    }
}
