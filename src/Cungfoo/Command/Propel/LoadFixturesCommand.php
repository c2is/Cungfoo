<?php

namespace Cungfoo\Command\Propel;

use Cungfoo\Command\ApplicationAwareCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Cungfoo\DataFixtures\Loader\YamlDataLoader,
    Symfony\Component\Finder\Finder;

class LoadFixturesCommand extends ApplicationAwareCommand
{
    protected $fixturesDir = 'data/fixtures';

    protected function configure()
    {
        $this
            ->setName('propel:fixtures:load')
            ->setDescription('Load YAML fixtures')
            ->addOption('dir', 'd', InputOption::VALUE_OPTIONAL, 'The directory where YAML fixtures files are located (relative to project root dir', null)
            ->setHelp(<<<EOT
The <info>propel:fixtures:load</info> loads <info>XML</info> fixtures.

  <info>php console propel:fixtures:load</info>

The <info>--dir</info> parameter allows you to change the directory that contains <info>YML</info> fixtures files <comment>(default: 'data/fixtures')</comment>.

YAML fixtures are:
<comment>
    \Awesome\Object:
        o1:
            Title: My title
            MyFoo: bar

    \Awesome\Related:
        r1:
            ObjectId: o1
            Description: Hello world !
</comment>
EOT
        )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $absoluteFixturesPath = $this->getApplication()->getRootDir().DIRECTORY_SEPARATOR;
        if(!is_null($input->getOption('dir')))
        {
            $absoluteFixturesPath .= $input->getOption('dir');
        }
        else
        {
            $absoluteFixturesPath .= $this->fixturesDir;   
        }

        if(!$absoluteFixturesPath && !file_exists($absoluteFixturesPath))
        {
            return $this->writeSection($output, array('The fixtures directory "'.$absoluteFixturesPath.'" does not exist.'), 'fg=white;bg=red');
        }

        $finder = new Finder();
        $finder->files()
            ->in($absoluteFixturesPath)
            ->sortByName()
            ->name('*.yml')
        ;

        if(iterator_count($finder) == 0)
        {
            $output->writeln('No <info>YML</info> fixtures found in "'.$absoluteFixturesPath.'"');
            return true;
        }

        $loader = new YamlDataLoader($this->getApplication()->getRootDir());

        try
        {
            $nb = $loader->load($finder);
        }
        catch(\Exception $e)
        {
            $this->writeSection($output, array('[Propel] Exception', '', $e->getMessage()), 'fg=white;bg=red');
            return false;
        }

        $output->writeln(sprintf('<comment>%s</comment> YML fixtures file%s loaded.', $nb, $nb > 1 ? 's' : ''));
        return true;
    }
}