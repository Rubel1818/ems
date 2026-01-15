<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = ([
            ['section_name_bn' => 'প্রশাসন শাখা', 'section_name_en' => 'Administration Section'],
            ['section_name_bn' => 'সংস্থাপন শাখা', 'section_name_en' => 'Establishment Section'],
            ['section_name_bn' => 'অর্থ শাখা', 'section_name_en' => 'Finance Section'],
            ['section_name_bn' => 'বাজেট শাখা', 'section_name_en' => 'Budget Section'],
            ['section_name_bn' => 'আইন শাখা', 'section_name_en' => 'Law Section'],
            ['section_name_bn' => 'সমন্বয় শাখা', 'section_name_en' => 'Coordination Section'],
            ['section_name_bn' => 'পরিকল্পনা শাখা', 'section_name_en' => 'Planning Section'],
            ['section_name_bn' => 'আইসিটি শাখা', 'section_name_en' => 'ICT Section'],
            ['section_name_bn' => 'প্রটোকল শাখা', 'section_name_en' => 'Protocol Section'],
            ['section_name_bn' => 'রেকর্ড শাখা', 'section_name_en' => 'Record Section'],
        ]);

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
