<?php

namespace App\DataFixtures;

use App\Entity\Abonnement;
use App\Entity\Admin;
use App\Entity\Baie;
use App\Entity\Client;
use App\Entity\Facturation;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Reservation;
use App\Entity\TypeUnite;
use App\Entity\Unite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
//    private UserPasswordEncoderInterface $passwordEncoder;
//
//    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
//    {
//        $this->passwordEncoder = $passwordEncoder;
//    }
    public function load(ObjectManager $manager): void
    {
        // Créez des données de test pour la table "abonnement"
        $abonnement1 = new Abonnement();
        $abonnement1->setNom('Abonnement Standard');
        $abonnement1->setPrix(50.00);
        $abonnement1->setRenAuto(true);

        $abonnement2 = new Abonnement();
        $abonnement2->setNom('Abonnement Premium');
        $abonnement2->setPrix(100.00);
        $abonnement2->setRenAuto(false);

        // Persistez les objets dans la base de données
        $manager->persist($abonnement1);
        $manager->persist($abonnement2);

        // Flush pour enregistrer les objets
        $manager->flush();


        $baie1 = new Baie();
        $baie1->setNbrEmplacement(10);
        $baie1->setStatus(true);

        $baie2 = new Baie();
        $baie2->setNbrEmplacement(20);
        $baie2->setStatus(false);

        // Persistez les objets dans la base de données
        $manager->persist($baie1);
        $manager->persist($baie2);

        // Flush pour enregistrer les objets
        $manager->flush();

        // Créez des données de test pour la table "admin"
        $admin1 = new Admin();
        $admin1->setUsername('admin1');
        $admin1->setPassword( 'motdepasse1');

        $admin2 = new Admin();
        $admin2->setUsername('admin2');
        $admin2->setPassword('motdepasse2');

        // Persistez les objets dans la base de données
        $manager->persist($admin1);
        $manager->persist($admin2);

        // Flush pour enregistrer les objets
        $manager->flush();

        // Créez des données de test pour la table "client"
        $client1 = new Client();
        $client1->setUsername('client1');
        $client1->setEmail('client1@example.com');
        $client1->setName('Nom1');
        $client1->setPrenom('Prénom1');
        $client1->setPassword('motdepasse1');

        $client2 = new Client();
        $client2->setUsername('client2');
        $client2->setEmail('client2@example.com');
        $client2->setName('Nom2');
        $client2->setPrenom('Prénom2');
        $client2->setPassword('motdepasse2');

        // Persistez les objets dans la base de données
        $manager->persist($client1);
        $manager->persist($client2);

        // Flush pour enregistrer les objets
        $manager->flush();

        // Créez des données de test pour la table "facturation"
        $facturation1 = new Facturation();
        $facturation1->setDateDeb(new \DateTime('2023-10-01'));
        $facturation1->setDateEnd(new \DateTime('2023-10-31'));
        $facturation1->setPrix(1500);
        $facturation1->setIdentifiantReservation($manager->getRepository(Reservation::class)->findOneBy(['id' => 5]));

        $facturation2 = new Facturation();
        $facturation2->setDateDeb(new \DateTime('2023-11-01'));
        $facturation2->setDateEnd(new \DateTime('2023-11-30'));
        $facturation2->setPrix(2000);
        $facturation2->setIdentifiantReservation($manager->getRepository(Reservation::class)->findOneBy(['id' => 6]));

        // Persistez les objets dans la base de données
        $manager->persist($facturation1);
        $manager->persist($facturation2);

        // Flush pour enregistrer les objets
        $manager->flush();

        // Créez des données de test pour la table "reservation"
        $reservation1 = new Reservation();
        $reservation1->setNumero(001);
        $reservation1->setDateDeb(new \DateTime('2023-10-15'));
        $reservation1->setDateEnd(new \DateTime('2023-10-20'));
        $reservation1->setIdentifiantAbonnement($manager->getRepository(Abonnement::class)->findOneBy(['id' => 5]));

        $reservation2 = new Reservation();
        $reservation2->setNumero(002);
        $reservation2->setDateDeb(new \DateTime('2023-11-01'));
        $reservation2->setDateEnd(new \DateTime('2023-11-10'));
        $reservation2->setIdentifiantAbonnement($manager->getRepository(Abonnement::class)->findOneBy(['id' => 6]));

        // Persistez les objets dans la base de données
        $manager->persist($reservation1);
        $manager->persist($reservation2);

        // Flush pour enregistrer les objets
        $manager->flush();

        // Créez des données de test pour la table "typeunite"
        $typeUnite1 = new TypeUnite();
        $typeUnite1->setNom('Type d\'Unité 1');

        $typeUnite2 = new TypeUnite();
        $typeUnite2->setNom('Type d\'Unité 2');

        // Persistez les objets dans la base de données
        $manager->persist($typeUnite1);
        $manager->persist($typeUnite2);

        // Flush pour enregistrer les objets
        $manager->flush();

        // Créez des données de test pour la table "unite"
        $unite1 = new Unite();
        $unite1->setNumero(001);
        $unite1->setStatus(true);
        $unite1->setIdentifiantReservation($manager->getRepository(Reservation::class)->findOneBy(['id' => 5]));
        $unite1->setIdentifiantTypeUnite($manager->getRepository(TypeUnite::class)->findOneBy(['id' => 5]));
        $unite1->setIdentifiantBaie($manager->getRepository(Baie::class)->findOneBy(['id' => 5]));

        $unite2 = new Unite();
        $unite2->setNumero(002);
        $unite2->setStatus(false);
        $unite2->setIdentifiantReservation($manager->getRepository(Reservation::class)->findOneBy(['id' => 6]));
        $unite2->setIdentifiantTypeUnite($manager->getRepository(TypeUnite::class)->findOneBy(['id' => 6]));
        $unite2->setIdentifiantBaie($manager->getRepository(Baie::class)->findOneBy(['id' => 6]));

        // Persistez les objets dans la base de données
        $manager->persist($unite1);
        $manager->persist($unite2);

        // Flush pour enregistrer les objets
        $manager->flush();

    }
}
