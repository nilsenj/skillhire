<?php

namespace App\Providers;

use App\Models\Contact;
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

        User::created(function(User $user) {
            $user->profile()->create([]);
            $user->contacts()->create(['skype' => $user->name.'-'.$user->id]);
            $user->additionalSettings()->create([]);
        });

        User::deleted(function(User $user) {
            $user->profile->delete();
            $user->contacts->delete();
            $user->additionalSettings->delete();
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
