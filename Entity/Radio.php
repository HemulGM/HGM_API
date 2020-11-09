<?php

/**
 * Description of Radio
 *
 * @author HemulGM
 */
class Radio {

    public $id;
    public $name;
    public $url;
    public $image;
 
    public function __construct(array $data = null) {
        
        self::setData($data);
    }

    public function setData($data) {
        $this->id = $data['id'];
        $this->url = $data['url'];
        $this->name = $data['name'];
        $this->image = $data['image'];
    }

}
