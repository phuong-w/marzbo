<?php

return [

    /*
    |--------------------------------------------------------------------------
    | General Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during general use for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'login' => [
        'title' => 'Đăng Nhập',
        'subtitle' => 'Đăng nhập vào tài khoản để tiếp tục.',
        'email' => 'Email / SĐT',
        'password' => 'Mật Khẩu',
        'question' => "Bạn chưa có tài khoản ?",
        'or' => 'Hoặc',
        'facebook' => 'Tiếp tục với Facebook',
        'google' => 'Tiếp tục với Google',
        'button' => [
            'submit' => 'Đăng Nhập',
            'create' => 'Tạo tài khoản'
        ]
    ],
    'register' => [
        'title' => 'Đăng Ký',
        'subtitle' => 'Bạn đã có một tài khoản?',
        'first_name' => 'Tên',
        'last_name' => 'Họ',
        'phone' => 'Số Điện Thoại',
        'password' => 'Mật Khẩu',
        'password_confirmation' => 'Nhập Lại Mật Khẩu',
        'cb_text' => [
            'start' => 'Tôi đồng ý với',
            'terms' => 'Các điều khoản',
            'between' => 'và',
            'policy' => 'Chính sách bảo mật',
            'end' => ' của Marzbo.'
        ],
        'button' => [
            'submit' => 'Đăng Ký',
            'login' => 'Đăng nhập'
        ],
        'text' => [
            'success' => 'Register successfully',
            'description_success' => 'Your account has been registered, you will be logged in automatically.'
        ]
    ],
    'dashboard' => [
        'title' => 'Bảng Điều Khiển',
        'menu_title' => 'Bảng Điều Khiển',
        'subtitle' => 'Một câu nói tạo cảm hứng cho ngày làm việc mới của bạn'
    ],
    'user' => [
        'title' => 'Người Dùng',
        'menu_title' => 'Người Dùng',
        'logout' => 'Đăng Xuất',
        'name' => 'Tên người dùng'
    ],
    'category' => [
        'title' => 'Danh Mục',
        'menu_title' => 'Danh Mục',
        'table_index' => [
            'name' => 'Tên Danh Mục'
        ]
    ],
    'post' => [
        'title' => 'Bài Viết',
        'menu_title' => 'Bài Viết',
        'table_index' => [
            'group_post' => 'Nhóm Bài Viết'
        ],
        'status' => [
            POST_STT_UNPUBLISHED => [
                'name' => 'Chưa phát hành'
            ],
            POST_STT_PUBLISHED => [
                'name' => 'Đã phát hành'
            ],
        ],
        'write_content' => 'Soạn nội dung',
    ],
    'schedule' => [
        'title' => 'Lịch Trình',
        'menu_title' => 'Lịch Trình',
        'status' => [
            SCHEDULE_STT_PENDING => [
                'name' => 'Đang chờ'
            ],
            SCHEDULE_STT_SUCCESS => [
                'name' => 'Thành công'
            ],
            SCHEDULE_STT_ERROR => [
                'name' => 'Lỗi'
            ]
        ]
    ],
    'chatgpt' => [
        'new_chat' => 'Thêm cuộc trò chuyện',
        'enter_question' => 'Nhập câu hỏi bất kỳ'
    ],
    'social_media' => [
        'title' => 'Social Media',
        'menu_title' => 'Social Media',
        'select' => 'Chọn nền tảng MXH',
        'select_sub' => 'Nhấp vào đây'
    ],
    'social_media_credential' => [
        'title' => 'Social Media Credential',
        'menu_title' => 'Social Media Credential',
    ],
    'role' => [
        'title' => 'Vai Trò',
        'menu_title' => 'Vai Trò'
    ],
    'permission' => [
        'title' => 'Phân Quyền',
        'menu_title' => 'Phân Quyền'
    ],
    'tooltip' => [
        'delete' => 'Xóa',
        'edit' => 'Sửa'
    ],
    'button' => [
        'cancel' => 'Hủy',
        'close' => 'Đóng',
        'create' => 'Tạo mới',
        'delete' => 'Xóa',
        'update' => 'Cập nhật',
        'save' => 'Lưu',
        'published' => 'Được phát hành',
        'not_published' => 'Chưa phát hành',
        'prev' => 'Lùi lại',
        'next' => 'Tiếp tục',
        'finish' => 'Hoàn thành'
    ],
    'choose' => [
        'status' => 'Choose status'
    ],
    'common' => [
        'actions' => 'Thao tác',
        'box_preview' => 'Nội dung tải lên',
        'created_at' => 'Ngày Khởi Tạo',
        'comment' => 'Bình luận',
        'content' => 'Nội dung',
        'contact' => 'Thông tin liên hệ',
        'contact_with_us' => 'Contact with us',
        'country' => 'Quốc gia',
        'disable' => 'Vô hiệu',
        'dismiss' => 'Bỏ qua',
        'email' => 'Email',
        'empty' => 'Trống',
        'empty_table_message' => 'Chưa có dữ liệu',
        'enable' => 'Enable',
        'first_name' => 'Tên',
        'last_name' => 'Họ',
        'group' => 'Nhóm',
        'group_select' => 'Chọn nhóm',
        'loading' => 'Đang sử lý...',
        'link_social' => 'Liên kết MXH',
        'name' => 'Tên',
        'user_role' => 'User role',
        'password' => 'Password',
        'password_confirm' => 'Nhập lại mật khẩu',
        'permissions' => 'Quyền cho vai trò',
        'phone_number' => 'Số điện thoại',
        'publish_date' => 'Phát hành',
        'react' => 'Tương tác',
        'result' => 'Số lượng',
        'roles' => 'Vai trò',
        'schedule_time' => 'Lịch hẹn',
        'status' => 'Trạng thái',
        'showing_page' => 'Hiển thị trang :page trong :pages trang',
        'search' => 'Tìm kiếm...',
        'setting' => 'Cài Đặt',
        'social_media' => 'Nền tảng MXH',
        'sort_by' => 'Sắp xếp',
        'statistic' => 'Thống kê',
        'time' => 'Thời gian',
        'view' => 'Lượt xem',
    ],
    'sidebar' => [
        'user_management' => 'Manage User',
    ],
    'menu' => [
        'dashboard' => 'Bảng Điều Khiển',
        'user_management' => [
            'title' => 'Người Dùng',
            'user' => 'Users',
            'role' => 'Roles',
            'permission' => 'Permissions',
        ],
        'category_management' => [
            'title' => 'Manage Categories',
            'category' => 'Categories',
        ],
        'post_management' => [
            'title' => 'Manage Posts',
            'post' => 'Posts',
        ],
        'schedule_management' => [
            'title' => 'Manage Schedules',
            'schedule' => 'Schedules',
        ],
        'social_media_management' => [
            'title' => 'Manage Social Media',
            'social_media' => 'Social Media',
        ],
        'social_media_credential_management' => [
            'title' => 'Manage Social Media Credential',
            'social_media_credential' => 'Social Media Credential',
        ],
    ],
];
