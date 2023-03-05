<?php


namespace App\Common\Command;


use App\Common\EmailSender;
use App\Service\FruitService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetFruitsCommand extends Command
{
    private FruitService $fruitService;

    private EmailSender $emailSender;

    public function __construct(
        FruitService $fruitService,
        EmailSender $emailSender,
        string $name = null
    )
    {
        parent::__construct($name);

        $this->fruitService = $fruitService;
        $this->emailSender = $emailSender;
    }

    protected function configure()
    {
        $this->setName('get:fruits')
            ->setDescription('Getting fruits');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start getting fruits');

        $result = $this->fruitService->getFruitsFromSite();

        $output->writeln('FINISHED TO DATABASE');

        $output->writeln('PROCESS SENDING EMAIL');

        $textSubject = 'Fruits is loaded';

        $bodyHtml = '<p>OMG! There are already here!!!!!! AA<p>';

        $emailResult = $this->emailSender->sendEmail('someOne@mail.ru', 'someTwo@mail.ru', $textSubject, $bodyHtml);

        $output->writeln("EMAIL SENT RESULT : $emailResult");


        return 0;
    }


}