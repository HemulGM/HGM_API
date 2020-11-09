<?php

namespace HGM_API\Controllers;


use Response;
use DB;
use Radio;

class RadiosController {

    /**
     * List
     */
    public static function list() {

        $query = DB::query("select id, name, url, image from radios where status = 1");
        
        $list = []; 
        foreach ($query as $radio)
        {
            $list[] = new Radio($radio);
        }
        
        Response::Ok($list);
    }

}