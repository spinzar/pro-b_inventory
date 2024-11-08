<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use App\Models\Brand;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Setting;
use App\Models\Business;
use App\Models\Currency;
use App\Models\Warehouse;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Models\AccountGroup;
use App\Models\JournalEntry;
use Illuminate\Database\Seeder;
use App\Models\MaterialCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Currency::insert([
            ['name' => 'Indonesian Rupiah', 'symbol' => 'Rp'],
            ['name' => 'US Dollar', 'symbol' => '$'],
            ['name' => 'Euro', 'symbol' => '€'],
            ['name' => 'British Pound', 'symbol' => '£'],
            ['name' => 'Japanese Yen', 'symbol' => '¥'],
            ['name' => 'Australian Dollar', 'symbol' => 'A$'],
            ['name' => 'Canadian Dollar', 'symbol' => 'C$'],
            ['name' => 'Swiss Franc', 'symbol' => 'CHF'],
            ['name' => 'Chinese Yuan', 'symbol' => '¥'],
            ['name' => 'Indian Rupee', 'symbol' => '₹'],
            ['name' => 'Mexican Peso', 'symbol' => 'MX$'],
            ['name' => 'Brazilian Real', 'symbol' => 'R$'],
            ['name' => 'South African Rand', 'symbol' => 'R'],
            ['name' => 'Russian Ruble', 'symbol' => '₽'],
            ['name' => 'South Korean Won', 'symbol' => '₩'],
            ['name' => 'Turkish Lira', 'symbol' => '₺'],
            ['name' => 'Singapore Dollar', 'symbol' => 'S$'],
            ['name' => 'Malaysian Ringgit', 'symbol' => 'RM'],
            ['name' => 'Philippine Peso', 'symbol' => '₱'],
            ['name' => 'Thai Baht', 'symbol' => '฿'],
            ['name' => 'Vietnamese Dong', 'symbol' => '₫'],
            ['name' => 'Saudi Riyal', 'symbol' => '﷼'],
            ['name' => 'United Arab Emirates Dirham', 'symbol' => 'د.إ'],
            ['name' => 'Hong Kong Dollar', 'symbol' => 'HK$'],
            ['name' => 'New Zealand Dollar', 'symbol' => 'NZ$'],
            ['name' => 'Norwegian Krone', 'symbol' => 'kr'],
            ['name' => 'Swedish Krona', 'symbol' => 'kr'],
            ['name' => 'Danish Krone', 'symbol' => 'kr'],
            ['name' => 'Egyptian Pound', 'symbol' => 'E£'],
            ['name' => 'Bangladeshi Taka', 'symbol' => '৳'],
            ['name' => 'Pakistani Rupee', 'symbol' => '₨'],
            ['name' => 'Sri Lankan Rupee', 'symbol' => 'Rs'],
            ['name' => 'Chilean Peso', 'symbol' => 'CLP$'],
            ['name' => 'Peruvian Sol', 'symbol' => 'S/'],
            ['name' => 'Colombian Peso', 'symbol' => 'COP$'],
            ['name' => 'Argentine Peso', 'symbol' => 'ARS$'],
            ['name' => 'Kuwaiti Dinar', 'symbol' => 'KD'],
            ['name' => 'Qatari Riyal', 'symbol' => 'QR'],
            ['name' => 'Omani Rial', 'symbol' => '﷼'],
        ]);

        Setting::insert([
            [
                'app_name' => 'Pro-B',
                'company_name' => 'PT Kebon Agung',
                'company_phone' => '021-12345678',
                'company_email' => 'info@kebonagung.com',
                'company_street' => 'Jl. Raya Kebon Agung No.1',
                'company_city_and_province' => 'Malang, Jawa Timur',
                'company_country' => 'Indonesia',
                'currency_id' => 1,
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
            ["name" => Str::title(str_replace('_', ' ', 'warehouse_list')), "route" => "warehouse.index"],
            ["name" => Str::title(str_replace('_', ' ', 'create_warehouse')), "route" => "warehouse.create"],
            ["name" => Str::title(str_replace('_', ' ', 'save_warehouse')), "route" => "warehouse.store"],
            ["name" => Str::title(str_replace('_', ' ', 'edit_warehouse')), "route" => "warehouse.edit"],
            ["name" => Str::title(str_replace('_', ' ', 'update_warehouse')), "route" => "warehouse.update"],
            ["name" => Str::title(str_replace('_', ' ', 'delete_warehouse')), "route" => "warehouse.destroy"],
            ["name" => Str::title(str_replace('_', ' ', 'unit_list')), "route" => "unit.index"],
            ["name" => Str::title(str_replace('_', ' ', 'create_unit')), "route" => "unit.create"],
            ["name" => Str::title(str_replace('_', ' ', 'save_unit')), "route" => "unit.store"],
            ["name" => Str::title(str_replace('_', ' ', 'edit_unit')), "route" => "unit.edit"],
            ["name" => Str::title(str_replace('_', ' ', 'update_unit')), "route" => "unit.update"],
            ["name" => Str::title(str_replace('_', ' ', 'delete_unit')), "route" => "unit.destroy"],
            ["name" => Str::title(str_replace('_', ' ', 'brand_list')), "route" => "brand.index"],
            ["name" => Str::title(str_replace('_', ' ', 'create_brand')), "route" => "brand.create"],
            ["name" => Str::title(str_replace('_', ' ', 'save_brand')), "route" => "brand.store"],
            ["name" => Str::title(str_replace('_', ' ', 'edit_brand')), "route" => "brand.edit"],
            ["name" => Str::title(str_replace('_', ' ', 'update_brand')), "route" => "brand.update"],
            ["name" => Str::title(str_replace('_', ' ', 'delete_brand')), "route" => "brand.destroy"],
            ["name" => Str::title(str_replace('_', ' ', 'material_category_list')), "route" => "material_category.index"],
            ["name" => Str::title(str_replace('_', ' ', 'create_material_category')), "route" => "material_category.create"],
            ["name" => Str::title(str_replace('_', ' ', 'save_material_category')), "route" => "material_category.store"],
            ["name" => Str::title(str_replace('_', ' ', 'edit_material_category')), "route" => "material_category.edit"],
            ["name" => Str::title(str_replace('_', ' ', 'update_material_category')), "route" => "material_category.update"],
            ["name" => Str::title(str_replace('_', ' ', 'delete_material_category')), "route" => "material_category.destroy"],
            ["name" => Str::title(str_replace('_', ' ', 'business_list')), "route" => "business.index"],
            ["name" => Str::title(str_replace('_', ' ', 'create_business')), "route" => "business.create"],
            ["name" => Str::title(str_replace('_', ' ', 'save_business')), "route" => "business.store"],
            ["name" => Str::title(str_replace('_', ' ', 'edit_business')), "route" => "business.edit"],
            ["name" => Str::title(str_replace('_', ' ', 'update_business')), "route" => "business.update"],
            ["name" => Str::title(str_replace('_', ' ', 'delete_business')), "route" => "business.destroy"],
            ["name" => Str::title(str_replace('_', ' ', 'material_list')), "route" => "material.index"],
            ["name" => Str::title(str_replace('_', ' ', 'create_material')), "route" => "material.create"],
            ["name" => Str::title(str_replace('_', ' ', 'save_material')), "route" => "material.store"],
            ["name" => Str::title(str_replace('_', ' ', 'edit_material')), "route" => "material.edit"],
            ["name" => Str::title(str_replace('_', ' ', 'update_material')), "route" => "material.update"],
            ["name" => Str::title(str_replace('_', ' ', 'delete_material')), "route" => "material.destroy"],
            ["name" => Str::title(str_replace('_', ' ', 'supplier_list')), "route" => "supplier.index"],
            ["name" => Str::title(str_replace('_', ' ', 'create_supplier')), "route" => "supplier.create"],
            ["name" => Str::title(str_replace('_', ' ', 'save_supplier')), "route" => "supplier.store"],
            ["name" => Str::title(str_replace('_', ' ', 'edit_supplier')), "route" => "supplier.edit"],
            ["name" => Str::title(str_replace('_', ' ', 'update_supplier')), "route" => "supplier.update"],
            ["name" => Str::title(str_replace('_', ' ', 'delete_supplier')), "route" => "supplier.destroy"],
        ]);

        $menus = Menu::select(['id'])->orderBy('id')->get();
        foreach($menus as $menu){
            Permission::insert(['menu_id' => $menu->id, 'role_id' => 1]);
        }

        Warehouse::insert([
            ["name" => "Main Warehouse"],
            ["name" => "Secondary Warehouse"],
            ["name" => "Spare Parts Storage"],
        ]);

        Unit::insert([
            ["name" => "Box", "symbol" => "box"],
            ["name" => "Pack", "symbol" => "pack"],
            ["name" => "Pieces", "symbol" => "pcs"],
            ["name" => "Ton", "symbol" => "ton"],
            ["name" => "Kuintal", "symbol" => "ku"],
            ["name" => "Kilogram", "symbol" => "kg"],
            ["name" => "Hectoliter", "symbol" => "hL"],
            ["name" => "Liter", "symbol" => "L"],
            ["name" => "Mililiter", "symbol" => "mL"],
            ["name" => "Kilometer", "symbol" => "km"],
            ["name" => "Meter", "symbol" => "m"],
            ["name" => "Centimeter", "symbol" => "cm"],
        ]);

        MaterialCategory::insert([
            ["name" => "Raw Materials"],
            ["name" => "Finished Goods"],
            ["name" => "Consumables"],
        ]);

        Brand::insert([
            ["name" => "Brand A"],
            ["name" => "Brand B"],
            ["name" => "Brand C"],
        ]);

        Business::insert([
            ["name" => "Pabrik"],
            ["name" => "Importir"],
            ["name" => "Penjual Partai"],
            ["name" => "Penjual Eceran"],
            ["name" => "Toko Online"],
        ]);

    }
}
