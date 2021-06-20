<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 15.06.2021
 * Time: 21:50
 */

namespace App\Model\Reloading;


use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReloadingFirstTruck implements ReloadingAllocatePackagesInterface
{

    private $packs;
    private $logger;

    const TOTAL_CAPACITY = 200;
    const RELOADING_NAME = 'FIRST TRUCK RELOADING';

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;

        $cache = new FilesystemAdapter();
        $this->packs = $cache->getItem('packages')->get();
    }

    public function reloadingOrganize() : array {

        $packsNumber = count($this->packs);

        $totalWeight = $this->calculateTotalWeight($this->packs);

        $busNumber = ceil($totalWeight/self::TOTAL_CAPACITY);

        return array('packsNumber' => $packsNumber, 'totalWeight' => $totalWeight, 'busNumber' => $busNumber);
    }

    public function allocatePackages() : array{

        $deliveryVehicles = [];
        $packsToVehicle = [];

        $vehicleNumber = 1;
        $totalWeight = 0;

        foreach ($this->packs as $pack) {

            if (($totalWeight + $pack['weight']) > self::TOTAL_CAPACITY) {

                $vehicle = array('vehicleNumber' => $vehicleNumber, 'packs' => $packsToVehicle);
                $vehicleNumber++;

                array_push($deliveryVehicles, $vehicle);
                $packsToVehicle = [];

                array_push($packsToVehicle, $pack);
                $totalWeight =  $pack['weight'];

            } else {
                array_push($packsToVehicle, $pack);
                $totalWeight =  $totalWeight + $pack['weight'];
            }
        }

        if (count($packsToVehicle) > 0) {
            $vehicle = array('vehicleNumber' => $vehicleNumber++, 'packs' => $packsToVehicle);
            array_push($deliveryVehicles, $vehicle);
        }

        return $deliveryVehicles;
    }

    public function getNameReloading() : string{

         return self::RELOADING_NAME;
    }


    private function calculateTotalWeight($packs){

        if (count($packs) == 0) {
            return 0;
        }

        $totalWeight = 0;
        foreach ($this->packs as $pack){
            $totalWeight = $totalWeight + $pack['weight'];
        }

        return $totalWeight;
    }

}