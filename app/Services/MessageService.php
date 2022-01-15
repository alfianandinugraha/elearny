<?php

namespace App\Services;

use Illuminate\Support\Facades\Lang;

class DatabaseMessage {
    public function exist($attribute) {
        $message = Lang::get('database.exist', compact('attribute'));
        return MessageService::makeSentance($message);
    }
}

class MessageService
{
    public static function makeSentance($sentance) {
        $split = explode(".", $sentance);

        foreach($split as $key => $item) {
            if ($split[$key] != '') {
                $split[$key][0] = strtoupper($item[0]);
            };
        }

        return implode("", $split);
    }

    public static function database() {
        $databaseMessage = new DatabaseMessage();
        return $databaseMessage;
    }
}
