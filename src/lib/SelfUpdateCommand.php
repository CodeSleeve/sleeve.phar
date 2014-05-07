<?php

use Herrera\Phar\Update\Manager;
use Herrera\Phar\Update\Manifest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SelfUpdateCommand extends Command
{
    const MANIFEST_FILE = 'https://raw.githubusercontent.com/CodeSleeve/sleeve.phar/master/manifest.json';

    protected function configure()
    {
        $this->setName('self-update')->setDescription('Update this phar to the latest version')
             ->addOption('config', null, InputOption::VALUE_REQUIRED, 'Use your own generate.json files')
             ->addOption('yes', null, InputOption::VALUE_NONE, 'Automatically answer yes to any prompts');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $appVersion = $this->getApplication()->getVersion();

        $appName = $this->getApplication()->getName();

        $manager = new Manager(Manifest::loadFile(self::MANIFEST_FILE));

        $updated = $manager->update($appVersion);

        return ($updated) ? $this->updated($output, $appName, $appVersion) : $this->notUpdated($output, $appName, $appVersion);
    }

    protected function updated($output, $appName, $appVersion)
    {
        $output->writeln('Updated ' . $appName. ' to newest version');
    }

    protected function notUpdated($output, $appName, $appVersion)
    {
        $output->writeln('Currently on latest version, ' . $appName . ' ' . $appVersion);
    }
}