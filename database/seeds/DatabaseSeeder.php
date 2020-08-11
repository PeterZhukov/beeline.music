<?php

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
        //Найти все картинки в storage/app/public/images (или аналог public/storage/images) и записать их в БД.
        $files = Storage::disk('public')->allFiles('images');
        /** @var \App\Models\Image $imageModel */
        $imageModel = app(\App\Models\Image::class);
        foreach($files as $file){
            $imageModel->insertImageIntoDatabase($file, 'superadmin');
        }
    }
}
