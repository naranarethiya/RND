<!DOCTYPE html>
<html class="bg-blue">
<head>
    @include('master.head')
</head>
    <body class="bg-blue">
        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form action="{{URL::to('/login')}}" method="post">
                <div class="body bg-gray">
                    
            @include('message')
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <label><input type="checkbox" value="1" name="remember_me"/> Remember me</label>
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                    <p><a href="#">I forgot my password</a></p>
                </div>
            </form>
        </div>  

    </body>
</html>