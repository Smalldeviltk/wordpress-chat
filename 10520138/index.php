<?php
@session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['userid']))
{
	$chatajax_enable = false;
	$username = '';
	//header('Location: login.php');
}else{
	//echo $_SESSION['username'];
	$username = $_SESSION['username'];
	$userid = $_SESSION['userid'];
	$chatajax_enable = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>10520138-Nguyễn Văn Thịnh</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
	@import url(fonts/font-awesome-4.2.0/css/font-awesome.min.css);

    .chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}
.iconchat{
margin-right: 80px;
position: absolute;
float: right;
right: 0;
z-index: 2;
}
.panel-body
{
    overflow-y: scroll;
    height: 450px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
.modal-header-info {
    color:#fff;
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #5bc0de;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
}
#newmessages,#oldmessages{
display:none
}
.hidepaging{display:none}
.showpaging{display:block}
.previous>a,.next>a{cursor: pointer;}
    </style>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-confirmation-icon.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Chat Ajax Web & Ứng dụng</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
		<?php if($chatajax_enable){?>
		<li><a href="#"><i class="fa fa-user"></i> <?php echo $username;?></a></li>
		<li><a href="#"><i class="fa fa-cog"></i> Tùy chỉnh</a></li>
		<li><a href="login.php?do=signout"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
		<?php }else{ ?>
        <li>
			<a class="btn" href="#signinchat" data-toggle="modal"><i class="fa fa-sign-in"></i> Đăng nhập</a>
			<!-- Modal -->
			<div class="modal fade" id="signinchat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header modal-header-info">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><i class="fa fa-sign-in"></i> Đăng nhập</h2>
						</div>
						<form id="loginform" class="form-horizontal" role="form" action="login.php" method=post>
							<div class="modal-body">
								<div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Tên đăng nhập">                                        
								</div>
								<div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input id="login-password" type="password" class="form-control" name="password" placeholder="Mật khẩu">
								</div>
							</div>
							<div class="modal-footer">
								<button id="btn-fblogin" href="#" type="submit" name="signin_chat" class="btn btn-primary">Đăng nhập</button>
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Hủy</button>
							</div>
						</form> 
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- Modal -->
		</li>
        <li>
			<a class="btn" href="#signupchat" data-toggle="modal"><i class="fa fa-plus"></i> Đăng ký</a>
			<!-- Modal -->
			<div class="modal fade" id="signupchat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header modal-header-info">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2><i class="fa fa-sign-in"></i> Đăng ký</h2>
						</div>
						<form id="signupform" class="form-horizontal" role="form" action="login.php" method=post>
							<div class="modal-body">
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
							</div>
							<div class="modal-footer">
								<button id="btn-signup" type="submit" name="signup_chat" class="btn btn-info"><i class="icon-hand-right"></i>Đăng ký</button>
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Hủy</button>
							</div>
						</form> 
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- Modal -->
		</li>
		<?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    <div class="btn-group pull-right">
                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </div>
                </div>
            <div class="panel-collapse collapse in" id="collapseOne">
                <div class="panel-body">
                    <ul class="chat">
						<li id="newmessages"></li>
						<?php 
							require_once('./server.php');
							loadMessages();
						?>
						<li id="oldmessages"></li>
                    </ul>
                </div>
                <div class="panel-footer">
				<?php if($chatajax_enable){?>
				<form name="sendmessage" method="post" onsubmit="return sendMessage(this);">
                    <div class="input-group">
						<input id="userid" type="hidden" name="userid" value="<?php echo $userid;?>"/>
                        <input id="message" type="text" class="form-control input-sm" name="message" placeholder="Nhập nội dung chat..." />
						<span class="input-group-btn iconchat">
							<!--<div class="container">
								<div class="row">
									<div class="col-md-12">-->
										<button type="button" class="btn btn-sm" id="btn-chat" data-toggle="confirmation" style="padding: 3px 11px;background:transparent">
											<i class="fa fa-smile-o" style="font-size: 1.7em;"></i>
										</button>
									<!--</div>
								</div>
							</div>-->
                        </span>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">
                                Gửi</button>
                        </span>
                    </div>
				</form>
				<?php }else{ ?>
					<div style="text-align: center">Đăng nhập để chat!</div>
				
				<?php } ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
$('[data-toggle="confirmation"]').confirmation();
</script>
<script src="js/loadMessages.js"></script>
	<script type="text/javascript">
		//$('#btn-chat').confirmation();
		//var element = document.getElementsByClassName("chat")[0].getElementsByTagName("li")[0];
		//var element = $(".chat").find("li");
		//var lastid = element.attr("value");
		var element = document.getElementsByClassName("chat")[0];
		var elementchild = element.getElementsByTagName("li");
		var lastid = (elementchild[1].getAttribute("value"));
		var firtid = (elementchild[elementchild.length-2].getAttribute("value"));
		//var lastid = element[0].attr("messageid");
		loadMessages();
		//paging icon chat
		var lenghticon = Math.round(44/12);//4 
		
		var paging = 1;// mặc định là trang 1
		function pagingIcon(e){
			
			if(e == 'tang'){
				if(paging < lenghticon){
					paging++;
					$(".previous").removeClass("disabled");
					$(".thamso>a").html(paging+'/'+lenghticon);
				}
				if(paging == lenghticon){
					$(".next").addClass("disabled");
					$(".thamso>a").html(paging+'/'+lenghticon);
				}
			}
			if(e == 'giam'){
				if(paging >1){
					paging--;
					$(".next").removeClass("disabled");
					$(".thamso>a").html(paging+'/'+lenghticon);
				}
				if(paging == 1){
					$(".previous").addClass("disabled");
					$(".thamso>a").html(paging+'/'+lenghticon);
				}
			}
			
			//alert(paging);
			$('.chaticon').hide();
			$('[pagerow="'+paging+'"]').show();
		}
		
	</script>
</body>
</html>


