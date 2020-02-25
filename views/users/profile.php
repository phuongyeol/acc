<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Account</title>
    <link rel="shortcut icon" href="public/images/base-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/profile/profile.css">
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php $user = $_SESSION['user_login'] ?>
    <!-- LEFT BAR -->
    <div class="left-bar">
        <div class="lbar">
            <div class="lbar-row lbar-avatar">
                <?php if ($user['avatar'] != '') { ?>
                    <img src="upload/avatars/<? echo $user['avatar']; ?>">
                <?php } else {?>
                    <img src="public/images/avatar_default.png">
                <?php } ?>
            </div>
            <div class="lbar-row profile">
                <div class="lbar-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
                <div class="lbar-title"><a href="?mod=account&act=profile">Cá nhân</a></div>
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
            <div class="lbar-logout lbar-title">
                <a href="?mod=account&act=logout">Logout</a>
            </div>
        </div>
    </div>

    <!-- CONTAINER -->
    <div class="container">
        <div class="container-top">
            <div class="top-icon"><i class="fa fa-arrow-left" aria-hidden="true"></i></div>
            <div class="top-title">
                <div class="top-account">TÀI KHOẢN</div>
                <div class="top-name"><?php echo $user['last_name'] . ' ' . $user['first_name'] ?></div>
            </div>
            <div class="top-act">
                <button id="myBtn">
                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                    &nbsp; Chỉnh sửa tài khoản
                </button>
            </div>
        </div>
        
        <div class="container-body">
            <div class="body-info">
                <div class="info-avatar">
                    <?php if ($user['avatar'] != '') { ?>
                        <img src="upload/avatars/<? echo $user['avatar']; ?>">
                    <?php } else {?>
                        <img src="public/images/avatar_default.png">
                    <?php } ?>
                </div>
                <div class="info-detail">
                    <div class="info-name"><?php echo $user['last_name'] . ' ' . $user['first_name'] ?></div>
                    <div class="info-position">
                        <?php echo $user['job_title']!=''?$user['job_title']:'(Không có)'; ?> 
                        &nbsp;·&nbsp; 
                        <?php echo $user['company_name']!=''?$user['company_name']:'(Không có)'; ?>
                    </div>
                    <div class="info-contact">
                        <div class="info-title">Địa chỉ email</div>
                        <div class="info-detail"><?php echo $user['email']; ?></div>
                    </div>
                    <div class="info-contact">Số điện thoại</div>
                </div>
            </div>
            <div class="body-detail">
                <div class="list contacts">
                    <div class="list-title">THÔNG TIN LIÊN HỆ</div>
                    <div class="list-row">
                        <div class="row-name">Địa chỉ nhà</div>
                        <div class="row-info">227 ngõ 211 Khương Trung, Thanh Xuân, Hà Nội.</div>
                    </div>
                    <div class="list-row">
                        <div class="row-name">Facebook </div>
                        <div class="row-info">https://www.facebook.com/phuong.yeolyeol</div>
                    </div>
                </div>
                <div class="list groups">
                    <div class="list-title">NHÓM</div>
                    <div class="list-row">
                        <div class="row-name"><b>Product</b></div>
                        <div class="row-info">
                            46 thành viên &nbsp;·&nbsp; Tham gia ngày 17/02/2020
                        </div>
                    </div>
                </div>
                <div class="list dreports">
                    <div class="list-title">DIRECT REPORTS</div>
                    <div class="list-row">
                        <div class="row-name"><b>Nguyễn Văn A</b></div>
                        <div class="row-info">
                            anguyen@ &nbsp;·&nbsp; PHP Fullstack Developer
                        </div>
                    </div>
                </div>
                <div class="list educations">
                    <div class="list-title">HỌC VẤN</div>
                    <div class="list-row">
                        <div class="row-name"><b>CN Công nghệ thông tin</b></div>
                        <div class="row-info">
                            Đại học bách khoa Hà Nội 
                            2015-2019
                        </div>
                    </div>
                </div>
                <div class="list exp-works">
                    <div class="list-title">KINH NGHIỆM LÀM VIỆC</div>
                    <div class="list-row">
                        <div class="row-name"><b></b></div>
                        <div class="row-info"></div>
                    </div>
                </div>
                <div class="list awards">
                    <div class="list-title">GIẢI THƯỞNG VÀ THÀNH TÍCH</div>
                    <div class="list-row">
                        <div class="row-name"><b></b></div>
                        <div class="row-info"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT BAR -->
    <div class="right-bar">
        <div class="rbar-top">
            <div class="top-name"><?php echo $user['last_name'] . ' ' . $user['first_name'] ?></div>
            <div class="top-subname">
                <?php echo $user['username']; ?> &nbsp;·&nbsp; <?php echo $user['email']; ?>
            </div>
        </div>
        <div class="rbar-menu">
            <div class="rbar-title">THÔNG TIN TÀI KHOẢN</div>
            <div class="rbar-actions">
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-cog" aria-hidden="true"></i></div>
                    <div class="rbar-act">Tài khoản</div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-pencil" aria-hidden="true"></i></div>
                    <div class="rbar-act">Chỉnh sửa</div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-flickr" aria-hidden="true"></i></div>
                    <div class="rbar-act">Ngôn ngữ</div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
                    <div class="rbar-act">Đổi mật khẩu</div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-tachometer" aria-hidden="true"></i></div>
                    <div class="rbar-act">Đổi màu hiển thị</div>
                </div>
                <div class="rbar-row">
                    <div class="rbar-icon"><i class="fa fa-shield" aria-hidden="true"></i></div>
                    <div class="rbar-act">Bảo mật hai lớp</div>
                </div>
            </div>
        </div>
        <div class="rbar-menu">
            <div class="rbar-title">ỨNG DỤNG - BẢO MẬT</div>
            <div class="rbar-actions">
                <div class="rbar-row">
                    <div class="rbar-icon"></div>
                    <div class="rbar-act"></div>
                </div>
            </div>
        </div>
        <div class="rbar-menu">
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
                    <div class="rbar-act">Chỉnh sửa múi giờ</div>
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

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-header">
                <span class="close">&times;</span>
                <b>CHỈNH SỬA THÔNG TIN CÁ NHÂN</b>
            </div>
            <form action="?mod=account&act=edit&id=<?php echo $user['id'] ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="modal-row">
                        <div class="modal-title"><b>Tên của bạn:</b></div>
                        <div class="modal-input">
                            <input type="text" name="first_name" id="first_name" value="<? echo $user['first_name'] ?>">
                        </div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-title"><b>Họ của bạn:</b></div>
                        <div class="modal-input">
                            <input type="text" name="last_name" id="last_name" value="<? echo $user['last_name']?>">
                        </div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-title"><b>Ảnh đại diện:</b></div>
                        <div class="modal-input">
                            <input type="file" name="avatar" id="avatar" value="">
                        </div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-title"><b>Vị trí công việc:</b></div>
                        <div class="modal-input">
                            <input type="text" name="job_title" id="job_title" value="<? echo $user['job_title']?>">
                        </div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-title"><b>Công ty:</b></div>
                        <div class="modal-input">
                            <input type="text" name="company_name" id="company_name" value="<? echo $user['company_name'] ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <input type="submit" class="button btn-cancel" name="cancel" value="Bỏ qua"> -->
                    <!-- <div class="button btn-cancel">Bỏ qua</div> -->
                    <input type="submit" class="button btn-success" name="edit-profile" value="Cập nhật">
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>