<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use DB;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('project-manage', function ($user, $project_id) {
            $user_id = $user->id;
            $access = DB::table('contributions')
                ->join('access_levels', 'contributions.access_id', '=', 'access_levels.id')
                ->where([
                    ['contributions.project_id', '=', $project_id],
                    ['contributions.contributor_id', '=', $user_id]
                ])
                ->select('access_levels.access AS access')
                ->get();
            if ($access->isEmpty()) {
                return false;
            } else if ($access[0]->access == 'manager') {
                return true;
            } else {
                return false;
            }
        });

        Gate::define('project-work', function ($user, $project_id) {
            $user_id = $user->id;
            $access = DB::table('contributions')
                ->join('access_levels', 'contributions.access_id', '=', 'access_levels.id')
                ->where([
                    ['contributions.project_id', '=', $project_id],
                    ['contributions.contributor_id', '=', $user_id]
                ])
                ->select('access_levels.access AS access')
                ->get();
            if ($access->isEmpty()) {
                return false;
            } else if ($access[0]->access == 'worker' || $access[0]->access == 'manager') {
                return true;
            } else {
                return false;
            }
        });
        //
    }
}
