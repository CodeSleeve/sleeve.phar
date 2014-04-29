<?php

class ApplicationFactory
{
	public static function make($name, $version)
	{
		$app = new Codesleeve\Generator\Console\Application($name, $version);

		$app->setupGenerators(getcwd(), __DIR__);

		$app->add(new Laravel\Craft\NewCommand);

		$app->add(new SelfUpdateCommand);

		return $app;
	}
}