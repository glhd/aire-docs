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
		$form->action('/books')
			->patch()
			->rules([
				'title' => 'required|min:5',
				'author' => 'required',
				'edition' => 'nullable|integer|min:1',
			]);
	}
	
	public function formFields(Aire $aire) : array
	{
		return [
			'title' => $aire->input('title', 'Title of Book')
				->placeholder('Book title'),
			'author' => $aire->input('author', 'Author')
				->helpText('Please try to be consistent in name formatting'),
			'edition' => $aire->number('edition', 'Book Edition')
				->min(1)
				->step(1)
				->defaultValue(1)
				->groupAddClass('w-48'),
			'submit' => $aire->submit('Save Book'),
		];
	}
}
