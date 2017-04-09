<?php

return [
    'users' => [
        'name' => 'users',
        'route' => 'users',
        'icon' => 'entypo-users',
        'service'=>[],
        'role' => ['admin'],
        'children'=>[
            [
           'name'=> 'view',
            'route'=>'users',
                'icon' => 'entypo-eye',
                ],
            [
              'name'=>'create',
             'route'=>'users/create',
                'icon' => 'entypo-plus-squared',
                ]
        ]
    ],
//    'service' => [
//        'name' => 'service',
//        'route' => 'service',
//        'icon' => 'entypo-sweden',
//        'service'=>[],
//        'role' => ['admin'],
//        'children'=>[
//            [
//                'name'=> 'view',
//                'route'=>'service',
//                'icon' => 'entypo-eye',
//            ],
//            [
//                'name'=>'create',
//                'route'=>'service/create',
//                'icon' => 'entypo-plus-squared',
//            ]
//        ]
//    ],
    // 'contract' => [
    //     'name' => 'contract',
    //     'route' => 'contractor',
    //     'icon' => 'entypo-vcard',
    //     'service'=>[],
    //     'role' => ['admin','contra_manager','contra_moderator'],
    //     'children'=>[
    //         [
    //             'name'=> 'view',
    //             'route'=>'contractor',
    //             'icon' => 'entypo-eye',
    //         ],
    //         [
    //             'name'=>'create',
    //             'route'=>'contractor/create',
    //             'icon' => 'entypo-plus-squared',
    //         ]
    //     ]
    // ],
    'violation' => [
        'name' => 'violation',
        'route' => 'violation',
        'icon' => 'entypo-eye',
        'service'=>[2,3,4],
        'role' => ['admin','contra_moderator','moderator','manager'],
        'children'=>[
            [
                'name'=> 'view',
                'route'=>'violation',
                'icon' => 'entypo-eye',
            ],
            [
                'name'=>'create',
                'route'=>'violation/create',
                'icon' => 'entypo-plus-squared',
            ]
        ]
    ],
    'violaton_type' => [
        'name' => 'violation_type',
        'route' => 'violationtype',
        'icon' => 'entypo-cc-nd',
        'service'=>[],
        'role' => ['admin'],
        'children'=>[
            [
                'name'=> 'view',
                'route'=>'violationtype',
                'icon' => 'entypo-eye',
            ],
            [
                'name'=>'create',
                'route'=>'violationtype/create',
                'icon' => 'entypo-plus-squared',
            ]
        ]
    ],
    'street' => [
        'name' => 'street',
        'route' => 'street',
        'icon' => 'entypo-switch',
        'service'=>[],
        'role' => ['admin'],
        'children'=>[
            [
                'name'=> 'view',
                'route'=>'street',
                'icon' => 'entypo-eye',
            ],
            [
                'name'=>'create',
                'route'=>'street/create',
                'icon' => 'entypo-plus-squared',
            ]
        ]
    ],
    'garden' => [
        'name' => 'garden',
        'route' => 'gardens',
        'icon' => 'entypo-palette',
        'service'=>[],
        'role' => ['admin'],
        'children'=>[
            [
                'name'=> 'view',
                'route'=>'gardens',
                'icon' => 'entypo-eye',
            ],
            [
                'name'=>'create',
                'route'=>'gardens/create',
                'icon' => 'entypo-plus-squared',
            ]
        ]
    ],
    'res_quar' => [
        'name' => 'res_quar',
        'route' => 'res_quar',
        'icon' => 'entypo-layout',
        'service'=>[],
        'role' => ['admin'],
        'children'=>[
            [
                'name'=> 'view',
                'route'=>'res_quar',
                'icon' => 'entypo-eye',
            ],
            [
                'name'=>'create',
                'route'=>'res_quar/create',
                'icon' => 'entypo-plus-squared',
            ]
        ]
    ],
//    'visit_search' => [
//        'name' => 'visit_search',
//        'route' => 'visit_search',
//        'icon' => 'entypo-search',
//        'service'=>[1],
//        'role' => ['admin'],
//        'children'=>[
//            [
//                'name'=> 'view',
//                'route'=>'visit_search',
//                'icon' => 'entypo-eye',
//            ],
//
//        ]
//    ],
//    'visit_today' => [
//        'name' => 'visit_today',
//        'route' => 'visit_today',
//        'icon' => 'entypo-calendar',
//        'service'=>[1],
//        'role' => ['admin'],
//        'children'=>[
//            [
//                'name'=> 'view',
//                'route'=>'visit_today',
//                'icon' => 'entypo-eye',
//            ],
//        ]
//    ],
];
