<?php

return [

    // チャットメッセージに関する設定
    'message' => [
        'max_length' => 100,    
    ],

    // ページネーションの設定
    'pagination' => [
        'per_page' => 10,
    ],

    // 部屋番号のID
    'room' => [
        'id' => 1,
    ],

    // テスト用メッセージデータ
    'test' => [
        'total_messages' => 15,

        'first_page' => [
            'start' => 1,
            'second' => 2,
            'end' => 10,
        ],
        'second_page' => [
            'start' => 11,
            'end' => 15,
        ],
    ],

];
