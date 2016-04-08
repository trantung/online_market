<?php
//permission role
define('ADMIN', 1);
define('EDITOR', 2);
//pagination manager admin
define('PAGINATE', 20);
//status
define('ACTIVE', 1);
define('INACTIVE', 2);
define('REFUSE', 3);
//status
define('ENABLED', 1);
define('DISABLED', 2);
//status user
define('ACTIVEUSER', 'Kích hoạt');
define('INACTIVEUSER', 'Chưa kích hoạt');
define('TYPESYSTEM', 'Hệ thống');
define('TYPEFACEBOOK', 'Facebook');
define('TYPEGOOGLE', 'Google');
//define type product
define('TYPE1', 'Cũ');
define('TYPE2', 'Mới');
define('TYPEVALUE1', 1);
define('TYPEVALUE2', 2);
//define status product
define('PRODUCT_ACTIVE', 'Đã đăng');
define('PRODUCT_INACTIVE', 'Chưa đăng');
//lengh random string
define('RANDOMSTRING', 16);
define('CODEPHONE', 6);
//define label setting menu
define('PRODUCT_LOG', 'Tin đã lưu');
define('SEARCH_LOG', 'Tìm kiếm đã lưu');
define('PRODUCT_STATUS_1', 'Đang bán');
define('PRODUCT_STATUS_2', 'Đợi duyệt');
define('PRODUCT_STATUS_3', 'Bị từ chối');
//hidden. deleted
define('PRODUCT_STATUS_4', 'Đã ẩn');
//account
define('REGISTER', 'Đăng ký');
define('LOGIN', 'Đăng nhập');
define('LOGOUT', 'Đăng xuất');
//success
define('SUCCESS', 'Success');
define('DELETE_SUCCESS', 'Delete success');
//menu setting
define('PROMO', 'Khuyến mại');
define('HELP', 'Hướng dẫn');
define('SHAREAPP', 'Chia sẻ ứng dụng');
define('CONTACT', 'Liên hệ');
define('SEETYPE', 'Kiểu xem');
//define save or favorite
// favorite/save product
define('TYPE_FAVORITE_SAVE', 1);
// favorite user
define('TYPE_FAVORITE_LIKE', 2);
// favorite category
define('TYPE_FAVORITE_CATE', 3);

//define upload product image origin
define('PRODUCT_UPLOAD', '/images/products');
//define upload user avatar
define('USER_AVATAR', '/images/users');
//define size avatar user
define('USER_AVATAR_WIDTH', 48);
define('USER_AVATAR_HEIGHT', 48);
//define product size avatar
define('PRODUCT_AVATAR_WIDTH', 800);
define('PRODUCT_AVATAR_HEIGHT', 600);
//define product size slide
define('PRODUCT_SLIDE_WIDTH', 800);
define('PRODUCT_SLIDE_HEIGHT', 600);
//define time product
define('TIME1', 'Hôm nay');
define('TIME2', 'Từ tuần trước');
define('TIME3', 'Từ tháng trước');
define('TIMEVALUE1', 1);
define('TIMEVALUE2', 2);
define('TIMEVALUE3', 3);
//default reset password 
define('DEFAULT_PASSWORD', '123456');
