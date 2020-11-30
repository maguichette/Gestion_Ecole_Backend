<?php

namespace App\Entity;

use Faker\Factory;
use App\Entity\Apprenant;
use Doctrine\ORM\Mapping as ORM;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\ProfilFixtures;
use App\Repository\ApprenantRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 */
