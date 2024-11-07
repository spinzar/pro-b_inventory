<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Models\AccountGroup;
use App\Models\JournalEntry;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Setting::insert([
            [
                'app_name' => 'Pro-B',
                'company_name' => 'PT Kebon Agung',
                'company_phone' => '021-12345678',
                'company_email' => 'info@kebonagung.com',
                'company_street' => 'Jl. Raya Kebon Agung No.1',
                'company_city_and_province' => 'Malang, Jawa Timur',
                'company_country' => 'Indonesia',
                // 'currency_id' => 1,
                'thousand_separator' => '.',
                'decimal_separator' => ',',
                'locale_string' => 'id-ID',
            ]
        ]);

        Role::insert([
            ["name" => ucwords(str_replace('_', ' ', 'admin'))],
            ["name" => ucwords(str_replace('_', ' ', 'user'))],
        ]);

        User::insert([
            ["name" => ucwords(str_replace('_', ' ', 'admin')), "email" => "admin@gmail.com", "password" => bcrypt("admin"), "is_active" => 1, "role_id" => 1],
            ["name" => ucwords(str_replace('_', ' ', 'user')), "email" => "user@gmail.com", "password" => bcrypt("user"), "is_active" => 1, "role_id" => 2],
        ]);

        Menu::insert([
            ["name" => Str::title(str_replace('_', ' ', 'dashboard')), "route" => "dashboard"],
            ["name" => Str::title(str_replace('_', ' ', 'view_setting')), "route" => "setting.index"],
            ["name" => Str::title(str_replace('_', ' ', 'save_setting')), "route" => "setting.store"],
            ["name" => Str::title(str_replace('_', ' ', 'role_list')), "route" => "role.index"],
            ["name" => Str::title(str_replace('_', ' ', 'create_role')), "route" => "role.create"],
            ["name" => Str::title(str_replace('_', ' ', 'save_role')), "route" => "role.store"],
            ["name" => Str::title(str_replace('_', ' ', 'edit_role')), "route" => "role.edit"],
            ["name" => Str::title(str_replace('_', ' ', 'update_role')), "route" => "role.update"],
            ["name" => Str::title(str_replace('_', ' ', 'delete_role')), "route" => "role.destroy"],
            ["name" => Str::title(str_replace('_', ' ', 'user_list')), "route" => "user.index"],
            ["name" => Str::title(str_replace('_', ' ', 'create_user')), "route" => "user.create"],
            ["name" => Str::title(str_replace('_', ' ', 'save_user')), "route" => "user.store"],
            ["name" => Str::title(str_replace('_', ' ', 'edit_user')), "route" => "user.edit"],
            ["name" => Str::title(str_replace('_', ' ', 'update_user')), "route" => "user.update"],
            ["name" => Str::title(str_replace('_', ' ', 'delete_user')), "route" => "user.destroy"],
            ["name" => Str::title(str_replace('_', ' ', 'activity_log_list')), "route" => "activity_log.index"],
        ]);

        $menus = Menu::select(['id'])->orderBy('id')->get();
        foreach($menus as $menu){
            Permission::insert(['menu_id' => $menu->id, 'role_id' => 1]);
        }


    }
}
