<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');
?>

<?php
include($TemplatePath.'header-home.php');
?>

<body class="qa-index">

	<!--全站导航-->
	<?php
		include($TemplatePath.'global-nav.php');
	?>

	<!-- main-content start -->
	<div class="wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-9">
					<div class="stream-list question-stream mt20">

						<?php foreach ($TopicsArray as $Topic) { ?>
						<section class="stream-list__item">
							<div class="qa-rank">
								<div class="votes hidden-xs">
									<?php echo $Topic['Favorites']; ?><small>收藏</small>
								</div>
								<?php if($Topic['Replies']){ ?>
								<div class="answers answered">
									<?php echo $Topic['Replies']; ?><small>回答</small>
								</div>
								<?php } else { ?>
								<div class="answers">
									0<small>回答</small>
								</div>
								<?php } ?>
								<div class="views hidden-xs viewsword0to99">
									<?php echo $Topic['Views']; ?><small>浏览</small>
								</div>
							</div>
							<div class="summary">
								<ul class="author list-inline">
									<li>
										<a href="<?php echo $Config['WebsitePath']; ?>/u/<?php echo urlencode($Topic['UserName']); ?>"><?php echo $Topic['UserName']; ?></a>
										<span class="split"></span>
										<span class="askDate"><?php echo FormatTime($Topic['LastTime']); ?></span>
									</li>
									<?php if($Topic['Replies']){ ?>
									<li>
										<span class="split"></span>
										<i class="fa fa-share" aria-hidden="true"></i>
										<span class="split"></span>
										<a href="<?php echo $Config['WebsitePath']; ?>/u/<?php echo urlencode($Topic['LastName']); ?>"><?php echo $Topic['LastName']; ?></a>
									</li>
									<?php } ?>
								</ul>
								<h2 class="title">
									<a href="<?php echo $Config['WebsitePath']; ?>/t/<?php echo $Topic['ID']; ?>"><?php echo $Topic['Topic']; ?></a>
								</h2>
								<ul class="taglist--inline ib">
									<?php
									if($Topic['Tags']){
										foreach (explode("|", $Topic['Tags']) as $Tag) {
									?>
									<li class="tagPopup">
										<a class="tag tag-sm" href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag); ?>"><?php echo $Tag; ?></a>
									</li>
									<?php } } ?>
								</ul>
							</div>
						</section>
						<?php } ?>
					</div>
					<!-- /.stream-list -->

					<div class="pagination">
						<?php
						/*
						foreach (range(1, 10) as $TotalPage) {
							foreach (range(1, $TotalPage) as $Page) {
								echo '<div class="pagination">';
								Pagination("/page/",$Page,$TotalPage);
								# code...
								echo "</div>";
							}
						}
						*/
						Pagination("/page/",$Page,$TotalPage);
						?>
					</div>
				</div>
				<!-- /.main -->
				<div class="col-xs-12 col-md-3 side mt30">

					<?php if(!$CurUserID && $UrlPath != 'login' && $UrlPath != 'register' && $UrlPath != 'oauth'){ ?>
					<!-- 首页登录框 -->
					<div class="side-ask alert alert-warning">
						<div class="slidebar_login">
							<p class="text-center mb0"><strong>小众程序</strong></p>
							<p class="text-center">一个小众程序交流网站</p>

							<form class="text-center register-form" action="<?php echo $Config['WebsitePath']; ?>/login" method="post" onsubmit="JavaScript:this.Password.value=md5(this.Password.value);">
								<input type="hidden" value="<?php echo $RequestURI; ?>" name="ReturnUrl" />
								<input type="hidden" name="FormHash" value="<?php echo $FormHash; ?>" />
								<input type="hidden" name="Expires" value="30" />
								<div class="form-group form-name">
									<input type="text" class="form-control" name="UserName" id="UserName" value="" placeholder="<?php echo $Lang['UserName']; ?>" onblur="CheckUserNameExist()">
								</div>
								<div class="form-group form-password">
									<input type="password" class="form-control" name="Password" value="" placeholder="<?php echo $Lang['Password']; ?>" />
								</div>
								<div class="form-group form-getCode">
									<div class="input-group mt15">
										<input type="text" class="form-control" name="VerifyCode" onfocus="document.getElementById('Verification_Code_Img').src='<?php echo $Config['WebsitePath']; ?>/seccode.php';document.getElementById('Verification_Code_Img').style.display='inline';" value="" placeholder="<?php echo $Lang['Verification_Code']; ?>" />
										<span class="input-group-btn">
											<img src="" id="Verification_Code_Img" style="cursor: pointer;display:none;" onclick="this.src+=''" alt="<?php echo $Lang['Verification_Code']; ?>" align="middle" />
										</span>
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-block mt15 register-button"><?php echo $Lang['Log_In']; ?></button>
							</form>
							<div class="text-center mt15">
								<a href="<?php echo $Config['WebsitePath']; ?>/register" class="mr20"><?php echo $Lang['Sign_Up']; ?></a>
								<a href="<?php echo $Config['WebsitePath']; ?>/forgot"><?php echo $Lang['Forgot_Password']; ?></a>
							</div>
						</div>
						<!-- <div class="mt10 side-system-notice">
							<i class="fa fa-bullhorn pull-left"></i><a class="side-system-notice--title" href="###">来看看实验室里面又上线了什么新功能？</a>
						</div> -->
					</div>

					<?php }else if($CurUserID && $UrlPath != 'register'){ ?>
					<div class="widget__subnav mb30">
						<div class="row">
							<div class="panel panel-default mb0">
								<div class="panel-heading clearfix" style="line-height: 24px">
									<span class="pull-right">
										<a href="<?php echo $Config['WebsitePath']; ?>/login?logout=<?php echo $CurUserCode; ?>">
											<?php echo $Lang['Log_Out']; ?>
										</a>
									</span>
									<a class="avatar pull-left" href="/u/wfdaj" style="background-image: url('https://static.segmentfault.com/v-59689f47/global/img/user-64.png')">
									</a>
									<span class="score pull-left ml10 mr10">0</span>
								</div>
								<div class="panel-body pt0 pb0 pl0 pr0">
									<span class="report">
										鸟儿从不担心树枝断裂，因为它依靠的不是树枝，而是自己的翅膀。
									</span>
									<a class="widget__subnav-item borderRight borderBottom " href="<?php echo $Config['WebsitePath']; ?>/favorites">
										<span class="icon"><?php echo $CurUserInfo['NumFavTopics']; ?></span>
										<span class="text"><?php echo $Lang['Favorite_Topics']; ?></span>
									</a>
									<a class="widget__subnav-item borderRight borderBottom " href="<?php echo $Config['WebsitePath']; ?>/tags/following">
										<span class="icon"><?php echo $CurUserInfo['NumFavTags']; ?></span>
										<span class="text"><?php echo $Lang['Tags_Followed']; ?></span>
									</a>
									<a class="widget__subnav-item borderBottom " href="<?php echo $Config['WebsitePath']; ?>/users/following">
										<span class="icon"><?php echo $CurUserInfo['NumFavUsers']; ?></span>
										<span class="text"><?php echo $Lang['Users_Followed']; ?></span>
									</a>
									<a class="widget__subnav-item borderRight" href="<?php echo $Config['WebsitePath']; ?>/notifications/list#notifications1">
										<span class="icon"><i class="fa fa-fw fa-bell-o" aria-hidden="true"></i></span>
										<span class="text"><?php echo $Lang['Notifications']; ?></span>
									</a>
									<?php if ($CurUserRole == 5) { ?>
									<a class="widget__subnav-item borderRight" href="<?php echo $Config['WebsitePath']; ?>/dashboard">
										<span class="icon"><i class="fa fa-fw fa-wrench" aria-hidden="true"></i></span>
										<span class="text"><?php echo $Lang['System_Settings']; ?></span>
									</a>
									<?php } ?>
									<a class="widget__subnav-item borderRight" href="###">
										<span class="icon"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i></span>
										<span class="text">###</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- main-content end -->

	<!-- footer start -->
	<?php
		include($TemplatePath.'footer.php');
	?>