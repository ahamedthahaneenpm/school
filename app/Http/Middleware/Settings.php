<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Settings\SettingsRepositoryInterface as SettingsRepository;

class Settings
{
    protected $settingsRepo;

    public function __construct(SettingsRepository $settingsRepo)
    {
        $this->settingsRepo = $settingsRepo;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Load general settings to cache and remains for 5 min
         */
        // $settings = cache()->remember('settings', 300, function () {
        //     try {
        //         $settingsArray = $this->settingsRepo->autoLoad()->pluck('value', 'key')->toArray();
        //     } catch (\Exception $e) {
        //         $settingsArray = [];
        //     }
        //     return $settingsArray;
        // });
        // config()->set('settings', $settings);

        return $next($request);
    }
}