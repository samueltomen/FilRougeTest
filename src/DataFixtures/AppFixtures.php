<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Mark;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Contact;
use App\Entity\Projets;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
        // $number = 0;
        // $projets = [];
        // for ($i = 1; $i <= 6; $i++) {
        //     $number++;
        //     $projet = new Projets();
        //     $projet
        //         ->setTitle($this->faker->sentence(8))
        //         ->setDescription($this->faker->text(500));
        //     // ->setImageFile('./assets/img/image_card_' . $number . 'r.png');

        //     $projets[] = $projet;
        //     $manager->persist($projet);
        // }

        //USERS

        // $users = [];
        // for ($i = 0; $i < 5; $i++) {
        //     $user = new User();
        //     $user
        //         ->setFirstName($this->faker->firstName())
        //         ->setLastName($this->faker->lastName())
        //         ->setPseudo(
        //             mt_rand(0, 1) === 1 ? $this->faker->firstName() : null
        //         )
        //         ->setEmail($this->faker->email())
        //         ->setRoles(['ROLE_USER'])
        //         ->setPlainPassword('password');
        //     $users[] = $user;
        //     $manager->persist($user);
        // }

        //Mark
        // foreach ($projets as $projet) {
        //     for ($i = 0; $i < mt_rand(0, 4); $i++) {
        //         $mark = new Mark();
        //         $mark
        //             ->setMark(mt_rand(1, 5))
        //             ->setUser($users[mt_rand(0, count($users) - 1)])
        //             ->setProjet($projet);

        //         $manager->persist($mark);
        //     }
        // }

        // Formulaire de contact

        // for ($i=0; $i < 5 ; $i++) {
        //     $contact = new Contact();
        //     $contact->setFirstName($this->faker->name())
        //     ->setLastName($this->faker->name())
        //         ->setEmail($this->faker->email())
        //         ->setSubject('Demande n°'.($i + 1))
        //         ->setMessage($this->faker->text());

        //         $manager->persist($contact);
        // }

        // $manager->flush();
    }
}
