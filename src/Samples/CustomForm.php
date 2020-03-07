<?php

namespace Docs\Samples;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\ConfiguresForm;
use Galahad\Aire\Elements\Form;

class CustomForm implements ConfiguresForm
{
	// Use configureForm to set properties on the form object itself
	public function configureForm(Form $form, Aire $aire) : void
	{
		$form->action('/book-demo')
			->patch()
			->rules([
				'title' => 'required|min:5',
				'author' => 'required',
				'edition' => 'nullable|int|min1',
			]);
	}
	
	public function formFields(Aire $aire) : array
	{
		return [
			'name' => $aire->input('name', 'Name'),
			'author' => $aire->number('p', 'Published Books')->step(1),
			'edition' => $aire->checkbox('edition', 'Favorite'),
			'f' => $aire->submit('Create New Author'),
		];
	}
}
