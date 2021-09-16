<?php

namespace App\DataFixtures;

use App\Entity\Family;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FamilyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 5; $i++)
        {
            $family = new Family();
            $family->setName($faker->word());
            $family->setSlug(strtolower($faker->word()));
            $family->setDescription($faker->sentence());
            $family->setUuid($faker->uuid());
            
            $this->addReference('family_'.$i, $family);

            $manager->persist($family);
        }

        $manager->flush();
    }
}
