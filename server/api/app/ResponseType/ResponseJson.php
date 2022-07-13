<?php
namespace App\ResponseType;

class ResponseJson implements ResponseType {

    public function convert($content, int $code){
        return response()->json($content, $code);
    }
    
}
