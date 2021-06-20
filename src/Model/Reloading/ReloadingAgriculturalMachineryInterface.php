<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 17.06.2021
 * Time: 22:44
 */

namespace App\Model\Reloading;


interface ReloadingAgriculturalMachineryInterface
{
    public function allocateMachine(): array;
}