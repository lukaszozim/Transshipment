<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 17.06.2021
 * Time: 22:34
 */

namespace App\Model\Reloading;


use PhpParser\Node\Scalar\MagicConst\File;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReloadingAgriculturalMachinery implements ReloadingAllocatePackagesInterface
{

    private $logger;
    private $agriculturalMachinery;

    const RELOADING_NAME = 'AGRICULTURAL MACHINERY RELOADING';

    public function __construct(SessionInterface $session, LoggerInterface $logger)
    {
        $this->logger = $logger;

        $cache = new FilesystemAdapter();
        $this->agriculturalMachinery = $cache->getItem('machinery')->get();
    }


    public function allocatePackages(): array
    {
       return $this->agriculturalMachinery;
    }


    public function getNameReloading() : string{

        return self::RELOADING_NAME;
    }
}