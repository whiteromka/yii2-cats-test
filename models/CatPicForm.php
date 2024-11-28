<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class CatPicForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function upload(/*int $catId*/)
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/cats/' . $file->baseName . '.' . $file->extension);
                // $c = new CatPic();
                // $c->catId = $catId;
                // $c->picName = $file->baseName . salt;
                // save()
            }
            return true;
        } else {
            return false;
        }
    }

    // hasMany

    // CatPic
    // id
    // picName
    // catId
}