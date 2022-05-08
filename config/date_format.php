<?php

//store : backend database
//display : backend dispaly
//js : front js format

return [
    'date_only' => [
        'store' => 'Y-m-d',
        'display' => 'd-m-Y',
        'js' => 'dd-mm-yyyy',
    ],
    'time_only' => [
        'store' => 'H:i:s',
        'display' => 'H:i',
        'js' => 'H:i',
    ],
    'date_time' => [
        'store' => 'Y-m-d H:i:s',
        'display' => 'd-m-Y H:i',
        'js' => 'dd-mm-yy H:i',
    ],
];