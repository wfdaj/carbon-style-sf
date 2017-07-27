<?php
	if (!defined('InternalAccess')) exit('error: 403 Access Denied');
?>

	<div class="global-nav sf-header sf-header--index">
		<div class="emptyProgressBar">
			<div class="progressBar" id="progressBar">
				<div class="bar1" id="progressBar1"></div>
			</div>
		</div>
		<nav class="container nav">
			<!--手机版才显示-->
			<div class="visible-xs header-response">
				<a href="###" style="display:block">
					<i class="fa fa-search" aria-hidden="true">
					</i>
				</a>
				<div class="sf-header__logo sf-header__logo--response">
					<h1>
						<a href="<?php echo $Config['WebsitePath']; ?>/">
						</a>
					</h1>
				</div>
				<?php if ($CurUserID) { ?>
				<div class="opts">
					<li class="opts__item user dropdown hoverDropdown">
						<a class="dropdownBtn user-avatar my-opts-user" href="<?php echo $Config['WebsitePath']; ?>/u/<?php echo urlencode($CurUserName); ?>">
							<?php echo GetAvatar($CurUserID, $CurUserName, 'middle'); ?>
						</a>
					</li>
					<li class="opts__item dropdown hoverDropdown write-btns mt0">
						<a class="dropdownBtn" href="<?php echo $Config['WebsitePath']; ?>/new">
							<i class="fa fa-plus fa-fw" aria-hidden="true" style="margin-top: 7px">
							</i>
						</a>
					</li>
				</div>
				<?php } else { ?>
				<a href="<?php echo $Config['WebsitePath']; ?>/login" class="pull-right login-btn">
					<i class="fa fa-user" aria-hidden="true">
					</i>
				</a>
				<?php } ?>

				<!--手机版底部按钮-->
				<div class="bottom-nav">
					<div class="opts">
						<a class="opts-group <?php echo $UrlPath == 'home' ? 'active' : ''; ?>" href="<?php echo $Config['WebsitePath']; ?>/">
							<i class="fa fa-comments" aria-hidden="true"></i>
							<span>论坛</span>
						</a>
						<a class="opts-group <?php echo $UrlPath == 'tags' ? 'active' : ''; ?>" href="<?php echo $Config['WebsitePath']; ?>/" href="<?php echo $Config['WebsitePath']; ?>/tags">
							<i class="fa fa-newspaper-o" aria-hidden="true"></i>
							<span>话题</span>
						</a>
						<a class="opts-group " href="###">
							<i class="fa fa-pencil-square" aria-hidden="true">
							</i>
							<span>
								专栏
							</span>
						</a>
						<a class="opts-group " href="###">
							<i class="fa fa-play-circle" aria-hidden="true">
							</i>
							<span>
								讲堂
							</span>
						</a>
					</div>
				</div>
			</div>

			<div class="row hidden-xs">
				<div class="col-sm-7 col-md-8 col-lg-8">
					<div class="sf-header__logo">
						<h1>
							<a href="<?php echo $Config['WebsitePath']; ?>/">
								<?php echo $Lang['Home']; ?>
							</a>
						</h1>
					</div>
					<div>
						<ul class="menu list-inline pull-left hidden-xs">
							<li class="menu__item">
								<a href="<?php echo $Config['WebsitePath']; ?>/" <?php echo $UrlPath == 'home' ? ' class="active-nav"' : ''; ?>>首页</a>
							</li>
							<li class="menu__item">
								<a href="<?php echo $Config['WebsitePath']; ?>/tags" <?php echo $UrlPath == 'tags' ? ' class="active-nav"' : ''; ?>>话题</a>
							</li>
						</ul>
						<form class="header-search hidden-sm hidden-xs pull-right searchbox">
							<button class="btn btn-link" id="SearchButton">
								<span class="sr-only">搜索</span>
								<i class="fa fa-fw fa-search f14"></i>
							</button>
							<input class="form-control" id="SearchInput" type="text" onkeydown="javascript:if((event.keyCode==13)&&(this.value!='')){$('#SearchButton').trigger('click');}" placeholder="<?php echo $Lang['Search']; ?>"<?php echo $UrlPath == 'search' && !empty($Keyword) ? ' value="' . $Keyword . '"' : ''; ?> />
						</form>
					</div>
				</div>
				<div class="col-sm-5 col-md-4 col-lg-4 text-right">
					<ul class="opts list-inline hidden-xs">
						<?php if ($CurUserID) { ?>
						<li class="opts__item write-btns visible-lg-inline-block">
							<div class="btn-group">
								<a class="btn btn-success f14" href="<?php echo $Config['WebsitePath']; ?>/new" style="border-radius: 18px;">
									<i class="icon fa fa-fw fa-pencil f14"></i>
									<?php echo $Lang['Create_New_Topic']; ?>
								</a>
							</div>
						</li>
						<li class="opts__item message has-unread hidden-sm">
							<a class="btn btn-icon dropdown-toggle-message" href="<?php echo $Config['WebsitePath']; ?>/notifications/list#notifications1" title="<?php echo $Lang['Notifications']; ?>" onclick="javascript:ShowNotification(0);">
								<i class="icon fa fa-fw fa-bell-o"></i>
								<span class="has-unread__count" id="MessageNumber">0</span>
							</a>
						</li>
						<li class="opts__item has-unread hidden-sm">
							<a class="btn btn-icon" href="<?php echo $Config['WebsitePath']; ?>/settings" title="<?php echo $Lang['Settings']; ?>">
								<i class="icon fa fa-fw fa-cog"></i>
							</a>
						</li>
						<li class="opts__item user dropdown hoverDropdown">
							<a class="dropdownBtn user-avatar my-opts-user" href="<?php echo $Config['WebsitePath']; ?>/u/<?php echo urlencode($CurUserName); ?>">
								<?php echo GetAvatar($CurUserID, $CurUserName, 'middle'); ?>
								<strong class="f14"><?php echo $CurUserName; ?></strong>
							</a>
						</li>
						<?php } else { ?>
						<li class="opts__item">
							<a href="<?php echo $Config['WebsitePath']; ?>/login" class="btn-signin" style="margin-bottom:2px;">
								<?php echo $Lang['Log_In']; ?>
							</a>
							<a href="<?php echo $Config['WebsitePath']; ?>/register" class="ml10 btn-signup" onClick="_gaq.push(['_trackEvent', 'Button', 'Click', 'Login']);">
								<?php echo $Lang['Sign_Up']; ?>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="sub-head hidden-xs">
				<span class="tag-nav__item btn-all-tag">
					<a href="<?php echo $Config['WebsitePath']; ?>/tags" class="text-secondNav">
						热门话题
					</a>
				</span>
				<div class="tag-container-outer">
					<span class="tag-nav__item mr20 active">
						<a class="active" href="<?php echo $Config['WebsitePath']; ?>/tags">
							全部
						</a>
					</span>
					<div class="tag-container">
						<?php if($HotTagsArray) { ?>
						<?php foreach ($HotTagsArray as $Tag) {?>
						<span class="tag-nav__item mr20">
							<a class="text-secondNav" href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag['Name']); ?>">
								<?php echo $Tag['Name']; ?>
							</a>
						</span>
						<?php } ?>
						<?php } ?>
					</div>
				</div>
				<div class="gradient-block"></div>
			</div>
		</nav>
	</div>