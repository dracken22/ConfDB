<?php
namespace com\confdb\game\cards\bean;

use com\confdb\base\bean\ABean;
use com\confdb\label\bean\Label;

class Card extends ABean{
    private Label $name;
    private $images = [];

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }

    public function getImages(){
        return $this->images;
    }
    public function setImages($images){
        if(!isset($images)){
            $images = [];
        }
        $this->images = $images;
    }
    public function addImage($image){
        $this->images[] = $image;
    }

    public function toJson(){
        return [
            'id' => $this->getId(),
            'images' => $this->getImages(),
            'name' => $this->getName() != null ? $this->getName()->toJson() : null
        ];
    }
}