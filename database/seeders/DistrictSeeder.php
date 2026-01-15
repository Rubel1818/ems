<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = ([
            ['district_name_bn' => 'ঢাকা', 'district_name_en' => 'Dhaka'],
            ['district_name_bn' => 'গাজীপুর', 'district_name_en' => 'Gazipur'],
            ['district_name_bn' => 'নারায়ণগঞ্জ', 'district_name_en' => 'Narayanganj'],
            ['district_name_bn' => 'নরসিংদী', 'district_name_en' => 'Narsingdi'],
            ['district_name_bn' => 'মুন্সিগঞ্জ', 'district_name_en' => 'Munshiganj'],
            ['district_name_bn' => 'মানিকগঞ্জ', 'district_name_en' => 'Manikganj'],
            ['district_name_bn' => 'টাঙ্গাইল', 'district_name_en' => 'Tangail'],
            ['district_name_bn' => 'কিশোরগঞ্জ', 'district_name_en' => 'Kishoreganj'],

            ['district_name_bn' => 'চট্টগ্রাম', 'district_name_en' => 'Chattogram'],
            ['district_name_bn' => 'কক্সবাজার', 'district_name_en' => 'Cox\'s Bazar'],
            ['district_name_bn' => 'কুমিল্লা', 'district_name_en' => 'Cumilla'],
            ['district_name_bn' => 'ফেনী', 'district_name_en' => 'Feni'],
            ['district_name_bn' => 'ব্রাহ্মণবাড়িয়া', 'district_name_en' => 'Brahmanbaria'],
            ['district_name_bn' => 'নোয়াখালী', 'district_name_en' => 'Noakhali'],
            ['district_name_bn' => 'চাঁদপুর', 'district_name_en' => 'Chandpur'],
            ['district_name_bn' => 'লক্ষ্মীপুর', 'district_name_en' => 'Lakshmipur'],
            ['district_name_bn' => 'খাগড়াছড়ি', 'district_name_en' => 'Khagrachari'],
            ['district_name_bn' => 'রাঙ্গামাটি', 'district_name_en' => 'Rangamati'],
            ['district_name_bn' => 'বান্দরবান', 'district_name_en' => 'Bandarban'],

            ['district_name_bn' => 'রাজশাহী', 'district_name_en' => 'Rajshahi'],
            ['district_name_bn' => 'নাটোর', 'district_name_en' => 'Natore'],
            ['district_name_bn' => 'নওগাঁ', 'district_name_en' => 'Naogaon'],
            ['district_name_bn' => 'চাঁপাইনবাবগঞ্জ', 'district_name_en' => 'Chapainawabganj'],
            ['district_name_bn' => 'পাবনা', 'district_name_en' => 'Pabna'],
            ['district_name_bn' => 'সিরাজগঞ্জ', 'district_name_en' => 'Sirajganj'],
            ['district_name_bn' => 'বগুড়া', 'district_name_en' => 'Bogura'],
            ['district_name_bn' => 'জয়পুরহাট', 'district_name_en' => 'Joypurhat'],

            ['district_name_bn' => 'খুলনা', 'district_name_en' => 'Khulna'],
            ['district_name_bn' => 'যশোর', 'district_name_en' => 'Jashore'],
            ['district_name_bn' => 'সাতক্ষীরা', 'district_name_en' => 'Satkhira'],
            ['district_name_bn' => 'ঝিনাইদহ', 'district_name_en' => 'Jhenaidah'],
            ['district_name_bn' => 'মাগুরা', 'district_name_en' => 'Magura'],
            ['district_name_bn' => 'নড়াইল', 'district_name_en' => 'Narail'],
            ['district_name_bn' => 'বাগেরহাট', 'district_name_en' => 'Bagerhat'],
            ['district_name_bn' => 'কুষ্টিয়া', 'district_name_en' => 'Kushtia'],
            ['district_name_bn' => 'চুয়াডাঙ্গা', 'district_name_en' => 'Chuadanga'],
            ['district_name_bn' => 'মেহেরপুর', 'district_name_en' => 'Meherpur'],

            ['district_name_bn' => 'বরিশাল', 'district_name_en' => 'Barishal'],
            ['district_name_bn' => 'পটুয়াখালী', 'district_name_en' => 'Patuakhali'],
            ['district_name_bn' => 'ভোলা', 'district_name_en' => 'Bhola'],
            ['district_name_bn' => 'ঝালকাঠি', 'district_name_en' => 'Jhalokathi'],
            ['district_name_bn' => 'পিরোজপুর', 'district_name_en' => 'Pirojpur'],
            ['district_name_bn' => 'বরগুনা', 'district_name_en' => 'Barguna'],

            ['district_name_bn' => 'সিলেট', 'district_name_en' => 'Sylhet'],
            ['district_name_bn' => 'মৌলভীবাজার', 'district_name_en' => 'Moulvibazar'],
            ['district_name_bn' => 'হবিগঞ্জ', 'district_name_en' => 'Habiganj'],
            ['district_name_bn' => 'সুনামগঞ্জ', 'district_name_en' => 'Sunamganj'],

            ['district_name_bn' => 'রংপুর', 'district_name_en' => 'Rangpur'],
            ['district_name_bn' => 'দিনাজপুর', 'district_name_en' => 'Dinajpur'],
            ['district_name_bn' => 'কুড়িগ্রাম', 'district_name_en' => 'Kurigram'],
            ['district_name_bn' => 'লালমনিরহাট', 'district_name_en' => 'Lalmonirhat'],
            ['district_name_bn' => 'নীলফামারী', 'district_name_en' => 'Nilphamari'],
            ['district_name_bn' => 'পঞ্চগড়', 'district_name_en' => 'Panchagarh'],
            ['district_name_bn' => 'ঠাকুরগাঁও', 'district_name_en' => 'Thakurgaon'],
            ['district_name_bn' => 'গাইবান্ধা', 'district_name_en' => 'Gaibandha'],

            ['district_name_bn' => 'ময়মনসিংহ', 'district_name_en' => 'Mymensingh'],
            ['district_name_bn' => 'জামালপুর', 'district_name_en' => 'Jamalpur'],
            ['district_name_bn' => 'শেরপুর', 'district_name_en' => 'Sherpur'],
            ['district_name_bn' => 'নেত্রকোনা', 'district_name_en' => 'Netrokona'],
        ]);

        foreach ($districts as $district) {
            District::create($district);
        }
    }
}
