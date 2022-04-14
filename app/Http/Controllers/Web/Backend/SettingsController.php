<?php 
namespace VanguardLTE\Http\Controllers\Web\Backend
{
    class SettingsController extends \VanguardLTE\Http\Controllers\Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('permission:access.admin.panel');
            $this->middleware('shopzero');
        }
        public function general()
        {
            $shops = \VanguardLTE\Shop::get();
            $directories = [];
            foreach( glob(public_path() . '/frontend/*', GLOB_ONLYDIR) as $fileinfo ) 
            {
                $dirname = basename($fileinfo);
                $directories[$dirname] = $dirname;
            }
            return view('backend.settings.general', compact('shops', 'directories'));
        }
        public function update(\Illuminate\Http\Request $request, \VanguardLTE\Repositories\Session\SessionRepository $sessionRepository)
        {
            $this->updateSettings($request->except('_token'));
            if( $request->siteisclosed ) 
            {
                $users = \VanguardLTE\User::where('role_id', '!=', 6)->get();
                foreach( $users as $user ) 
                {
                    $sessionRepository->invalidateAllSessionsForUser($user->id);
                }
            }
            return back()->withSuccess(trans('app.settings_updated'));
        }
        private function updateSettings($input)
        {
            foreach( $input as $key => $value ) 
            {
                \Settings::set($key, $value);
            }
            \Settings::save();
            event(new \VanguardLTE\Events\Settings\Updated());
        }
    }

}
