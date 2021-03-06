<?php

namespace Docs;

use Galahad\Aire\Elements\ClientValidation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use ReflectionProperty;
use Symfony\Component\Process\Process;

class BuildCommand extends Command
{
	protected $name = 'build';
	
	protected $description = 'Build static documentation.';
	
	public function handle()
	{
		app()->instance('env', 'production');
		
		config()->set('app.url', 'https://airephp.com');
		app('url')->forceRootUrl('https://airephp.com/');
		app('url')->forceScheme('https');
		app('galahad.aire')->resetTheme();
		
		$this->buildCSS();
		$this->copyAssets();
		$this->writeFiles();
		
		$this->comment('Done.');
	}
	
	protected function buildCSS()
	{
		$this->comment('Building tailwind CSS file...');
		
		$process = (new Process(['yarn', 'run', 'css']))->setTimeout(null);
		$process->run();
		
		if (!$process->isSuccessful()) {
			throw new \RuntimeException($process->getErrorOutput());
		}
	}
	
	protected function copyAssets()
	{
		$this->comment('Copying assets...');
		
		File::copy(__DIR__.'/../public/aire.css', __DIR__.'/../docs/aire.css');
		File::copy(__DIR__.'/../public/logo.svg', __DIR__.'/../docs/logo.svg');
	}
	
	protected function writeFiles()
	{
		$dist = __DIR__.'/../docs';
		$files = File::glob(__DIR__.'/views/*.blade.php');
		
		$reflect = new ReflectionProperty(ClientValidation::class, 'aire_loaded');
		$reflect->setAccessible(true);
		
		foreach ($files as $filename) {
			$reflect->setValue(ClientValidation::class, false);
			$view = basename($filename, '.blade.php');
			
			// Skip partials
			if ('_' === $view[0]) {
				$this->comment("Skipping '$view' partial...");
				continue;
			}
			
			$data = [
				'current_path' => 'index' === $view ? '/' : $view,
				'readme' => new Readme(),
			];
			
			$this->comment("Writing '$view' view...");
			File::put("$dist/$view.html", View::make($view, $data)->render());
		}
	}
}
