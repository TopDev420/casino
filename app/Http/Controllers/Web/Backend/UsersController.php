<?php
namespace VanguardLTE\Http\Controllers\Web\Backend
{
    class UsersController extends \VanguardLTE\Http\Controllers\Controller
    {
        private $users = null;
        private $max_users = 10000000;
        public function __construct(\VanguardLTE\Repositories\User\UserRepository $users)
        {
            $this->middleware('auth');
            $this->middleware('permission:access.admin.panel');
            $this->users = $users;
        }
        public function index(\Illuminate\Http\Request $request)
        {
/*            $checked = new \VanguardLTE\Lib\LicenseDK();
            $license_notifications_array = $checked->aplVerifyLicenseDK(null, 0);
            if( $license_notifications_array['notification_case'] != 'notification_license_ok' )
            {
                return redirect()->route('frontend.page.error_license');
            }
            if( !$this->security() )
            {
                return redirect()->route('frontend.page.error_license');
            }*/
            $statuses = ['' => trans('app.all')] + \VanguardLTE\Support\Enum\UserStatus::lists();
            $roles = \jeremykenedy\LaravelRoles\Models\Role::where('level', '<', \Illuminate\Support\Facades\Auth::user()->level())->pluck('name', 'id');
            $roles->prepend(trans('app.all'), '0');
            $users = \VanguardLTE\User::orderBy('created_at', 'DESC');
            /*if( !auth()->user()->shop_id )
            {
                if( auth()->user()->hasRole('admin') )
                {
                    $users = $users->whereIn('role_id', [
                        4,
                        5
                    ]);
                }
                if( auth()->user()->hasRole('agent') )
                {
                    $distributors = auth()->user()->availableUsersByRole('distributor');
                    if( $distributors )
                    {
                        $users = $users->whereIn('id', $distributors);
                    }
                    else
                    {
                        $users = $users->where('id', 0);
                    }
                }
                if( auth()->user()->hasRole('distributor') )
                {
                    $managers = auth()->user()->availableUsersByRole('manager');
                    if( $managers )
                    {
                        $users = $users->whereIn('id', $managers);
                    }
                    else
                    {
                        $users = $users->where('id', 0);
                    }
                }
            }
            else
            {
                $users = $users->whereIn('id', auth()->user()->availableUsers())->whereHas('rel_shops', function($query)
                {
                    $query->where('shop_id', auth()->user()->shop_id);
                });
            }*/
            $users = $users->where('id', '!=', \Illuminate\Support\Facades\Auth::user()->id);
            if($request->username != '' ){
                $users = $users->where('username', 'like', '%' . $request->username . '%');
            }
            if($request->status != '' ){
                $users = $users->where('status', $request->status);
            }
            if($request->role ){
                $users = $users->where('role_id', $request->role);
            }
            if ($request->email != ''){
                $users = $users->where('email', 'like', '%' . $request->email . '%');
            }
            if ($request->first_name != ''){
                $users = $users->where('first_name', 'like', '%' . $request->first_name . '%');
            }
            if ($request->last_name != ''){
                $users = $users->where('last_name', 'like', '%' . $request->last_name . '%');
            }
            if ($request->birthday != ''){
                $users = $users->where('birthday', 'like', '%' . $request->birthday . '%');
            }
            if ($request->phone != ''){
                $users = $users->where('phone', 'like', '%' . $request->phone . '%');
            }
            if ($request->address != ''){
                $users = $users->where('address', 'like', '%' . $request->address . '%');
            }
            if ($request->city != ''){
                $users = $users->where('city', 'like', '%' . $request->city . '%');
            }
            if ($request->postalCode != ''){
                $users = $users->where('postalCode', 'like', '%' . $request->postalCode . '%');
            }
            $users = $users->paginate(20);
            $happyhour = \VanguardLTE\HappyHour::where([
                'shop_id' => auth()->user()->shop_id,
                'time' => date('G')
            ])->first();
            return view('backend.user.list', compact('users', 'statuses', 'roles', 'happyhour'));
        }
        public function tree(\Illuminate\Http\Request $request)
        {
            $users = \VanguardLTE\User::where('id', auth()->user()->id)->get();
            if( auth()->user()->hasRole('admin') )
            {
                $users = \VanguardLTE\User::where('role_id', 5)->get();
            }
            $role = \jeremykenedy\LaravelRoles\Models\Role::where('id', auth()->user()->role_id - 1)->first();
            return view('backend.user.tree', compact('users', 'role'));
        }
        public function view(\VanguardLTE\User $user, \VanguardLTE\Repositories\Activity\ActivityRepository $activities)
        {
            $userActivities = $activities->getLatestActivitiesForUser($user->id, 10);
            if( \Illuminate\Support\Facades\Auth::user()->role_id < $user->role_id )
            {
                return redirect()->route('backend.user.list');
            }
            return view('backend.user.view', compact('user', 'userActivities'));
        }
        public function create()
        {
            $happyhour = \VanguardLTE\HappyHour::where([
                'shop_id' => auth()->user()->shop_id,
                'time' => date('G')
            ])->first();
            $roles = \jeremykenedy\LaravelRoles\Models\Role::where('level', '<', \Illuminate\Support\Facades\Auth::user()->level())->pluck('name', 'id');
            $statuses = \VanguardLTE\Support\Enum\UserStatus::lists();
            $currencies = \VanguardLTE\Currency::pluck('currency', 'id');
            $countries = \VanguardLTE\Country::pluck('country', 'id');
            $shops = auth()->user()->shops();
            $availibleUsers = [];
            if( auth()->user()->hasRole('admin') )
            {
                $availibleUsers = \VanguardLTE\User::get();
            }
            if( auth()->user()->hasRole('agent') )
            {
                $me = \VanguardLTE\User::where('id', \Illuminate\Support\Facades\Auth::id())->get();
                $distributors = \VanguardLTE\User::where([
                    'parent_id' => auth()->user()->id,
                    'role_id' => 4
                ])->get();
                if( $shopsIds = \Illuminate\Support\Facades\Auth::user()->shops(true) )
                {
                    $users = \VanguardLTE\ShopUser::whereIn('shop_id', $shopsIds)->pluck('user_id');
                    if( $users )
                    {
                        $availibleUsers = \VanguardLTE\User::whereIn('id', $users)->whereIn('role_id', [
                            2,
                            3
                        ])->get();
                    }
                }
                $me = $me->merge($distributors);
                $availibleUsers = $me->merge($availibleUsers);
            }
            if( auth()->user()->hasRole([
                'distributor',
                'manager',
                'cashier'
            ]) )
            {
                $me = \VanguardLTE\User::where('id', \Illuminate\Support\Facades\Auth::id())->get();
                if( $shopsIds = \Illuminate\Support\Facades\Auth::user()->shops(true) )
                {
                    $users = \VanguardLTE\ShopUser::whereIn('shop_id', $shopsIds)->pluck('user_id');
                    if( $users )
                    {
                        $availibleUsers = \VanguardLTE\User::whereIn('id', $users)->whereIn('role_id', [
                            2,
                            3
                        ])->get();
                    }
                }
                $availibleUsers = $me->merge($availibleUsers);
            }
            return view('backend.user.add', compact('roles', 'statuses', 'shops', 'currencies', 'countries', 'availibleUsers', 'happyhour'));
        }
        public function store(\VanguardLTE\Http\Requests\User\CreateUserRequest $request)
        {
            // $count = \VanguardLTE\User::where([
            //     'shop_id' => \Illuminate\Support\Facades\Auth::user()->shop_id,
            //     'role_id' => 1
            // ])->count();
            // if( $request->role_id <= 3 && !$request->shop_id )
            // {
            //     return redirect()->route('backend.user.list')->withErrors([trans('app.choose_shop')]);
            // }
            $data = $request->all() + ['status' => \VanguardLTE\Support\Enum\UserStatus::ACTIVE];
            // if( trim($data['username']) == '' )
            // {
            //     $data['username'] = null;
            // }
            // if( $this->max_users <= $count && $data['role_id'] == 1 )
            // {
            //     return redirect()->route('backend.user.list')->withErrors([trans('app.max_users', ['max' => $this->max_users])]);
            // }
            // if( !$request->parent_id )
            // {
            //     $data['parent_id'] = \Illuminate\Support\Facades\Auth::user()->id;
            // }
            $data['parent_id'] = \Illuminate\Support\Facades\Auth::user()->id;
            // if( $request->balance && $request->balance > 0 )
            // {
            //     $shop = \VanguardLTE\Shop::find(\Illuminate\Support\Facades\Auth::user()->shop_id);
            //     $sum = floatval($request->balance);
            //     if( $shop->balance < $sum )
            //     {
            //         return redirect()->back()->withErrors([trans('app.not_enough_money_in_the_shop', [
            //             'name' => $shop->name,
            //             'balance' => $shop->balance
            //         ])]);
            //     }
            //     $open_shift = \VanguardLTE\OpenShift::where([
            //         'shop_id' => \Illuminate\Support\Facades\Auth::user()->shop_id,
            //         'end_date' => null
            //     ])->first();
            //     if( !$open_shift )
            //     {
            //         return redirect()->back()->withErrors([trans('app.shift_not_opened')]);
            //     }
            // }
            $role_id = (isset($data['role_id']) && $data['role_id'] < auth()->user()->role_id ? $data['role_id'] : auth()->user()->role_id - 1);
            $data['role_id'] = $role_id;
            $role = \jeremykenedy\LaravelRoles\Models\Role::find($role_id);
            // if( (auth()->user()->hasRole('distributor') && $role->slug == 'manager' || auth()->user()->hasRole('manager') && $role->slug == 'cashier') && \VanguardLTE\User::where([
            //     'role_id' => $role->id,
            //     'shop_id' => $request->shop_id
            // ])->count() )
            // {
            //     return redirect()->route('backend.user.list')->withErrors([trans('app.only_1', ['type' => $role->slug])]);
            // }
            $user = $this->users->create($data);
            $user->detachAllRoles();
            $user->attachRole($role);
            // if( $request->shop_id && $request->shop_id > 0 && !empty($request->shop_id) )
            // {
            //     \VanguardLTE\ShopUser::create([
            //         'shop_id' => $request->shop_id,
            //         'user_id' => $user->id
            //     ]);
            // }
            // if( $request->balance && $request->balance > 0 )
            // {
            //     $happyhour = \VanguardLTE\HappyHour::where([
            //         'shop_id' => auth()->user()->shop_id,
            //         'time' => date('G')
            //     ])->first();
            //     $balance = $sum;
            //     if( $happyhour )
            //     {
            //         $transactionSum = $sum * intval(str_replace('x', '', $happyhour->multiplier));
            //         $bonus = $transactionSum - $sum;
            //         $wager = $bonus * intval(str_replace('x', '', $happyhour->wager));
            //         \VanguardLTE\Transaction::create([
            //             'user_id' => $user->id,
            //             'system' => 'HH ' . $happyhour->multiplier,
            //             'summ' => $transactionSum,
            //             'shop_id' => ($user->hasRole('user') ? $user->shop_id : 0)
            //         ]);
            //         $user->increment('wager', $wager);
            //         $user->increment('bonus', $bonus);
            //         $user->increment('count_bonus', $bonus);
            //         $balance = $transactionSum;
            //     }
            //     else
            //     {
            //         \VanguardLTE\Transaction::create([
            //             'user_id' => $user->id,
            //             'payeer_id' => \Illuminate\Support\Facades\Auth::id(),
            //             'summ' => $sum,
            //             'shop_id' => auth()->user()->shop_id
            //         ]);
            //     }
            //     $user->update([
            //         'balance' => $balance,
            //         'count_balance' => $sum,
            //         'total_in' => $sum,
            //         'count_return' => \VanguardLTE\Lib\Functions::count_return($sum, $user->shop_id)
            //     ]);
            //     $shop->update(['balance' => $shop->balance - $sum]);
            //     $open_shift->increment('balance_out', abs($sum));
            //     $open_shift->increment('money_in', abs($sum));
            // }
            // if( !$user->shop_id && $user->hasRole([
            //     'cashier',
            //     'user'
            // ]) )
            // {
            //     $shops = $user->shops(true);
            //     if( count($shops) )
            //     {
            //         $shop_id = $shops->first();
            //         $user->update(['shop_id' => $shop_id]);
            //     }
            // }
            return redirect()->route('backend.user.list')->withSuccess(trans('app.user_created'));
        }
        public function edit(\Illuminate\Http\Request $request, \VanguardLTE\Repositories\Activity\ActivityRepository $activitiesRepo, \VanguardLTE\User $user)
        {
            $edit = true;
            $dateFrom = ($request->dateFrom ?: '1900-01-01');
            $dateTo = ($request->dateTo ?: '2200-12-31');
            $roles = \jeremykenedy\LaravelRoles\Models\Role::where('level', '<=', \Illuminate\Support\Facades\Auth::user()->level())->pluck('name', 'id');
            $statuses = \VanguardLTE\Support\Enum\UserStatus::lists();
            $shops = $user->shops();
            $countries = \VanguardLTE\Country::get();
            $currencies = \VanguardLTE\Currency::get();
            $userActivities = $activitiesRepo->getLatestActivitiesForUser($user->id, 50);
            $transactions = \VanguardLTE\Transaction::where([['user_id', $user->id], ['created_at', '>', $dateFrom], ['created_at', '<', $dateTo]])->orderBy('created_at', 'DESC')->get();
            $bets = \VanguardLTE\StatGame::where([['user_id', $user->id], ['date_time', '>', $dateFrom], ['date_time', '<', $dateTo]])->orderBy('id','DESC')->get();
            $apiGameBet = \VanguardLTE\UserGamesLog::select('user_games_log.*', 'api_games.name')->leftJoin('api_games','api_games.game_id','=','user_games_log.game_id')
                                                    ->where([['user_games_log.user_id', $user->id], ['user_games_log.created_at', '>', $dateFrom], ['user_games_log.created_at', '<', $dateTo], ['user_games_log.status', 'NOT_ROLLBACKED']])->orderBy('user_games_log.created_at', 'DESC')->get();

            $totalBet = $bets->sum('bet');
            $amountWin = $bets->sum('win');
            $api_game_bet = \VanguardLTE\UserGamesLog::leftJoin('api_games','api_games.game_id','=','user_games_log.game_id')
                                                        ->where([['user_games_log.user_id', $user->id], ['user_games_log.action', 'debit'], ['user_games_log.created_at', '>', $dateFrom], ['user_games_log.created_at', '<', $dateTo], ['status', 'NOT_ROLLBACKED']])->orderBy('user_games_log.created_at', 'DESC')->get();

            $totalApiGameBet = $api_game_bet->sum('amount');
            $api_game_win = \VanguardLTE\UserGamesLog::leftJoin('api_games','api_games.game_id','=','user_games_log.game_id')
                                                    ->where([['user_games_log.user_id', $user->id], ['user_games_log.action', 'credit'], ['user_games_log.created_at', '>', $dateFrom], ['user_games_log.created_at', '<', $dateTo], ['status', 'NOT_ROLLBACKED']])->orderBy('user_games_log.created_at', 'DESC')->get();

            $totalApiGameWin = $api_game_win->sum('amount');
            $winPercent = $totalBet > 0 ? round($amountWin/$totalBet * 100) : 0;

            $winApiGamePercent = $totalApiGameBet > 0 ? round($totalApiGameWin/$totalApiGameBet * 100) : 0;
            $bonus = \VanguardLTE\BonusLog::where([['user_id', $user->id], ['created_at', '>', $dateFrom], ['created_at', '<', $dateTo]])->get();
            $freespin = \VanguardLTE\WelcomePackageLog::where([['user_id', $user->id], ['created_at', '>', $dateFrom], ['started_at', '<', $dateTo]])->get();
            $users = auth()->user()->availableUsers();
            $verify = \VanguardLTE\Verify::where('user_id', $user->id)->first();

            if( count($users) && !in_array($user->id, $users) )
            {
                return redirect()->route('backend.user.list')->withErrors([trans('app.wrong_shop')]);
            }
            if( \Illuminate\Support\Facades\Auth::user()->role_id < $user->role_id )
            {
                return redirect()->route('backend.user.list');
            }
            if( $shopIds = $user->shops(true) )
            {
                $allShops = \VanguardLTE\Shop::whereIn('id', $shopIds)->get();
            }
            else
            {
                $allShops = \VanguardLTE\Shop::where('id', 0)->get();
            }
            $free_shops = [];
            foreach( $allShops as $shop )
            {
                if( !$shop->distributors_count() )
                {
                    $free_shops[$shop->id] = $shop->name;
                }
            }
            $hasActivities = $this->hasActivities($user);
            $langs = [];
            foreach( glob(resource_path() . '/lang/*', GLOB_ONLYDIR) as $fileinfo )
            {
                $dirname = basename($fileinfo);
                $langs[$dirname] = $dirname;
            }
            $date = ($request->date ?: \Carbon\Carbon::now()->format('Y-m-d'));
            $numbers = \DB::select("SELECT `game`, SUM(number) AS summ
                                    FROM `w_games_activity`
                                    WHERE `user_id` =:userID AND `number` != \"\" AND `created_at` >:dateFrom AND `created_at` <:dateTo
                                    GROUP BY game
                                    ORDER BY SUM(number) DESC LIMIT 5", [
                'userID' => $user->id,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
            ]);
            /* get user that have multi accounts */
            $multiAccounts = [];
            $multiAccountsCount = 0;
            if($user->visitor_id != '' || $user->visitor_id != NULL){
                $multiAccountsCount = \VanguardLTE\User::where('visitor_id', $user->visitor_id)->count();
                $multiAccounts = \VanguardLTE\User::where('visitor_id', $user->visitor_id)->get();
            }
            
