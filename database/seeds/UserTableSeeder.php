<?php

use Carbon\Carbon;
use App\Users\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qoruz_bot = new User;
        $qoruz_bot->name = 'Qoruz Bot';
        $qoruz_bot->email = 'bot@qoruz.com';
        $qoruz_bot->gender = 'na';
        $qoruz_bot->account_id = env('QORUZ_BOT_ACCOUNT_ID');
        $qoruz_bot->password = bcrypt('qoruz_bot');
        $qoruz_bot->email_token = str_random(60);
        $qoruz_bot->email_verified_at = Carbon::now();
        $qoruz_bot->save();
    }
}
