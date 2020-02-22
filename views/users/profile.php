<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Account</title>
    <link rel="shortcut icon" href="public/images/base-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/account.css">
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- LEFT BAR -->
    <div class="left-bar">
        <div class="sidenav">
            <div class="lbar-row lbar-avatar">
                <img src="public/images/avatar_default.png" class="" alt="">
            </div>
            <div class="lbar-row profile">
                <div class="lbar-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
                <div class="lbar-title"><a href="#">Cá nhân</a></div>
            </div>
            <div class="lbar-row members">
                <div class="lbar-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                <div class="lbar-title"><a href="#">Thành viên</a></div>
            </div>
            <div class="lbar-row groups">
                <div class="lbar-icon"><i class="fa fa-free-code-camp" aria-hidden="true"></i></div>
                <div class="lbar-title"><a href="#">Nhóm</a></div>
            </div>
            <div class="lbar-row customer-acc">
                <div class="lbar-icon"><i class="fa fa-ravelry" aria-hidden="true"></i></div>
                <div class="lbar-title"><a href="#">TK Khách</a></div>
            </div>
            <div class="lbar-row base-apps">
                <div class="lbar-icon"><i class="fa fa-bookmark-o" aria-hidden="true"></i></div>
                <div class="lbar-title"><a href="#">Ứng dụng</a></div>
            </div>
        </div>
        <div class="logout">
            <div class="lbar-title">
                <a href="?mod=account&act=logout">Logout</a>
            </div>
        </div>
    </div>

    <!-- CONTAINER -->
    <div class="container">
        <div class="container-header">
            <div class="header-icon"><span></span></div>
            <div class="header-title">
                <div class="row account">Tài khoản</div>
                <div class="row name">Trần Thị Phương</div>
            </div>
            <div class="header-edit">
                <button:sub>Chỉnh sửa tài khoản</button:sub>
            </div>
        </div>
        <div class="container-body">
            <div class="body-info">
                <div class="info-avatar"></div>
                <div class="info-detail">
                    <div class="your-name">Trần Thị Phương</div>
                    <div class="your-position">Vị trí</div>
                    <div class="your-email">Địa chỉ email</div>
                    <div class="your-phone">Số điện thoại</div>
                </div>
            </div>
            <div class="body-detail">
                <div class="detail">
                    <div class="detail-title">THÔNG TIN LIÊN HỆ</div>
                    <div class="detail-contact">
                        Địa chỉ nhà
                    </div>
                </div>
                <div class="detail">
                    <div class="detail-title">Nhóm</div>
                    <div class="detail-groups">
                        <div class="detail-row">
                            <div class="group-name">Product</div>
                            <div class="group-info">
                                46 thành viên . Tham gia ngày 17/02/2020
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail">
                    <div class="detail-title">DIRECT REPORTS</div>
                    <div class="detail-dreports">
                        <div class="detail-row">
                            <div class="dreport-name">Nguyễn Văn A</div>
                            <div class="dreport-info">
                                anguyen@ . PHP Fullstack Developer
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail">
                    <div class="detail-title">HỌC VẤN</div>
                    <div class="detail-education">
                        <div class="detail-row">
                            <div class="major-name">CN Công nghệ thông tin</div>
                            <div class="school-name">
                                Đại học bách khoa Hà Nội 
                                2015-2019
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail">
                    <div class="detail-title">KINH NGHIỆM LÀM VIỆC</div>
                    <div class="detail-exp-work">
                        <div class="detail-row">
                            <div class="work-position"></div>
                            <div class="work-company"></div>
                        </div>
                    </div>
                </div>
                <div class="detail">
                    <div class="detail-title">GIẢI THƯỞNG VÀ THÀNH TÍCH</div>
                    <div class="detail-award">
                        <div class="detail-row">
                            <div class="award-name"></div>
                            <div class="award-info"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT BAR -->
    <div class="right-bar">
        <div class="rbar-top">
            <div class="">Trần Thị Phương</div>
            <div>
                <div class="username">@phuongtran</div>
                <div class="email">phuong.tran@base.vn</div>
            </div>
        </div>
        <div class="rbar-account">
            <div class="rbar-title">THÔNG TIN TÀI KHOẢN</div>
            <div class="rbar-actions">
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-cog" aria-hidden="true"></i></div>
                    <div class="rbar-act"><a href="#">Tài khoản</a></div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-pencil" aria-hidden="true"></i></div>
                    <div class="rbar-act"><a href="#">Chỉnh sửa</a></div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-flickr" aria-hidden="true"></i></div>
                    <div class="rbar-act"><a href="#">Ngôn ngữ</a></div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
                    <div class="rbar-act"><a href="#">Đổi mật khẩu</a></div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-tachometer" aria-hidden="true"></i></div>
                    <div class="rbar-act"><a href="#">Đổi màu hiển thị</a></div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-shield" aria-hidden="true"></i></div>
                    <div class="rbar-act"><a href="#">Bảo mật hai lớp</a></div>                                                </a></div>
                </div>
            </div>
        </div>
        <div class="rbar-scurity">
            <div class="rbar-title">ỨNG DỤNG-BẢO MẬT</div>
            <div class="rbar-actions">
                <div class="rbar-row">
                    <div class="rbar-icon"></div>
                    <div class="rbar-act">Tài khoản</div>
                </div>
            </div>
        </div>
        <div class="rbar-optional">
            <div class="rbar-title">TÙY CHỈNH NÂNG CAO</div>
            <div class="rbar-actions">
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                    <div class="rbar-act">Lịch sử đăng nhập</div>
                </div>
            </div>
            <div class="rbar-actions">
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-television" aria-hidden="true"></i></div>
                    <div class="rbar-act">Quản lý thiết bị</div>
                </div>
            </div>
            <div class="rbar-actions">
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <div class="rbar-act">Tùy chỉnh email thông báo</div>
                </div>
            </div>
            <div class="rbar-actions">
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-superpowers" aria-hidden="true"></i></div>
                    <div class="rbar-act">Chỉnh sưả múi giờ</div>
                </div>
            </div>

            <div class="rbar-actions">
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-share-alt" aria-hidden="true"></i></div>
                    <div class="rbar-act">Ùy quyền tạm thời</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>