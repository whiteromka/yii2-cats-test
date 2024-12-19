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
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif', 'maxFiles' => 4],
        ];
    }

    public function upload(int $catId)
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $path = 'uploads/cats/' . md5($file->baseName . microtime(true)) . '.' . $file->extension;
                $file->saveAs($path);

                $catPic = new CatPic();
                $catPic->cat_id = $catId;
                $catPic->pic_name = '/' . $path;
                $catPic->save();
            }
            return true;
        } else {
            return false;
        }
    }
}