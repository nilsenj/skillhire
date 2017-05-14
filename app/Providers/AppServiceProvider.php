<?php

namespace App\Providers;

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
