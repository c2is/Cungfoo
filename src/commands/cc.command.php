<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

$console
    ->register('cc')
    ->setDefinition(array(
        // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
    ))
    ->setDescription('Clear cache expect .gitignore file')
    ->setHelp('Usage: <info>./console.php cc</info>')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
      $finder = new Finder();
      $finder->files()->in($app['config.root-dir'].'/cache')->notName('.gitignore');
      
      $fs = new Filesystem();
      $fs->remove($finder);

      $output->write('Cache cleared.', true);
    })
;
