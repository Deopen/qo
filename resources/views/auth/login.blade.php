
<!-- 
Written By Omid Yaghoubi (DeOpen)
DeOpenMail@gmail.com
+98935-822-23-55
-->

<!DOCTYPE html>
<html>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <head>
    <title>Login</title>
    </head>
    <body>
    
    <form action="{{ url('/login') }}" method="post" name="login_form">
        
        {!! csrf_field() !!}
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
        
        <div class="login_container" id="login_container">
        
        


        <div class="banner">
        <img id="img_banner" src=" {{ asset('img/SIB.png') }} "></img>   
        </div> <!-- end loginBanner -->
            
            <div class="user_pass_containter">
            <input type="text" required name="username" placeholder="Username" value="{{ old('username') }}">
            @if ($errors->has('username'))
                <span class="error">
                <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif

            <input type="password" required name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="error">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif


            <input style="
            background-color: hsla(190, 35%, 30%,0.35);
            margin-top: 8%;
            " 
            type="submit" value="Login" name="login">

            <div class="checkbox">
                <input type="checkbox" name="remember_me" id="remember_me">
                <font color="hsla(290, 85%, 35%,0.6)">
                <label for="remember_me" >Remember Me</label>
                </font>
            </div>

            <div align="center" 
            class="g-recaptcha" id="captcha" data-sitekey={{ env("RE_CAP_SITE_KEY") }}
            data-theme= "dark"
            ></div>

            @if ($errors->has('g-recaptcha-response'))
                <span class="error">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif


        </div> <!-- end user pass container -->
        
        

        
        </div> <!-- end login fold -->

    </form>

    <script type="text/javascript">
    
        function printLn(element){

            document.write(element+"<br>")
        }//end print line

        function getEl(id){
            return document.getElementById(id)
        }//end get el

        function captchaScaleDown() {
            var loginContainerHeight=getEl("login_container").offsetHeight
            var loginContainerWidth=getEl("login_container").offsetWidth
            var el=getEl("captcha")
            var diffW=loginContainerWidth*0.0025
            var diffH=loginContainerHeight*0.0020
            
            
            //el.style.transform="scale("+diffW+","+diffH+")"
            el.style.transform="scale(0.8,0.8)"
        }//end captcha scale down
        
        window.onresize=captchaScaleDown;
        window.onload=captchaScaleDown;
    </script>

    </body>
</html>
