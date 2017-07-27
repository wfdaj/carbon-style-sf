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

	<script type="text/javascript">
		var TopicID = <?php echo $ID; ?>;
	</script>

	<!-- main-content start -->
	<div class="wrap" id="main">
		<?php
		if ($Page == 1) {
			?>
		<div class="post-topheader">
			<div class="container">
				<div class="block-for-right-border">
					<div class="row">
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="post-topheader__info">
								<h1 class="h3 post-topheader__info--title" id="questionTitle" data-id="1010000010251765">
									<a href="###">
										<?php echo $Topic['Topic']; ?>
									</a>
								</h1>
								<div class="inline-block" id="TagsList">
									<div class="inline-block" id="TagsElements">
										<ul class="taglist--inline inline-block question__title--tag mr10">
											<?php
											if ($Topic['Tags']) {
												foreach (explode("|", $Topic['Tags']) as $Tag) {
													?>
													<li class="tagPopup mb5">
														<a class="tag" id="Tag<?php echo md5($Tag); ?>" href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag); ?>"><?php echo $Tag; ?></a>
													</li>
													<?php
												}
											}
											?>
										</ul>
									</div>
									<?php if ($CurUserRole >= 4 || $Topic['UserID'] == $CurUserID) { ?>
									<a href="###" class="tag edittag" style="background-color: #426799; color: #fff;" onclick="javascript:EditTags();">
										<?php echo $Lang['Edit_Tags']; ?>
									</a>
									<?php } ?>
								</div>
								<div class="inline-block" id="EditTags" style="display:none;">
									<div class="inline-block" id="EditTagsElements">
										<ul class="taglist--inline inline-block question__title--tag mr10">
										<?php
										if ($Topic['Tags']) {
											foreach (explode("|", $Topic['Tags']) as $Tag) {
												?>
												<li class="tagPopup mb5">
													<a class="tag" href="###" onclick="javascript:DeleteTag(<?php echo $ID; ?>, this, '<?php echo $Tag; ?>');">
														<?php echo $Tag; ?>&nbsp;×
													</a>
												</li>
												<?php
											}
										}
										?>
									</div>
									<input type="text" class="form-control inline-block" name="AlternativeTag" id="AlternativeTag" value="" placeholder="<?php echo $Lang['Add_Tags']; ?>" style="width: 200px;">
									<a href="###" class="btn btn-sm btn-primary edittag" onclick="javascript:CompletedEditingTags();">
										<?php echo $Lang['Complete_Edit_Tags']; ?>
									</a>
								</div>
								<div class="question__author inline-block ml20">
									<a href="<?php echo $Config['WebsitePath'] . '/u/' . urlencode($Topic['UserName']); ?>" class="mr5">
										<strong><?php echo $Topic['UserName']; ?></strong>
									</a>
									<?php echo FormatTime($Topic['PostTime']); ?>
									<span class="hidden-xs"></span>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-12 hidden-xs">
							<ul class="post-topheader__side list-unstyled">
							<?php
							if ($CurUserRole >= 4) {
								if ($Topic['IsDel'] == 0) {
									?>
								<li class="inline-block">
									<button type="button" class="btn btn-warning btn-sm" onclick="javascript:Manage(<?php echo $ID; ?>, 1, 'Delete', true, this);">
										<?php echo $Lang['Delete']; ?>
									</button>
								</li>
								<?php } else { ?>
								<li class="inline-block">
									<button type="button" class="btn btn-default btn-sm" onclick="javascript:Manage(<?php echo $ID; ?>, 1, 'Recover', false, this);">
										<?php echo $Lang['Recover']; ?>
									</button>
								</li>
								<li class="inline-block">
									<button type="button" class="btn btn-default btn-sm" onclick="javascript:Manage(<?php echo $ID; ?>, 1, 'PermanentlyDelete', true, this);">
										<?php echo $Lang['Permanently_Delete']; ?>
									</button>
								</li>
								<?php } ?>
								<li class="inline-block">
									<button type="button" class="btn btn-default btn-sm" onclick="javascript:Manage(<?php echo $ID; ?>, 1, 'Lock', true, this);">
										<?php echo $Topic['IsLocked'] ? $Lang['Unlock'] : $Lang['Lock']; ?>
									</button>
								</li>
								<li class="inline-block">
									<button type="button" class="btn btn-default btn-sm" onclick="javascript:Manage(<?php echo $ID; ?>, 1, 'Sink', true, this);">
										<?php echo $Lang['Sink']; ?>
									</button>
								</li>
								<li class="inline-block">
									<button type="button" class="btn btn-default btn-sm" onclick="javascript:Manage(<?php echo $ID; ?>, 1, 'Rise', true, this);">
										<?php echo $Lang['Rise']; ?>
									</button>
								</li>
							<?php } ?>
								<?php if ($CurUserID) { ?>
								<li>
									<button type="button" class="btn btn-primary btn-sm" onclick="javascript:Manage(<?php echo $ID; ?>, 4, 1, false, this);"><?php echo $IsFavorite ? $Lang['Unsubscribe'] : $Lang['Collect']; ?></button>
									<strong><?php echo $Topic['Favorites']; ?></strong> <?php echo $Lang['People_Collection']; ?>，
									<strong class="no-stress"><?php echo($Topic['Views'] + 1); ?></strong> <?php echo $Lang['People_Have_Seen']; ?>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end .post-topheader -->
		<div class="container mt30">
			<div class="row">
				<div class="col-xs-12 col-md-9 main">
					<article class="widget-question__item">
						<div class="post-col">
							<a href="<?php echo $Config['WebsitePath'] . '/u/' . urlencode($Topic['UserName']); ?>">
								<?php echo GetAvatar($Topic['UserID'], $Topic['UserName'], 'middle'); ?>
							</a>
						</div>
						<div class="post-offset topic-content2">
							<div class="question fmt f16">
								<div id="p<?php echo $PostsArray[0]['ID']; ?>"><?php echo $PostsArray[0]['Content']; ?></div>
								<div id="edit<?php echo $PostsArray[0]['ID']; ?>" style="width: 100%; height: auto; display: none;"></div>
							</div>
							<div class="row">
								<div class="post-opt col-md-8">
									<ul class="list-inline mb0">
										<li class="pr15">
											<?php echo FormatTime($Topic['PostTime']); ?>
										</li>
										<?php if ($CurUserRole >= 4 || ($Config['AllowEditing'] === 'true' && $Topic['UserID'] == $CurUserID)) { ?>
										<li class="p10 pr15">
											<a class="hand" href="###" onclick="javascript:EditPost(<?php echo $PostsArray[0]['ID']; ?>);">
												<i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
												<?php echo $Lang['Edit']; ?>
											</a>
										</li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
						<!-- end .post-offset -->
					</article>
				<?php
				unset($PostsArray[0]);
			}
			if ($Topic['Replies'] != 0) {
				?>
					<div class="widget-answers">
						<div class="pull-right">
							<?php echo $Lang['Last_Updated_In']; ?> <?php echo FormatTime($Topic['LastTime']); ?>
						</div>
						<h2 class="title h4 mt30 mb20 post-title" id="answers-title">
							<?php echo $Topic['Replies']; ?><?php echo $Lang['Replies']; ?>
						</h2>

						<?php
						foreach ($PostsArray as $key => $Post) {
							$PostFloor = ($Page - 1) * $Config['PostsPerPage'] + $key;
							?>
						<article class="clearfix widget-answers__item">
							<a name="Post<?php echo $Post['ID']; ?>"></a>
							<div class="post-col">
								<a class="mr10" href="<?php echo $Config['WebsitePath'] . '/u/' . urlencode($Post['UserName']); ?>">
									<?php echo GetAvatar($Post['UserID'], $Post['UserName'], 'middle'); ?>
								</a>
							</div>
							<div class="post-offset">
								<div class="answer fmt f16 comment-content2" id="p<?php echo $Post['ID']; ?>"><?php echo $Post['Content']; ?></div>
								<div id="edit<?php echo $Post['ID']; ?>" style="width: 100%; height: auto; display: none;"></div>
								<div class="row answer__info--row">
									<div class="post-opt col-md-10 col-sm-10 col-xs-10">
										<ul class="list-inline mb0">
											<li class="pr15 text-muted">
												<?php echo FormatTime($Post['PostTime']); ?>
											</li>
											<li class="pl0 pr15">
												<a href="#reply" class="comments" title="<?php echo $Lang['Reply']; ?>" onclick="JavaScript:Reply('<?php echo $Post['UserName']; ?>', <?php echo $PostFloor; ?>, <?php echo $Post['ID']; ?>);">
													<i class="fa fa-commenting mr4" aria-hidden="true"></i>评论
												</a>
											</li>

											<?php if ($CurUserID) { ?>
												<?php if ($CurUserRole >= 4 || ($Config['AllowEditing'] === 'true' && $Post['UserID'] == $CurUserID)) { ?>
												<li class="edit-btn pl0 pr15">
													<a href="###" onclick="javascript:EditPost(<?php echo $Post['ID']; ?>);" >
														<i class="fa fa-fw fa-pencil" aria-hidden="true"></i><?php echo $Lang['Edit']; ?>
													</a>
												</li>
												<?php } ?>
												<?php if ($CurUserRole >= 4) { ?>
												<li class="edit-btn pl0 pr15">
													<a href="###" onclick="javascript:Manage(<?php echo $Post['ID']; ?>, 2, 'Delete', true, this);"
													   title="<?php echo $Lang['Delete']; ?>">
														<i class="fa fa-fw fa-trash-o" aria-hidden="true"></i><?php echo $Lang['Delete']; ?>
													</a>
												</li>
												<?php } ?>
											<?php } ?>
										</ul>
									</div>
									<div class="col-md-2 col-sm-2 hidden-xs">
										<div class="text-right">
											#<?php echo $PostFloor; ?>
										</div>
									</div>
								</div>
								<!-- /.widget-comments -->
							</div>
						</article>
						<?php } ?>
						<!-- /article -->
					</div>
				<?php } ?>
					<!-- /.widget-answers -->
					<!-- comment list end -->

					<!-- editor start -->
					<div style="padding-left: 65px;" id="goToAnswerEditor">

						<?php if ($Topic['IsLocked'] || (!$Topic['IsLocked'] && !$CurUserInfo)) { ?>

						<script type="text/javascript">
							loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/default/topic.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
								loadScript("<?php echo $Config['WebsitePath']; ?>/static/editor/ueditor.parse.min.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
									RenderTopic();
								});
							});
						</script>
						<script type="text/javascript" charset="utf-8" src="<?php echo $Config['WebsitePath']; ?>/static/js/default/topic.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>"></script>
						<div class="text-danger f16 pt20">
							<p><?php echo $Topic['IsLocked'] ? $Lang['Topic_Has_Been_Locked'] : $Lang['Requirements_For_Login'];; ?></p>
						</div>

						<?php }else{ ?>

						<a name="reply"></a>
						<script type="text/javascript">
							var MaxPostChars = <?php echo $Config['MaxPostChars']; ?>;//主题内容最多字节数
							loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/default/topic.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
								InitNewTagsEditor();
								loadScript("<?php echo $Config['WebsitePath']; ?>/static/editor/ueditor.config.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
									loadScript("<?php echo $Config['WebsitePath']; ?>/static/editor/ueditor.all.min.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
										loadScript("<?php echo $Config['WebsitePath']; ?>/language/<?php echo ForumLanguage; ?>/<?php echo ForumLanguage; ?>.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
											$("#editor").empty();
											InitEditor();
											loadScript("<?php echo $Config['WebsitePath']; ?>/static/editor/ueditor.parse.min.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
												RenderTopic();
											});
										});
									})
								});
							});
						</script>
						<form name="reply" class="editor-wrap">
							<input type="hidden" name="FormHash" value="<?php echo $FormHash; ?>">
							<input type="hidden" name="TopicID" value="<?php echo $ID; ?>">
							<style>
								.edui-editor-iframeholder {
									height: 200px !important;
								}
							</style>
							<div class="editor" id="editor">编辑器加载中...</div>
							<div id="answerSubmit" class="mt15 clearfix">
								<!-- <div class="checkbox pull-left">
									<label>
										<input type="checkbox" class="" id="shareToWeibo">
										同步到新浪微博
									</label>
								</div> -->
								<div class="pull-right">
									<button type="submit" id="ReplyButton" class="btn btn-lg btn-primary ml20" onclick="JavaScript:ReplyToTopic();">
										<?php echo $Lang['Reply']; ?>(Ctrl+Enter)
									</button>
								</div>
							</div>
						</form>
						<?php } ?>
						<!-- editor end -->
					</div>
				</div>
				<!-- /.main -->
				<div class="col-xs-12 col-md-3 side">
	            </div>
				<!-- /.side -->
			</div>
		</div>
		<div class="reply-mouse-tip sider-box" id="reply-mouse-tip">
			<a class="author" href="javascript:;"></a>
			<div class="content">内容加载中...</div>
		</div>
	</div>
	<!-- main-content end -->

	<!-- footer start -->
	<?php
		include($TemplatePath.'footer.php');
	?>


	