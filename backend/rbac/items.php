<?php
return [
    'makeCRUD' => [
        'type' => 2,
        'description' => 'Create Read Update Delete',
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'makeCRUD',
        ],
    ],
];
