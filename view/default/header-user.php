<!DOCTYPE HTML>
<html lang="<?php echo $Lang['Language']; ?>">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php
	if ($Config['MobileDomainName']) {
		?>
		<meta http-equiv="mobile-agent"
			  content="format=xhtml; url=<?php echo $CurProtocol . $Config['MobileDomainName'] . $RequestURI; ?>">
		<?php
	}
	if (isset($PageMetaKeyword) && $PageMetaKeyword) {
		echo '<meta name="keywords" content="', $PageMetaKeyword, '" />
';
	}
	if (isset($PageMetaDesc) && $PageMetaDesc) {
		echo '<meta name="description" content="', $PageMetaDesc, '" />
';
	}
	if (IsSSL()) {
		echo '<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
';
	}
	?>
	<meta name="msapplication-TileImage" content="<?php echo $Config['WebsitePath']; ?>/static/img/retinahd_icon.png"/>
	<title><?php echo $LayoutPageTitle; ?></title>
	<link rel="apple-touch-icon-precomposed"
		  href="<?php echo $Config['WebsitePath']; ?>/static/img/apple-touch-icon-57x57-precomposed.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="72x72"
		  href="<?php echo $Config['WebsitePath']; ?>/static/img/apple-touch-icon-72x72-precomposed.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="114x114"
		  href="<?php echo $Config['WebsitePath']; ?>/static/img/apple-touch-icon-114x114-precomposed.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="144x144"
		  href="<?php echo $Config['WebsitePath']; ?>/static/img/apple-touch-icon-144x144-precomposed.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="180x180"
		  href="<?php echo $Config['WebsitePath']; ?>/static/img/retinahd_icon.png"/>
	<link rel="shortcut icon" type="image/ico" href="<?php echo $Config['WebsitePath']; ?>/favicon.ico"/>
	<link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $Config['WebsitePath']; ?>/static/sfgg/css/global.css?version=<?php echo CARBON_FORUM_VERSION; ?>">
	<link rel="stylesheet" href="<?php echo $Config['WebsitePath']; ?>/static/sfgg/css/user.css?version=<?php echo CARBON_FORUM_VERSION; ?>">
	<link rel="stylesheet" href="<?php echo $Config['WebsitePath']; ?>/static/sfgg/css/responsive.css?version=<?php echo CARBON_FORUM_VERSION; ?>">
	<link rel="search" type="application/opensearchdescription+xml" title="<?php echo mb_substr($Config['SiteName'], 0, 15, 'utf-8'); ?>" href="<?php echo $Config['WebsitePath']; ?>/search.xml"/>
	<script type="text/javascript">
		var Prefix = "<?php echo PREFIX; ?>";
		var WebsitePath = "<?php echo $Config['WebsitePath'];?>";
	</script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $Config['LoadJqueryUrl']; ?>"></script>
	<script type="text/javascript" charset="utf-8"
			src="<?php echo $Config['WebsitePath']; ?>/static/js/default/global.js?version=<?php echo CARBON_FORUM_VERSION; ?>"></script>
	<script type="text/javascript">
		<?php if ($CurUserID) {
			echo 'setTimeout(function() {GetNotification();}, 1);';
		}
		?>
		loadScript(WebsitePath + "/language/<?php echo ForumLanguage; ?>/global.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function () {
		});
	</script>
	<?php echo $Config['PageHeadContent']; ?>

</head>