<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User'         => 'App\Policies\UserPolicy',
        'App\Mailbox'      => 'App\Policies\MailboxPolicy',
        'App\Folder'       => 'App\Policies\FolderPolicy',
        'App\Conversation' => 'App\Policies\ConversationPolicy',
        'App\Thread'       => 'App\Policies\ThreadPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
