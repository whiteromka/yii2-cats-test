<?php

namespace app\components;

use yii\base\Widget;

class ItemWidget extends Widget
{
    public ?string $imgSrc = null;
    public string $name;
    public string $description;
    public string $buttonName;
    public string $buttonLink;
    public int $catId;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('item', [
            'imgSrc' => $this->imgSrc,
            'name' => $this->name,
            'description' => $this->description,
            'buttonName' => $this->buttonName,
            'buttonLink' => $this->buttonLink,
            'catId' => $this->catId,
        ]);
    }
}