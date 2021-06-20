<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 18.06.2021
 * Time: 23:38
 */

namespace App\Commands;


use App\Model\TruckLoading\TruckAgriculturalMachinery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TruckAgriculturalMachineryLoading extends Command
{

    protected static $defaultName = 'app:agricultural-machinery-trucks-loading';

    private $truck;

    public function __construct(TruckAgriculturalMachinery $truck)
    {
        $this->truck = $truck;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('machine', InputArgument::IS_ARRAY, 'Machine')
            ->setDescription('Utworzenie zaladunku.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): string
    {
        $output->writeln('============Utworzenie załadunku============');

        $agriculturalMachineList = array(
            'M1.5' => 'Maszyna rolnicza 1,5 t',
            'M2' => 'Maszyna rolnicza 2 t'
        );

        $machinery = $input->getArgument('machine');
        $selectedMachinery = [];
        $i = 1;

        if (count($machinery) == 2) {
            foreach ($machinery as $machineCode){
                $machine = $agriculturalMachineList[$machineCode];
                array_push($selectedMachinery, $machine);
                $output->writeln('Maszyna nr. ' .$i .': ' . $machine);
            }
        }

        $this->truck->loading($selectedMachinery);

        return 'SUCCESS';
    }
}