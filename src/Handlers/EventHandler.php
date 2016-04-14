<?php namespace Sanatorium\Profile\Handlers;

use Illuminate\Events\Dispatcher;
use Cartalyst\Sentinel\Users\UserInterface;
use Cartalyst\Sentinel\Addons\Social\Models\LinkInterface;
use Platform\Users\Handlers\EventHandler as BaseEventHandler;
use Platform\Users\Handlers\EventHandlerInterface;
use Sanatorium\Mailer\Models\Mailtransaction;
use Event;
use Cookie;

class EventHandler extends BaseEventHandler implements EventHandlerInterface
{

    /**
     * {@inheritDoc}
     */
    public function subscribe(Dispatcher $dispatcher)
    {
        $dispatcher->listen('platform.user.logged_in', __CLASS__.'@loggedIn');

        $dispatcher->listen('platform.user.logged_out', __CLASS__.'@loggedOut');

        $dispatcher->listen('platform.user.creating', __CLASS__.'@creating');
        $dispatcher->listen('platform.user.created', __CLASS__.'@created');

        $dispatcher->listen('platform.user.updating', __CLASS__.'@updating');
        $dispatcher->listen('platform.user.updated', __CLASS__.'@updated');

        $dispatcher->listen('platform.user.deleted', __CLASS__.'@deleted');

        $dispatcher->listen('platform.user.registering', __CLASS__.'@registering');
        $dispatcher->listen('platform.user.registered', __CLASS__.'@registered');

        $dispatcher->listen('platform.user.reminder', __CLASS__.'@reminder');

        $dispatcher->listen('sentinel.social.registered', __CLASS__.'@registeredSocial');
    }

    /**
     * {@inheritDoc}
     */
    public function registered(UserInterface $user)
    {
        // Assign the default role
        $this->assignDefaultRole($user);

        // Prepare the email subject
        $subject = trans('platform/users::email.subject.welcome', [
            'sitename' => $this->app['config']->get('platform.app.title'),
        ]);

        // Get the activation repository
        $activationRepository = $this->app['platform.users.activation'];

        // Cookie - invited by - @todo make loose coupling
        if ( Cookie::has('invited_by') ) {
            $invited_by = Cookie::get('invited_by');
            Event::fire('sanatorium.rewards.invited_by', [$invited_by]);
        }

        switch ($this->app['config']->get('platform-users.activation')) {
            case 'email':

                $activation = $activationRepository->create($user);

                $activationLink = $this->app['url']->route('user.activate', [$user->id, $activation->code]);

                // Find a custom email to be dispatched
                $mailtransactions = Mailtransaction::where('event', 'platform.user.registered.email')->count();

                if ( $mailtransactions > 0 ) {
                    // Custom email is set
                    $object = new \stdClass;
                    $object->user = $user;
                    $object->activationLink = $activationLink;
                    Event::fire('platform.user.registered.email', [$object]);

                } else {
                    // No custom email is set, use the default one
                    $this->getMailer()->genericUserEmail($user, $subject, 'user_welcome_inactive', compact('user', 'activationLink'));

                }

                break;

            case 'admin':

                $activation = $activationRepository->create($user);

                $activationLink = $this->app['url']->route('admin.user.edit', [$user->id]);

                // Find a custom email to be dispatched
                $mailtransactions = Mailtransaction::where('event', 'platform.user.registered.admin.touser')->count();

                if ( $mailtransactions > 0 ) {
                    // Custom email is set
                    $object = new \stdClass;
                    $object->user = $user;
                    $object->activationLink = $activationLink;
                    
                    Event::fire('platform.user.registered.admin.toadmin', [$object]);

                    Event::fire('platform.user.registered.admin.touser', [$object]);

                } else {
                    // No custom email is set, use the default one
                    $this->getMailer()->genericUserEmail($user, $subject, 'admin_welcome_inactive', compact('user'));

                    $this->getMailer()->adminApproval($user, $subject, 'admin_activate', compact('user', 'activationLink'));
                }

                break;

            default:

                // Find a custom email to be dispatched
                $mailtransactions = Mailtransaction::where('event', 'platform.user.registered.default')->count();

                if ( $mailtransactions > 0 ) {
                    // Custom email is set
                    $object = new \stdClass;
                    $object->user = $user;

                    Event::fire('platform.user.registered.default', [$object]);

                } else {
                    // No custom email is set, use the default one
                    $this->getMailer()->genericUserEmail($user, $subject, 'user_welcome', compact('user'));
                }

                break;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function registeredSocial(LinkInterface $link, $provider, $token, $slug)
    {
        $this->assignDefaultRole($link->getUser());
    }

    /**
     * {@inheritDoc}
     */
    public function reminder(UserInterface $user)
    {
        $subject = trans('platform/users::email.subject.reset-password');

        $reminder = $this->app['platform.users']->getReminderRepository()->create($user);

        $reminderLink = $this->app['url']->route('user.password_reminder.confirm', [$user->id, $reminder->code]);

        // Find a custom email to be dispatched
        $mailtransactions = Mailtransaction::where('event', 'platform.user.reminder.trigger')->count();

        if ( $mailtransactions > 0 ) {
            // Custom email is set
            $object = new \stdClass;
            $object->user = $user;
            $object->reminderLink = $reminderLink;

            Event::fire('platform.user.reminder.trigger', [$object]);
            
        } else {

            $this->getMailer()->genericUserEmail($user, $subject, 'user_password_reminder', compact('user', 'reminderLink'));
        }
    }

}
