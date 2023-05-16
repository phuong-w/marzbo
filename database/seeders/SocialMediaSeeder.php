<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialMedias = SocialMedia::$socialMedias;

        foreach ($socialMedias as $key => $value) {
            SocialMedia::updateOrCreate(
                [
                    'id' => $key
                ],
                [
                    'name' => $value
                ]
            );
        }
    }
}
