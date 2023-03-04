<?php


namespace App\Common\Command;


use App\Service\FruitService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetFruitsCommand extends Command
{
    private FruitService $fruitService;

    public function __construct(FruitService $fruitService, string $name = null)
    {
        parent::__construct($name);

        $this->fruitService = $fruitService;
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

        $output->writeln(json_encode($result));
        return 0;
    }


}