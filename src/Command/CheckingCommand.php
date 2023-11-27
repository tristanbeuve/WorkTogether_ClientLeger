<?php
//
//namespace App\Command;
//
//use App\Entity\Reservation;
//use App\Entity\Unite;
//use Doctrine\ORM\EntityManager;
//use Symfony\Component\Console\Attribute\AsCommand;
//use Symfony\Component\Console\Command\Command;
//use Symfony\Component\Console\Input\InputArgument;
//use Symfony\Component\Console\Input\InputInterface;
//use Symfony\Component\Console\Input\InputOption;
//use Symfony\Component\Console\Output\OutputInterface;
//use Symfony\Component\Console\Style\SymfonyStyle;
//
//#[AsCommand(
//    name: 'checking',
//    description: 'Add a short description for your command',
//)]
//class CheckingCommand extends Command
//{
//    public function __construct(EntityManager $entityManager)
//    {
//        $this->entityManager = $entityManager;
//        parent::__construct();
//    }
//
//    protected function configure(): void
//    {
//        $this
//            ->setName('app:checking')
//            ->setDescription('Check la disponibilité des Unités');
//    }
//
//    protected function execute(InputInterface $input, OutputInterface $output)
//    {
//        $unites = $this->em->getRepository(Unite::class)->findAll();
//
//        foreach ($unites as $unite){
//            $ReservationUnite = $this->em->getRepository(Reservation::class)->findOneBy(['id'=>$unite->getIdentifiantReservation()]);
//            if ($ReservationUnite != null){
//                if ($ReservationUnite->getDateEnd() <= new \DateTime('now') && $ReservationUnite->IsDelaie() == 0){
//                    if($ReservationUnite->isRenAuto()){
//                        $renouvellement = $ReservationUnite->getRenouvellement()->getNom();
//                        if ($renouvellement) {
//                            $duration = new \DateInterval("P1M");
//                        }
//                        if ($renouvellement) {
//                            $duration = new \DateInterval("P1Y");
//                        }
//                        $ReservationUnite->setDateEndForm($duration);
//                        $this->em->flush();
//                    }
//                    else{
//                        //envoie un mail
//                        //ajouter deux semaines de delais pour renouveller manuellement
//                        $delaie = new \DateInterval("P2W");
//                        $ReservationUnite->setDateEndForm($delaie);
//                        $ReservationUnite->setDelaie(1);
//                        $this->em->flush();
//                    }
//                }
//                else{
//                    if ($ReservationUnite->getDateEnd() <= new \DateTime('now') && $ReservationUnite->IsDelaie()){
//                        //envoie de mail
//                        $statut = 0;
//                    $this->em->remove($unite);
//                    $this->em->flush();
//                    }
//                }
//            }
//        }
//        $unite->setStatus($statut);
//        $this->em->flush();
//        $output->writeln('Checking effectué avec succès');
//
//        return Command::SUCCESS;
//    }
//}
