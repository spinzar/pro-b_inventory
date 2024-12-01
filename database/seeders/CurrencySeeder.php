<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Currency data
        $currencies = [
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
        ];

        // Insert or update currencies
        foreach ($currencies as $currency) {
            Currency::updateOrCreate(
                ['name' => $currency['name']], // Match by 'name'
                ['symbol' => $currency['symbol']] // Update 'symbol' if it exists
            );
        }
    }
}
