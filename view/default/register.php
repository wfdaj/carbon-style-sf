<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');
?>

<?php
include($TemplatePath.'header-home.php');
?>

<body>

	<!--全站导航-->
	<?php
		include($TemplatePath.'global-header.php');
	?>

	<script type="text/javascript">
	loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/default/account.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function() {});
	</script>
	
		<!-- main-content start -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $Lang['Log_In']; ?></h4>
			</div>
			<div class="modal-body">
				<div class="sfModal-content" style="height: 500px;">
					<div class="row bg-white login-modal">
						<div class="col-md-4 col-sm-12 col-md-push-7 login-wrap">
							<!-- <?php if($Error){ ?>
							<span class="pull-right img-rounded bg-danger text-danger p5">
								<?php echo $Error; ?>
							</span>
							<?php } ?>
							<h1 class="h4 text-muted login-title">
								<?php echo $Lang['Log_In']; ?>
							</h1>
							<form class="mt30" action="?" method="post" role="form" onsubmit="JavaScript:this.Password.value=md5(this.Password.value);">
								<input type="hidden" value="<?php echo $ReturnUrl; ?>" name="ReturnUrl">
								<input type="hidden" name="FormHash" value="<?php echo $FormHash; ?>">
								<div class="form-group">
									<label for="UserName" class="control-label">
										<?php echo $Lang['UserName']; ?>
									</label>
									<input type="text" class="form-control" name="UserName" id="UserName" value="<?php echo htmlspecialchars($UserName); ?>" onblur="CheckUserNameExist()" autocomplete="off">
								</div>
								<div class="form-group">
									<label for="Password" class="control-label">
										<?php echo $Lang['Password']; ?>
									</label>
									<span class="pull-right">
										<a href="<?php echo $Config['WebsitePath']; ?>/forgot">
											<?php echo $Lang['Forgot_Password']; ?>
										</a>
									</span>
									<input type="password" class="form-control" name="Password" id="Password" required="" value="" placeholder="<?php echo $Lang['Password']; ?>">
								</div>
								<div class="form-group input-group">
									<label for="VerifyCode2" class="control-label">
										<?php echo $Lang['Verification_Code']; ?>
									</label>
									<input type="text" class="form-control" name="VerifyCode2" id="VerifyCode2" onfocus="document.getElementById('Verification_Code_Img2').src='<?php echo $Config['WebsitePath']; ?>/seccode.php';document.getElementById('Verification_Code_Img2').style.display='inline';" value="" placeholder="<?php echo $Lang['Verification_Code']; ?>">
									<span class="input-group-btn">
										<img src="" id="Verification_Code_Img2" style="cursor: pointer; display: none; margin-top: 25px;" onclick="this.src+=''" alt="<?php echo $Lang['Verification_Code']; ?>" width="60" height="34" align="middle">
									</span>
								</div>
								<div class="form-group clearfix">
									<div class="checkbox pull-left">
										<label>
											<input name="remember" type="checkbox" value="1" checked="">
											记住登录状态
										</label>
									</div>
									<button type="submit" class="btn btn-primary pull-right pl20 pr20">
										<?php echo $Lang['Log_In']; ?>
									</button>
								</div>
							</form>
							<p class="h4 text-muted visible-xs-block h4">
								快速登录
							</p>
							<div class="widget-login mt30">
								<p class="text-muted mt5 mr10 pull-left hidden-xs">
									快速登录
								</p>
								<a href="<?php echo $Config['WebsitePath']; ?>/oauth-1" title="QQ账号">
									<span class="icon-sn-qq"></span>
									<strong class="visible-xs-inline">
										QQ账号
									</strong>
								</a>
								<a href="<?php echo $Config['WebsitePath']; ?>/oauth-2" title="新浪微博账号">
									<span class="icon-sn-weibo"></span>
									<strong class="visible-xs-inline">
										新浪微博账号
									</strong>
								</a>
								<a href="<?php echo $Config['WebsitePath']; ?>/oauth-2" title="GitHub账号">
									<span class="icon-sn-github"></span>
									<strong class="visible-xs-inline">
										GitHub账号
									</strong>
								</a>
							</div> -->
						</div>
						<div class="login-vline hidden-xs hidden-sm"></div>
						<div class="col-md-4 col-md-pull-3 col-sm-12 login-wrap">
							<script type="text/javascript">
								loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/default/account.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function() {});
							</script>
							<?php if($Error){ ?>
							<span class="pull-right img-rounded bg-danger text-danger p5">
								<?php echo $Error; ?>
							</span>
							<?php } ?>
							<h1 class="h4 text-muted login-title">
								<?php echo $Lang['Sign_Up']; ?>
							</h1>
							<form action="?" method="post" onsubmit="JavaScript:this.Password.value=md5(this.Password.value);" role="form" class="mt30">
								<input type="hidden" name="FormHash" value="<?php echo $FormHash; ?>" />
								<div class="form-group">
									<label class="control-label">
										<?php echo $Lang['UserName']; ?>
									</label>
									<input type="text" class="form-control" name="UserName" id="UserName" value="<?php echo htmlspecialchars($UserName); ?>" onblur="CheckUserName()" placeholder="<?php echo $Lang['UserName']; ?>">
								</div>
								<div class="form-group">
									<label class="control-label">邮箱</label>
									<input type="text" name="Email" id="Email" class="form-control mb15" value="<?php echo htmlspecialchars($Email); ?>" onblur="CheckMail()" placeholder="<?php echo $Lang['Email']; ?>" autocomplete="off">
								</div>
								<div class="form-group">
									<label class="control-label">
										密码
									</label>
									<input type="password" class="form-control mb15" name="Password" id="Password" value="" onblur="CheckPassword()" placeholder="<?php echo $Lang['Password']; ?>" />
								</div>
								<div class="form-group">
									<div class="js-register-switch-content">
										<div class="input-group">
											<input type="text" name="VerifyCode" class="form-control" onfocus="document.getElementById('Verification_Code_Img').src='<?php echo $Config['WebsitePath']; ?>/seccode.php';document.getElementById('Verification_Code_Img').style.display='inline';" value="" placeholder="<?php echo $Lang['Verification_Code']; ?>" />
											<span class="input-group-btn">
												<img src="" id="Verification_Code_Img" style="cursor: pointer; display:none;" height="34" onclick="this.src+=''" align="middle" />
											</span>
										</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<div class="checkbox pull-left">
										同意并接受
										<a href="###" target="_blank">
											《服务条款》
										</a>
									</div>
									<button type="submit" class="btn btn-primary pl20 pr20 pull-right">
										<?php echo $Lang['Sign_Up']; ?>
									</button>
								</div>
							</form>
						</div>
					</div>
					<div style="position: absolute;transform: scale(0.5,0.5) translate(136%,-60%); left: -3px;" class="hidden-xs">
						<img src="https://static.segmentfault.com/v-59689f47/global/img/fool/login@2x.png">
					</div>
					<div class="text-center text-muted mt30">
					</div>
				</div>
			</div>
			<div class="modal-footer hidden">
			</div>
		</div>
	</div>
	<!-- main-content end -->

	<!-- footer start -->
	<?php
		include($TemplatePath.'footer.php');
	?>