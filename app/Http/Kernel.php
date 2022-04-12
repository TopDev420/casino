<?php

namespace VanguardLTE\Http {

    use Illuminate\Console\Scheduling\Schedule;
    use Carbon\Carbon;
    use VanguardLTE\Http\Controllers\Web\Frontend\Auth\AuthController;

    class Kernel extends \Illuminate\Foundation\Http\Kernel
    {
        protected $middleware = [
            'Fruitcake\Cors\HandleCors',
            'VanguardLTE\Http\Middleware\VerifyInstallation',
            'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
            'VanguardLTE\Http\Middleware\TrimStrings',
            'Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull',
            'VanguardLTE\Http\Middleware\TrustProxies',
        ];
        protected $middlewareGroups = [
            'web' => [
                'VanguardLTE\Http\Middleware\EncryptCookies',
                'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
                'Illuminate\Session\Middleware\StartSession',
                'Illuminate\View\Middleware\ShareErrorsFromSession',
                'VanguardLTE\Http\Middleware\VerifyCsrfToken',
                'Illuminate\Routing\Middleware\SubstituteBindings',
                'VanguardLTE\Http\Middleware\SelectLanguage'
            ],
            'api' => [
                'VanguardLTE\Http\Middleware\UseApiGuard',
                'throttle:60,1',
                'bindings'
            ]
        ];
        protected $routeMiddleware = [
            'auth' => 'VanguardLTE\Http\Middleware\Authenticate',
            'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
            'guest' => 'VanguardLTE\Http\Middleware\RedirectIfAuthenticated',
            'registration' => 'VanguardLTE\Http\Middleware\Registration',
            'session.database' => 'VanguardLTE\Http\Middleware\DatabaseSession',
            'bindings' => 'Illuminate\Routing\Middleware\SubstituteBindings',
            'throttle' => 'Illuminate\Routing\Middleware\ThrottleRequests',
            'cache.headers' => 'Illuminate\Http\Middleware\SetCacheHeaders',
            'role' => 'jeremykenedy\LaravelRoles\App\Http\Middleware\VerifyRole',
            'permission' => 'jeremykenedy\LaravelRoles\App\Http\Middleware\VerifyPermission',
            'level' => 'jeremykenedy\LaravelRoles\App\Http\Middleware\VerifyLevel',
            'ipcheck' => 'VanguardLTE\Http\Middleware\IpMiddleware',
            'siteisclosed' => 'VanguardLTE\Http\Middleware\SiteIsClosed',
            'localization' => 'VanguardLTE\Http\Middleware\SelectLanguage',
            'shopzero' => 'VanguardLTE\Http\Middleware\ShopZero',
        ];

        protected function schedule(Schedule $schedule)
        {
            $schedule->call(function () {
                $users = \VanguardLTE\WelcomePackageLog::leftJoin('users', 'users.id', '=', 'user_id')
                    ->where([['game_id', '975'], ['started_at', '>=', Carbon::yesterday()->toDateString()]])
                    ->orderBy('user_id', 'DESC')
                    ->select('user_id', 'users.username', 'users.phone')->get();
                foreach ($users as $user) {
                    $message = "Hello, this is Ann from Canada777, we saw that you did not take advantage of all  your 100 free spins, click on the following link https://canada777.com/game/BookOfTombGM/realgo";
                    AuthController::sendSMS($user->phone, $message);
                }
            })->everyMinute();
        }
    }
}
