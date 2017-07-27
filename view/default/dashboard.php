<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');

function GenerateSelect($Options, $Name)
{
	global $Config;
	if (isset($Config[$Name])) {
		$DefaultValue = $Config[$Name];
	} else {
		$DefaultValue = '';
	}
	$IsValueInOptions = false;
	$Result = '<select class="form-control" name="' . $Name . '">';
	foreach ($Options as $Key => $Value) {
		if ($Value !== $DefaultValue) {
			$Result .= '<option value="' . $Value . '">' . $Key . '</option>';
		} else {
			$Result .= '<option value="' . $Value . '" selected="selected">' . $Key . '</option>';
			$IsValueInOptions = true;
		}
	}
	if ($IsValueInOptions === false && !empty($DefaultValue)) {
		$Result .= '<option value="' . $DefaultValue . '" selected="selected">' . $DefaultValue . '</option>';
	}
	$Result .= '</select>';
	return $Result;
}
?>

<?php
include($TemplatePath.'header-user.php');
?>

<body class="user-index">

	<!--全站导航-->
	<?php
		include($TemplatePath.'global-header.php');
	?>

	<!-- main-content start -->
	<div class="profile">
		<div class="wrap mt30">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<script type="text/javascript">
							// 选项卡
							$(document).ready(function(e) {
						        $(".tab li").click(function(){
									$(".tab li").eq($(this).index()).addClass("active").siblings().removeClass("active");
									$(".tabCon article").hide().eq($(this).index()).show();
								})
						    });
						</script>
						<ul class="nav nav-pills nav-stacked profile__nav tab">
							<li class="active">
								<a href="javascript:;">
									<i class="fa fa-fw fa-cog mr5"></i>
									<?php echo $Lang['Basic_Settings']; ?>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="fa fa-fw fa-cog mr5"></i>
									<?php echo $Lang['Page_Settings']; ?>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="fa fa-fw fa-cog mr5"></i>
									<?php echo $Lang['Advanced_Settings']; ?>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="fa fa-fw fa-cog mr5"></i>
									<?php echo $Lang['Parameter_Settings']; ?>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="fa fa-fw fa-cog mr5"></i>
									<?php echo $Lang['Oauth_Settings']; ?>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="fa fa-fw fa-cog mr5"></i>
									<?php echo $Lang['Refresh_Cache']; ?>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="fa fa-fw fa-trash-o mr5"></i>
									<?php echo $Lang['Recycle_Bin']; ?>
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-7">
						<div class="tabCon">
							<article style="display: block;">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title"><?php echo $Lang['Basic_Settings']; ?></h3>
									</div>
									<div class="panel-body">
										<form class="form-horizontal" method="post" action="<?php echo $Config['WebsitePath']; ?>/dashboard#dashboard1">
											<input type="hidden" name="Action" value="Basic"/>
											<div class="form-group">
												<label for="SiteName" class="col-sm-4 control-label"><?php echo $Lang['Forum_Name']; ?></label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="SiteName" id="SiteName" value="<?php echo $Config['SiteName']; ?>"/>
												</div>
											</div>
											<div class="form-group">
												<label for="SiteDesc" class="col-sm-4 control-label"><?php echo $Lang['Forum_Descriptions']; ?></label>
												<div class="col-sm-8">
													<textarea class="form-control" rows="5" name="SiteDesc" id="SiteDesc"><?php echo $Config['SiteDesc']; ?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Page_Show']; ?>几<?php echo $Lang['Page_Topics']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														'10' => '10',
														'20' => '20',
														'50' => '50',
														'100' => '100'
													), 'TopicsPerPage'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Topic_Show']; ?>几<?php echo $Lang['Topic_Posts']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														'10' => '10',
														'20' => '20',
														'50' => '50',
														'100' => '100'
													), 'PostsPerPage'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Topic_Max']; ?>几<?php echo $Lang['Topic_Max_Tags']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														// '0' => '0',
														'1' => '1',
														'2' => '2',
														'3' => '3',
														'4' => '4',
														'5' => '5'
													), 'MaxTagsNum'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Tag_Max']; ?>几<?php echo $Lang['Tag_Max_Chars']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														'32' => '32',
														'64' => '64',
														'128' => '128',
														'256' => '256'
													), 'MaxTagChars'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Post_Max']; ?>几<?php echo $Lang['Post_Max_Chars']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														'7500' => '7500',
														'15000' => '15000',
														'30000' => '30000',
														'60000' => '60000',
														'120000' => '120000',
														'240000' => '240000'
													), 'MaxPostChars'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Allow_Ordinary_Users_To_Edit_Their_Own_Posts']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														$Lang['Yes'] => 'true',
														$Lang['No'] => 'false',
													), 'AllowEditing'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Allow_Empty_Tags']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														$Lang['Yes'] => 'true',
														$Lang['No'] => 'false',
													), 'AllowEmptyTags'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Allow_Ordinary_Users_To_Create_New_Topics']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														$Lang['Yes'] => 'true',
														$Lang['No'] => 'false',
													), 'AllowNewTopic'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Close_Registration']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														$Lang['Yes'] => 'true',
														$Lang['No'] => 'false',
													), 'CloseRegistration'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['New_User_Freeze_Time']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														'0 秒' => '0',
														'半分钟' => '30',
														'1分钟' => '60',
														'5分钟' => '300',
														'半小时' => '1800',
														'1小时' => '3600',
														'12小时' => '43200',
														'24小时' => '86400',
													), 'FreezingTime'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Posting_Interval']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														'0秒' => '0',
														'10秒' => '10',
														'半分钟' => '30',
														'1分钟' => '60',
														'10分钟' => '600'
													), 'PostingInterval'); ?>
													<input class="btn btn-primary mt20" type="submit" value="<?php echo $Lang['Save']; ?>" name="submit">
												</div>
											</div>
										</form>
									</div>
								</div>
							</article>
							<article style="display: none;">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title"><?php echo $Lang['Page_Settings']; ?></h3>
									</div>
									<div class="panel-body">
										<form class="form-horizontal" method="post" action="<?php echo $Config['WebsitePath']; ?>/dashboard#dashboard2">
											<input type="hidden" name="Action" value="Page"/>
											<div class="form-group">
												<label for="PageHeadContent" class="col-sm-4 control-label"><?php echo $Lang['Html_Between_Head']; ?></label>
												<div class="col-sm-8">
													<textarea class="form-control" rows="5" name="PageHeadContent" id="PageHeadContent"><?php echo CharCV($Config['PageHeadContent']); ?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="PageBottomContent" class="col-sm-4 control-label"><?php echo $Lang['Html_Before_Body']; ?></label>
												<div class="col-sm-8">
													<textarea class="form-control" name="PageBottomContent" id="PageBottomContent"><?php echo CharCV($Config['PageBottomContent']); ?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="PageSiderContent" class="col-sm-4 control-label"><?php echo $Lang['Html_SiderBar']; ?></label>
												<div class="col-sm-8">
													<textarea class="form-control" name="PageSiderContent" id="PageSiderContent"><?php echo CharCV($Config['PageSiderContent']); ?></textarea>
													<input class="btn btn-primary mt20" type="submit" value="<?php echo $Lang['Save']; ?>" name="submit">
												</div>
											</div>
										</form>
									</div>
								</div>
							</article>
							<article style="display: none;">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title"><?php echo $Lang['Advanced_Settings']; ?></h3>
									</div>
									<div class="panel-body">
										<form class="form-horizontal" method="post" action="<?php echo $Config['WebsitePath']; ?>/dashboard#dashboard3">
											<input type="hidden" name="Action" value="Advanced"/>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['jQuery_CDN']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														'不使用内容分发网络 (默认)' => $Config['WebsitePath'] . '/static/js/jquery.js',
														'Bootcss CDN' => '//cdn.bootcss.com/jquery/1.10.2/jquery.min.js',
														'新浪 CDN' => '//lib.sinaapp.com/js/jquery/1.10.2/jquery-1.10.2.min.js',
														'百度 CDN' => '//libs.baidu.com/jquery/1.10.2/jquery.min.js',
														'360 CDN' => '//libs.useso.com/js/jquery/1.10.2/jquery.min.js',
														'微软 CDN' => '//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.2.min.js',
														'谷歌 CDN' => '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'
													), 'LoadJqueryUrl'); ?>
												</div>
											</div>
											<div class="form-group">
												<label for="MainDomainName" class="col-sm-4 control-label"><?php echo $Lang['Main_Domainname']; ?>(www.jpdm.net)</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="MainDomainName" id="MainDomainName" value="<?php echo $Config['MainDomainName']; ?>"/>
												</div>
											</div>
											<div class="form-group">
												<label for="MobileDomainName" class="col-sm-4 control-label"><?php echo $Lang['Mobile_Domainname']; ?>(m.jpdm.net)</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="MobileDomainName" id="MobileDomainName" value="<?php echo $Config['MobileDomainName']; ?>"/>
												</div>
											</div>
											<div class="form-group">
												<label for="AppDomainName" class="col-sm-4 control-label"><?php echo $Lang['API_Domainname']; ?>(api.94cb.com)</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="AppDomainName" id="AppDomainName" value="<?php echo $Config['AppDomainName']; ?>"/>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['Push_Connection_Timeout_Period']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														'22 秒' => '22',
														'53 秒' => '53',
														'80 秒' => '80',
														'110 秒' => '110',
														'170 秒' => '170',
														'235 秒' => '235',
														'280 秒' => '280'
													), 'PushConnectionTimeoutPeriod'); ?>
												</div>
											</div>
											<div class="form-group">
												<label for="SMTPHost" class="col-sm-4 control-label"><?php echo $Lang['SMTP_Host']; ?>(smtp1.example.com)</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="SMTPHost" id="SMTPHost" value="<?php echo $Config['SMTPHost']; ?>"/>
												</div>
											</div>
											<div class="form-group">
												<label for="SMTPPort" class="col-sm-4 control-label"><?php echo $Lang['SMTP_Port']; ?>(587)</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="SMTPPort" id="SMTPPort" value="<?php echo $Config['SMTPPort']; ?>"/>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><?php echo $Lang['SMTP_Auth']; ?></label>
												<div class="col-sm-8">
													<?php echo GenerateSelect(array(
														$Lang['Yes'] => 'true',
														$Lang['No'] => 'false'
													), 'SMTPAuth'); ?>
												</div>
											</div>
											<div class="form-group">
												<label for="SMTPUsername" class="col-sm-4 control-label"><?php echo $Lang['SMTP_Username']; ?>(user@qq.com)</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="SMTPUsername" id="SMTPUsername" value="<?php echo $Config['SMTPUsername']; ?>"/>
												</div>
											</div>
											<div class="form-group">
												<label for="SMTPPassword" class="col-sm-4 control-label"><?php echo $Lang['SMTP_Password']; ?></label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="SMTPPassword" id="SMTPPassword" value="<?php echo $Config['SMTPPassword']; ?>" />
													<input class="btn btn-primary mt20" type="submit" value="<?php echo $Lang['Save']; ?>" name="submit">
												</div>
											</div>
										</form>
									</div>
								</div>
							</article>
						</div>
					</div>
					<div class="col-md-3">
						<div class="profile__skill  ">
							<h4 class="profile__heading--tech-heading"><?php echo $Lang['Hot_Tags']; ?></h4>
							<div style="margin-bottom: -5px;">
								<?php foreach ($HotTagsArray as $Tag) {?>
								<a class="profile__badges-item mb5 mr5" href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag['Name']); ?>">
									<span class="badge badge--sf badge--bronze">
										<span>
											<?php echo $Tag['Name']; ?>
										</span>
									</span>
								</a>
								<?php } ?>
							</div>
						</div>
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