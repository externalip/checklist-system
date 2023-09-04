<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = [
            '5S Start-Up Check Sheet',
            'P-Touch Soldering',
            'P-Touch ICT',
            'FFC',
            'SMT',
        ];
        $data = '{"form_name":"5S Start-Up Check Sheet","form_content":{"section1":{"section_name":"Type of Checking","section_type":"question","section_content":{"question1":{"label":"Type of Checking","instruction":"Select a type of checking","type":"radio","required":true,"options":{"ans1":"Start-up","ans2":"Re-startup","ans3":"Change Model"}}}},"section2":{"section_name":"Checking Items","section_type":"question","section_content":{"question1":{"label":"Production Checksheet","instruction":"Is it the correct checksheet corresponding to the lot? Are all information required to fill up are correct and complete? Is it the correct checksheet corresponding to the lot?","type":"radio","required":true,"options":{"ans1":"OK","ans2":"NG","ans3":"NA"}},"question2":{"label":"Procedures\/OPL\/Work Instructions","instruction":"Are all SOP\/OPL\/ WORK INSTRUCTION posted properly according to correct model running? Are all visual aid required on the stations present? Are all visible, accessible and easy to open in case posted in area only? Are all SOP\/OPL\/WORK INSTRUCTION has complete signatories, complete pages and were issued by DOC?","type":"radio","required":true,"options":{"ans1":"OK","ans2":"NG","ans3":"NA"}},"question3":{"label":"Working Area","instruction":"Is the work area clean and free from any items not required on station? Is the work set-up are defined and labelled? Are tools, jigs, supplies located on defined areas? Are the tray slots for WIP units in GOOD condition? Are grounding wires on working tables connected? Are grounding strap properly worn in the working area?","type":"radio","required":true,"options":{"ans1":"OK","ans2":"NG","ans3":"NA"}},"question4":{"label":"Materials","instruction":"Are the materials correct? Is the validity date\/ manufacturing date expiry per standard? Are these place and label on defined control area? Are tool, jigs, supplies localed on defined areas? Are the wip products store on place required by standard? In case of Change Model, there should no wip on the working table as well as NG \/ For Rework units on reject bins.","type":"radio","required":true,"options":{"ans1":"OK","ans2":"NG","ans3":"NA"}},"question5":{"label":"Tools\/Jigs Instrument","instruction":"Are correct tools\/ jigs \/ instruments used as per standard? Are tools \/ jig in good condition? Are tools \/ jig calibration not expired? Arecalibration validity of instruments within standard? Are inspection jigs\/tyemplates used is not worn out? Are ground strap already worn out? Are instruments\/machine wires are properly harnessed?","type":"radio","required":true,"options":{"ans1":"OK","ans2":"NG","ans3":"NA"}}}}}}';

        for ($i = 0; $i < 5; $i++) {
            DB::table('forms')->insert([
                'form_name' => $forms[$i],
                'completed' => random_int(0, 1),
                'created_by' => $i + 1,
                'form_data' => $data,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
