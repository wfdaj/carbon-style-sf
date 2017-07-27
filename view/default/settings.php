<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');
?>

<?php
include($TemplatePath.'header-user.php');
?>

<body class="user-index">

	<!--全站导航-->
	<?php
		include($TemplatePath.'global-header.php');
	?>

	<script>
	$(document).ready(function(){
		loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/default/account.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function() {});
	});
	</script>

	<div class="wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<nav class="list-group mt30">
						<a href="#settings1" class="list-group-item">
							<?php echo $Lang['Avatar_Settings']; ?>
						</a>
						<a href="#settings2" class="list-group-item">
							<?php echo $Lang['Profile_Settings']; ?>
						</a>
						<a href="#settings3" class="list-group-item">
							<?php echo $Lang['Account_Settings']; ?>
						</a>
						<a href="#settings4" class="list-group-item">
							<?php echo $Lang['Security_Settings']; ?>
						</a>
					</nav>
				</div>
				<div class="resp-tabs-container col-md-10 form-horizontal">
					<div class="user-settings-general__item" id="settings1">
						<h3 class="user-settings-general__item-title">
							<?php echo $Lang['Avatar_Settings']; ?>
						</h3>
						<div class="user-settings-general__item-list">
							<div class="pull-left mr20 text-center">
								<img class="p10 img-rounded" id="CurAvatar" src="<?php echo $Config['WebsitePath']; ?>/upload/avatar/large/<?php echo $CurUserID; ?>.png?cache=<?php echo $TimeStamp; ?>" alt="<?php echo $CurUserName; ?>" width="200" height="200">
								<p><a class="btn btn-default mt10" href="###" onclick="javascript:Manage(<?php echo $CurUserID; ?>, 3, 'ResetAvatar', true, this);">随机改变头像底色</a></p>
							</div>
							<div class="pull-left">
								<form class="mt20" method="post" enctype="multipart/form-data" action="<?php echo $Config['WebsitePath']; ?>/settings#settings1">
									<nput type="hidden" name="Action" value="UploadAvatar">
									<p><span class="red"><?php echo $UploadAvatarMessage; ?></span></p>
									<input type="file" class="btn btn-default" id="Avatar" name="Avatar" accept="image/*" />
									<p class="text-muted"><?php echo $Lang['Max_Avatar_Size_Limit']; ?></p>
									<p class="text-muted"><?php echo $Lang['Avatar_Image_Format_Support']; ?></p>
									<input type="submit" class="btn btn-primary" value="<?php echo $Lang['Upload_Avatar']; ?>" name="submit">
								</form>
							</div>
						</div>
					</div>
					<div class="user-settings-general__item" id="settings2">
						<h3 class="user-settings-general__item-title">
							<?php echo $Lang['Profile_Settings']; ?>
						</h3>
						<div class="user-settings-general__item-list">
							<p class="red text-center"><?php echo $UpdateUserInfoMessage; ?></p>
							<form method="post" action="<?php echo $Config['WebsitePath']; ?>/settings#settings2">
								<input type="hidden" name="Action" value="UpdateUserInfo" />
								<div class="form-group">
									<label for="" class="control-label col-sm-2">
										<?php echo $Lang['UserName']; ?>
									</label>
									<div class="col-sm-8" style="padding-top:7px;">
										<?php echo $CurUserName; ?>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">
										<?php echo $Lang['User_Sex']; ?>
									</label>
									<div class="col-sm-8">
										<select name="UserSex" class="form-control">
											<option value="<?php echo $CurUserInfo['UserSex']; ?>"><?php echo $Lang['Do_Not_Modify']; ?></option>
											<option value="0"><?php echo $Lang['Sex_Unknown']; ?></option>
											<option value="1"><?php echo $Lang['Sex_Male']; ?></option>
											<option value="2"><?php echo $Lang['Sex_Female']; ?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">
										<?php echo $Lang['Email']; ?>
									</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="UserMail" id="Email" onblur="CheckMail()" value="<?php echo $CurUserInfo['UserMail']; ?>">
										<p class="help-block"><?php echo $Lang['Ensure_That_Email_Is_Correct']; ?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">
										<?php echo $Lang['Homepage']; ?>
									</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="UserHomepage" value="<?php echo $CurUserInfo['UserHomepage']; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">
										<?php echo $Lang['Introduction']; ?>
									</label>
									<div class="col-sm-8">
										<textarea class="form-control" name="UserIntro"><?php echo $CurUserInfo['UserIntro']; ?></textarea>
										<input class="btn btn-primary mt20" type="submit" value="<?php echo $Lang['Save_Settings']; ?>" name="submit">
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="user-settings-general__item" id="settings3">
						<h3 class="user-settings-general__item-title">
							<?php echo $Lang['Account_Settings']; ?>
						</h3>
						<?php foreach ($CurUserOauthData as $Value) { ?>
							<img src="<?php echo $Config['WebsitePath'] . $OauthData[$Value['AppID']]['LogoUrl']; ?>" />
							<?php echo $Value['AppUserName']?$Value['AppUserName']:'Unknown'; ?>&nbsp;(<?php echo FormatTime($Value['Time']); ?>)
						<?php } ?>
						<?php foreach ($OauthData as $Value) { ?>
							<img src="<?php echo $Config['WebsitePath'] . $Value['LogoUrl']; ?>" />
							<a href="<?php echo $Config['WebsitePath']; ?>/oauth-<?php echo $Value['ID']; ?>">
								<?php echo str_replace('{{AppName}}', $Value['Alias'], $Lang['Connect_XXX_Account']); ?>
							</a>
						<?php } ?>
					</div>
					<div class="user-settings-general__item" id="settings4">
						<h3 class="user-settings-general__item-title">
							<?php echo $Lang['Security_Settings']; ?>
						</h3>
						<p class="red text-center"><?php echo $ChangePasswordMessage; ?></p>
						<form method="post" action="<?php echo $Config['WebsitePath']; ?>/settings#settings4">
							<input type="hidden" name="Action" value="ChangePassword" />

							<?php if(!$DoNotNeedOriginalPassword){ ?>
							<div class="form-group">
								<label for="OriginalPassword" class="control-label col-sm-2">
									<?php echo $Lang['Current_Password']; ?>
								</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" name="OriginalPassword" id="OriginalPassword" value="" />
								</div>
							</div>
							<?php } ?>

							<div class="form-group">
								<label for="Password" class="control-label col-sm-2">
									<?php echo $Lang['New_Password']; ?>
								</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" name="NewPassword" id="Password" value="" />
								</div>
							</div>

							<div class="form-group">
								<label for="NewPassword2" class="control-label col-sm-2">
									<?php echo $Lang['Confirm_New_Password']; ?>
								</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" name="NewPassword2" id="NewPassword2" value="" />
									<input type="submit" class="btn btn-primary mt20" value="<?php echo $Lang['Change_Password']; ?>" name="submit">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- main-content end -->

	<!-- footer start -->
	<?php
		include($TemplatePath.'footer.php');
	?>