<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>10520138-Nguyễn Văn Thịnh</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
	
			<style type="text/css">
				@import url(fonts/font-awesome-4.2.0/css/font-awesome.min.css);

			body {padding-top:50px;}

			.box {
				border-radius: 3px;
				box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
				padding: 10px 25px;
				text-align: right;
				display: block;
				margin-top: 60px;
			}
			.box-icon {
				background-color: #57a544;
				border-radius: 50%;
				display: table;
				height: 100px;
				margin: 0 auto;
				width: 100px;
				margin-top: -61px;
			}
			.box-icon span {
				color: #fff;
				display: table-cell;
				text-align: center;
				vertical-align: middle;
			}
			.info h4 {
				font-size: 26px;
				letter-spacing: 2px;
				text-transform: uppercase;
			}
			.info > p {
				color: #717171;
				font-size: 16px;
				padding-top: 10px;
				text-align: justify;
			}
			.info > a {
				background-color: #03a9f4;
				border-radius: 2px;
				box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
				color: #fff;
				transition: all 0.5s ease 0s;
			}
			.info > a:hover {
				background-color: #0288d1;
				box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.12);
				color: #fff;
				transition: all 0.5s ease 0s;
			}
				</style>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php
@session_start();
if(isset($_GET['do']) && $_GET['do'] == 'signout'){
@session_unset(); #removes all the variables in the session
@session_destroy(); #destroys the session
?>
				<div class="container">
					<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
						<div class="box">
							<div class="box-icon">
								<!--<span class="fa fa-4x fa-html5"></span>-->
								<span class="fa fa-4x fa-check"></span>
							</div>
							<div class="info">
								<p style="text-align: center;">Bạn đã đăng xuất! Hãy quay lại nhé!</p>
								<!--<a href="" class="btn">Link</a>-->
							</div>
						</div>
					</div>
				</div>
<?php
header('refresh:3;url=index.php');
}else{
	if(isset($_SESSION['username']))
	{
		header('Location: index.php');
	}else{
		/*Xử lý khi đăng ký*/

		if(isset($_POST['signup_chat']))
		{
			if($_POST['txtCaptcha'] == NULL)
			{
				//echo "Hãy nhập mã bảo mật!";
				?>
					<div class="container">
						<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
							<div class="box">
								<div class="box-icon" style="background-color: #E05454;">
									<!--<span class="fa fa-4x fa-html5"></span>-->
									<span class="fa fa-4x fa-exclamation-circle"></span>
								</div>
								<div class="info">
									<h4 class="text-center">Lỗi</h4>
									<p style="text-align: center;">Bạn chưa nhập mã bảo mật!</p>
									<!--<a href="" class="btn">Link</a>-->
								</div>
							</div>
						</div>
					</div>
				<?php
				header('refresh:3;url=login.php');
			}
			else
			{
				if($_POST['txtCaptcha'] == $_SESSION['security_code'])
				{
					//echo "Mã bảo mật chính xác!";
					require_once('./server.php');
					Signup();
				}
				else
				{
					//echo "Mã bảo mật không chính xác!";
					?>
						<div class="container">
							<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
								<div class="box">
									<div class="box-icon" style="background-color: #E05454;">
										<!--<span class="fa fa-4x fa-html5"></span>-->
										<span class="fa fa-4x fa-exclamation-circle"></span>
									</div>
									<div class="info">
										<h4 class="text-center">Lỗi</h4>
										<p style="text-align: center;">Mã bảo mật không chính xác!</p>
										<!--<a href="" class="btn">Link</a>-->
									</div>
								</div>
							</div>
						</div>
					<?php
					header('refresh:3;url=login.php');
				}
			}
		}
		/*Xử lý khi đăng nhập*/
		if(isset($_POST['signin_chat']))
		{
			//if(isset($_POST['username']) && isset($_POST['password'])){
				/*$_SESSION['username'] = $_POST['username'];
				echo "Đăng nhập thành công";
				header('Location: index.php');*/
				require_once('./server.php');
				Signin();
				//echo $_POST['username'];
				//echo $_POST['password'];
			//}
			//else
			//{
				//echo "Đăng nhập thất bại";
			//}
		}
		if(!isset($_POST['signin_chat']) && !isset($_POST['signup_chat']))
		{
	?>

			<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
						<div class="panel-heading">
							<div class="panel-title">Đăng nhập</div>
							<div style="float:right; font-size: 85%; position: relative; top:-10px">
								<a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
									Đăng ký
								</a>
							</div>
						</div>     

						<div style="padding-top:30px" class="panel-body" >

							<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
								
							<form id="loginform" class="form-horizontal" role="form" method=post>
										
								<div style="margin-bottom: 25px" class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Tên đăng nhập">                                        
										</div>
									
								<div style="margin-bottom: 25px" class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
											<input id="login-password" type="password" class="form-control" name="password" placeholder="Mật khẩu">
										</div>

									<!--
								<div class="input-group">
										  <div class="checkbox">
											<label>
											  <input id="login-remember" type="checkbox" name="remember" value="1"> Ghi nhớ
											</label>
										  </div>
										</div>-->


									<div style="margin-top:10px" class="form-group">
										<!-- Button -->

										<div class="col-sm-12 controls">
										  <button id="btn-fblogin" href="#" type="submit" name="signin_chat" class="btn btn-primary">Đăng nhập</button>

										</div>
									</div>

	<!--
									<div class="form-group">
										<div class="col-md-12 control">
											<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
												Chưa có tài khoản! 
											<a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
												Đăng ký
											</a>
											</div>
										</div>
									</div> 
	-->								
								</form>     



							</div>                     
						</div>  
			</div>
			<div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title">Đăng ký tài khoản</div>
								<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Đăng nhập</a></div>
							</div>  
							<div class="panel-body" >
								<form id="signupform" class="form-horizontal" role="form" method=post>
									
									<div id="signupalert" style="display:none" class="alert alert-danger">
										<p>Lỗi:</p>
										<span></span>
									</div>
										
									
									  
									<div class="form-group">
										<label for="email" class="col-md-3 control-label">Email</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="email" placeholder="Địa chỉ Email">
										</div>
									</div>
										
									<div class="form-group">
										<label for="username" class="col-md-3 control-label">Tên đăng nhập</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="username" placeholder="Tên đăng nhập">
										</div>
									</div>
									<div class="form-group">
										<label for="password" class="col-md-3 control-label">Mật khẩu</label>
										<div class="col-md-9">
											<input type="password" class="form-control" name="passwd" placeholder="Mật khẩu">
										</div>
									</div>
									<div class="form-group">
										<label for="repassword" class="col-md-3 control-label"></label>
										<div class="col-md-9">
											<input type="repassword" class="form-control" name="repasswd" placeholder="Nhập lại mật khẩu">
										</div>
									</div>
										
									<div class="form-group">
										<!--<label for="icode" class="col-md-3 control-label"><img src="capcha.php" alt="CAPTCHA image" align="top" /></label>-->
										<label for="icode" class="col-md-3"><img src="capcha.php" alt="CAPTCHA image" align="top" /></label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="txtCaptcha" id="txtCaptcha" placeholder="Nhập mã bảo mật" />
											
										</div>
									</div>

									<div class="form-group">
										<!-- Button -->                                        
										<div class="col-md-offset-3 col-md-9">
											<button id="btn-signup" type="submit" name="signup_chat" class="btn btn-info"><i class="icon-hand-right"></i>Đăng ký</button>
										</div>
									</div>
									
									
									
								</form>
							 </div>
						</div>
			 </div> 
		</div>
		
		
	<?php
		}
	}
}
?>
<script type="text/javascript">
	
	</script>
</body>
</html>