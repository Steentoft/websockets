<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\User();

        $user->name = "Christian";
        $user->email = "chrsteentoft@gmail.com";
        $user->status_message = "No status set";
        $user->setPasswordAttribute("ideapadgaming");

        $user->save();

        $user = new \App\Models\User();

        $user->name = "Steentoft";
        $user->email = "christeentoft@gmail.com";
        $user->status_message = "No status set";
        $user->setPasswordAttribute("ideapadgaming");

        $user->save();

        $user = new \App\Models\User();

        $user->name = "Steentofte";
        $user->email = "chrissteentoft@gmail.com";
        $user->status_message = "No status set";
        $user->setPasswordAttribute("ideapadgaming");

        $user->save();

        $user->save();

        $user = new \App\Models\User();

        $user->name = "Steentoften";
        $user->email = "christesteentoft@gmail.com";
        $user->status_message = "No status set";
        $user->setPasswordAttribute("ideapadgaming");

        $user->save();
    }
}
