<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 15.06.2021
 * Time: 20:01
 */

namespace App\Model\TruckLoading;


use PHPUnit\Util\Exception;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Truck
{

    const INCORRECT_LOADING = 'Niepoprawny załadunek.';

    /**
     * @param array $packs
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function loading(array $packs) : bool {

        if($this->checkContent($packs)){
            $cache = new FilesystemAdapter();
            $packages = $cache->getItem('packages');
            $packages->set($packs);
            $cache->save($packages);

            return true;
        } else {
            throw new \Exception(self::INCORRECT_LOADING);

            return false;
        }
    }

    /**
     * @param $packs
     * @return bool
     */
    private function checkContent($packs)
    {
        $count = count($packs);

        if ($count >= 5 && $count <= 40) {
            foreach ($packs as $pack) {
                if($pack['weight'] < 10 || $pack['weight'] > 20){
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

}