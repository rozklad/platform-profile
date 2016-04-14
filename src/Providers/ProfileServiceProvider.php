<?php namespace Sanatorium\Profile\Providers;

use Cartalyst\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class ProfileServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register all the default hooks
        $this->registerHooks();
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
        // Register the auth repository
        $this->app->bind('platform.users.auth', 'Sanatorium\Profile\Repositories\AuthRepository');

        // Register the event handler
        $this->app->bind('platform.users.handler.event', 'Sanatorium\Profile\Handlers\EventHandler');
	}

	/**
     * Register all hooks.
     *
     * @return void
     */
    protected function registerHooks()
    {
        $hooks = [
            [
                'position' => 'register.after',
                'hook' => 'sanatorium/profile::hooks.register',
            ]
        ];

        $manager = $this->app['sanatorium.hooks.manager'];

        foreach ($hooks as $item) {
        	extract($item);
            $manager->registerHook($position, $hook);
        }
    }
}
