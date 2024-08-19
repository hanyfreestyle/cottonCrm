<?php

namespace App\AppPlugin\Leads\ContactUs;

use App\AppPlugin\Data\Country\Country;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SeederContactUsForm extends Seeder {


    public function run(): void {
        $newData = 0;

        if($newData == 0) {
            ContactUsForm::unguard();
            $tablePath = public_path('db/leads_contact_us.sql');
            DB::unprepared(file_get_contents($tablePath));
        } else {
            for ($i = 0; $i < 500; $i++) {

                $countryId = ['66', '197', '121', '237', '239', '18'];
                $MeetingTime_Arr = ['10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM', '12:00 PM', '12:30 PM', '01:00 PM', '01:30 PM', '02:00 PM', '02:30 PM', '03:00 PM', '03:30 PM', '04:00 PM', '04:30 PM', '05:00 PM'];

                $thisCounry = Country::wherein('id', $countryId)->inRandomOrder()->first();
                if($thisCounry->id == '239') {
                    $locales = "en_US";
                } elseif($thisCounry->id == '197') {
                    $locales = "ar_" . $thisCounry->iso2;
                } else {
                    $locales = "ar_EG";
                }
                $faker = Factory::create($locales);
                $nunber = fake()->numerify('##########');
                $request_type = fake()->randomElement(['1', '2', '3']);

                $date = $faker->dateTimeThisYear();

                $subject = null;
                $message = null;
                $meeting_day = null;
                $meeting_time = null;
                $listing_id = null;
                $project_id = null;

                if($request_type == 1) {
                    $subject = $faker->realText('30');
                    $message = $faker->realText('200');
                } elseif($request_type == 3) {
                    $meeting_day = Carbon::parse($date)->addDays(rand(2, 6));
                    $meeting_time = fake()->randomElement($MeetingTime_Arr);
                }

                if($request_type != 1) {
                    $list = Listing::inRandomOrder()->first();
                    $listing_id = $list->id;
                    $project_id = $list->parent_id;
                }

                ContactUsForm::create([
                    'export' => $faker->boolean('40'),
                    'name' => $faker->name,
                    'phone' => $nunber,
                    'full_number' => "+" . $thisCounry->phone . $nunber,
                    'country' => strtolower($thisCounry->iso2),
                    'subject' => $subject,
                    'request_type' => $request_type,
                    'meeting_day' => $meeting_day,
                    'meeting_time' => $meeting_time,
                    'created_at' => $date,
                    'message' => $message,
                    'listing_id' => $listing_id,
                    'project_id' => $project_id,

                ]);
            };
        }
    }


}
