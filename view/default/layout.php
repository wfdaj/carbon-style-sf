<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');

//只有上一页下一页的分页
function PaginationSimplified($PageUrl, $CurrentPage, $IsLastPage = false)
{
	global $Config, $Lang;
	$PageUrl = $Config['WebsitePath'] . $PageUrl;
	if ($CurrentPage != 1)
		echo '<div class="float-left"><a class="previous-next" href="' . $PageUrl . ($CurrentPage - 1) . '">&lsaquo;&lsaquo;' . $Lang['Page_Previous'] . '</a></div>';
	echo '<span class="currentpage">' . $CurrentPage . '</span>';
	if (!$IsLastPage)
		echo '<div class="float-right"><a href="' . $PageUrl . ($CurrentPage + 1) . '">' . $Lang['Page_Next'] . '&rsaquo;&rsaquo;</a></div>';
}

//分页
function Pagination($PageUrl, $CurrentPage, $TotalPage)
{
	if ($TotalPage <= 1)
		return false;
	global $Config, $Lang;
	$PageUrl = $Config['WebsitePath'] . $PageUrl;
	$PageLast = $CurrentPage - 1;
	$PageNext = $CurrentPage + 1;
	//echo '<span id="pagenum"><span class="currentpage">' . $CurrentPage . '/' . $TotalPage . '</span>';
	if ($CurrentPage != 1)
		echo '<div class="float-left"><a href="' . $PageUrl . $PageLast . '">&lsaquo;&lsaquo;' . $Lang['Page_Previous'] . '</a></div>';
	if ($CurrentPage <= 4) {
		$PageiStart = 1;
	} else if ($CurrentPage >= ($TotalPage - 3)) {
		$PageiStart = $TotalPage - 7;
	} else {
		$PageiStart = $CurrentPage - 3;
	}

	if ($CurrentPage + 3 >= $TotalPage) {
		$PageiEnd = $TotalPage;
	} else if ($CurrentPage <= 3 && $TotalPage >= 8) {
		$PageiEnd = 8;
	} else {
		$PageiEnd = $CurrentPage + 3;
	}
	if ($CurrentPage >= 5 && $PageiStart > 1)
		echo '<a href="' . $PageUrl . '1">1</a>';
	for ($Pagei = $PageiStart; $Pagei <= $PageiEnd; $Pagei++) {
		if ($CurrentPage == $Pagei) {
			echo '<span class="currentpage">' . $Pagei . '</span>';
		} elseif ($Pagei > 0 && $Pagei <= $TotalPage) {
			echo '<a href="' . $PageUrl . $Pagei . '">' . $Pagei . '</a>';
		}
	}
	if ($CurrentPage + 3 < $TotalPage && $PageiEnd < $TotalPage) {
		echo '<a href="' . $PageUrl . $TotalPage . '">' . $TotalPage . '</a>';
	}
	if ($CurrentPage != $TotalPage) {
		echo '<div class="float-right"><a href="' . $PageUrl . $PageNext . '">' . $Lang['Page_Next'] . '&rsaquo;&rsaquo;</a></div>';
	}
	//echo '&nbsp;&nbsp;&nbsp;<input type="text" onkeydown="JavaScript:if((event.keyCode==13)&&(this.value!=\'\')){window.location=\''.$PageUrl.'\'+this.value;}" onkeyup="JavaScript:if(isNaN(this.value)){this.value=\'\';}" size=4 title="请输入要跳转到第几页,然后按下回车键">';
	//echo '</span>';
}


$LayoutPageTitle = ($CurUserID && $CurUserInfo['NewNotification'] ? str_replace('{{NewMessage}}', $CurUserInfo['NewNotification'], $Lang['New_Message']) : '') . $PageTitle . ($UrlPath == 'home' ? '' : ' - ' . $Config['SiteName']);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
ob_start();
if(!$IsAjax){
?>
	
	<?php
	} else {
		?>
		<title><?php echo $LayoutPageTitle; ?></title>
		<?php
	}
	?>
	
	<?php
	if ($IsMobile && $Config['MobileDomainName']) {
		?>
		<div class="swtich-to-mobile">
			<a href="<?php echo $CurProtocol . $Config['MainDomainName']; ?>/redirect-mobile?callback=<?php echo urlencode($RequestURI); ?>">
				<?php echo $Lang['Mobile_Version']; ?>
			</a>
		</div>
		<?php
	}
	?>

	<?php
	include($ContentFile);
	?>
	<a style="display: none; " rel="nofollow" href="#top" id="go-to-top"><i class="fa fa-fw fa-arrow-up"></i></a>

	<?php
	if (!$IsAjax){
	?>
	<!-- main end -->

<?php
if ($Config['PageBottomContent']) {
	echo $Config['PageBottomContent'];
}
?>
</body>
</html>
<?php
}
ob_end_flush();
?>