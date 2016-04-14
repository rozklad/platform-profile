<?php namespace Sanatorium\Profile\Repositories;

use Cartalyst\Support\Traits;
use Cartalyst\Sentinel\Checkpoints;
use Illuminate\Container\Container;
use Platform\Users\Repositories\AuthRepositoryInterface;
use Platform\Users\Repositories\AuthRepository as BaseAuthRepository;

class AuthRepository extends BaseAuthRepository implements AuthRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function getSocialConnections()
    {
        return array_filter($this->container['sentinel.addons.social']->getConnections(), function ($connection, $key) {
            return ($connection['identifier'] && $connection['secret'] && config('sanatorium-social.connections.'.$key));
        }, ARRAY_FILTER_USE_BOTH);
    }
}
