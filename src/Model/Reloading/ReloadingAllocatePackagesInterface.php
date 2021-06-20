<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 17.06.2021
 * Time: 22:48
 */

namespace App\Model\Reloading;


interface ReloadingAllocatePackagesInterface
{

    /**
     * @return array;
     */
    public function allocatePackages() : array;

    public function getNameReloading() : string;
}