<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 17.06.2021
 * Time: 21:29
 */

namespace App\Model\Reloading;


use Psr\Log\LoggerInterface;

class Reloading
{

    private $reloading;
    private $logger;

    public function __construct(ReloadingAllocatePackagesInterface $reloading, LoggerInterface $logger)
    {
        $this->reloading = $reloading;
        $this->logger = $logger;
    }

    public function allocatePackages(){

        $this->logger->info($this->reloading->getNameReloading());

        return $this->reloading->allocatePackages();
    }

}