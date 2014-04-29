<?php

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\HelperSet;

class LaravelWriter extends Codesleeve\Generator\FileWriter
{
	public $neverOverwrite = array(
		'app/views/layouts/scaffold.php'
	);

	public function write(array $files, OutputInterface $output, HelperSet $helperSet, $options = array())
	{
		$files = $this->ensureSomeFilesAreNeverOverridden($files);

		parent::write($files, $output, $helperSet, $options);
	}

	/**
	 * We don't want to keep overwriting the scaffold layout file
	 * and there could be others too.
	 *
	 * @param  array $files
	 * @return array
	 */
	protected function ensureSomeFilesAreNeverOverridden($files)
	{
		foreach ($this->neverOverwrite as $neverOverwrite)
		{
			if (in_array($neverOverwrite, array_keys($files)) && $this->file->exists($neverOverwrite))
			{
				unset($files[$neverOverwrite]);
			}
		}

		return $files;
	}
}