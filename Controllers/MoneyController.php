<?php

namespace HGM_API\Controllers;

use Response;
use DB;
use HGM_API\Controllers\MainController;
use MoneyCirculation;

class MoneyController {

    /**
     * Circulations
     */
    public static function Circulations() {

        $user_id = MainController::getUser()->id;
        $query = DB::query("select value, period_type, period_value, lastOperation, description from money_circulation where user_id = '$user_id'");
        $list = [];
        foreach ($query as $item) {
            $list[] = new MoneyCirculation($item);
        }

        Response::Ok($list);
    }

}
