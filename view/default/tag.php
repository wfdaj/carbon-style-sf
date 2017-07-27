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
		<div class="site-topheader">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="media">
							<a class="pull-left media-object" href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo $TagInfo['Name']; ?>"><?php echo GetTagIcon($TagInfo['ID'], $TagInfo['Icon'], $TagInfo['Name'], 'large'); ?></a>
							<div class="media-body">
								<h1 class="media-heading h3"><a href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo $TagInfo['Name']; ?>"><?php echo $TagInfo['Name']; ?></a></h1>
								<div class="description">
									<div id="TagDescription"><p><?php echo $TagInfo['Description']; ?></p></div>
									<div id="EditTagDescription" style="display: none;">
										<textarea class="form-control mb10" id="TagDescriptionInput"><?php echo $TagInfo['Description']; ?></textarea>
										<input type="button" value="<?php echo $Lang['Submit']; ?>" class="btn btn-primary mr10" onclick="JavaScript:SubmitTagDescription(<?php echo $TagInfo['ID']; ?>);">
										<input type="button" value="<?php echo $Lang['Cancel']; ?>" class="btn btn-default" onclick="JavaScript:CompletedEditingTagDescription();">
									</div>
									<div class="mt10">
										<?php if ($CurUserRole >= 3) { ?>
										<script>
											loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/jquery.async.uploader.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
												loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/default/tag.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
												});
											});
										</script>
										<a href="###" class="btn btn-default btn-sm edittag" onclick="javascript:EditTagDescription();">
											<?php echo $Lang['Edit_Description']; ?>
										</a>
										<a class="btn btn-default btn-sm" href="###" onclick="javascript:UploadTagIcon(<?php echo $TagInfo['ID']; ?>);">
											<?php echo $Lang['Upload_A_New_Icon']; ?>
										</a>
										<?php } ?>

										<?php if ($CurUserRole >= 4) { ?>
										<a class="btn btn-default btn-sm edittag" href="###" onclick="javascript:Manage(<?php echo $TagInfo['ID']; ?>, 5, 'SwitchStatus', true, this);">
											<?php echo $TagInfo['IsEnabled'] ? $Lang['Disable_Tag'] : $Lang['Enable_Tag']; ?>
										</a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<p class="mt5">想及时了解最新动态就关注本话题吧！</p>
						<?php if ($CurUserID) { ?>
						<a class="btn pl50 pr50 <?php echo $IsFavorite ? 'btn-warning' : 'btn-primary'; ?> btn-sm tagfollow" href="###" onclick="javascript:Manage(<?php echo $TagInfo['ID']; ?>, 4, 2, false, this);">
							<?php echo $IsFavorite ? $Lang['Unfollow'] : $Lang['Follow']; ?>
						</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container mt30">
			<div class="row">
				<div class="col-xs-12 col-md-9 main">
					<div class="tab-content">
						<div id="qa" class="stream-list question-stream">
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
											<?php echo FormatTime($Topic['LastTime']); ?>
											<?php if ($Topic['Replies']) { ?>
											<span class="split"></span>
											<i class="fa fa-fw fa-share"></i>
											<a href="<?php echo $Config['WebsitePath']; ?>/u/<?php echo urlencode($Topic['LastName']); ?>" title="<?php echo $Lang['Last_Reply_From']; ?>"><?php echo $Topic['LastName']; ?></a>
											<?php } ?>
										</li>
									</ul>
									<h2 class="title">
										<a href="<?php echo $Config['WebsitePath']; ?>/t/<?php echo $Topic['ID']; ?>">
											<?php echo $Topic['Topic']; ?>
										</a>
									</h2>
									<ul class="taglist--inline ib">
										<?php
										if ($Topic['Tags']) {
											foreach (explode("|", $Topic['Tags']) as $Tag) {
												?>
												<li class="tagPopup">
													<a class="tag tag-sm" href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag); ?>">
														<?php echo $Tag; ?>
													</a>
												</li>
										<?php } } ?>
									</ul>
								</div>
							</section>
							<?php } ?>
						</div>
						<div class="text-center">
							<ul class="pagination">
								<?php Pagination('/tag/' . $TagInfo['Name'] . '/page/', $Page, $TotalPage); ?>
							</ul>
						</div>
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.main -->
				<div class="col-xs-12 col-md-3 side">
					<div class="widget-box">
						<h2 class="h4 widget-box__title">
							热门标签
						</h2>
						<ul class="taglist--inline multi">
							<?php foreach ($HotTagsArray as $Tag) {?>
							<li class="tagPopup">
								<a class="tag" href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag['Name']); ?>">
									<?php echo $Tag['Name']; ?>
								</a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<!-- /.side -->
			</div>
		</div>
	</div>
	<!-- main-content end -->

	<!-- footer start -->
	<?php
		include($TemplatePath.'footer.php');
	?>
