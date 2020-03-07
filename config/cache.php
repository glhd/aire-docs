<?php

return [
	'default' => 'file',
	'stores' => [
		'file' => [
			'driver' => 'file',
			'path' => __DIR__.'/../storage/cache',
		],
	],
	'prefix' => 'aire-docs',
];
