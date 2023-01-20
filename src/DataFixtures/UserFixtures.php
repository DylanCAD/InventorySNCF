<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $userPassword;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher){
        $this->userPassword=$userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");

            $user=new User();
            $user   ->setNom($faker->lastName())
                    ->setPrenom($faker->firstName())
                    ->setUuid($faker->uuid())
                    ->setPassword( $this->userPassword->hashPassword(
                        $user,
                        "SNCFutilisateur1234"
                    ))
                    ;
            $manager->persist($user);
        
        $admin=new User();
        $admin  ->setNom("admin")
                ->setPrenom("DKA")
                ->setUuid("admin1234")
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword( $this->userPassword->hashPassword(
                    $admin,
                    "SNCFadministrateur1234"
                ))
                ;
        $manager->persist($admin);
        $manager->flush();
    }
}
