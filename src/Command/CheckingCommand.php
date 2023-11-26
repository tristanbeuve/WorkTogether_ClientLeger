<?php

namespace App\Command;

use App\Entity\Reservation;
use App\Entity\Unite;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'checking',
    description: 'Add a short description for your command',
)]
class CheckingCommand extends Command
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:checking')
            ->setDescription('Check la disponibilité des Unités');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
//        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }
//
//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        $unites = $this->em->getRepository(Unite::class)->findAll();

        foreach ($unites as $unite){
            $ReservationUnite = $this->em->getRepository(Reservation::class)->findOneBy(['id'=>$unite->getIdentifiantReservation()]);
            if ($ReservationUnite != null){
                if ($ReservationUnite->getDateEnd() <= new \DateTime('now') && $ReservationUnite->IsDelaie() == 0){
                    if($ReservationUnite->isRenAuto()){
                        $renouvellement = $ReservationUnite->getRenouvellement()->getNom();
                        if ($renouvellement) {
                            $duration = new \DateInterval("P1M");
                        }
                        if ($renouvellement) {
                            $duration = new \DateInterval("P1Y");
                        }
                        $ReservationUnite->setDateEndForm($duration);
                    }
                    else{
                        //envoie un mail
                        //ajouter deux semaines de delais pour renouveller manuellement
                        $delaie = new \DateInterval("P2W");
                        $ReservationUnite->setDateEndForm($delaie);
                        $ReservationUnite->setDelaie(1);
                    }
                }
                else{
                    if ($ReservationUnite->getDateEnd() <= new \DateTime('now') && $ReservationUnite->IsDelaie()){
                        //envoie de mail
                        $statut = 0;
                    }
                }
            }
        }
        $unite->setStatus($statut);
        $output->writeln('Checking effectué avec succès');

        return Command::SUCCESS;
    }
}
