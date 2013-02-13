<?php
namespace VacancesDirectes\Command\Translations;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Yaml\Yaml;

class UpdateCommand extends Command
{
    const LOCALES_PATTERN = '%s/app/config/VacancesDirectes/locales/%s.yml%s';

    protected function configure()
    {
        $this
            ->setName('vacancesdirectes:translations:update')
            ->setDescription('Updates yml translation files with new labels from .dist files')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<info>%s</info> <comment>started</comment>.', $this->getName()));

        $languages = array_keys($this->getSilexApplication()['config']->get('languages'));
        foreach ($languages as $locale)
        {
            $actualTranslations = Yaml::parse(sprintf(self::LOCALES_PATTERN, $this->getSilexApplication()['config']->get('root_dir'), $locale, ''));
            $updatedTranslations = Yaml::parse(sprintf(self::LOCALES_PATTERN, $this->getSilexApplication()['config']->get('root_dir'), $locale, '.dist'));

            $diff = array_diff($updatedTranslations, $actualTranslations);
            $actualTranslations += $diff;

            file_put_contents(sprintf(self::LOCALES_PATTERN, $this->getSilexApplication()['config']->get('root_dir'), $locale, ''), Yaml::dump($actualTranslations));
        }

        $output->writeln(sprintf('<info>%s</info> <comment>success</comment>.', $this->getName()));

        return true;
    }
}
