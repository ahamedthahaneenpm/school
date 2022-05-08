<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Settings\SettingsRepositoryInterface as SettingsRepository;
use App\Http\Requests\Admin\Settings\SettingsUpdateRequest;
use App\Http\Requests\Admin\Settings\SettingsViewRequest;
use App\Http\Requests\Admin\Settings\SettingsRemoveFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function view(SettingsViewRequest $request, SettingsRepository $settingsRepo)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['name' => "General Settings"]
        ];
        $settings = $settingsRepo->getAll()->keyBy('key');
        return view('admin.settings.viewSettings', compact('settings', 'breadcrumbs'));
    }

    public function save(SettingsRepository $settingsRepo, SettingsUpdateRequest $request)
    {
        $settingsRepo->update($request->all());
        return redirect()
            ->route('settings_view')
            ->with('success', 'Settings updated successfully');
    }

    public function saveGeneral(SettingsRepository $settingsRepo, SettingsUpdateRequest $request)
    {
        $saveData = $request->all();

        if ($request->hasFile('fav_icon')) {
            $favIcon = $request->file('fav_icon');
            $favIconName = 'favicon.' . $favIcon->getClientOriginalExtension();
            $favIconPath = 'app';
            $file = Storage::disk('school')->putFileAs($favIconPath, $favIcon, $favIconName);
            $saveData['fav_icon'] = $file;
        }

        if ($request->hasFile('logo_light')) {
            $logo = $request->file('logo_light');
            $logoName = 'logo_light.' . $logo->getClientOriginalExtension();
            $logoPath = 'app';
            $file = Storage::disk('school')->putFileAs($logoPath, $logo, $logoName);
            $saveData['logo_light'] = $file;
        }

        if ($request->hasFile('logo_dark')) {
            $logo = $request->file('logo_dark');
            $logoName = 'logo_dark.' . $logo->getClientOriginalExtension();
            $logoPath = 'app';
            $file = Storage::disk('school')->putFileAs($logoPath, $logo, $logoName);
            $saveData['logo_dark'] = $file;
        }

        $settingsRepo->update($saveData);
        cache()->forget('settings');
        return redirect()
            ->route('settings_view')
            ->with('success', 'Settings updated successfully');
    }

    public function removeFavicon(SettingsRemoveFileRequest $request, SettingsRepository $settingsRepo)
    {
        $favIcon = $settingsRepo->getByKey('fav_icon');
        if (Storage::disk('school')->delete($favIcon->value)) {
            $settingsRepo->resetValue($favIcon);
        }
        return redirect()
            ->route('settings_view')
            ->with('success', 'Fav icon deleted successfully');
    }

    public function removeDarkLogo(SettingsRemoveFileRequest $request, SettingsRepository $settingsRepo)
    {
        $logo = $settingsRepo->getByKey('logo_dark');
        if (Storage::disk('school')->delete($logo->value)) {
            $settingsRepo->resetValue($logo);
        }
        return redirect()
            ->route('settings_view')
            ->with('success', 'Dark logo deleted successfully');
    }

    public function removeLightLogo(SettingsRemoveFileRequest $request, SettingsRepository $settingsRepo)
    {
        $logo = $settingsRepo->getByKey('logo_light');
        if (Storage::disk('school')->delete($logo->value)) {
            $settingsRepo->resetValue($logo);
        }
        return redirect()
            ->route('settings_view')
            ->with('success', 'Light logo deleted successfully');
    }

    public function linkSave(SettingsRepository $settingsRepo, Request $request)
    {
        $saveData = $request->all();
        $settingsRepo->update($saveData);
        return redirect()
            ->route('settings_link_view')
            ->with('success', 'External Link updated successfully');
    }
}
