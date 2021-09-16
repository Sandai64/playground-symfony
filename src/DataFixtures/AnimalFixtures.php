<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnimalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /* 
            Here we'll have the methods needed to insert data into the database/table
        */

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 256; $i++)
        {
            $animal = new Animal();
            $animal->setName($faker->word());
            $animal->setDescription($faker->sentence());
            $animal->setDangerous($faker->boolean(10));
            $animal->setImage($faker->imageUrl(640, 480, 'animals', true));
            $animal->setWeight($faker->numberBetween(8, 96));
            $animal->setUuid($faker->uuid());
            $animal->setFood($faker->randomElement(['Carnivorous', 'Herbivorous', 'Omnivorous']));
            $animal->setHeight($faker->randomFloat(2, 0.2, 1.4));
            $animal->setProtected($faker->boolean(5));

            $family_ref = 'family_' . $faker->numberBetween(1, 5);
            $animal->setFamily($this->getReference($family_ref));
            
            // Set it so that Doctrine persists the generated object

            $manager->persist($animal);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies() : array
    {
        /**
         * Sets up a dependency between this fixture and Family.
         * So that we can use FamilyFixtures before Animals.
         */
        return [FamilyFixtures::class];
    }
}
