<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 19.06.2021
 * Time: 00:11
 */

namespace App\Commands;



use App\Model\Reloading\Reloading;
use App\Model\Reloading\ReloadingAgriculturalMachinery;
use App\Model\Reloading\ReloadingFirstTruck;
use Psr\Log\LoggerInterface;
use Psr\Log\Test\LoggerInterfaceTest;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrganizeReloading extends Command
{

    protected static $defaultName = 'app:organize-reloading';

    private $reloadingFirstTruck;
    private $reloadingAgriculturalMachinery;
    private $logger;

    public function __construct(
        ReloadingFirstTruck $reloadingFirstTruck,
        ReloadingAgriculturalMachinery $reloadingAgriculturalMachinery,
        LoggerInterface $logger
    )
    {
        $this->reloadingAgriculturalMachinery = $reloadingAgriculturalMachinery;
        $this->reloadingFirstTruck = $reloadingFirstTruck;
        $this->logger = $logger;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Organizacja przeładunku');
    }

    protected function execute(InputInterface $input, OutputInterface $output): string
    {

        $reloading = new Reloading($this->reloadingFirstTruck, $this->logger);
        $deliveryVehicles = $reloading->allocatePackages();

        $reloadingAM = new Reloading($this->reloadingAgriculturalMachinery, $this->logger);
        $agriculturalMachinery = $reloadingAM->allocatePackages();

        $output->writeln(['=====PRZEŁADUNEK CIĘŻARÓWKI Z PACZKAMI DO POJAZDÓW DOSTAWCZYCH=====', '']);
        $output->writeln([
            '===Ilość potrzebnych pojazdów: ' . count($deliveryVehicles) .' ===',
            '===Zawartość pojazdów ===', '']);

        foreach ($deliveryVehicles as $deliveryVehicle) {
            $output->writeln('Pojazd ' .$deliveryVehicle['vehicleNumber']);
            foreach ($deliveryVehicle['packs'] as $pack) {
                $output->writeln('Pojazd nr ' . $pack['packId'] . ' Waga: ' . $pack['weight'] . ' kg');
            }
        }

        $output->writeln(['', '=====PRZEŁADUNEK CIĘŻARÓWKI WIELKOGABARYTOWEJ NA SAMOLOT=====', '']);
        foreach ($agriculturalMachinery as $machinery) {
            $output->writeln($machinery);
        }

        return 'SUCCESS';
    }
}