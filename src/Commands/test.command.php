<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

$console
    ->register('test')
    ->setDescription('Launches tests')
    ->setHelp('Usage: <info>./console.php test</info>')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
      $atoum     = $app['config.root-dir'].'/vendor/mageekguy/atoum/bin/atoum';
      $unitTests = $app['config.root-dir'].'/tests';

      passthru(sprintf('%s -d %s', $atoum, $unitTests), $status);
    })
;
