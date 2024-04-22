<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.index',
        'title' => 'Dashboard',
        'active' => 'dashboard*',
        'links' => [
            [
                'icon' => 'far fa-circle nav-icon',
                'route' => 'dashboard.index',
                'title' => 'Home',
            ],
            [
                'icon' => 'far fa-circle nav-icon',
                'route' => 'dashboard.categories.index',
                'title' => 'Categories',
            ],
            [
                'icon' => 'far fa-circle nav-icon',
                'route' => 'dashboard.products.index',
                'title' => 'Products',
                'badge' => 'New'
            ],
        ]
    ],
];
