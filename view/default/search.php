<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');
//关键字加亮
function KeywordHighlight($Content)
{
	global $KeywordArray;
	if ($KeywordArray) {
		$KeywordHighlightArray = array();
		foreach ($KeywordArray as $Value) {
			$KeywordHighlightArray[] = '<span class="text-danger">' . $Value . '</span>';
		}
		return str_ireplace($KeywordArray, $KeywordHighlightArray, $Content);
	} else {
		return $Content;
	}
}
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
				<div class="col-xs-12 col-md-9 main">
					<?php if( $Error) {?>
					    <div class="alert-warning"><?php echo $Error;?></div>
					<?php } ?>
					<div class="stream-list question-stream mt20">

						<?php foreach ($TopicsArray as $Topic) { ?>
						<section class="stream-list__item">
							
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
								<?php if (empty($Topic['PostID'])): ?>
									<a href="<?php echo $Config['WebsitePath']; ?>/t/<?php echo $Topic['ID']; ?>">
								<?php else: ?>
									<a href="/goto/<?php echo $Topic['ID']; ?>-<?php echo $Topic['PostID']; ?>#Post<?php echo $Topic['PostID']; ?>">
								<?php endif ?>
									<?php echo KeywordHighlight($Topic['Topic']); ?>
									</a>
								</h2>
								<ul class="taglist--inline ib">
									<?php
									if($Topic['Tags']){
										foreach (explode("|", $Topic['Tags']) as $Tag) {
									?>
									<li class="tagPopup">
										<a class="tag tag-sm" href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag); ?>"><?php echo KeywordHighlight($Tag); ?></a>
									</li>
									<?php } } ?>
								</ul>
								<?php if( isset($Topic['MinContent']) ) { ?>
				                <div class="topic-dec">
				                    <?php echo $PostsSearch ? KeywordHighlight($Topic['MinContent']) : $Topic['MinContent']; ?>
				                </div>
				                <?php } ?>
							</div>
						</section>
						<?php } ?>
					</div>
					<!-- /.stream-list -->

					<div class="pagination">
						<?php PaginationSimplified('/search/'.$Keyword.'/page/', $Page, $IsLastPage); ?>
					</div>
				</div>
				<!-- /.main -->
				<div class="col-xs-12 col-md-3 side mt30">

					asdf
				</div>
			</div>
		</div>
	</div>
	<!-- main-content end -->

	<!-- footer start -->
	<?php
		include($TemplatePath.'footer.php');
	?>