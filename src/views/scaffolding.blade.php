@extends('_layout')

@section('page-title')
	Scaffolding Forms
@endsection

@section('content')
	
	<h1 class="text-2xl text-gray-900">
		Scaffolding Forms
	</h1>
	
	<p>
		If you need to get started quickly, or just want a basic CRUD form that
		doesn't have sophisticated design needs, you can use Aire's scaffolding
		to generate an entire form in seconds:
	</p>
	
	<div class="flex">
		<div class="w-3/5 px-1">
			<h2 class="mb-2">
				Eloquent Model
			</h2>
			
			@sample('Author.php')
		</div>
		<div class="w-2/5 px-1">
			<h2 class="mb-2">
				Create Form
			</h2>
			
			@inlineSample(Aire::scaffold(Author::class))
			
			<div class="border rounded p-2 mt-2">
				{{ Aire::scaffold(Docs\Samples\Author::class) }}
			</div>
			
			<h2 class="mb-0 mt-10 pt-10 border-t">
				Update Form
			</h2>
			
			@inlineSample(Aire::scaffold(Author::find(1)))
			
			<?php
			$author = new Docs\Samples\Author();
			$author->setRawAttributes([
				'id' => 1,
				'name' => 'N.K. Jemisin',
				'is_favorite' => true,
				'genre' => 'fa',
				'last_read_at' => now(),
			], false);
			$author->exists = true;
			?>
			
			<div class="border rounded p-2 mt-2">
				{{ Aire::scaffold($author) }}
			</div>
		</div>
	</div>
	
	<h2>
		Custom Forms
	</h2>
	
	<p>
		If you need more control or want to build custom form objects that are not
		tied to an Eloquent model, you can implement the <code>ConfiguresForm</code> interface:
	</p>
	
	<div class="flex">
		<div class="w-3/5 px-1">
			<h2 class="mb-0">
				Sample Custom Form
			</h2>
			
			@sample('CustomForm.php')
		</div>
		<div class="w-2/5 px-1">
			<h2 class="mb-0">
				Sample Output
			</h2>
			
			@sample('snippets/scaffold-custom-form.blade.php')
			
			<div class="border rounded p-2 mt-2">
				{{ Aire::scaffold(new Docs\Samples\CustomForm())->bind([
					'title' => 'Radical Candor',
					'author' => 'Kim Scott',
					'edition' => 2,
				]) }}
			</div>
		</div>
	</div>
	
@endsection
