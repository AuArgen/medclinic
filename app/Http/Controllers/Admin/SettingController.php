<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-settings');
        $settings = [
            'site_name' => Setting::get('site_name', 'MedClinic'),
            'site_logo' => Setting::get('site_logo'),
        ];
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        Gate::authorize('manage-settings');

        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        Setting::set('site_name', $request->site_name);

        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $imagePath = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $imagePath);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Жөндөөлөр ийгиликтүү жаңыртылды!');
    }
}
