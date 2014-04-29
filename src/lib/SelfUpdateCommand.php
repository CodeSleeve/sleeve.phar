<?php

use Herrera\Phar\Update\Manager;
use Herrera\Phar\Update\Manifest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SelfUpdateCommand extends Command
{
    const MANIFEST_FILE = 'https://raw.githubusercontent.com/CodeSleeve/sleeve.phar/master/manifest.json';

    protected function configure()
    {
        $this->setName('self-update')->setDescription('Updates sleeve.phar to the latest version');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $appVersion = $this->getApplication()->getVersion();

        $appName = $this->getApplication()->getName();

        $manager = new Manager(Manifest::loadFile(self::MANIFEST_FILE));

        $output = $manager->update($appVersion);

        return ($updated) ? $this->updated($appName, $appVersion) : $this->notUpdated($appName, $appVersion);
    }

    protected function updated($appName, $appVersion)
    {
        $this->output->writeln('Updated ' . $appName. ' to newest version');
    }

    protected function notUpdated($appName, $appVersion)
    {
        $this->output->writeln('Currently on latest version, ' . $appName . ' ' . $appVersion);
    }
}