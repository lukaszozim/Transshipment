<?php

namespace App\Controller;

use App\Model\TruckLoading\Truck;
use App\Model\TruckLoading\TruckAgriculturalMachinery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TruckLoadingController
 * @package App\Controller
 */
class TruckLoadingController extends Controller
{
    /**
     * @Route("/truck-loading", name="truck_loading", methods="GET")
     */
    public function createPacks()
    {

        return $this->render('truck_loading/index.html.twig', [
            'controller_name' => 'TruckLoadingController',
        ]);
    }

    /**
     * @Route("/truck-loading/set-packs", name="set_packs", methods="POST")
     */
    public function sendPacks(Request $request, Truck $truck, TruckAgriculturalMachinery $truckAgriculturalMachinery)
    {
        $packs = $request->request->get('packs');
        $agriculturalMachinery = $request->request->get('agriculturalMachinery');

        if($truck->loading($packs) && $truckAgriculturalMachinery->loading($agriculturalMachinery)){
            return $this->json('SUCCESS');
        } else {
            return $this->json('ERROR');
        }
    }
}
