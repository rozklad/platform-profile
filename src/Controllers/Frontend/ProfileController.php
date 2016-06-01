<?php

namespace Sanatorium\Profile\Controllers\Frontend;

use Platform\Users\Controllers\Frontend\ProfileController as BaseProfileController;
use Sentinel;
use View;
use Sanatorium\Pricing\Models\Currency;

class ProfileController extends BaseProfileController
{

    /**
     * Show the form for the user profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile($active = 'profile')
    {
        $this->addresses = app('Sanatorium\Addresses\Repositories\Address\AddressRepositoryInterface');

        $this->orders = app('Sanatorium\Shoporders\Repositories\Order\OrderRepositoryInterface');

        $currency = Currency::getPrimaryCurrency();

        $user = Sentinel::getUser();

        $addresses = $this->addresses->where('user_id', $user->id)->get();

        $orders = $this->orders->where('user_id', $user->id)->orderBy('id', 'DESC')->get();

        $slips = $this->orders->where('user_id', $user->id)->orderBy('id', 'DESC')->get();

        $primaryAddresses = [];

        foreach( $addresses as $address ) {

            $primaryAddresses[$address->type] = $address;

        }

        if ( !isset($primaryAddresses['fakturacni']) ) {

            $primaryAddresses['fakturacni'] = new \Sanatorium\Addresses\Models\Address;

        }

        if ( !isset($primaryAddresses['dodaci']) ) {

            $primaryAddresses['dodaci'] = new \Sanatorium\Addresses\Models\Address;
            
        }

        View::share([ 'active' => $active ]);

        return view('sanatorium/profile::auth.profile', compact(
            'addresses', 
            'primaryAddresses',
            'orders',
            'currency',
            'user',
            'active',
            'slips'
            ));
    }

    /**
     * Handle posting of the form for the user profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processProfile()
    {
        // Store the user
        list($messages) = $this->users->auth()->profile($this->currentUser, request()->all());

        // Do we have any errors?
        if ($messages->isEmpty()) {
            $this->alerts->success(
                trans('platform/users::auth/message.success.update')
            );

            return redirect()->back();
        }

        $this->alerts->error($messages, 'form');

        return redirect()->back()->withInput();
    }

    public function addresses()
    {
        return $this->profile('addresses');
    }

    public function processAddresses()
    {
        $user = Sentinel::getUser();

        $addresses = request()->get('address');

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

        foreach( $prepared_addresses as $type => $address ) {

            if ( $address_obj = $this->addresses->where('type', $type)->where('user_id', $user->id)->first() ) {

                $this->addresses->store($address_obj->id, $address);

            } else {
            
                $this->addresses->create($address);

            }

        }

        return redirect()->back();

    }

    public function orders()
    {
        return $this->profile('orders');
    }

    public function slips()
    {
        return $this->profile('slips');
    }

}
