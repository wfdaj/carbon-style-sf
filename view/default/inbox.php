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
						
					</div>
					<div class="col-md-7">
						<div class="panel panel-default timeline">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a href="<?php echo $Config['WebsitePath']; ?>/notifications/list#notifications3"><?php echo $Lang['Inbox']; ?></a> &raquo;
									<?php echo str_replace('{{UserName}}', '<a href="' . $Config['WebsitePath']  . '/u/' . $ContactUserName . '"><strong class="text-primary">' . $ContactUserName . '</strong></a>', $Lang['Chat_With_SB']) ?>
								</h3>
							</div>
							<div class="panel-body pt0 pb30">
								<script>
								$(document).ready(function(){
									loadMoreMessages(true);
									loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/default/inbox.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function(){
									});
								});
								</script>
								<input type="hidden" id="InboxID" value="<?php echo $InboxID; ?>" />
								<input type="hidden" id="MessagesPage" value="1" />
								<input type="hidden" id="MessagesLoading" value="0" />
								<script type="text/template" id="MessageTemplate">
									<div class="message-item message-{{Position}}">
										<div class="message-avatar avatar-{{Position}}">
											<a href="<?php echo $Config['WebsitePath']; ?>/u/{{ContactName}}">
												<img src="<?php echo $Config['WebsitePath']; ?>/upload/avatar/middle/{{ContactID}}.png" alt="{{ContactName}}"/>
											</a>
										</div>
										<div class="jt jt-{{Position}}"></div>
										<div class="message-content f16 p5">
											<p>{{Content}}</p>
											<div class="text-muted">{{FormatTime}}</div>
										</div>
									</div>
								</script>
								<div class="mb10" id="MessagesList"></div>
							</div>
							<div class="panel-body" style="border-top: 1px solid #ddd;">
								<textarea class="form-control mt10" name="MessageContent" id="MessageContent" rows="6" placeholder="<?php echo $Lang['Message_Content']; ?>"></textarea>
								<button class="btn btn-success mt15" type="button" value="" onclick="JavaScript:;" id="SendMessageButton">
									<?php echo $Lang['Send_Message']; ?>
								</button>
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