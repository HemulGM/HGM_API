<?php

class ResponseData {

    public $response;

    public function __construct($response) {
        $this->response = $response;
    }

}

class ResponseErrorData {

    public $code;
    public $text;

    public function __construct(int $code, string $text) {
        $this->code = $code;
        $this->text = $text;
    }

}

class ResponseError {

    public $error;

    public function __construct($code, $text) {
        $this->error = new ResponseErrorData($code, $text);
    }

}

/**
 * Description of Response
 *
 * @author malinin_g
 */
class Response {

    public static function Ok($value) {

        $response = new ResponseData($value);

        http_response_code(200);
        header('Content-Type: application/json');
        print_r(json_encode($response));
        exit;
    }

    public static function Error(int $code, string $text) {

        $response = new ResponseError($code, $text);
        http_response_code($code);
        header('Content-Type: application/json');
        print_r(json_encode($response));
        exit;
    }

}
