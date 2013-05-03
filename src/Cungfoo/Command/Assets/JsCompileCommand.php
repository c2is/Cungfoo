<?php
namespace Cungfoo\Command\Assets;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Filesystem\Filesystem,
    Symfony\Component\Finder\Finder;

class JsCompileCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('assets:js:compile')
            ->setDescription('Compile JS files')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // define all input and output javascript for combined process

        $commands = array(
            array(
                'command'    => 'uglifyjs',
                'input'      => '#rootdir#/web/js/vacancesdirectes/pluginGmap.js',
                'output'     => '#rootdir#/web/js/vacancesdirectes/pluginGmap.min.js',
                'parameters' => '-o'
            ),
            array(
                'command'    => 'uglifyjs',
                'input'      => '#rootdir#/web/js/vacancesdirectes/compte.js',
                'output'     => '#rootdir#/web/js/vacancesdirectes/compte.min.js',
                'parameters' => '-o'
            ),
            array(
                'command'    => 'uglifyjs',
                'input'      => '#rootdir#/web/js/vacancesdirectes/couloir.js',
                'output'     => '#rootdir#/web/js/vacancesdirectes/couloir.min.js',
                'parameters' => '-o'
            ),
            array(
                'command'    => 'uglifyjs',
                'input'      => '#rootdir#/web/js/vacancesdirectes/date.js',
                'output'     => '#rootdir#/web/js/vacancesdirectes/date.min.js',
                'parameters' => '-o'
            ),
            array(
                'command'    => 'uglifyjs',
                'input'      => '#rootdir#/web/js/vacancesdirectes/iframe.js',
                'output'     => '#rootdir#/web/js/vacancesdirectes/iframe.min.js',
                'parameters' => '-o'
            ),
            array(
                'command'    => 'uglifyjs',
                'input'      => '#rootdir#/web/js/vacancesdirectes/plugins.js',
                'output'     => '#rootdir#/web/js/vacancesdirectes/plugins.min.js',
                'parameters' => '-o'
            ),
            array(
                'command'    => 'uglifyjs',
                'input'      => '#rootdir#/web/js/vacancesdirectes/front.js',
                'output'     => '#rootdir#/web/js/vacancesdirectes/front.min.js',
                'parameters' => '-o'
            ),
            array(
                'command'    => 'uglifyjs',
                'input'      => '#rootdir#/web/js/vacancesdirectes/searchSelectChange.js',
                'output'     => '#rootdir#/web/js/vacancesdirectes/searchSelectChange.min.js',
                'parameters' => '-o'
            ),
            array(
                'command'    => 'uglifyjs',
                'input'      => '#rootdir#/web/js/vacancesdirectes/plugins.min.js #rootdir#/web/js/vacancesdirectes/front.min.js #rootdir#/web/js/vacancesdirectes/searchSelectChange.min.js',
                'output'     => '#rootdir#/web/js/vacancesdirectes/plugFront.min.js',
                'parameters' => '-o'
            ),
        );

        foreach ($commands as $command) {
            $line = sprintf("%s %s %s %s",
                $command['command'],
                str_replace('#rootdir#', $this->getProjectDirectory(), $command['input']),
                $command['parameters'],
                str_replace('#rootdir#', $this->getProjectDirectory(), $command['output'])
            );

            passthru($line);

            $output->writeln(sprintf('%s <info>%s</info>', $this->getName(), $line));
        }

        return true;
    }
}
