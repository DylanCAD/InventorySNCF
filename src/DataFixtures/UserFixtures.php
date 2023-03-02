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
            $user   ->setNom("Nyankam")
                    ->setPrenom("Noé")
                    ->setUuid("0400777C")
                    ->setRoles(['ROLE_UTILISATEUR'])
                    ->setPassword( $this->userPassword->hashPassword(
                        $user,
                        "1234"
                    ))
                    ;
            $manager->persist($user);

            $user=new User();
            $user   ->setNom("Schattel")
                    ->setPrenom("Jérôme")
                    ->setUuid("7903868L")
                    ->setRoles(['ROLE_UTILISATEUR'])
                    ->setPassword( $this->userPassword->hashPassword(
                        $user,
                        "1234"
                    ))
                    ;
            $manager->persist($user);

            $user=new User();
            $user   ->setNom("Dai")
                    ->setPrenom("Johann")
                    ->setUuid("9508900L")
                    ->setRoles(['ROLE_UTILISATEUR'])
                    ->setPassword( $this->userPassword->hashPassword(
                        $user,
                        "1234"
                    ))
                    ;
            $manager->persist($user);

            $user=new User();
            $user   ->setNom("Nzau")
                    ->setPrenom("Josual")
                    ->setUuid("9508707B")
                    ->setRoles(['ROLE_UTILISATEUR'])
                    ->setPassword( $this->userPassword->hashPassword(
                        $user,
                        "1234"
                    ))
                    ;
            $manager->persist($user);
        
        $admin=new User();
        $admin  ->setNom("Ravary")
                ->setPrenom("William")
                ->setUuid("7109649E")
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword( $this->userPassword->hashPassword(
                    $admin,
                    "0000"
                ))
                ;
        $manager->persist($admin);
        $manager->flush();
    }
}
