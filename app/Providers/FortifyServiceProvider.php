<?php

namespace App\Providers;

// start: added by zc 
use Illuminate\Contracts\Auth\StatefulGuard; 
use App\Actions\Fortify\AttemptToAuthenticate; // edited by zc
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable; // edited by zc
use App\Http\Controllers\AdmonController;
use Auth;
// end: added by zc

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() // edited by zc 
    {
        $this->app->when([AdminController::class, AttemptToAuthenticate::class, 
            RedirectIfTwoFactorAuthenticatable::class])
            ->needs(StatefulGuard::class)
            ->give(function(){
                return Auth::guard('admin');
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
