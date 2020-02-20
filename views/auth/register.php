<?php
    // Include config file
    require_once "../../config.php";

    // session start
    session_start();

    $username = $first_name = $last_name = "";
    $email = $job_title = $company_name = "";
    $password = $confirm_password = "";

    if (isset($_POST['create-account'])) {
        // Get data
        $username = trim($_POST['username']);
        $first_name = trim($_POST['first-name']);
        $last_name = trim($_POST['last-name']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $job_title = trim($_POST['job-title']); 
        $company_name = trim($_POST['company-name']);

        // Validation
        if ($username == null || $first_name == null || $last_name == null || $email == null || $password == null || 
        $confirm_password == null) {
            die ("Invalid or empty a require feild. Please try again.");
        } elseif ($password !== $confirm_password) {
            die ("Password must match. Please try again.");
        } elseif (strlen($password) < 8) {
            die ("Password mus have at least 8 characters.");
        } 

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Base Account</title>
    <link rel="shortcut icon" href="../../public/images/base-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/login.css">
</head>
<body>
    <div id="container" class="full-height">
        <div id="register">
            <!-- Register header -->
            <div class="header">
                <div class="base-logo"><img src="../../public/images/logo.full.png" alt=""></div>
                <div class=""><h2>Sign Up</h2></div>
                <div class="welcome gray">Welcome. Sign up to start working.</div>
            </div>
            <!-- Register body -->
            <div class="body">
                <form action="?act=register" name="register" method="post">
                    <div class="register-form">
                        <div class="row form-avatar">
                        <div class="title"><label for=""><b>Avatar</b></label></div>
                            <div class="avatar">
                                <input type="file" name="avatar" id="avatar">
                            </div>
                        </div>
                        <div class="row form-username">
                            <div class="title">
                                <label for=""><b>Username</b></label>
                                <span class="red">*</span>
                            </div>
                            <div class="input">
                                <input type="text" name="username" id="username" placeholder="Your username">
                            </div>
                        </div>
                        <div class="row form-fullname col2">
                            <div class="first-name">
                                <div class="title">
                                    <label for=""><b>First name</b></label>
                                    <span class="red">*</span>
                                </div>
                                <div class="input">
                                    <input type="text" name="first-name" id="first-name" placeholder="Your first name">
                                </div>
                            </div>
                            <div class="last-name">
                                <div class="title"><label for="">
                                    <b>Last name</b></label>
                                    <span class="red">*</span>
                                </div>
                                <div class="input">
                                    <input type="text" name="last-name" id="last-name" placeholder="Your last name">
                                </div>
                            </div>
                        </div>
                        <div class="row form-email">
                            <div class="title">
                                <label for=""><b>Email</b></label>
                                <span class="red">*</span>
                            </div>
                            <div class="input">
                                <input type="email" name="email" id="email" placeholder="Your email">
                            </div>
                        </div>
                        <div class="row form-password col2">
                            <div class="password">
                                <div class="title">
                                    <label for=""><b>Password</b></label>
                                    <span class="red">*</span>
                                </div>
                                <div class="input">
                                    <input type="password" name="password" id="password" placholder="Your password">
                                </div>
                            </div>
                            <div class="confirm-password">
                                <div class="title">
                                    <label for=""><b>Confirm Password</b></label>
                                    <span class="red">*</span>
                                </div>
                                <div class="input">
                                    <input type="password" name="confirm-password" id="comfirm-password" placeholder="Confirm your password">
                                </div>
                            </div>
                        </div>
                        <div class="row form-job-title">
                            <div class="title"><label for=""><b>Job Title</b></label></div>
                            <div class="input">
                                <input type="text" name="job-title" id="job-title" placeholder="Your job title">
                            </div>
                        </div>
                        <div class="row form-company">
                            <div class="title"><label for=""><b>Company name</b></label></div>
                            <div class="input">
                                <input type="text" name="company-name" id="company-name" placeholder="Your company name">
                            </div>
                        </div>
                        <div class="row form-submit">
                            <input type="submit" name="register" value="Create a new account">
                        </div>
                    </div>
                </form>
            </div>
            <!-- Register footer -->
            <div class="footer">
                <div class="register">
                    <p><a href="../../views/auth/login.php" class="a">Login with regular access?</a></p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <script src="../../public/js/login.js"></script>
        <script type="text/javascript">

        </script>
    </footer>
</body>
</html>