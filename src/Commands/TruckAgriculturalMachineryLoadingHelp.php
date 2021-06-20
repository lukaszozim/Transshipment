<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 18.06.2021
 * Time: 23:53
 */

namespace App\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TruckAgriculturalMachineryLoadingHelp extends Command
{

    protected static $defaultName = 'app:agricultural-machinery-trucks-loading-help';

    protected function configure()
    {
        $this
            ->setDescription('===== Opis wykonania procedury =====');
    }

    protected function execute(InputInterface $input, OutputInterface $output): string
    {
        $output->writeln('Opis wykonania procedury.');

        $output->writeln(['===  Dozwolone parametry procedury:  ===',
            'M1.5 ====== Maszyna rolnicza 1,5 t',
            'M2 ====== Maszyna rolnicza 2 t',
            '======================================',
            'Przykład wywołania: php bin/console app:agricultural-machinery-trucks-loading M1.5 M2']);

        return 'SUCCESS';
    }
}