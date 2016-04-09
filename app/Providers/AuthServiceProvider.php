<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate) {

        // ACL for only operators
        $gate->define('is_admin', function ($user) {
            if($user->is_operator == '1'){
                return true;
            }
        });
        
        $gate->define("view_reports",function($user, $report){
            if($user->is_operator == '1'){
                return true;
            }
            
            if($user->is_operator == '0'){
                return ($user->id === $report->user_id);
            }
        });
        $this->registerPolicies($gate);

        
    }

}
