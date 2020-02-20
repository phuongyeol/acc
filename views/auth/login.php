<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Base Account</title>
    <link rel="shortcut icon" href="public/images/base-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <div id="container" class="full-height">
        <div id="login">
            <!-- Login header -->
            <div class="header">
                <div class="base-logo"><img src="public/images/logo.full.png" alt=""></div>
                <div class=""><h2>Login</h2></div>
                <div class="welcome gray">Welcome back. Login to start working.</div>
            </div>
            <!-- Login body -->
            <div class="body">
                <form name="form_login" action="?act=login" method="post">
                    <div class="login-form">
                        <div class="form-email row">
                            <div class="title">
                                <label for=""><b>Email</b></label>
                            </div>
                            <div class="input">
                                <input type="email" name="email" id="email" placeholder="Your email">
                            </div>
                        </div>
                        <div class="form-password row">
                            <div class="title">
                                <label for=""><b>Password</b></label>
                                <a href="#"><span class="a right">Forget your password?</span></a>
                            </div>
                            <div class="input">
                                <input type="password" name="password" id="password" placeholder="Your password">
                            </div>
                        </div>
                        <div class="login-remember row">
                            <input type="checkbox" name="remember" id="remember-me">
                            <span class="gray">Keep me logged in</span>
                        </div>
                        <div class="form-submit row">
                            <input type="submit" name="login" value="Login to start working">
                        </div>
                        <!-- Message error -->
                        <div class="message">
                            <?php if($msg != "") { ?>
                            <span class="red">Error: <?php echo @$msg;?></span>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Login footer -->
            <div class="footer">
                <div class="title gray">
                    <p>Or, login  via single sign-on</p>
                </div>
                <div class="login-with-app">
                    <input type="submit" value="Login with Google">
                    <input type="submit" value="Login with Microsoft">
                    <input type="submit" value="Login with SAML">
                </div>
                <div class="login-with-other">
                    <a href="#" class="a">Login with Guest/Client access?</a>
                </div>
                <div class="register">
                    <a href="views/auth/register.php" class="a">Create a new account?</a>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>