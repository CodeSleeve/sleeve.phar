<?php

/**
 * Add this line to composer.json classmap which is similar
 * to how TestCase.php is setup
 *
 * 	"app/tests/IntegrationTestCase.php"
 */
class IntegrationTestCase extends Illuminate\Foundation\Testing\TestCase
{
	/**
	 * Setup the application
	 */
	public function setUp()
	{
		parent::setUp();

		DB::beginTransaction();
	}

	/**
	 * Teardown the application
	 */
	public function tearDown()
	{
		DB::rollback();
	}

	/**
	 * Creates the application.
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		$app = require __DIR__.'/../../bootstrap/start.php';

		Artisan::call('migrate');

		return $app;
	}

	/**
	 * Creates faker instance for us
	 */
	public function faker($seed = 1234)
	{
		$faker = Faker\Factory::create();

		$faker->seed($seed);

		return $faker;
	}
}