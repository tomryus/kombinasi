<?php

use Illuminate\Database\Seeder;

class Profile_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new \App\profile;
        $profile->email = "admin@gmail.com";
        $profile->nama ="admin";
        $profile->pekerjaan = "admin";

        $profile->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
