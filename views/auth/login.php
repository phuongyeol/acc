<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Base Account</title>
</head>
<body>
    <div class="left-bar">
        <div class="header"></div>
            <div class="base-logo">
                <img src="public/logo.full.png" alt="">
            </div>
            <div class="welcome">
                <p><h3>Login</h3></p>
                <p>Welcome back. Login to start working.</p>
            </div>
        </div>

        <div class="body">
            <div class="login-form">
                <div class="login-email">
                    <div class="email-title">
                        <label for="">Email</label>
                    </div>
                    <div class="email-input">
                        <input type="email" name="email" id="email">
                    </div>
                </div>
                <div class="login-password">
                    <div class="password-title">
                        <label for="">Password</label>
                        <span>Forget your password?</span>
                    </div>
                    <div class="password-input">
                        <input type="password" name="password" id="password">
                    </div>
                </div>
            </div>
            <div class="login-remember">
                <input type="checkbox" name="remember" id="remember-me">
                <span>Keep me logged in</span>
            </div>
            <div class="login-submit">
                <button type="submit">Login to start working</button>
            </div>
        </div>
        
        <div class="footer">
            <div class="title">
                <p>Or, login  via single sign-on</p>
            </div>
            <div class="login-with-app">
                <button type="submit">Login with Google</button>
                <button type="submit">Login with Microsoft</button>
                <button type="submit">Login with SAML</button>
            </div>
            <div class="login-with-other">
                <a href="#">Login with Guest/Client access?</a>
            </div>
        </div>
    </div>
    
    <div class="right-bar">
        <img src="public/background.png" alt="">
    </div>
</body>
</html>