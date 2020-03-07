<?php

namespace Docs;

use Galahad\Aire\Support\Facades\Aire;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Docs';
	
	public function boot()
	{
		parent::boot();
		
		Aire::resetTheme();
	}
	
	public function map()
	{
		$files = File::glob(__DIR__.'/views/*.blade.php');
		
		Route::get('validator.js', function() {
			return response(file_get_contents(__DIR__.'/../../node_modules/validatorjs/dist/validator.js'), 200, [
				'Content-Type' => 'text/javascript',
			]);
		});
		
		// These are just for sample code
		Route::post('/authors', 'AuthorsController@store')->name('authors.store');
		Route::put('/authors/{author}', 'AuthorsController@update')->name('authors.update');
		
		View::share(
			'css_version',
			app()->environment('production')
				? md5_file(base_path('src/aire.css'))
				: ''
		);
		
		foreach ($files as $filename) {
			$view = basename($filename, '.blade.php');
			
			// Skip partials
			if (0 === strpos($view, '_')) {
				continue;
			}
			
			$path = 'index' === $view
				? '/'
				: $view;
			
			Route::any($path, function() use ($view, $path) {
				if (request()->isMethod('post')) {
					session()->flashInput(request()->all());
				}
				return view($view, [
					'current_path' => $path,
					'readme' => new Readme(),
				]);
			})->middleware([
				AddQueuedCookiesToResponse::class,
				StartSession::class,
				ShareErrorsFromSession::class,
			]);
		}
	}
}
