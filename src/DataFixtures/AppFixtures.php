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
        $abonnement3->setNbrEmplacement(50);
        $abonnement3->setReduction(20); // 20% de réduction
        $abonnement3->setImgPath("Entreprise.webp");
        $abonnement3->setDescription("Un abonnement idéal pour les grandes entreprises avec des besoins de haute performance et un stockage de données intensif.");
        $manager->persist($abonnement3);

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


        // Créez des données de test pour la table "client"
        $client1 = new User();
//        $client1->setUsername('admin');
        $client1->setEmail('admin@admin.com');
//        $client1->setName('Nom1');
//        $client1->setFirstname('Prénom1');
        $client1->setPassword('123456');
        $client1->setRoles(['ROLE_ADMIN']);
//

        $client2 = new User();
//        $client2->setUsername('client');
        $client2->setEmail('client@client.com');
//        $client2->setName('Nom2');
//        $client2->setFirstname('Prénom2');
        $client2->setPassword('123456');
        $client2->setRoles(['ROLE_USER']);
//

        // Persistez les objets dans la base de données
        $manager->persist($client1);
        $manager->persist($client2);

        // Flush pour enregistrer les objets
        $manager->flush();


        // Créez des données de test pour la table "reservation"
        $reservation1 = new Reservation();
        $reservation1->setDateDeb(new \DateTime('2023-10-15'));
        $reservation1->setDateEnd(new \DateTime('2023-10-20'));
        $reservation1->setRenAuto(0);
        $reservation1->setQuantity(5);
        $reservation1->setCustomer($manager->getRepository(User::class)->findOneBy(['email'=>"client@client.com"]));
        $reservation1->setUniteId($manager->getRepository(Unite::class)->findOneBy(['status' => 1]));
        $reservation1->setRenouvellement($manager->getRepository(Renouvellement::class)->findOneBy(['nom' => 'Mois']));
        $reservation1->setIdentifiantAbonnement($manager->getRepository(Abonnement::class)->findOneBy(['prix' => 199]));

        $reservation2 = new Reservation();
        $reservation2->setDateDeb(new \DateTime('2023-11-01'));
        $reservation2->setDateEnd(new \DateTime('2023-11-10'));
        $reservation2->setRenAuto(1);
        $reservation2->setQuantity(1);
        $reservation2->setCustomer($manager->getRepository(User::class)->findOneBy(['email'=>"client@client.com"]));
        $reservation2->setUniteId($manager->getRepository(Unite::class)->findOneBy(['status' => 0]));
        $reservation2->setRenouvellement($manager->getRepository(Renouvellement::class)->findOneBy(['nom' => 'Mois']));
        $reservation2->setIdentifiantAbonnement($manager->getRepository(Abonnement::class)->findOneBy(['prix' => 99]));

        $reservation3 = new Reservation();
        $reservation3->setDateDeb(new \DateTime('2023-12-01'));
        $reservation3->setDateEnd(new \DateTime('2023-12-15'));
        $reservation3->setRenAuto(0);
        $reservation3->setQuantity(20);
        $reservation3->setCustomer($manager->getRepository(User::class)->findOneBy(['email'=>"client@client.com"]));
        $reservation3->setUniteId($manager->getRepository(Unite::class)->findOneBy(['status' => 0]));
        $reservation3->setRenouvellement($manager->getRepository(Renouvellement::class)->findOneBy(['nom' => 'An']));
        $reservation3->setIdentifiantAbonnement($manager->getRepository(Abonnement::class)->findOneBy(['prix' => 49]));

        // Persistez les objets dans la base de données
        $manager->persist($reservation1);
        $manager->persist($reservation2);
        $manager->persist($reservation3);

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
        $unite1->setIdentifiantBaie($manager->getRepository(Baie::class)->findOneBy(['status' => 0]));

        $unite2 = new Unite();
        $unite2->setNumero(002);
        $unite2->setStatus(false);
        $unite2->setIdentifiantReservation($manager->getRepository(Reservation::class)->findOneBy(['id' => 6]));
        $unite2->setIdentifiantTypeUnite($manager->getRepository(TypeUnite::class)->findOneBy(['id' => 6]));
        $unite2->setIdentifiantBaie($manager->getRepository(Baie::class)->findOneBy(['status' => 1]));

        // Persistez les objets dans la base de données
        $manager->persist($unite1);
        $manager->persist($unite2);

        // Flush pour enregistrer les objets
        $manager->flush();

    }
}
