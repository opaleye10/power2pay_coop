<div class="login">
    <h1><a href="#"><span style="color: #000000; font-size: .7em"  >Power</spane><span style="color: #228B22; font-size: 1em">2</span><span style="color: #000000; font-size: .7em">Pay</span> <span style="font-size: 0.3em"> Ver 1.0 </span></a></h1>
    <div class="login-bottom">
        <h2>Login</h2>
        <form method="post" enctype="multipart/form-data" action="<?php echo URL ;?>login/permit">
            <div class="col-md-6">
                <div class="login-mail">
                    <input type="text"  name="_login_name" placeholder="Username" required="">
                    <i class="fa fa-user"></i>
                </div>
                <div class="login-mail">
                    <input type="password" name="_login_password" placeholder="Password" required="">
                    <i class="fa fa-lock"></i>
                </div>

            </div>
            <div class="col-md-6 login-do">
                <label class="hvr-shutter-in-horizontal login-sub">
                    <input type="submit" value="login">
                </label>
                <p>Do not have an account? Contact Administrator.</p>

            </div>

            <div class="clearfix"> </div>
        </form>
    </div>
</div>
<!---->