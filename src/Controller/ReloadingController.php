<?php

namespace App\Controller;

use App\Model\Reloading\Reloading;
use App\Model\Reloading\ReloadingAgriculturalMachinery;
use App\Model\Reloading\ReloadingFirstTruck;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ReloadingController
 * @package App\Controller
 */
class ReloadingController extends Controller
{
    /**
     * @Route("/reloading-organize", name="reloading")
     */
    public function organize(
        ReloadingFirstTruck $reloadingFirstTruck,
        ReloadingAgriculturalMachinery $reloadingAgriculturalMachinery
    )
    {

        //ZAstosowano interface, aby dać możliwość użycia innej implementacji funkcji przydzielającej paczki
        $reloading = new Reloading($reloadingFirstTruck);
        $organizerInfo = $reloadingFirstTruck->reloadingOrganize();
        $deliveryVehicles = $reloading->allocatePackages();

        $reloadingAM = new Reloading($reloadingAgriculturalMachinery);
        $agriculturalMachinery = $reloadingAM->allocatePackages();

        $result = array(
            'information' => $organizerInfo,
            'plan' => count($deliveryVehicles),
            'vehicles' => $deliveryVehicles,
            'agriculturalMachinery' => $agriculturalMachinery
        );

        return $this->json($result);
    }
}
