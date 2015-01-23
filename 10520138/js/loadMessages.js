function loadMessages(){
		var countPost = 1;
		$.ajax({ //create an ajax request to load_page.php
			type: "POST",
			url: "server.php",
			data: {lastid: lastid,loadMessages:"loadMessages"},
			async: false,
			dataType : 'json',               
			success: function(response) {
				var offset = 0;
				//console.log(response[4]);
				for(var k in response) {
					countPost = response.length;
					
					if(response[k].lastid != 0){
						lastid = response[k].lastid;
					}
					console.log(lastid);
					//console.log(response[k].avatar);
					appendMessages(response[k].avatar,response[k].author,response[k].messageid,response[k].message,response[k].time);
				}
				function appendMessages(avatar,author,messageid,message,time){
						setTimeout(function(){
							$('<li class="left clearfix" value="'+messageid+'">'+
					'<span class="chat-img pull-left">'+
						'<img src="'+avatar+'" alt="'+author+' Avatar" class="img-circle" />'+
                    '</span>'+
					'<div class="chat-body clearfix">'+
						'<div class="header">'+
							'<strong class="primary-font">'+author+'</strong> '+
							'<small class="pull-right text-muted">'+
								'<span class="glyphicon glyphicon-time"></span>'+time+''+
							'</small>'+
						'</div>'+
                        '<p>'+message+'</p>'+
					'</div>'+
				'</li>').insertAfter("#newmessages");
						
						},1000 + offset);
						offset += 1000;
				}
			}
		});
		t = setTimeout(function(){loadMessages()},(countPost*1000+2000));

	//};
	}
	function sendMessage(e){
		var message = e.message.value;
		var userid 	= e.userid.value;
		//var time = new Date(); 
		if (message.replace(/ /g, '') == '')
		{
			alert('Bạn chưa nhập nội dung chat!');
			//return false;
		}
		else{
			//alert(message);
			//alert(userid);
			$.ajax({ //create an ajax request to load_page.php
				type: "POST",
				url: "server.php",
				data: {userid: userid,message: message,sendMessage: "sendMessage"},
				async: false,
				dataType : 'html',               
				success: function(response) {
					if(response == 'Thành công!'){
						insertMessage();
						e.reset();
					}else{
						alert(response);
					}
				}
			});
		}
		return false;
	}
	function insertMessage(){
	$.ajax({ //create an ajax request to load_page.php
			type: "POST",
			url: "server.php",
			data: {lastid: lastid,loadMessages:"loadMessagesOne"},
			async: false,
			dataType : 'json',               
			success: function(response) {
				for(var k in response) {
					if(response[k].lastid != 0){
						lastid = response[k].lastid;
					}
					console.log(lastid);
					//console.log(response[k].avatar);
					appendMessages(response[k].avatar,response[k].author,response[k].messageid,response[k].message,response[k].time);
				}
				//alert(response);
				function appendMessages(avatar,author,messageid,message,time){
							$('<li class="left clearfix" value="'+messageid+'">'+
					'<span class="chat-img pull-left">'+
						'<img src="'+avatar+'" alt="'+author+' Avatar" class="img-circle" />'+
                    '</span>'+
					'<div class="chat-body clearfix">'+
						'<div class="header">'+
							'<strong class="primary-font">'+author+'</strong> '+
							'<small class="pull-right text-muted">'+
								'<span class="glyphicon glyphicon-time"></span>'+time+''+
							'</small>'+
						'</div>'+
                        '<p>'+message+'</p>'+
					'</div>'+
				'</li>').insertAfter("#newmessages");
				}
			}
		});
	}
	function InsertIcon(e){
		//alert(e.value);
		var messageValue = $("#message").val();
		$("#message").val(messageValue+' '+e.value+' ');
	}
