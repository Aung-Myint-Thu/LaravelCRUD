<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('article-delete', function($user, $article){
            return $user->id === $article->user_id;
        });

        Gate::define('article-update', function ($user, $article){
            return $user->id === $article->user_id;
        });

        Gate::define('comment-delete', function($user, $comment){
            return $user->id === $comment->user_id
            or $user->id === $comment->article->user_id;
        });

        Gate::define('comment-update', function($user, $comment){
            return $user->id === $comment->user_id
            or $user->id === $comment->article->user_id;
        });

        

        //
    }
}
