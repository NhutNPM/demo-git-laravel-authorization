<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Module;
use App\Models\User;
use App\Models\Group;
use App\Models\Post;

use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Policies\GroupPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
        Group::class => GroupPolicy::class,
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
        $moduleList = Module::all();
        if ($moduleList->count() > 0)
            foreach ($moduleList as $module) {
                // echo $module->name . '<br>';
                Gate::define($module->name, function (User $user) use ($module) {
                    $roleJson = $user->group->permission;
                    // dd($roleJson);
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        // dd($roleArr);
                        $check = isRole($roleArr, $module->name);
                        return $check;
                    }
                    return false;
                });
                // Gate update
                Gate::define($module->name . '.add', function (User $user) use ($module) {
                    $roleJson = $user->group->permission;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name, 'add');
                        return $check;
                    }
                    return false;
                });
                // Gate update
                Gate::define($module->name . '.edit', function (User $user) use ($module) {
                    $roleJson = $user->group->permission;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name, 'edit');
                        return $check;
                    }
                    return false;
                });
                // Gate delete
                Gate::define($module->name . '.delete', function (User $user) use ($module) {
                    $roleJson = $user->group->permission;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name, 'delete');
                        return $check;
                    }
                    return false;
                });
                // Gate permission
                Gate::define($module->name . '.permission', function (User $user) use ($module) {
                    // dd($module->name);
                    $roleJson = $user->group->permission;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name, 'permission');
                        // dd($check);
                        return $check;
                    }
                    return false;
                });
            }

        // dd($moduleList);
    }
}
