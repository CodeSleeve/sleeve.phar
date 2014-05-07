<?php

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as BaseCommand;

class CustomizeCommand extends BaseCommand
{
	/**
	 * Configure the console command.
	 *
	 * @return void
	 */
	protected function configure()
	{
		$this->setName('customize')
			 ->setDescription('Copy templates and generator.json into current directory')
 			 ->addOption('config', null, InputOption::VALUE_REQUIRED, 'Use your own generate.json files')
			 ->addOption('yes', null, InputOption::VALUE_NONE, 'Automatically answer yes to any prompts');
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$cwd = getcwd();

		$this->xcopy(__DIR__ . '/templates', $cwd . '/templates');

		copy(__DIR__ . '/generator.json', $cwd . '/generator.json');

		$output->writeln('Finished copying template and generator.json, happy customizing!');
	}

	/**
	 * Recursive copy of directory
	 *
	 * @param  string $source
	 * @param  string $dest
	 * @return void
	 */
    private function xcopy($source, $dest)
    {
        if (!is_dir($dest))
        {
        	mkdir($dest);
        }

        foreach ($iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS), \RecursiveIteratorIterator::SELF_FIRST) as $item)
        {
            if ($item->isDir())
            {
                if (!is_dir($dest . '/' . $iterator->getSubPathName()))
                {
                    mkdir($dest . '/' . $iterator->getSubPathName());
                }
            }
            else
            {
                copy($item, $dest . '/' . $iterator->getSubPathName());
            }
        }
    }
}