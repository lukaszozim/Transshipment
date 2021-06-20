<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 17.06.2021
 * Time: 22:25
 */

namespace App\Model\TruckLoading;


use PHPUnit\Util\Exception;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TruckAgriculturalMachinery
{

    /**
     *
     */
    const QUANTITY_REQUIRED_MACHINES = 2;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * TruckAgriculturalMachinery constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @param $agriculturalMachinery
     * @return bool
     */
    public function loading($agriculturalMachinery) : bool{

        try{
            if(count($agriculturalMachinery) == self::QUANTITY_REQUIRED_MACHINES){
                //$this->session->set('agriculturalMachinery', $agriculturalMachinery);

                $cache = new FilesystemAdapter();

                $machinery = $cache->getItem('machinery');
                $machinery->set($agriculturalMachinery);
                $cache->save($machinery);

                return true;
            } else {

                return false;
            }
        } catch (\Exception $e){

            return false;
        }
    }
}