<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');
?>

<?php
include($TemplatePath.'header-tags.php');
?>

<body>

	<!--全站导航-->
	<?php
		include($TemplatePath.'global-header.php');
	?>

	<!-- main-content start -->
	<div class="wrap">
		<div class="container">
			<div class="row all-event-list mt20">
				<?php foreach ($TagsArray as $Tag) { ?>
				<div class="col-md-3 col-sm-4 col-xs-12">
					<div class="widget-event">
						<a class="widget-event__banner" href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag['Name']); ?>">
							<?php echo GetTagIcon($Tag['ID'], $Tag['Icon'], $Tag['Name'], 'large'); ?>
						</a>
						<div class="widget-event__info">
							<h2 class="h4 title">
								<a href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag['Name']); ?>">
									<?php echo $Tag['Name']; ?>
								</a>
							</h2>
							<ul class="widget-event__meta clearfix">
								<li><?php echo $Tag['TotalPosts']; ?><?php echo $Lang['Topics']; ?></li>
								<li><?php echo $Tag['Followers']; ?><?php echo $Lang['Followers']; ?></li>
							</ul>
							<p class=" clearfix mt10"><?php echo ($Tag['Description']? mb_strlen($Tag['Description']) > 60 ? mb_substr($Tag['Description'], 0, 60, 'utf-8').'……' : $Tag['Description'] : '' ); ?></p>
							<?php if($CurUserID){ ?>
							<a href="###" class="btn btn-primary btn-sm pull-right" onclick="javascript:Manage(<?php echo $Tag['ID']; ?>, 4, 2, false, this);">
								<?php echo isset($IsFavoriteArray[$Tag['ID']])?$Lang['Unfollow']:$Lang['Follow']; ?>
							</a>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="text-center">
				<?php
					Pagination("/tags/page/",$Page,$TotalPage);
				?>
			</div>
		</div>
	</div>
	<!-- main-content end -->