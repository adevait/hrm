<?php

use Illuminate\Database\Seeder;
use App\CustomField;

class CustomFieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('custom_fields')->insert([[
            'key' => 'required_skills',
            'value' => 'Which skills does the candidate need to have to meet the job requirements?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Skills',
        ],[
            'key' => 'appreciated_skills',
            'value' => 'What complementary skills are good to have for this position, but not required?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Skills',
        ],[
            'key' => 'tools',
            'value' => 'What tools/technologies does the candidate need to be familier with?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Skills',
        ],[
            'key' => 'experience',
            'value' => 'What level of expertise does the candidate need to have to be a good fit for this team?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Skills',
        ],[
            'key' => 'portfolio',
            'value' => 'What kind of portfolio projects will demonstrate the needed skill level of the candidate?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Skills',
        ],[
            'key' => 'previous_challenges',
            'value' => 'Are there any specific challenges the candidate faced, or goals they achieved in the past, that would be appreciated?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Skills',
        ],[
            'key' => 'personality',
            'value' => 'What kind of personality is valued for this position?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Attitude & Personality',
        ],[
            'key' => 'unwanted_personality',
            'value' => 'Are there any personality traits that will make the candidate unsuited for the position?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Attitude & Personality',
        ],[
            'key' => 'soft_skills',
            'value' => 'What are the most important soft skills for this position?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Attitude & Personality',
        ],[
            'key' => 'team_player',
            'value' => 'What should the candidate posses that would make them a good team member?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Attitude & Personality',
        ],[
            'key' => 'communication',
            'value' => 'What communication level is required from the candidate for this position? Will they be required to talk to shareholders and clients?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Attitude & Personality',
        ],[
            'key' => 'career_advancement',
            'value' => 'How will this position advance the career of the candidate? What skills will it help them improve/aquire?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Career & Conditions',
        ],[
            'key' => 'salary',
            'value' => 'What\'s the monthly budget for the candidate\'s salary?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Career & Conditions',
        ],[
            'key' => 'working_hours',
            'value' => 'What are the working hours?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Career & Conditions',
        ],[
            'key' => 'special_requirements',
            'value' => 'Any special requirements (meetings at specific time, availability after hours)?',
            'tagname' => 'textarea',
            'type' => CustomField::TYPE_PERSONA,
            'category' => 'Career & Conditions',
        ]]);
    }
}
