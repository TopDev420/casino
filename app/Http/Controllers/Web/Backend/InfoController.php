<?php 
namespace VanguardLTE\Http\Controllers\Web\Backend
{
    class InfoController extends \VanguardLTE\Http\Controllers\Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('permission:access.admin.panel');
            $this->middleware('permission:helpers.manage');
        }
        public function index(\Illuminate\Http\Request $request)
        {
            /*$checked = new \VanguardLTE\Lib\LicenseDK();
            $license_notifications_array = $checked->aplVerifyLicenseDK(null, 0);
            if( $license_notifications_array['notification_case'] != 'notification_license_ok' ) 
            {
                return redirect()->route('frontend.page.error_license');
            }
            if( !$this->security() ) 
            {
                return redirect()->route('frontend.page.error_license');
            }*/
            $info = \VanguardLTE\Info::get();
            if( !auth()->user()->hasRole('admin') ) 
            {
                $info = \VanguardLTE\Info::where('user_id', \Auth::id())->get();
            }
            return view('backend.info.list', compact('info'));
        }
        public function create()
        {
            $roles = [];
            return view('backend.info.add', compact('roles'));
        }
        public function store(\Illuminate\Http\Request $request)
        {
            $data = $request->only([
                'link', 
                'title', 
                'text', 
                'roles'
            ]);
            if( $data['link'] == '' ) 
            {
                unset($data['link']);
            }
            $data['roles'] = implode('|', $data['roles']);
            $info = \VanguardLTE\Info::create($data + ['user_id' => \Auth::id()]);
            if( $request->shops && count($request->shops) ) 
            {
                foreach( $request->shops as $shop ) 
                {
                    if( !empty($shop) ) 
                    {
                        \VanguardLTE\InfoShop::create([
                            'shop_id' => $shop, 
                            'info_id' => $info->id
                        ]);
                    }
                }
            }
            return redirect()->route('backend.info.list')->withSuccess(trans('app.info_created'));
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
