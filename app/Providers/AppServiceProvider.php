<?php

namespace App\Providers;

use App\Models\Profile;
use App\Models\User;
use App\Models\UserSkillCounter;
use Illuminate\Support\ServiceProvider;
use TagsCloud\Tagging\Model\UserTagged;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        User::created(function($user) {
            Profile::create(['user_id' => $user->id]);
        });

        User::deleted(function(User $user) {
            $user->profile->delete();
        });

        UserTagged::created(function($tagged) {
            UserSkillCounter::create(['tagged_id' => $tagged->id, 'counter' => '1']);
        });

        UserTagged::deleted(function($tagged) {
            $item = UserSkillCounter::where('tagged_id', $tagged->id);
            if($item->count()) {
                $item->destroy();
            }
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
