<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    public $table = 'images';
    public function insertImageIntoDatabase($imagePath, $author){
        $model = new static();
        $model->path = $imagePath;
        $model->author = $author;
        $model->save();
    }
}
