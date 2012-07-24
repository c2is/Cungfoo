<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

$console
    ->register('init')
    ->setDefinition(array(
        // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
    ))
    ->setDescription('Init project')
    ->setHelp('Usage: <info>./console.php init</info>')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {

      // Propel build
      exec(
        'export PHP_CLASSPATH='.$app['config.root-dir'].'/vendor/phing/phing/classes &&'
        .$app['config.root-dir'].'/vendor/propel/propel1/generator/bin/propel-gen config/Propel main',
        $lines,
        $status
      );

      if($status)
      {
        foreach ($lines as $line) {
          $output->write($line, true);
        }
        $output->write("<info>Project</info>\t<error>Propel build failed</error>", true);
      }
      else
      {
        $output->write("<info>Project</info>\tPropel build OK", true);
      }

      $output->write("<info>Project</info>\tinitialized", true);
    })
;
