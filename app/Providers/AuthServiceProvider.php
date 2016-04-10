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

        # Policy to grant access only to the operator
        $gate->define('is_admin', function ($user) {
            if($user->is_operator == '1'){
                return true;
            }
        });
        
        # policy to make sure that only users falling under this
        # policy has access to view the reports
        $gate->define("view_reports",function($user, $report){
            
            # only if the user is an operator
            if($user->is_operator == '1'){
                return true;
            }
            
            # Only if the report belongs to the patient
            if($user->is_operator == '0'){
                return ($user->id === $report->user_id);
            }
        });
        
        
        $this->registerPolicies($gate);

        
    }

}
