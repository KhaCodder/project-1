<?php   
return [
    'module' => [
        [
            'title' => 'Trang tổng quan',
            'icon' => '<svg class="line" viewBox="0 0 24 24"><path d="M22 8.27V4.23C22 2.64 21.36 2 19.77 2H15.73C14.14 2 13.5 2.64 13.5 4.23V8.27C13.5 9.86 14.14 10.5 15.73 10.5H19.77C21.36 10.5 22 9.86 22 8.27Z"></path><path d="M10.5 8.52V3.98C10.5 2.57 9.86 2 8.27 2H4.23C2.64 2 2 2.57 2 3.98V8.51C2 9.93 2.64 10.49 4.23 10.49H8.27C9.86 10.5 10.5 9.93 10.5 8.52Z"></path><path d="M10.5 19.77V15.73C10.5 14.14 9.86 13.5 8.27 13.5H4.23C2.64 13.5 2 14.14 2 15.73V19.77C2 21.36 2.64 22 4.23 22H8.27C9.86 22 10.5 21.36 10.5 19.77Z"></path><path d="M14.5 17.5H20.5"></path><path d="M17.5 20.5V14.5"></path></svg>',
            'name' => ['dashboard'],
            'route' => '/member/dashboard',
        ],
        [
            'title' => 'Tỷ lệ cấp độ',
            'icon' => '<svg class="line" viewBox="0 0 24 24"><path d="M3.5 20.4999C4.33 21.3299 5.67 21.3299 6.5 20.4999L19.5 7.49994C20.33 6.66994 20.33 5.32994 19.5 4.49994C18.67 3.66994 17.33 3.66994 16.5 4.49994L3.5 17.4999C2.67 18.3299 2.67 19.6699 3.5 20.4999Z"></path><path d="M18.01 8.98999L15.01 5.98999"></path><path d="M8.5 2.44L10 2L9.56 3.5L10 5L8.5 4.56L7 5L7.44 3.5L7 2L8.5 2.44Z"></path><path d="M4.5 8.44L6 8L5.56 9.5L6 11L4.5 10.56L3 11L3.44 9.5L3 8L4.5 8.44Z"></path><path d="M19.5 13.44L21 13L20.56 14.5L21 16L19.5 15.56L18 16L18.44 14.5L18 13L19.5 13.44Z"></path></svg>',
            'name' => ['payout-rates'],
            'route' => '/member/payout-rates',
        ],
        [
            'title' => 'Quản lý liên kết',
            'icon' => '<svg class="line" viewBox="0 0 24 24"><path d="M13.0601 10.9399C15.3101 13.1899 15.3101 16.8299 13.0601 19.0699C10.8101 21.3099 7.17009 21.3199 4.93009 19.0699C2.69009 16.8199 2.68009 13.1799 4.93009 10.9399"></path><path d="M10.59 13.4099C8.24996 11.0699 8.24996 7.26988 10.59 4.91988C12.93 2.56988 16.73 2.57988 19.08 4.91988C21.43 7.25988 21.42 11.0599 19.08 13.4099"></path></svg>',
            'name' => ['stu-links','note-links'],
            'sub_module' => [
                [
                    'title' => 'SubUnlock',
                    'route' => 'member/stu-links'
                ],
                [
                    'title' => 'Ghi chú',
                    'route' => 'member/note-links'
                ]
            ]
        ],
        [
            'title' => 'Rút tiền',
            'icon' => '<svg class="line" viewBox="0 0 24 24"><path d="M13 11.1499H7"></path><path d="M2 11.1501V6.53009C2 4.49009 3.65 2.84009 5.69 2.84009H11.31C13.35 2.84009 15 4.11009 15 6.15009"></path><path d="M17.48 12.1999C16.98 12.6799 16.74 13.4199 16.94 14.1799C17.19 15.1099 18.11 15.6999 19.07 15.6999H20V17.1499C20 19.3599 18.21 21.1499 16 21.1499H6C3.79 21.1499 2 19.3599 2 17.1499V10.1499C2 7.9399 3.79 6.1499 6 6.1499H16C18.2 6.1499 20 7.9499 20 10.1499V11.5999H18.92C18.36 11.5999 17.85 11.8199 17.48 12.1999Z"></path><path d="M22 12.6201V14.6801C22 15.2401 21.5399 15.7001 20.9699 15.7001H19.0399C17.9599 15.7001 16.97 14.9101 16.88 13.8301C16.82 13.2001 17.0599 12.6101 17.4799 12.2001C17.8499 11.8201 18.36 11.6001 18.92 11.6001H20.9699C21.5399 11.6001 22 12.0601 22 12.6201Z"></path></svg>',
            'name' => ['withdraw'],
            'route' => '/member/withdraw',
        ],
        [
            'title' => 'Hồ sơ',
            'icon' => '<svg class="line" viewBox="0 0 24 24"><path d="M12.12 12.78C12.05 12.77 11.96 12.77 11.88 12.78C10.12 12.72 8.71997 11.28 8.71997 9.50998C8.71997 7.69998 10.18 6.22998 12 6.22998C13.81 6.22998 15.28 7.69998 15.28 9.50998C15.27 11.28 13.88 12.72 12.12 12.78Z"></path><path d="M18.74 19.3801C16.96 21.0101 14.6 22.0001 12 22.0001C9.40001 22.0001 7.04001 21.0101 5.26001 19.3801C5.36001 18.4401 5.96001 17.5201 7.03001 16.8001C9.77001 14.9801 14.25 14.9801 16.97 16.8001C18.04 17.5201 18.64 18.4401 18.74 19.3801Z"></path><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"></path></svg>',
            'name' => ['profile', 'payment', 'change-password'],
            'sub_module' => [
                [
                    'title' => 'Thông tin cá nhân',
                    'route' => 'member/profile'
                ],
                [
                    'title' => 'Thông tin thanh toán',
                    'route' => 'member/payment'
                ],
                [
                    'title' => 'Đổi mật khẩu',
                    'route' => 'member/change-password'
                ]
            ]
        ],
    ],
];
