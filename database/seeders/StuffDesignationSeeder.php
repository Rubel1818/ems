<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StuffDesignation;

class StuffDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = firstOrCreate([

            // Grade 10–13
            ['designation_name_bn' => 'প্রশাসনিক কর্মকর্তা', 'designation_name_en' => 'Administrative officer'],
            ['designation_name_bn' => 'ব্যক্তিগত কর্মকর্তা', 'designation_name_en' => 'personal officer'],
            ['designation_name_bn' => 'সহকারী হিসাবরক্ষন কর্মকর্তা', 'designation_name_en' => 'Assistant Accounting Officer'],
            ['designation_name_bn' => 'হিসাবরক্ষক', 'designation_name_en' => 'Accountant'],
            ['designation_name_bn' => 'কম্পিউটার অপারেটর', 'designation_name_en' => 'Computer Operator'],
            ['designation_name_bn' => 'অফিস সহকারী', 'designation_name_en' => 'Office Assistant'],
            ['designation_name_bn' => 'অফিস সহকারী কাম কম্পিউটার মুদ্রাক্ষরিক', 'designation_name_en' => 'Office Assistant cum Computer Typist'],
            ['designation_name_bn' => 'সাঁট মুদ্রাক্ষরিক', 'designation_name_en' => 'Steno Typist'],
            ['designation_name_bn' => 'উচ্চমান সহকারী', 'designation_name_en' => 'Upper Division Assistant (UDA)'],
            ['designation_name_bn' => 'নিম্নমান সহকারী', 'designation_name_en' => 'Lower Division Assistant (LDA)'],

            // Grade 14–16
            ['designation_name_bn' => 'ডাটা এন্ট্রি অপারেটর', 'designation_name_en' => 'Data Entry Operator'],
            ['designation_name_bn' => 'অফিস সহকারী কাম ক্যাশিয়ার', 'designation_name_en' => 'Office Assistant cum Cashier'],
            ['designation_name_bn' => 'হিসাব সহকারী', 'designation_name_en' => 'Accounts Assistant'],
            ['designation_name_bn' => 'রেকর্ড কিপার', 'designation_name_en' => 'Record Keeper'],
            ['designation_name_bn' => 'লাইব্রেরি সহকারী', 'designation_name_en' => 'Library Assistant'],

            // Grade 17–20
            ['designation_name_bn' => 'অফিস পিয়ন', 'designation_name_en' => 'Office Peon'],
            ['designation_name_bn' => 'নৈশ প্রহরী', 'designation_name_en' => 'Night Guard'],
            ['designation_name_bn' => 'দপ্তরি', 'designation_name_en' => 'Doptori'],
            ['designation_name_bn' => 'এমএলএসএস', 'designation_name_en' => 'MLSS'],
            ['designation_name_bn' => 'পরিচ্ছন্নতাকর্মী', 'designation_name_en' => 'Cleaner'],
        ]);

        foreach ($designations as $designation) {
            StuffDesignation::create($designation);
        }
    }
}
