<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 17.06.2021
 * Time: 23:43
 */

namespace App\Commands;


use App\Model\TruckLoading\Truck;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadingFirstTruck extends Command
{

    protected static $defaultName = 'app:first-truck-loading';

    private $truck;

    public function __construct(Truck $truck)
    {
        $this->truck = $truck;


        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('pack', InputArgument::IS_ARRAY, 'weight')
            ->setDescription('Utworzenie zaladunku.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): string
    {
        $output->writeln([
            '============Utworzenie załadunku============',
            '',
        ]);
        $packages = $input->getArgument('pack');
        $packs = [];
        $i = 1;
        if (count($packages) > 0) {
            foreach ($packages as $p){
                $pack = array('packId' => $i, 'weight' => (float) $p);
                array_push($packs, $pack);
                $output->writeln('paczka: ' . $i . ' Waga: ' . (float) $p .' kg');
                $i++;
            }
        }

        $this->truck->loading($packs);

        return 'SUCCESS';
    }

}