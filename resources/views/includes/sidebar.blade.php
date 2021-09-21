@php
    $current_path = '/' . request()->path();

    $dashboard = [
        'title' => 'Dashboard',
        'url' => '/dashboard'
    ]; 

    $penduduk = [
        'title' => 'Data Penduduk',
        'url' => '#',
        'icon' => 'bi bi-person-fill',
        'childrens' => [
            [
            'title' => 'List Data Penduduk',
            'url' => '/resident/all'
            ],
            [
                'title' => 'Create Data Penduduk',
                'url' => '/resident/create'
            ]
        ]
    ];

    $kartu_keluarga = [
        'title' => 'Kartu Keluarga',
        'url' => '#',
        'icon' => 'bi bi-file-text-fill',
        'childrens' => [
            [
            'title' => 'List Kartu Keluarga',
            'url' => '/family-card/all'
            ],
            [
                'title' => 'Create Kartu Keluarga',
                'url' => '/family-card/create'
            ]
        ]
    ];

    $kedatangan = [
        'title' => 'Data Kedatangan',
        'url' => '#',
        'icon' => 'bi bi-person-plus-fill',
        'childrens' => [
            [
            'title' => 'List Data Kedatangan',
            'url' => '/comer/all'
            ],
            [
                'title' => 'Create Data Kedatangan',
                'url' => '/comer/create'
            ]
        ]
    ];

    $kepergian = [
        'title' => 'Data Kepergian',
        'url' => '#',
        'icon' => 'bi bi-person-dash-fill',
        'childrens' => [
            [
            'title' => 'List Data Kepergian',
            'url' => '/move/all'
            ],
            [
                'title' => 'Create Data Kepergian',
                'url' => '/move/create'
            ]
        ]
    ];
    
    $kematian = [
        'title' => 'Data Kematian',
        'url' => '#',
        'icon' => 'bi bi-person-x-fill',
        'childrens' => [
            [
            'title' => 'List Data Kematian',
            'url' => '/die/all'
            ],
            [
                'title' => 'Create Data Kematian',
                'url' => '/die/create'
            ]
        ]
    ];

    $menus = [$dashboard, $penduduk, $kartu_keluarga, $kedatangan, $kepergian, $kematian];
@endphp

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="#"><img src="/dist/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                @foreach ($menus as $menu)
                    @if (isset($menu['childrens']))
                        @php
                            $isActive = false;
                            foreach ($menu['childrens'] as $child) {
                                if($child['url'] == $current_path){
                                    $isActive = true;
                                }
                            }
                        @endphp
                        <li class="sidebar-item has-sub {{ $isActive ? 'active' : ''}}">
                            <a href="{{ $menu['url'] }}" class='sidebar-link'>
                                <i class="{{ $menu['icon'] }}"></i>
                                <span>{{ $menu['title'] }}</span>
                            </a>
                            <ul class="submenu {{ $isActive ? 'active' : '' }}">
                                @foreach ($menu['childrens'] as $item)
                                <li class="submenu-item ">
                                    <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="sidebar-item {{$current_path == $menu['url'] ? 'active' : ''}} ">
                            <a href="{{ $menu['url'] }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>{{ $menu['title'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>