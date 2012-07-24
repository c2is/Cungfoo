<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

$console
    ->register('cl')
    ->setDefinition(array(
        // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
    ))
    ->setDescription('Clear log expect .gitignore file')
    ->setHelp('Usage: <info>./console.php cl</info>')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
      $finder = new Finder();
      $finder->files()->in($app['config.root-dir'].'/logs')->notName('.gitkeep');
      
      $fs = new Filesystem();
      $fs->remove($finder);

      $output->write("<info>Log</info>\tcleared", true);
    })
;
