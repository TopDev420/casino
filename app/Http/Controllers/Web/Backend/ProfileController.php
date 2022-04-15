<?php 
namespace VanguardLTE\Http\Controllers\Web\Backend
{
    class ProfileController extends \VanguardLTE\Http\Controllers\Controller
    {
        protected $theUser = null;
        private $users = null;
        public function __construct(\VanguardLTE\Repositories\User\UserRepository $users)
        {
            $this->middleware('auth');
            $this->middleware('session.database', [
                'only' => [
                    'sessions', 
                    'invalidateSession'
                ]
            ]);
            $this->middleware('permission:access.admin.panel');
            $this->users = $users;
            $this->middleware(function($request, $next)
            {
                $this->theUser = \Auth::user();
                return $next($request);
            });
        }
        public function index(\VanguardLTE\Repositories\Role\RoleRepository $rolesRepo)
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
            $user = $this->theUser;
            $edit = true;
            $roles = $rolesRepo->lists();
            $statuses = \VanguardLTE\Support\Enum\UserStatus::lists();
            $shops = \Auth::User()->shops();
            $allShops = \VanguardLTE\Shop::get();
            $free_shops = [];
            foreach( $allShops as $shop ) 
            {
                if( !$shop->distributors_count() ) 
                {
                    $free_shops[$shop->id] = $shop->name;
                }
            }
            return view('backend.user.profile', compact('user', 'edit', 'roles', 'statuses', 'shops', 'free_shops'));
        }
        public function updateDetails(\VanguardLTE\Http\Requests\User\UpdateProfileDetailsRequest $request)
        {
            $this->users->update($this->theUser->id, $request->except('role_id', 'status', 'shops'));
            event(new \VanguardLTE\Events\User\UpdatedProfileDetails());
            return redirect()->back()->withSuccess(trans('app.profile_updated_successfully'));
        }
    }

}
namespace 
{
    function onkXppk3PRSZPackRnkDOJaZ9()
    {
        return 'OkBM2iHjbd6FHZjtvLpNHOc3lslbxTJP6cqXsMdE4evvckFTgS';
    }

}
