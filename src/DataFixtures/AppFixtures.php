<?php

namespace App\DataFixtures;

use App\Entity\Abonnement;
use App\Entity\Admin;
use App\Entity\Baie;
use App\Entity\Client;

//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Renouvellement;
use App\Entity\Reservation;
use App\Entity\TypeUnite;
use App\Entity\Unite;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use PharIo\Manifest\Email;
use phpDocumentor\Reflection\PseudoTypes\List_;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use function Sodium\add;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $renouvellement1 = new Renouvellement();
        $renouvellement1->setNom('Mois');
        $renouvellement2 = new Renouvellement();
        $renouvellement2->setNom('An');
        $manager->persist($renouvellement1);
        $manager->persist($renouvellement2);
        $manager->flush();


        $abonnement1 = new Abonnement();
        $abonnement1->setNom('Abonnement Standard');
        $abonnement1->setPrix(49.99);
        $abonnement1->setNbrEmplacement(10);
        $abonnement1->setReduction(0.0);
        $abonnement1->setImgPath("Standard.webp");
        $abonnement1->setDescription("Un abonnement adapté aux petites entreprises, idéal pour le stockage de données de base et la gestion de projets personnels.");
        $manager->persist($abonnement1);

        $abonnement2 = new Abonnement();
        $abonnement2->setNom('Abonnement Premium');
        $abonnement2->setPrix(99.99);
        $abonnement2->setNbrEmplacement(20);
        $abonnement2->setReduction(10); // 10% de réduction
        $abonnement2->setImgPath("Premium.webp");
        $abonnement2->setDescription("Un abonnement idéal pour les entreprises de taille moyenne, offrant un stockage de données avancé et favorisant la collaboration au sein des équipes.");
        $manager->persist($abonnement2);

        $abonnement3 = new Abonnement();
        $abonnement3->setNom('Abonnement Entreprise');
        $abonnement3->setPrix(199.99);
        $abonnement3->setNbrEmplacement(40);
        $abonnement3->setReduction(20); // 20% de réduction
        $abonnement3->setImgPath("Entreprise.webp");
        $abonnement3->setDescription("Un abonnement idéal pour les grandes entreprises avec des besoins de haute performance et un stockage de données intensif.");
        $manager->persist($abonnement3);

        // Flush pour enregistrer les objets
        $manager->flush();

        //Créer un Utilisateur ADMIN
        $admin = new User();
        $admin->setPassword($this->hasher->hashPassword($admin, "vv83Bd^Jo!!6h^m%Lbn5"));
        $admin->setEmail("admin@admin.com");
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setNom("Beuve");
        $admin->setPrenom("Tristan");
        $manager->persist($admin);
        $manager->flush();

        //Créer des utilisateurs qui n'ont pas de reservation
        for ($h = 1; $h <= 4; $h++) {
            $client = new User();
            $client->setNom($faker->lastName);
            $client->setPrenom($faker->firstName);
            $client->setEmail($faker->email);
            $client->setRoles(['ROLE_CUSTOMER']);
            $client->setPassword($this->hasher->hashPassword($client, '123456789'));
            $manager->persist($client);
        }
        $manager->flush();
        $reservationCount = 0;

        // Créez des utilisateurs qui ont réserver 1 abonnement
        for ($i = 1; $i <= 10; $i++) {
            $client = new User();
            $client->setNom($faker->lastName);
            $client->setPrenom($faker->firstName);
            $client->setEmail($faker->email);
            $client->setRoles(['ROLE_CUSTOMER']);
            $client->setPassword($this->hasher->hashPassword($client, '123456789'));
            $manager->persist($client);

            $manager->flush();

            $reservation = new Reservation();
            $reservation->setDateDeb();
            $var = $faker->boolean();
            if ($var == 1) {
                $duration = new \DateInterval('P1M');
            } else {
                $duration = new \DateInterval('P1Y');
            }
            $reservation->setDateEndForm($duration);
            $randomField = $faker->randomElement(['Mois', 'An']);
            $reservation->setRenouvellement($manager->getRepository(Renouvellement::class)->findOneBy(['nom' => $randomField]));
            $reservation->setRenAuto($faker->boolean);
            $reservation->setDelaie(False);
            $reservation->setQuantity(1);
            $user = $manager->getRepository(User::class)->findOneBy(['id' => $h + $i ]);
            $reservation->setCustomer($user);
            $randomField = $faker->randomElement([49, 99, 199]);
            $reservation->setIdentifiantAbonnement($manager->getRepository(Abonnement::class)->findOneBy(['prix' => $randomField]));
            $reservation->setNumero(strtoupper(substr($client->getNom(), 0, 3)) . 'ABO' . count($client->getReservations()) + 1);

            $manager->persist($reservation);
            $reservationCount++;
        }
        $manager->flush();

        //Créer des utilisateurs qui ont plusieurs abonnements
        for ($j = 1; $j <= 5; $j++) {
            $client = new User();
            $client->setNom($faker->lastName);
            $client->setPrenom($faker->firstName);
            $client->setEmail($faker->email);
            $client->setRoles(['ROLE_CUSTOMER']);
            $client->setPassword($this->hasher->hashPassword($client, '123456789'));
            $manager->persist($client);
            $manager->flush();

            for ($k = 0; $k <= 1; $k++) {
                $reservation = new Reservation();
                $reservation->setDateDeb();
                $var = $faker->boolean();
                if ($var == 1) {
                    $duration = new \DateInterval('P1M');
                } else {
                    $duration = new \DateInterval('P1Y');
                }
                $reservation->setDateEndForm($duration);
                $randomField = $faker->randomElement(['Mois', 'An']);
                $reservation->setRenouvellement($manager->getRepository(Renouvellement::class)->findOneBy(['nom' => $randomField]));
                $reservation->setRenAuto($faker->boolean);
                $reservation->setDelaie(False);
                $reservation->setQuantity(1);
                $user = $manager->getRepository(User::class)->findOneBy(['id' => $h + $i + $j -1]);
                $reservation->setCustomer($user);
                $randomField = $faker->randomElement([49, 99, 199]);
                $reservation->setIdentifiantAbonnement($manager->getRepository(Abonnement::class)->findOneBy(['prix' => $randomField]));
                $reservation->setNumero(strtoupper(substr($client->getNom(), 0, 3)) . 'ABO' . count($client->getReservations()) + $k + 1);

                $manager->persist($reservation);
                $reservationCount++;
                $manager->flush();
            }

        }


        // Créez des données de test pour la table "typeunite"
        for ($i = 1; $i <= 5; $i++) {
            $typeUnite = new TypeUnite();
            $typeUnite->setNom('Type d\'Unité ' . $i);

            $manager->persist($typeUnite);
            $manager->flush();
        }



        //Créer des Baies avec des unités reservées
        for ($j = 1; $j <= 2; $j++) {
            $baie = new Baie();
            $baie->setNumero("B".sprintf("%03d", $j));
            $baie->setNbrEmplacement(42); // Valeurs aléatoires pour le nombre d'emplacements
            $baie->setStatus(1);

            $manager->persist($baie);
            $manager->flush();


            // Créez des données de test pour la table "unite"
            for ($k = 1; $k <= 42; $k++) {
                $unite = new Unite();
                $unite->setNumero($j . "-" . $k);
                $Resa = $manager->getRepository(Reservation::class)->findOneBy(['id' => $faker->numberBetween(1, $reservationCount)]);
                $unite->setIdentifiantReservation($Resa);
                $unite->setStatus(1);

                $unite->setIdentifiantTypeUnite($manager->getRepository(TypeUnite::class)->findOneBy(['id' => $faker->numberBetween(1, $i - 1)]));
                $unite->setIdentifiantBaie($manager->getRepository(Baie::class)->findOneBy(['id'=>$j]));
                $manager->persist($unite);
                $manager->flush();
            }

        }

        //Créer des baies avec des unitées non-reservées
        for ($l = 1; $l <= 2; $l++) {
            $baie = new Baie();
            $baie->setNumero("B".sprintf("%03d", $j+$l-1));
            $baie->setNbrEmplacement(42); // Valeurs aléatoires pour le nombre d'emplacements
            $baie->setStatus(0);

            $manager->persist($baie);
            $manager->flush();


            // Créez des données de test pour la table "unite"
            for ($k = 1; $k <= 42; $k++) {
                $unite = new Unite();
                $unite->setNumero($l+$j-1 . "-" . $k);
                $unite->setIdentifiantReservation($manager->getRepository(Reservation::class)->findOneBy(['id' => $faker->numberBetween(1, $reservationCount)]));
                $unite->setStatus(0);

                $unite->setIdentifiantTypeUnite($manager->getRepository(TypeUnite::class)->findOneBy(['id' => $faker->numberBetween(1, $i - 1)]));
                $unite->setIdentifiantBaie($manager->getRepository(Baie::class)->findOneBy(['id'=>$l+$j-1]));
                $manager->persist($unite);
                $manager->flush();
            }
        }
    }
}
