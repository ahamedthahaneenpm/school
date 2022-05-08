<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Setting::create(['key' => 'company_name', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'company_description', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'fav_icon', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'logo_dark', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'logo_light', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'facebook_url', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'twitter_url', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'youtube_url', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'instagram_url', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'meta_tags', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'address', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'email', 'value' => '', 'autoload' => 1]);
        Setting::create(['key' => 'phone', 'value' => '', 'autoload' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Setting::where('key', 'company_name')->delete();
        Setting::where('key', 'company_description')->delete();
        Setting::where('key', 'fav_icon')->delete();
        Setting::where('key', 'logo_dark')->delete();
        Setting::where('key', 'logo_light')->delete();
        Setting::where('key', 'facebook_url')->delete();
        Setting::where('key', 'twitter_url')->delete();
        Setting::where('key', 'youtube_url')->delete();
        Setting::where('key', 'instagram_url')->delete();
        Setting::where('key', 'meta_tags')->delete();
        Setting::where('key', 'address')->delete();
        Setting::where('key', 'email')->delete();
        Setting::where('key', 'phone')->delete();
    }
};