<?php 

namespace Sanatorium\Profile\Controllers\Frontend;

use Platform\Users\Controllers\Frontend\UsersController as BaseUsersController;

class UsersController extends BaseUsersController
{

	/**
     * Show the form for the user registration.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return view('sanatorium/profile::auth/register');
    }

    /**
     * Handle posting of the form for the user registration.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processRegistration()
    {
        // Store the user
        list($messages, $user) = $this->users->auth()->register(request()->except(['address']));

        // Do we have any errors?
        if ($messages->isEmpty()) {

        	if ( request()->has('address') ) {

        		$this->processAddresses($user, request()->get('address'));

        	}

            return redirect()->route('user.register')->with('registration-complete', $user);
        }

        $this->alerts->error($messages, 'form');

        return redirect()->back()->withInput();
    }

    public function processAddresses($user, $addresses)
    {

    	$this->addresses = app('Sanatorium\Addresses\Repositories\Address\AddressRepositoryInterface');

    	$prepared_addresses = [];

    	foreach( $addresses as $type => $address ) {

    		if ( $type != 'firemni' ) {

    			$prepared_addresses[$type] = $address;
    			$prepared_addresses[$type]['type'] = $type;
    			$prepared_addresses[$type]['user_id'] = $user->id;

    		}

    	}

    	if ( isset($addresses['firemni']) && isset($addresses['fakturacni']) ) {

    		$prepared_addresses['fakturacni']['ic'] = $addresses['firemni']['ic'];
    		$prepared_addresses['fakturacni']['dic'] = $addresses['firemni']['dic'];

    	}

    	foreach( $prepared_addresses as $address ) {

    		$this->addresses->create($address);

    	}

    	return true;

    }

}