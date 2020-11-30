<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Admin;
use App\DataFixtures\ProfilFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures  extends Fixture implements DependentFixtureInterface
{
    // private $encoder;
    // public function __construct(UserPasswordEncoderInterface $encoder)
    // {
    //     $this->encoder = $encoder;
    // }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $admin=new Admin();
        $admin->setEmail($faker->email());
        $admin->setPrenom($faker->firstName());
        $admin->setNom($faker->lastName);
        $aApp->setTelephone($faker->PhoneNumber);
        $a->setAdresse($faker->city);
        $admin->setArchive(0);
        $admin->setPRofil($this->getReference(ProfilFixtures::ADMIN_REFERENCE));
        $admin->setPassword(122);
        $manager->persist($admin);

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
