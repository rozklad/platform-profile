<?php 

namespace Sanatorium\Profile\Controllers\Admin;

use Platform\Access\Controllers\AdminController;

class HelperController extends AdminController
{

	public function index() 
	{

		return view('sanatorium/profile::index');

	}

	public function process($type = null)
	{

		switch( $type ) {

			case 'eshop':

				$this->seedShopProfiles();

			break;

		}

		return redirect()->back();

	}

	public function seedShopProfiles()
	{

		$this->attributes = app('Platform\Attributes\Repositories\AttributeRepositoryInterface');

		$defaults = [
			'namespace' 	=> \Platform\Users\Models\User::getEntityNamespace(),
			'type'			=> 'input',
			'enabled'		=> 1,
		];

		$fields = [
			[
				'name'	=> 'Telefon',
				'slug'	=> 'user_phone',
			],
			[
				'name'	=> 'Souhlasím s obchodními podmínkami',
				'slug'  => 'user_terms',
				'type'	=> 'checkbox',
			],
			[
				'name'	=> 'Mám zájem o zasílání marketingových sdělení',
				'slug'	=> 'user_newsletter',
				'type'	=> 'checkbox',
			]
		];

		foreach( $fields as $field ) {

			if ( !isset($field['slug']) ) {
				continue;
			}

			$attribute_exists = $this->attributes->where('slug', $field['slug'])->count() > 0;

			$input = $defaults + $field;

			if ( !$attribute_exists ) {
				$this->attributes->create($input);
			}

		}
		

		/**
		 * Registrace právnické osoby (mám ič)
		 * Fakturační údaje: Název společnosti, IČ, DIČ, Ulice, Číslo popisné, Město, PSČ
		 * Dodací údaje: Ulice, Číslo popisné, Město, PSČ
		 * Registrace fyzické osoby (nemám ič)
		 * Fakturační údaje: Ulice, Číslo popisné, Město, PSČ
		 * Dodací údaje: Ulice, Číslo popisné, Město, PSČ
		 */

	}

}