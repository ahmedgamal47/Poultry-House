<?php

use Illuminate\Database\Seeder;
use App\Models\Content;
use App\Enums\ContentKey;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (ContentKey::getValues() as $key) {
            $content = new Content();
            $content->key = $key;
            $content->save();
        }
    }
}
