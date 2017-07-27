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
								<a href="#notifications1">
									<span><?php echo $Lang['Notifications_Replied_To_Me']; ?></span>
									<?php if ($CurUserInfo['NewReply'] > 0) { ?>
									<span class="count"><?php echo $CurUserInfo['NewReply']; ?></span>
									<?php } ?>
								</a>
							</li>
							<li>
								<a href="#notifications2">
									<span><?php echo $Lang['Notifications_Mentioned_Me']; ?></span>
									<?php if ($CurUserInfo['NewMention'] > 0) { ?>
									<span class="count"><?php echo $CurUserInfo['NewMention']; ?></span>
									<?php } ?>
								</a>
							</li>
							<li>
								<a href="#notifications3">
									<span><?php echo $Lang['Inbox']; ?></span>
									<?php if ($CurUserInfo['NewMessage'] > 0) { ?>
									<span class="count"><?php echo $CurUserInfo['NewMessage']; ?></span>
									<?php } ?>
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-7">
						<div class="panel panel-default timeline timeline-jsnotwork">
							<div class="panel-heading">
								<h3 class="panel-title">站内消息</h3>
							</div>
							<script>
								$(document).ready(function(){
									$("#notifications").easyResponsiveTabs({
										type: 'default', //Types: default, vertical, accordion           
										width: 'auto', //auto or any custom width
										fit: true,   // 100% fits in a container
										closed: false, // Close the panels on start, the options 'accordion' and 'tabs' keep them closed in there respective view types
										activate: function() {}  // Callback function, gets called if tab is switched
									});
									loadMoreReply(true);
									loadMoreMention(true);
									loadMoreInbox(true);
									<?php
									if ($CurUserInfo['NewMention'] > 0) {
									?>
									$(".resp-tab-item")[1].click();
									<?php
									} else if ($CurUserInfo['NewMessage'] > 0) {
									?>
									$(".resp-tab-item")[2].click();
									<?php
									}
									?>
								});
							</script>
							<script type="text/template" id="RepliedToMePostTemplate">
							<div class="pl15" style="position:relative">
								<div class="media-body pt15 pb10">
									<p class="text-muted sentence ">
										<a href="<?php echo $Config['WebsitePath']; ?>/u/{{UserName}}">{{UserName}}</a>
										<?php echo $Lang['Replied_To_Topic']; ?> · {{FormatPostTime}}
									</p>
									<h2 class="h4 title mt0">
										<a href="<?php echo $Config['WebsitePath']; ?>/goto/{{TopicID}}-{{ID}}#Post{{ID}}" target="_blank">{{Subject}}</a>
									</h2>
									<p class="excerpt wordbreak hidden-xs">{{Content}}</p>
								</div>
							</div>
							</script>

							<script type="text/template" id="MentionedMePostTemplate">
							<div class="pl15" style="position:relative">
								<div class="media-body pt15 pb10">
									<p class="text-muted sentence ">
										<a href="<?php echo $Config['WebsitePath']; ?>/u/{{UserName}}">{{UserName}}</a>
										<?php echo $Lang['Mentioned_Me']; ?> · {{FormatPostTime}}
									</p>
									<h2 class="h4 title mt0">
										<a href="<?php echo $Config['WebsitePath']; ?>/goto/{{TopicID}}-{{ID}}#Post{{ID}}" target="_blank">{{Subject}}</a>
									</h2>
									<p class="excerpt wordbreak hidden-xs">{{Content}}</p>
								</div>
							</div>
							</script>

							<script type="text/template" id="InboxTemplate">
							<div class="pl15" style="position:relative">
								<div class="message-item message-left">
									<div class="message-avatar avatar-left">
										<a href="<?php echo $Config['WebsitePath']; ?>/u/{{ContactName}}">
											<img src="<?php echo $Config['WebsitePath']; ?>/upload/avatar/middle/{{ContactID}}.png" alt="{{ContactName}}">
										</a>
									</div>
									<div class="jt jt-left"></div>
									<div class="message-content f16 p5">
										<p>{{Content}}</p>
										<a class="text-primary" href="<?php echo $Config['WebsitePath']; ?>/u/{{ContactName}}">{{ContactName}}</a> · 
										<span class="text-muted">{{FormatPostTime}}</span>
									</div>
								</div>
							</div>
							</script>
							<div class="panel-body pt0 pl0" id="notifications">
								<input type="hidden" id="RepliedToMePage" value="1" />
								<input type="hidden" id="RepliedToMeLoading" value="0" />
								<input type="hidden" id="MentionedMePage" value="1" />
								<input type="hidden" id="MentionedMeLoading" value="0" />
								<input type="hidden" id="InboxPage" value="1" />
								<input type="hidden" id="InboxLoading" value="0" />
								<div class="tabCon">
									<article style="display: block;"><div id="RepliedToMeList"></div></article>
									<article style="display: none;"><div id="MentionedMeList"></div></article>
									<article style="display: none;"><div id="InboxList"></div></article>
								</div>
							</div>
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