<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/classroom.ico" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Welcome to MyTutor</title>
    <script src="script/login.js"></script>
</head>
<body class="bg" onload="loadCookies()">
    <div>
        <header class="header w3-card w3-center w3-padding-16">
            <div style="font-size: 225%; font-weight: bold"><i class="fa fa-graduation-cap"></i> MyTutor</div>
            <br />
            <div style="font-size: 18px">
                <button class="link w3-button" onclick="document.getElementById('register').style.display='block';">Registration</button>
                <span style="margin: 0 20px"></span>
                <button class="link w3-button" onclick="document.getElementById('login').style.display='block';">Login</button>
            </div>
        </header>
        <div class="w3-container w3-padding-32" style="max-width: 1024px; margin: 0 auto; padding-left: 64px; padding-right: 64px; word-wrap: keep-all">
            <div class="w3-row" style="display: flex; align-items: center; justify-content: center">
                <div class="w3-col m7 l6">
                    <p>Lorem ipsum dolor sit amet. Vel iure neque a reprehenderit atque ut nemo commodi ut nihil alias sit quidem autem ut neque mollitia. A officiis nihil voluptatem distinctio ut voluptates aut consequatur molestiae! Ut velit expedita et aperiam laboriosam ea facilis illum eum inventore quas hic quam sapiente eum reprehenderit ducimus et corrupti. Sed sint cupiditate ut repellendus amet non tempora voluptates et amet deserunt.</p>
                    <p>Et quos iure qui ducimus minima sed quaerat eaque et quis quos ea eligendi accusamus eum iste possimus qui ducimus voluptatum. Qui possimus sunt eos reprehenderit quam et recusandae laudantium.</p>
                    <p>Id assumenda fuga est nihil consequatur est accusamus cupiditate. Ut omnis voluptas sit officia dolor id eligendi adipisci! Qui unde cupiditate id labore corrupti et voluptate laudantium id nemo necessitatibus est exercitationem laboriosam. A distinctio quisquam id placeat nostrum non alias similique et repellat quia At dolor facilis eos nihil nemo.</p>
                </div>
                <div class="w3-col m5 l6 w3-hide-small" style="padding-left: 48px">
                    <p><img src="img/study.jpg" alt="Study_1" style="max-width: 100%; height: auto; border-radius: 10px; box-shadow: 5px 5px 15px #333" class="slideshow" /></p>
                    <p><img src="img/study_2.jpg" alt="Study_2" style="max-width: 100%; height: auto; border-radius: 10px; box-shadow: 5px 5px 15px #333" class="slideshow" /></p>
                    <p><img src="img/study_3.jpg" alt="Study_3" style="max-width: 100%; height: auto; border-radius: 10px; box-shadow: 5px 5px 15px #333" class="slideshow" /></p>
                </div>
            </div>
        </div>
        <!-- Register Modal -->
        <div id="register" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-center w3-animate-zoom">
                <header class="header w3-center w3-container w3-padding w3-large">
                    <span onclick="document.getElementById('register').style.display='none';" class="w3-button w3-display-topright">&times;</span>
                    <p><b>Registration</b></p>
                </header>
                <form name="user_reg" action="php/register.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
                    <div class="w3-padding">
                        <!-- User Profile IMG -->
                        <div class="w3-padding-16">
                            <img class="w3-image" src="img/user_profile.png" alt="User Profile" style="max-height: 10%; max-width: 10%; border-radius: 50%" />
                            <span style="margin: 0 15px"></span>
                            <input type="file" id="img" name="image" onchange="check_file(); preview_img()" />
                        </div>
                        <!-- E-mail -->
                        <div class="w3-row w3-padding" style="display: flex; align-items: center; justify-content: center">
                            <div class="w3-col s1 m1 l1">
                                <i class="fa fa-envelope fa-lg"></i>
                            </div>
                            <span style="margin: 0 15px"></span>
                            <div class="w3-col s5 m6 l7">
                                <input class="w3-input w3-border w3-round" name="email" type="email" placeholder="E-mail" required />
                            </div>
                        </div>
                        <!-- Name -->
                        <div class="w3-row w3-padding" style="display: flex; align-items: center; justify-content: center">
                            <div class="w3-col s1 m1 l1">
                                <i class="fa fa-user fa-lg"></i>
                            </div>
                            <span style="margin: 0 15px"></span>
                            <div class="w3-col s5 m6 l7">
                                <input class="w3-input w3-border w3-round" name="name" type="text" placeholder="Name" required />
                            </div>
                        </div>
                        <!-- Phone No. -->
                        <div class="w3-row w3-padding" style="display: flex; align-items: center; justify-content: center">
                            <div class="w3-col s1 m1 l1">
                                <i class="fa fa-phone fa-lg"></i>
                            </div>
                            <span style="margin: 0 15px"></span>
                            <div class="w3-col s5 m6 l7">
                                <input class="w3-input w3-border w3-round" name="phone" type="tel" placeholder="Phone No." required />
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="w3-row w3-padding" style="display: flex; align-items: center; justify-content: center">
                            <div class="w3-col s1 m1 l1">
                                <i class="fa fa-lock fa-lg"></i>
                            </div>
                            <span style="margin: 0 15px"></span>
                            <div class="w3-col s5 m6 l7">
                                <input class="w3-input w3-border w3-round" name="password" id="password" type="password" placeholder="Password" required />
                            </div>
                        </div>
                        <!-- Confirm Password -->
                        <div class="w3-row w3-padding" style="display: flex; align-items: center; justify-content: center">
                            <div class="w3-col s1 m1 l1">
                                <i class="fa fa-unlock-alt fa-lg"></i>
                            </div>
                            <span style="margin: 0 15px"></span>
                            <div class="w3-col s5 m6 l7">
                                <input class="w3-input w3-border w3-round" name="confirm_password" id="confirm_password" type="password" placeholder="Confirm Password" onchange="check_pw()" required />
                            </div>
                        </div>
                        <!-- Home Address -->
                        <div class="w3-row w3-padding" style="display: flex; align-items: center; justify-content: center">
                            <div class="w3-col s1 m1 l1">
                                <i class="fa fa-home fa-lg"></i>
                            </div>
                            <span style="margin: 0 15px"></span>
                            <div class="w3-col s5 m6 l7">
                                <textarea class="w3-input w3-border w3-round" rows="4" width="100%" name="home_address" placeholder="Home Address" required></textarea>
                            </div>
                        </div>
                        <div class="w3-padding-32">
                            <button class="w3-button w3-cyan w3-round w3-large" type="submit" id="reg" name="register" disabled>Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Login Modal -->
        <div id="login" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom">
                <header class="header w3-center w3-container w3-padding w3-large">
                    <span onclick="document.getElementById('login').style.display='none';" class="w3-button w3-display-topright">&times;</span>
                    <p><b>Login</b></p>
                </header>
                <form name="user_login" action="php/login.php" method="post">
                    <div class="w3-container w3-center w3-padding">
                        <!-- Login IMG -->
                        <div class="w3-padding-16">
                            <img class="w3-image" src="img/login.png" alt="Login" style="max-height: 10%; max-width: 10%; border-radius: 50%" />
                        </div>
                        <!-- E-mail -->
                        <div class="w3-row w3-padding" style="display: flex; align-items: center; justify-content: center">
                            <div class="w3-col s1 m1 l1">
                                <i class="fa fa-envelope fa-lg"></i>
                            </div>
                            <span style="margin: 0 15px"></span>
                            <div class="w3-col s5 m6 l7">
                                <input class="w3-input w3-border w3-round" name="email" id="email_id" type="email" placeholder="E-mail" required />
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="w3-row w3-padding" style="display: flex; align-items: center; justify-content: center">
                            <div class="w3-col s1 m1 l1">
                                <i class="fa fa-lock fa-lg"></i>
                            </div>
                            <span style="margin: 0 15px"></span>
                            <div class="w3-col s5 m6 l7">
                                <input class="w3-input w3-border w3-round" name="password" id="password_id" type="password" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="w3-padding">
                            <input class="w3-check" type="checkbox" name="remember_me" id="remember_id" onclick="rememberMe()" />
                            <label>Remember Me</label>
                        </div>
                        <div class="w3-padding-32">
                            <button class="w3-button w3-cyan w3-round w3-large" type="submit" name="login">Login</button>
                        </div>
                    </div>
                </form>
                <div id="cookieNotice" class="w3-right w3-padding-32 w3-block w3-container w3-white w3-modal-content" style="display: none; margin: 0 auto">
                    <div class=" w3-padding" style="background-image: linear-gradient(to bottom , #20dfdf, #dcdcdc);">
                        <h4><b>Cookie Consent</b></h4>
                        <p>This website uses cookies or similar technologies, to enhance your browsing experience and provide personalized recommendations. By continuing to use our website, you agree to our <a style="color:#115cfa;" href="php/privacy_policy.php">Privacy Policy</a>.
                        </p>
                        <p>
                            <button class="w3-button w3-cyan w3-round" onclick="acceptCookieConsent();">Accept</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer w3-center w3-padding">&copy; MyTutor 2022</footer>
    </div>
</body>
<script src="script/script.js"></script>
<script>
    let cookie_consent = getCookie("user_cookie_consent");
    
    if (cookie_consent != "") {
        document.getElementById("cookieNotice").style.display = "none";
    } else {
        document.getElementById("cookieNotice").style.display = "block";
    }
</script>
</html>