            /* --- */
            $max_wins = \VanguardLTE\GameActivity::where('user_id', $user->id)->where('created_at', 'LIKE', $date . '%')->where('max_win', '!=', '')->groupBy('game')->orderBy('max_win', 'DESC')->take(5)->get();
            $max_bets = \VanguardLTE\GameActivity::where('user_id', $user->id)->where('created_at', 'LIKE', $date . '%')->where('max_bet', '!=', '')->groupBy('game')->orderBy('max_bet', 'DESC')->take(5)->get();
            return view('backend.user.edit', compact('edit', 'user', 'verify', 'roles', 'statuses', 'shops', 'countries', 'currencies', 'free_shops', 'userActivities', 'hasActivities', 'langs', 'max_wins', 'max_bets', 'numbers', 'transactions', 'bets', 'apiGameBet',  'bonus', 'freespin', 'multiAccountsCount', 'multiAccounts', 'totalBet', 'totalApiGameBet', 'amountWin', 'totalApiGameWin', 'winPercent', 'winApiGamePercent'));
        }
        public function updateDetails(\VanguardLTE\User $user, \VanguardLTE\Http\Requests\User\UpdateDetailsRequest $request)
        {
            $users = auth()->user()->availableUsers();
            if( count($users) && !in_array($user->id, $users) )
            {
                return redirect()->route('backend.user.list')->withErrors([trans('app.wrong_shop')]);
            }
            if( \Illuminate\Support\Facades\Auth::user()->role_id < $user->role_id )
            {
                return redirect()->route('backend.user.list');
            }
            $request->validate([
                'username' => 'required|unique:users,username,' . $user->id,
                'email' => 'nullable|unique:users,email,' . $user->id
            ]);
            $count = \VanguardLTE\User::where([
                'shop_id' => \Illuminate\Support\Facades\Auth::user()->shop_id,
                'role_id' => 1
            ])->count();
            $data = $request->all();
            if( empty($data['password']) )
            {
                unset($data['password']);
            }
            if( empty($data['password_confirmation']) )
            {
                unset($data['password_confirmation']);
            }
            if( isset($data['role_id']) && $user->role_id != $data['role_id'] && $data['role_id'] == 1 && $this->max_users <= ($count + 1) )
            {
                return redirect()->route('backend.user.list')->withErrors([trans('max_users', ['max' => $this->max_users])]);
            }
            unset($data['role_id']);
            $this->users->update($user->id, $data);
            if( $user->hasRole([
                'distributor',
                'cashier',
                'user'
            ]) && $request->shops && count($request->shops) )
            {
                foreach( $request->shops as $shop )
                {
                    \VanguardLTE\ShopUser::create([
                        'shop_id' => $shop,
                        'user_id' => $user->id
                    ]);
                }
            }
            if( $user->hasRole([
                'agent',
                'distributor'
            ]) && $request->free_shops && count($request->free_shops) )
            {
                foreach( $request->free_shops as $shop )
                {
                    \VanguardLTE\ShopUser::create([
                        'shop_id' => $shop,
                        'user_id' => $user->id
                    ]);
                }
            }
            event(new \VanguardLTE\Events\User\UpdatedByAdmin($user));
            if( $this->userIsBanned($user, $request) )
            {
                event(new \VanguardLTE\Events\User\Banned($user));
            }
            return redirect()->back()->withSuccess(trans('app.user_updated'));
        }
        public function delete(\VanguardLTE\User $user)
        {
            if( $user->id == \Illuminate\Support\Facades\Auth::id() )
            {
                return redirect()->route('backend.user.list')->withErrors(trans('app.you_cannot_delete_yourself'));
            }
            if( $user->balance > 0 )
            {
                return redirect()->route('backend.user.list')->withErrors([trans('app.balance_not_zero')]);
            }
            if( (auth()->user()->hasRole('admin') && $user->hasRole('agent') || auth()->user()->hasRole('agent') && $user->hasRole('distributor') || auth()->user()->hasRole('distributor') && $user->hasRole('manager')) && ($count = \VanguardLTE\User::where('parent_id', $user->id)->count()) )
            {
                return redirect()->route('backend.user.list')->withErrors([trans('app.has_users', ['name' => $user->username])]);
            }
            if( (auth()->user()->hasRole('admin') && $user->hasRole('agent') || auth()->user()->hasRole('agent') && $user->hasRole('distributor') || auth()->user()->hasRole('distributor') && $user->hasRole('manager') || auth()->user()->hasRole('manager') && $user->hasRole('cashier')) && $this->hasActivities($user) )
            {
                return redirect()->route('backend.user.list')->withErrors([trans('app.has_stats', ['name' => $user->username])]);
            }
            $user->detachAllRoles();
            \VanguardLTE\Transaction::where('user_id', $user->id)->delete();
            \VanguardLTE\ShopUser::where('user_id', $user->id)->delete();
            \VanguardLTE\StatGame::where('user_id', $user->id)->delete();
            \VanguardLTE\GameLog::where('user_id', $user->id)->delete();
            \VanguardLTE\UserActivity::where('user_id', $user->id)->delete();
            \VanguardLTE\Session::where('user_id', $user->id)->delete();
            \VanguardLTE\Info::where('user_id', $user->id)->delete();
            event(new \VanguardLTE\Events\User\Deleted($user));
            $user->delete();
            return redirect()->route('backend.user.list')->withSuccess(trans('app.user_deleted'));
        }
        public function hasActivities($user)
        {
            if( $user->hasRole([
                'distributor',
                'manager',
                'cashier'
            ]) )
            {
                $transactions = \VanguardLTE\Transaction::where('payeer_id', $user->id)->count();
                if( $transactions )
                {
                    return true;
                }
                $stats = \VanguardLTE\BankStat::where('user_id', $user->id)->count();
                if( $stats )
                {
                    return true;
                }
                $stats = \VanguardLTE\StatGame::where('user_id', $user->id)->count();
                if( $stats )
                {
                    return true;
                }
                $stats = \VanguardLTE\ShopStat::where('user_id', $user->id)->count();
                if( $stats )
                {
                    return true;
                }
                $open_shifts = \VanguardLTE\OpenShift::where('user_id', $user->id)->count();
                if( $open_shifts )
                {
                    return true;
                }
            }
            return false;
        }
/*        public function security()
        {
            if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' )
            {
                return false;
            }
            if( md5_file(base_path() . '/app/Lib/LicenseDK.php') != '3c5aece202a4218a19ec8c209817a74e' )
            {
                return false;
            }
            if( md5_file(base_path() . '/config/LicenseDK.php') != '951a0e23768db0531ff539d246cb99cd' )
            {
                return false;
            }
            return true;
        }*/
    }

}
namespace
{
    function onkXppk3PRSZPackRnkDOJaZ9()
    {
        return 'OkBM2iHjbd6FHZjtvLpNHOc3lslbxTJP6cqXsMdE4evvckFTgS';
    }

}
