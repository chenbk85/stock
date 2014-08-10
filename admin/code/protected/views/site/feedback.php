

<div class="row" id="feedback_main">
	<div class="col-md-12">
		<div class="post-comment margin-bottom-15">
			<h3>欢快地吐槽：</h3>
			<form id="msgform" role="form" action="/site/feedback" method="post">
				<div class="form-group">
					<label class="control-label">昵称<span class="required">*</span></label>
					<input name="nickname" type="text" class="form-control">
					<div class="tmperr"></div>
				</div>
				<div class="form-group">
					<label class="control-label">邮箱<span class="required">*</span></label>
					<input name="email" type="text" class="form-control">
					<div class="tmperr"></div>
				</div>
				<div class="form-group">
					<label class="control-label">吐槽内容<span class="required">*</span></label>
					<textarea name="content" class="col-md-10 form-control" rows="5"></textarea>
					<div class="tmperr"></div>
				</div>
				<button name="subbtn" class="margin-top-20 btn blue" type="submit">提交</button>
			</form>
		</div>
		<div id="feedback_panel">
		<?php foreach($feeds as $v) { ?>
			<div class="media">
				<a href="#" class="pull-left">
				<img alt="" src="/assets/img/avatar1.jpg" class="media-object">
				</a>
				<div class="media-body">
					<h4 class="media-heading"><?php echo htmlspecialchars($v['name']);?> <span><?php echo htmlspecialchars($v['ctime']);?> <!--/ <a href="#">Reply</a>--></span></h4>
					<p><?php echo htmlspecialchars($v['message']);?> </p>
				</div>
			</div>
			<hr>
		<?php } ?>
		</div>

	</div>
</div>


<link href="/css/feedback.css" rel="stylesheet" media="screen" type="text/css" />
<script src="/assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/assets/plugins/jquery-validation/lib/jquery.form.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {


	var msgpage = 1;
	$("#feedback_panel").scroll(function() {
		//console.log($(this)[0].scrollHeight, $(this)[0].scrollTop,$(this).height());
		totalheight  = $(this)[0].scrollHeight;
		topheight 	 = $(this)[0].scrollTop;
		borderheight = $(this).height();
		if(topheight+borderheight+30>=totalheight) {
			$.getJSON("/site/getFeedback", { page: msgpage }, function(json){
				if(json.data.length>0) {
					insertData = '';
					$.each(json.data, function(i, n) {
						insertData += '<div class="media">' + 
							'<a href="#" class="pull-left"><img alt="" src="/assets/img/avatar1.jpg" class="media-object"></a>' +
							'<div class="media-body">' +
							'<h4 class="media-heading">' + n.name + ' <span>' + n.ctime + '</span></h4>' +
							'<p>' + n.message + '</p>' +
							'</div></div><hr>';
					});
					$("#feedback_panel").append(insertData);
				}
				msgpage++;
			});
		}
	});

	$('#msgform').validate({
	    errorElement: 'span', //default input error message container
	    errorClass: 'help-block', // default input error message class
	    focusInvalid: false, // do not focus the last invalid input
	    rules: {
	        nickname: {
	            required: true
	        },
	        email: {
	            required: true,
	            email: true
	        },
	        content: {
	            required: true
	        }
	    },

	    messages: {
	        nickname: {
	            required: "请填入用户名"
	        },
	        email: {
                required: "请填入邮箱",
                email: "请填入正确邮箱"
	        },
	        content: {
	            required: "请填入反馈意见"
	        }
	    },

	    invalidHandler: function (event, validator) { //display error alert on form submit   
	        $('.alert-danger', $('#msgform')).show();
	    },

	    highlight: function (element) { // hightlight error inputs
	        $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
	    },

	    success: function (label) {
	        label.closest('.form-group').removeClass('has-error');
	        label.remove();
	    },

	    errorPlacement: function (error, element) { // 将error标签插入element的某个位置
	        error.insertAfter(element);
	    },

	    submitHandler: function (form) {
            form.submit();
	    }
	});
});
</script>