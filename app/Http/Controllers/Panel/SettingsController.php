<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Constants\Status;

class SettingsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('permission:settings_view');
        // $this->middleware('permission:settings_update', ['only' => ['save']]);
    }

    public function index()
    {
        $settings = Setting::get_settings();

        return view('panel.settings.listing', ['settings' => $settings]);
    }

    public function save(Request $request)
    {
        $inputs = $request->all();

        //dd($inputs);

        try{
            foreach ($inputs['settings'] as $key => $value) {

                $setting = Setting::stored()->name($key)->first();
                if (!$setting) {
                    $setting = new Setting();
                }
                $setting->name = $key;
                $setting->value = $value ?: '';
                // dd($setting);
                $setting->save();
            }

            $request->session()->flash('success', 'All settings saved successful!');

        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('error', 'Error while saving settings.' . $e->getMessage());
        }finally {
            return redirect(route('admin.panel.settings'));
        }
    }
}
