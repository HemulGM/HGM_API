<?php

/**
 * Description of MoneyCirculation
 *
 * @author HemulGM
 */
class MoneyCirculation {

    //public $id;
    //public $user_id;
    public $value;
    public $period;
    public $lastOperation;
    public $description;
 
    public function __construct(array $data = null) {
        
        self::setData($data);
    }

    public function setData($data) {
        //$this->id = $data['id'];
        //$this->user_id = $data['user_id'];
        $this->value = $data['value'];
        $this->lastOperation = $data['lastOperation'];
        $this->description = $data['description'];
        $this->period = [$data['period_type'], $data['period_value']];
    }

}
