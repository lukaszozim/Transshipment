<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 17.06.2021
 * Time: 21:24
 */

namespace App\Model\Reloading;


interface ReloadingInterface
{

    /**
     * @return array [packsNumber, totalWeight, busNumber]
     */
    public function reloadingOrganize() : array;

}