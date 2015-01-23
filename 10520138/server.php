<?php
function ConnectDatabase(){
	mysql_connect("localhost","root","") or die("Ket noi khong thanh cong");
	mysql_select_db("10520138") or die("khong tim thay co so du lieu nay");
	mysql_query("SET NAMES utf8");
}
function Signup(){
	
	@session_start();
	if(($_POST['username']=="") OR ($_POST['passwd']=="") OR ($_POST['repasswd']=="") OR ($_POST['email']=="") OR ($_POST['passwd']!= $_POST['repasswd']))
	{	
		/*echo "-Bạn chưa điền đủ thông tin!";
		if($_POST['passwd']!= $_POST['repasswd']){
			echo "<br/>-Mật khẩu không khớp!";
		}
		*/
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
									<p style="text-align: center;">-Bạn chưa điền đủ thông tin!</p>
									<?php 
									if($_POST['passwd']!= $_POST['repasswd']){
										echo '<p style="text-align: center;">-Mật khẩu không khớp!</p>';
									}
									?>
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
		ConnectDatabase();
		$time = time();
		$username = $_POST['username'];
		$password = md5(md5($_POST['passwd']).$username);
		$usergroup = 2;
		$email = $_POST['email'];
		// kiểm tra user tồn tại chưa
		$sql_user = "SELECT * FROM user WHERE(username='".$username."')";
		$query_user = mysql_query($sql_user);
		$result_user = mysql_fetch_array($query_user);
		// kiểm tra email tồn tại chưa
		$sql_email = "SELECT * FROM user WHERE(email='".$email."')";
		$query_email = mysql_query($sql_email);
		$result_email = mysql_fetch_array($query_email);
		if($result_user[0]==0)
		{
			if($result_email[0]==0)
			{
				$adduser = mysql_query("
					INSERT INTO user (username, password, usergroup, email, dateline)
					VALUES
						('$username', '$password', '$usergroup', '$email', '$time')
				");
				
				$_SESSION['userid'] = mysql_insert_id();
				//echo "Đã đăng ký thành công";
				?>
				<div class="container">
					<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
						<div class="box">
							<div class="box-icon">
								<!--<span class="fa fa-4x fa-html5"></span>-->
								<span class="fa fa-4x fa-check"></span>
							</div>
							<div class="info">
								<h4 class="text-center"><?php echo $username; ?></h4>
								<p style="text-align: center;">Đã đăng ký thành công!</p>
								<!--<a href="" class="btn">Link</a>-->
							</div>
						</div>
					</div>
				</div>
				<?php
				$_SESSION['username'] = $username;
				//header('Location: index.php');
				header('refresh:3;url=index.php');
			}else{
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
									<p style="text-align: center;">Email đã tồn tại!</p>
									<!--<a href="" class="btn">Link</a>-->
								</div>
							</div>
						</div>
					</div>
				<?php
				break;
				header('refresh:3;url=login.php');
			}
		}else{
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
									<p style="text-align: center;">Tài khoản đã tồn tại!</p>
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
function Signin(){
	?>
	<?php
	@session_start();
	if($_POST['username'] == "" OR $_POST['password'] == "")
	{	
		?>
				<div class="container">
					<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
						<div class="box">
							<div class="box-icon" style="background-color: #E05454;">
								<!--<span class="fa fa-4x fa-html5"></span>-->
								<span class="fa fa-4x fa-exclamation-circle"></span>
							</div>
							<div class="info">
								<h4 class="text-center">Thất bại</h4>
								<?php
								if($_POST['username']==""){
									echo '<p style="text-align: center;">-Bạn chưa nhập Tên đăng nhập!</p>';
								}
								if($_POST['password']==""){
									echo '<p style="text-align: center;">-Bạn chưa nhập Mật khẩu!</p>';
								}
								?>
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
		ConnectDatabase();
		$username = $_POST['username'];
		$password = md5(md5($_POST['password']).$username);
		
		$sql = "SELECT * FROM user WHERE(
			username='".$username."' and  password='".$password."')";
		$query = mysql_query($sql);
		$result = mysql_fetch_array($query);
	 
		if($result[0]>0)
		{
			$_SESSION['username'] = $username;
			$_SESSION['userid'] = $result['id'];
			//echo "Đăng nhập thành công";
			?>
				<div class="container">
					<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
						<div class="box">
							<div class="box-icon">
								<!--<span class="fa fa-4x fa-html5"></span>-->
								<span class="fa fa-4x fa-check"></span>
							</div>
							<div class="info">
								<h4 class="text-center"><?php echo $username; ?></h4>
								<p style="text-align: center;">Đăng nhập thành công! Chúc bạn online vui vẻ ^^ .</p>
								<!--<a href="" class="btn">Link</a>-->
							</div>
						</div>
					</div>
				</div>
			<?php
			//header('Location: index.php');
			header('refresh:3;url=index.php');
		}else{
			?>
				<div class="container">
					<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
						<div class="box">
							<div class="box-icon" style="background-color: #E05454;">
								<!--<span class="fa fa-4x fa-html5"></span>-->
								<span class="fa fa-4x fa-exclamation-circle"></span>
							</div>
							<div class="info">
								<h4 class="text-center">Thất bại</h4>
								<p style="text-align: center;">Sai Tên tài khoản hoặc Mật khẩu!</p>
								<!--<a href="" class="btn">Link</a>-->
							</div>
						</div>
					</div>
				</div>
			<?php
			header('refresh:3;url=login.php');
			//header('refresh:1;url=login.php');
		}
	}
}
if(isset($_POST['sendMessage'])){
	sendMessage();
}
function sendMessage(){
	ConnectDatabase();
	$time 		= time();
	$userid 	= $_POST['userid'];
	$message 	= $_POST['message'];
	// kiểm tra tin nhắn vừa gửi và lần cuối có trùng hay không
	$query = mysql_query("SELECT * FROM message WHERE(userid='".$userid."') ORDER BY id DESC LIMIT 1");
	//$result_user = mysql_fetch_array($query);
	//echo $time;
	$check = '';
	if($query)
	{
		while($row =  mysql_fetch_array($query))
		{
			$check = $row['message'];
		}
		if($check != $message)
		{
			//$message =  preg_replace(array('/\"/', '/\'/'),array('\"','\''),$message);
			$adduser = mysql_query("
				INSERT INTO message (userid, message, dateline)
				VALUES
					('$userid', '".mysql_real_escape_string($message)."', '$time')
			");
			echo 'Thành công!';
		}else{
			echo 'Nội dung bị trùng! Có phải bạn spam?';
		}
	}
}
if(isset($_POST['loadMessages'])){
	if($_POST['loadMessages'] == 'loadMessagesOne'){
		loadMessagesAjax(10);
	}else{
		loadMessagesAjax(1);
	}
}
function loadMessagesAjax($count){
//echo'ok';
	ConnectDatabase();
	$setTime = 6;
		$output = '[';
		$timenow = time();
		$lastid = 0;
		$condition = "";
		if(isset($_POST['lastid'])){
			$lastid = $_POST['lastid'];
			//echo $lastid;
			$condition .= "
				AND 
					message.id > ".$lastid."
			";
		}
		
		$list = mysql_query("
			SELECT message.id,message.userid,message.message,message.dateline,user.username
			FROM message,user 
			WHERE message.userid = user.id
			".$condition." 
			ORDER BY message.id DESC 
			LIMIT ".$count."
		");
		if($list){
			@session_start();
			while($row =  mysql_fetch_array($list))
			{
				$lastid = $row['id'];
				if(isset($_SESSION['username']) && $_SESSION['username'] == $row['username']){
					$avatar = 'http://placehold.it/50/FA6F57/fff&text=ME';
				}else{
					$avatar = 'http://placehold.it/50/55C1E7/fff&text=U';
				}
				
				$message = convertMessage($row['message']);
				$message =  preg_replace(array('/\"/', '/\'/'),array('\"','\''),$message);
				$output .= '{"avatar" : "'.$avatar.'", "author" : "'.$row['username'].'", "messageid" : "'.$row['id'].'", "message" : "'.$message.'", "time" : "'.date('h:i d/m/Y', $row['dateline']).'", "lastid" : "'.$lastid.'"},';	
			}
		}
		$output .= ']';
		$output = str_replace(',]',']',$output);
		echo $output;
		//echo $message;
	
}
function loadMessages(){
	ConnectDatabase();
		$output = '';
		$list = mysql_query("
			SELECT message.id,message.userid,message.message,message.dateline,user.username
			FROM message,user 
			WHERE message.userid = user.id
			ORDER BY message.id DESC 
			LIMIT 10
		");
		@session_start();
		while($row =  mysql_fetch_array($list))
		{
			
			if(isset($_SESSION['username']) && $_SESSION['username'] == $row['username']){
				$avatar = 'http://placehold.it/50/FA6F57/fff&text=ME';
			}else{
				$avatar = 'http://placehold.it/50/55C1E7/fff&text=U';
			}
			$message = $row['message'];
			$message = convertMessage($message);
			$output .= '
				<li class="left clearfix" value="'.$row['id'].'">
					<span class="chat-img pull-left">
						<img src="'.$avatar.'" alt="'.$row['username'].' Avatar" class="img-circle" />
                    </span>
					<div class="chat-body clearfix">
						<div class="header">
							<strong class="primary-font">'.$row['username'].'</strong> 
							<small class="pull-right text-muted">
								<span class="glyphicon glyphicon-time"></span>'.date('h:i d/m/Y', $row['dateline']).'
							</small>
						</div>
                        <p>
							'.$message.'
						</p>
					</div>
				</li>
			';
		}
		echo $output;
}
function convertMessage($message){
	$iconBbcode = array('/icon_01/', '/icon_02/', '/icon_03/', '/icon_04/', '/icon_05/', '/icon_06/', '/icon_07/', '/icon_08/', '/icon_09/', '/icon_10/', '/icon_11/', '/icon_12/', '/icon_13/', '/icon_14/', '/icon_15/', '/icon_16/', '/icon_17/', '/icon_18/', '/icon_19/', '/icon_20/', '/icon_21/', '/icon_22/', '/icon_23/', '/icon_24/', '/icon_25/', '/icon_26/', '/icon_27/', '/icon_28/', '/icon_29/', '/icon_30/', '/icon_31/', '/icon_32/', '/icon_33/', '/icon_34/', '/icon_35/', '/icon_36/', '/icon_37/', '/icon_38/', '/icon_39/', '/icon_40/', '/icon_41/', '/icon_42/', '/icon_43/', '/icon_44/');
	$iconImage  = array('<img src="icon/facebook/10520138_icon_01.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_02.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_03.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_04.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_05.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_06.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_07.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_08.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_09.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_10.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_11.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_12.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_13.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_14.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_15.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_16.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_17.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_18.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_19.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_20.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_21.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_22.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_23.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_24.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_25.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_26.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_27.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_28.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_29.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_30.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_31.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_32.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_33.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_34.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_35.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_36.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_37.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_38.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_39.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_40.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_41.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_42.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_43.png" width=30 height=30 />', '<img src="icon/facebook/10520138_icon_44.png" width=30 height=30 />');
	$str =  preg_replace($iconBbcode,$iconImage,$message);
	return $str;
}

?>