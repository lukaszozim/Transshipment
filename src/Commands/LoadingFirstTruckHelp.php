<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 19.06.2021
 * Time: 12:58
 */

namespace App\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadingFirstTruckHelp extends Command
{

    protected static $defaultName = 'app:first-truck-loading-help';

    protected function configure()
    {
        $this->setDescription('Opis wykonania procedury.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): string
    {
        $output->writeln('=====  Opis wykonania procedury  =====');

        $output->writeln(['===Funkcja przyjmuje od 5 do 40 parametrów===',
            'Dozwolone formaty parametrów:',
            '1) int',
            '2) float',
            'Dozwolone wartości od 10 do 20',
            '======================================',
            'Przykład wywołania: php bin/console app:first-truck-loading 12 10 15.6 19 20 16']);

        return 'SUCCESS';
    }

}