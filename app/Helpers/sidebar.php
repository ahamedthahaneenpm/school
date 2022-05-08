<?php
if (!function_exists('sideMenu')) {

    function sideMenu()
    {
        $sideMenuList = [
            [
                'id' => '1',
                'name' => __('Dashboard'),
                'icon' => '<i class="material-icons">desktop_windows</i>',
                'active' => routeMatch(['dashboard']),
                'url' => route('dashboard'),
            ],
            [
                'id' => '2',
                'name' => __('Teachers'),
                'icon' => '<i class="material-icons">supervisor_account</i>',
                'permission' => ['teacher_read'],
                'active' => routeMatch(['teacher_list', 'teacher_add', 'teacher_edit', 'teacher_view']),
                'url' => route('teacher_list'),
            ],
            [
                'id' => '3',
                'name' => __('Students'),
                'icon' => '<i class="material-icons">account-check</i>',
                'permission' => ['student_read'],
                'active' => routeMatch(['student_list', 'student_add', 'student_edit', 'student_view']),
                'url' => route('student_list'),
            ],
            [
                'id' => '4',
                'name' => __('Mark Lists'),
                'icon' => '<i class="material-icons">account-check</i>',
                'permission' => ['score_read'],
                'active' => routeMatch(['score_list', 'score_add', 'score_edit', 'score_view']),
                'url' => route('score_list'),
            ],
            [
                'id' => '0',
                'name' => __('Setup'),
                'icon' => '<i class="material-icons">dvr</i>',
                'permission' => ['role_read', 'user_read', 'settings_read'],
                'child' => [
                    [
                        'id' => '001',
                        'name' => __('Roles'),
                        'icon' => '<i class="material-icons">radio_button_unchecked</i>',
                        'permission' => ['role_read'],
                        'active' => routeMatch(['role_list', 'role_add', 'role_edit', 'role_view']),
                        'url' => route('role_list'),
                    ],
                    [
                        'id' => '002',
                        'name' => __('Users'),
                        'icon' => '<i class="material-icons">radio_button_unchecked</i>',
                        'permission' => ['user_read'],
                        'active' => routeMatch(['user_list', 'user_add', 'user_edit', 'user_view']),
                        'url' => route('user_list'),
                    ],
                    [
                        'id' => '003',
                        'name' => __('Settings'),
                        'icon' => '<i class="material-icons">radio_button_unchecked</i>',
                        'permission' => ['settings_read'],
                        'active' => routeMatch(['settings_view']),
                        'url' => route('settings_view'),
                    ],
                ]
            ],
        ];
        $user = auth()->user();
        $sideMenu = renderList($sideMenuList, $user);
        return $sideMenu['view'];
    }

    function renderList($sideMenuList, $user)
    {
        $sideMenuView = '';
        $sideMenuActive = false;

        foreach ($sideMenuList as $sideMenu) {
            $menuRoles = isset($sideMenu['role']) ? $sideMenu['role'] : [];
            $menuPermissions = isset($sideMenu['permission']) ? $sideMenu['permission'] : [];
            $menuUrl = isset($sideMenu['url']) ? $sideMenu['url'] : '#';
            $menuIcon = isset($sideMenu['icon']) ? $sideMenu['icon'] : '<i class="material-icons">radio_button_unchecked</i>';
            $menuName = isset($sideMenu['name']) ? $sideMenu['name'] : '';
            $menuActive = isset($sideMenu['active']) ? $sideMenu['active'] : false;

            $sideMenuActive = $sideMenuActive || $menuActive;

            $userCan = true;

            if (!empty($menuPermissions)) {
                $userCan = false;
                foreach ($menuPermissions as $permission) {
                    if ($user->can($permission)) {
                        $userCan = true;
                        break;
                    }
                }
            }

            if (!empty($menuRoles)) {
                $roleAccess = $user->hasAnyRole($menuRoles);
                $userCan = (!empty($menuPermissions)) ? ($userCan = $userCan || $roleAccess) : $roleAccess;
            }

            if ($userCan) {
                if (isset($sideMenu['child'])) {
                    $subMenu = renderList($sideMenu['child'], $user);
                    if (!empty($subMenu['view'])) {
                        $sideMenuView .= '<li class="' . ($subMenu['active'] ? 'bold active open' : 'bold') . '">
                                                <a class="collapsible-header waves-effect waves-cyan " data-target="#sidemenu_' . $sideMenu['id'] . '" data-toggle="collapse"
                                                    aria-expanded="' . ($subMenu['active'] ? 'true' : 'false') . '" > 
                                                    ' . $menuIcon . '<span class="menu-title">' . $menuName . '</span>  
                                                </a>
                                                <div id="sidemenu_' . $sideMenu['id'] . '" class="collapsible-body ' . ($subMenu['active'] ? 'active' : '') . '">
                                                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">' . $subMenu['view'] . '</ul>
                                                </div>
                                          </li>';
                    }
                } else {
                    $sideMenuView .= '<li class="' . ($menuActive ? 'active' : '') . '">
                                            <a class="' . ($menuActive ? 'active' : '') . '" href="' . $menuUrl . '">' . $menuIcon . '<span>' . $menuName . '</span></a>
                                      </li>';
                }
            }
        }
        return ['view' => $sideMenuView, 'active' => $sideMenuActive];
    }
}