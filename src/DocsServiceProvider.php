<?php

namespace Docs;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DocsServiceProvider extends ServiceProvider
{
	public function boot()
	{
		Blade::directive('sample', function ($expression) {
			$regex = '/^\s*<\?(?:php)?\s*(?:namespace[^;]+;\s*)?(?:use[^;]+;\s*)*\s*/si';
			return implode('', [
				'<pre class="m-0"><code class="language-php">',
				'<?php ',
				'echo e(',
				'trim(',
				"preg_replace('{$regex}', '',",
				'file_get_contents(',
				'base_path(\'src/Samples/\'.',
				$expression,
				')', // base_path()
				')', // file_get_contents()
				')', // preg_replace()
				')', // trim()
				');', // e()
				' ?>',
				'</code></pre>',
			]);
		});
		
		Blade::directive('inlineSample', function ($expression) {
			return implode('', [
				'<pre class="m-0"><code class="language-php">',
				'<?php ',
				'echo \'{\'.\'{ \';',
				'echo e(\'',
				addslashes(trim($expression)),
				'\');', // e()
				'echo \' }\'.\'}\';',
				' ?>',
				'</code></pre>',
			]);
		});
	}
}
