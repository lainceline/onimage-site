<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'onimage:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Installs the Onimage site.  Installs node dependencies, and runs gulp tasks.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->info('Setting up Onimage site...');

        $this->info('Installing Node dependencies');
        $output = shell_exec('npm install');
        $this->info($output);
        $this->info('Node dependencies installed');

        $this->info('Running Gulp.js tasks');
	    $output = shell_exec('gulp make');
        $this->info($output);
        $this->info('Gulp.js tasks complete');

        $this->info('Installation complete!  Please setup your database info, run migrations, then simply php artisan serve to start developing.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
