<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailSetting;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $generalSettings = GeneralSetting::first();
        $emailSettings = EmailSetting::first();
        $logoSetting = LogoSetting::first();

        return view('admin.setting.index', compact('generalSettings','emailSettings','logoSetting'));
    }


    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'max:200'],
            'contact_email' => ['required', 'max:200'],
            'contact_phone' => ['required', 'max:200'],
            'contact_address' => ['required', 'max:200'],
            'link_fb' => ['required', 'max:200'],
            'link_insta' => ['required', 'max:200'],
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'email' => $request->contact_email,
                'phone' => $request->contact_phone,
                'contact_address' => $request->contact_address,
                'fb' => $request->link_fb,
                'insta' => $request->link_insta,
            ]
        );

        toastr('Updated successfully!', 'success');

        return redirect()->back();

    }

    public function emailConfigSettingUpdate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'host' => ['required', 'max:200'],
            'username' => ['required', 'max:200'],
            'password' => ['required', 'max:200'],
            'port' => ['required', 'max:200'],
            'encryption' => ['required', 'max:200'],
        ]);

         EmailSetting::updateOrCreate(
            ['id' => 1],
            [
                'email' => $request->email,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
                'encryption' => $request->encryption,
            ]
        );

        toastr('Updates successfully!', 'success');
        return redirect()->back();
    }

    public function logoSettingUpdate(Request $request)
    {
        $request->validate([
            'logo' => ['image', 'max:3000'],
            'favicon' => ['image', 'max:3000'],
        ]);

        $logoPath = $this->updateImage($request, 'logo', 'uploads', $request->old_logo);
        $favicon = $this->updateImage($request, 'favicon', 'uploads', $request->old_favicon);

        LogoSetting::updateOrCreate(
            ['id' => 1],
            [
                'logo' =>  (!empty($logoPath)) ? $logoPath : $request->old_logo,
                'favicon' => (!empty($favicon)) ? $favicon : $request->old_favicon
            ]
        );

        toastr('Updated successfully!', 'success');

        return redirect()->back();
    }

}
