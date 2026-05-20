<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

Artisan::command('supabase:insert-selection', function () {

    $supabaseUrl = env('SUPABASE_URL');
    $supabaseKey = env('SUPABASE_SERVICE_KEY');

    if (!$supabaseUrl || !$supabaseKey) {
        $this->error('❌ SUPABASE_URL or SUPABASE_SERVICE_KEY not set in .env');
        return;
    }

    $postUrl = $supabaseUrl . '/rest/v1/selection';

    // -----------------------------
    // KING RECORDS (gender = M)
    // -----------------------------
    $kingData = [
        [
            'name'     => 'Mg Aung Kaung Myat Paing',
            'gender'   => 'M',
            'number'   => '1',
            'birthday' => '2006-10-18',
            'image'    => 'default.png',
            'zodiac'   => 'Libra',
            'hobby'    => 'Playing Guitar, Playing Game, Video Editing, Learning Foreign Languages',
            'hometown' => 'Paung',
            'height'   => '5\'5"'
        ],
        [
            'name'     => 'Mg Paing Zay Htut',
            'gender'   => 'M',
            'number'   => '2',
            'birthday' => '2007-07-12',
            'image'    => 'default.png',
            'zodiac'   => 'Cancer',
            'hobby'    => 'Football, Cooking',
            'hometown' => 'Thanbyuzayat',
            'height'   => '5\'6"'
        ],
        [
            'name'     => 'Mg Khant Pyae Hlyan Nyein',
            'gender'   => 'M',
            'number'   => '3',
            'birthday' => '2007-10-15',
            'image'    => 'default.png',
            'zodiac'   => 'Libra',
            'hobby'    => 'Playing Guitar, Singing',
            'hometown' => 'Mawlamyine',
            'height'   => '5\'8"'
        ],
        [
            'name'     => 'Khun Aung Myat Bhone',
            'gender'   => 'M',
            'number'   => '4',
            'birthday' => '2006-05-21',
            'image'    => 'default.png',
            'zodiac'   => 'Gemini',
            'hobby'    => 'Playing Guitar, Football, Gym',
            'hometown' => 'Bilin',
            'height'   => '5\'7"'
        ],
        [
            'name'     => 'Mg I J Lin',
            'gender'   => 'M',
            'number'   => '5',
            'birthday' => '2007-04-22',
            'image'    => 'default.png',
            'zodiac'   => 'Taurus',
            'hobby'    => 'Football, Travelling, Playing Game',
            'hometown' => 'Thanbyuzayat',
            'height'   => '5\'7"'
        ],
        [
            'name'     => 'Saw Aung Kaung Myat',
            'gender'   => 'M',
            'number'   => '6',
            'birthday' => '2007-06-10',
            'image'    => 'default.png',
            'zodiac'   => 'Gemini',
            'hobby'    => 'Football, Cycling, Listening to music',
            'hometown' => 'Thaton',
            'height'   => '5\'10"'
        ],
        [
            'name'     => 'Mg Bhone Myat Min Khant',
            'gender'   => 'M',
            'number'   => '7',
            'birthday' => '2007-01-11',
            'image'    => 'default.png',
            'zodiac'   => 'Capricorn',
            'hobby'    => 'Listening to music, Cooking, Gardening',
            'hometown' => 'Mawlamyine',
            'height'   => '5\'11"'
        ],
        [
            'name'     => 'Mg Arkar Phyo',
            'gender'   => 'M',
            'number'   => '8',
            'birthday' => '2006-08-13',
            'image'    => 'default.png',
            'zodiac'   => 'Leo',
            'hobby'    => 'Listening to music, Playing game',
            'hometown' => 'Mudon',
            'height'   => '6\'0"'
        ],
    ];

    // -----------------------------
    // QUEEN RECORDS (gender = F)
    // -----------------------------
    $queenData = [
        [
            'name'     => 'Ma Thain Mwae Thu',
            'gender'   => 'F',
            'number'   => '1',
            'birthday' => '2006-07-14',
            'image'    => 'default.png',
            'zodiac'   => 'Cancer',
            'hobby'    => 'Travelling, Hiking, Singing',
            'hometown' => 'Kyaikkhami',
            'height'   => '5\'1"'
        ],
        [
            'name'     => 'Ma Myat Noe Eain',
            'gender'   => 'F',
            'number'   => '2',
            'birthday' => '2006-03-30',
            'image'    => 'default.png',
            'zodiac'   => 'Aries',
            'hobby'    => 'Listen to music, Playing game',
            'hometown' => 'Mawlamyine',
            'height'   => '5\'1"'
        ],
        [
            'name'     => 'Ma Chit Myat Noo',
            'gender'   => 'F',
            'number'   => '3',
            'birthday' => '2006-11-06',
            'image'    => 'default.png',
            'zodiac'   => 'Scorpio',
            'hobby'    => 'Listening to music, Gardening, Travelling',
            'hometown' => 'Ye',
            'height'   => '5\'3"'
        ],
        [
            'name'     => 'Ma Myat Thiri Ko',
            'gender'   => 'F',
            'number'   => '4',
            'birthday' => '2007-05-20',
            'image'    => 'default.png',
            'zodiac'   => 'Taurus',
            'hobby'    => 'Traveling, Drawing',
            'hometown' => 'Kyaikhto',
            'height'   => '5\'1"'
        ],
        [
            'name'     => 'Ma Ei Ei Moe',
            'gender'   => 'F',
            'number'   => '5',
            'birthday' => '2007-04-08',
            'image'    => 'default.png',
            'zodiac'   => 'Aries',
            'hobby'    => 'Travelling, Cooking',
            'hometown' => 'Mawlamyine',
            'height'   => '5\'2"'
        ],
        [
            'name'     => 'Ma Ei Tha Zin',
            'gender'   => 'F',
            'number'   => '6',
            'birthday' => '2007-06-17',
            'image'    => 'default.png',
            'zodiac'   => 'Gemini',
            'hobby'    => 'Hand-make, Drawing',
            'hometown' => 'Kyaikhto',
            'height'   => '5\'3"'
        ],
        [
            'name'     => 'Ma Htet Htet Win Hlan',
            'gender'   => 'F',
            'number'   => '7',
            'birthday' => '2006-11-11',
            'image'    => 'default.png',
            'zodiac'   => 'Scorpio',
            'hobby'    => 'Listening to music, Traveling, Reading',
            'hometown' => 'Mudon',
            'height'   => '5\'2"'
        ],
        [
            'name'     => 'Ma Ingyin Pwint',
            'gender'   => 'F',
            'number'   => '8',
            'birthday' => '2006-10-08',
            'image'    => 'default.png',
            'zodiac'   => 'Libra',
            'hobby'    => 'Singing, Gym, Makeup',
            'hometown' => 'Kyarinn Seikkyi',
            'height'   => '5\'5"'
        ],
    ];

    // Merge king + queen
    $allData = array_merge($kingData, $queenData);

    $response = Http::withHeaders([
        'apikey'        => $supabaseKey,
        'Authorization' => "Bearer {$supabaseKey}",
        'Content-Type'  => 'application/json',
        'Prefer'        => 'return=minimal'
    ])->post($postUrl, $allData);

    if ($response->successful()) {
        $this->info('✅ All king and queen data inserted into Supabase successfully.');
    } else {
        $this->error('❌ Failed to insert data.');
        $this->line($response->body());
    }

})->purpose('Insert all king and queen records into Supabase selection table');
