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

	<!-- main-content start -->
	<div class="profile">
		<header class="profile__heading">
			<div class="container">
				<div class="row" style="position: relative;">
					<div class="col-md-2 col-sm-3 col-xs-3">
						<div class="profile__heading--avatar-warp">
							<a href="###" class="profile__heading--avatar">
								<?php echo GetAvatar($UserInfo['ID'], $UserInfo['UserName'], 'large'); ?>
							</a>
							<input type="file" id="avatarFile" name="avatar" class="file hide">
							<div class="profile__avatar-uploader">
								<span>
									上传头像
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-5 col-sm-9 col-xs-9">
						<h2 class="profile__heading--name">
							<?php echo $UserInfo['UserName']; ?>
						</h2>
						<div class="profile__heading--award">
							<a class="profile__rank-btn" href="###">
								<span class="h4">0</span>
								<span class="profile__rank-btn-text">声望</span>
							</a>
						</div>
						<div class="profile__heading--other">
							<span class="profile__heading--other-item" title="<?php echo $Lang['Registered_In']; ?>">
								<i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
								<?php echo $Lang['Registered_In']; ?> <?php echo FormatTime($UserInfo['UserRegTime']); ?>
							</span>
							<span class="profile__heading--other-item" title="<?php echo $Lang['Homepage']; ?>">
								<i class="fa fa-fw fa-link" aria-hidden="true"></i>
								<a href="<?php echo $UserInfo['UserHomepage']; ?>" target="_blank" rel="nofollow"><?php echo $UserInfo['UserHomepage']; ?></a>
							</span>
						</div>
					</div>
					<div class="profile__heading--desc col-md-5 col-sm-12 col-xs-12">
						<div class="profile__heading--desc-heading">
							<span class="profile__heading--desc-heading-dot-warp">
								<span class="profile__heading-dot profile__heading-dot--red">
								</span>
								<span class="profile__heading-dot profile__heading-dot--yellow">
								</span>
								<span class="profile__heading-dot profile__heading-dot--green">
								</span>
							</span>
							<!-- <div class="pull-right">
								<span data-type="desc" class="profile__heading-edit btn btn-xs profile__heading--desc-heading-edit">
									<i class="fa fa-pencil" aria-hidden="true">
									</i>
									编辑
								</span>
							</div> -->
						</div>
						<div class="profile__heading--desc-body">
							<div class="profile__desc f16">
								<?php echo str_replace("\n", "<br \>", $UserInfo['UserIntro']); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="wrap mt30">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<?php if ($CurUserID) { ?>
						<div class="mb15">
							<?php if ($CurUserID != $UserInfo['ID']) { ?>
							<a class="btn mr5 btn-success userfollow" onclick="javascript:Manage(<?php echo $UserInfo['ID']; ?>, 4, 3, false, this);">
                                <?php echo $IsFavorite ? $Lang['Unfollow'] : $Lang['Follow']; ?>
                            </a>
                            <a class="btn btn-default" href="<?php echo $Config['WebsitePath']; ?>/inbox/<?php echo urlencode($UserInfo['UserName']); ?>">
                            	<?php echo $Lang['Send_Message'] ?>
                            </a>
                            <?php } ?>
                            <hr>
                            <?php if ($CurUserRole >= 4) { ?>
                            <a href="###" class="btn btn-warning" onclick="javascript:Manage(<?php echo $UserInfo['ID']; ?>, 3, 'Block', true, this);">
								<?php echo $UserInfo['UserAccountStatus'] ? $Lang['Block_User'] : $Lang['Unblock_User']; ?>
							</a>

							<a href="###" class="btn btn-default" onclick="javascript:Manage(<?php echo $UserInfo['ID']; ?>, 3, 'ResetAvatar', true, this);">
								<?php echo $Lang['Reset_Avatar']; ?>
							</a>
							<?php } ?>
						</div>
						<?php } ?>
						<div class="profile__heading-info row">
							<div class="col-md-6 col-xs-6" style="border-right: 1px solid #eee;">
								<a href="<?php echo $Config['WebsitePath']; ?>/users/following">
									<span>关注了</span>
									<span class="h5"><?php echo $CurUserInfo['NumFavUsers']; ?> 人</span>
								</a>
							</div>
							<div class="col-md-6 col-xs-6">
								<a href="<?php echo $Config['WebsitePath']; ?>/tags/following">
									<span>粉丝</span>
									<span class="h5">0 人</span>
								</a>
							</div>
						</div>
						<ul class="nav nav-pills nav-stacked profile__nav">
							<li role="separator" class="divider">
								<a>
								</a>
							</li>
							<li>
								<a href="<?php echo $Config['WebsitePath']; ?>/search/<?php echo urlencode('user:' . $UserInfo['UserName']); ?>">
									<span><?php echo $Lang['Topics_Number']; ?></span>
									<span class="count"><?php echo $UserInfo['Topics']; ?></span>
								</a>
							</li>
							<li>
								<a href="<?php echo $Config['WebsitePath']; ?>/search/<?php echo urlencode('user:' . $UserInfo['UserName'] . ' post:true'); ?>">
									<span><?php echo $Lang['Posts_Number']; ?></span>
									<span class="count"><?php echo $UserInfo['Replies']; ?></span>
								</a>
							</li>
							<li>
								<a href="<?php echo $Config['WebsitePath']; ?>/favorites">
									<span><?php echo $Lang['Favorite_Topics']; ?></span>
									<span class="count"><?php echo $CurUserInfo['NumFavTopics']; ?></span>
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-7">
						<!-- 个人动态（timeline）开始 -->
						<div class="panel panel-default timeline timeline-jsnotwork">
							<div class="panel-heading">
								<h3 class="panel-title">
									<span class="pull-right f14"><?php echo $Lang['Last_Activity_In']; ?> <?php echo FormatTime($UserInfo['LastPostTime']); ?></span>
									个人动态
								</h3>
							</div>
							<div class="panel-body pt0 pl0">
								<div class="profile__content">
									<div class="tab-content">
										<?php foreach ($PostsArray as $Post) { ?>
										<div class="pl15" style="position:relative">
											<div class="media-body pt15 pb10">
												<a class="packup" data-toggle="tooltip" data-placement="left" title=""
												href="javascript:;" data-original-title="收起">
												</a>
												<p class="text-muted sentence ">
													<?php echo $UserInfo['UserName']; ?> <?php echo $Post['IsTopic'] ? $Lang['Created_Topic'] : $Lang['Replied_To_Topic']; ?> · <?php echo FormatTime($Post['PostTime']); ?>
												</p>
												<h2 class="h4 title mt0">
													<a href="<?php echo $Config['WebsitePath']; ?>/goto/<?php echo $Post['TopicID']; ?>-<?php echo $Post['ID']; ?>#Post<?php echo $Post['ID']; ?>" target="_blank"><?php echo $Post['Subject']; ?></a>
												</h2>
												<div class="fulltext fmt hide">
													<?php echo strip_tags(mb_substr($Post['Content'], 0, 300, 'utf-8'), '<p><br>'); ?>
												</div>
												<?php echo strip_tags(mb_substr($Post['Content'], 0, 300, 'utf-8'), '<p><br>'); ?>
											</div>
										</div>
										<?php } ?>
									</div>
									<p class="text-right profile__content--footer mt10">
										查看全部
										<a href="###">
											个人动态
										</a>
										→
									</p>
								</div>
							</div>
						</div>
						<!-- 个人动态结束 -->
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