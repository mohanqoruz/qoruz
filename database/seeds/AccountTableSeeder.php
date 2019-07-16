<?php

use App\Accounts\Models\Account;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bot_account = new Account;
        $bot_account->name = 'Qoruz';
        $bot_account->type = 'agency';
        $bot_account->status = 'trialing';
        $bot_account->save();
    }
}
