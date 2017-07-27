<?php
	if (!defined('InternalAccess')) exit('error: 403 Access Denied');
?>

<?php
include($TemplatePath.'header-home.php');
?>

<body>

	<!--全站导航-->
	<?php
		include($TemplatePath.'global-header.php');
	?>

	<!-- main-content start -->
	<script>
	var AllowEmptyTags = <?php echo $Config["AllowEmptyTags"]; ?>;//允许空话题
	var MaxTagNum = <?php echo $Config["MaxTagsNum"]; ?>;//最多的话题数量
	var MaxTitleChars = <?php echo $Config['MaxTitleChars']; ?>;//主题标题最多字节数
	var MaxPostChars = <?php echo $Config['MaxPostChars']; ?>;//主题内容最多字节数
	loadScript("<?php echo $Config['WebsitePath']; ?>/static/editor/ueditor.config.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function() {
		loadScript("<?php echo $Config['WebsitePath']; ?>/static/editor/ueditor.all.min.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function(){
			loadScript("<?php echo $Config['WebsitePath']; ?>/language/<?php echo ForumLanguage; ?>/<?php echo ForumLanguage; ?>.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function(){
				loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/default/new.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function(){
					$("#editor").empty();
					InitNewTopicEditor();
					$.each(<?php echo json_encode(ArrayColumn($HotTagsArray, 'Name')); ?>,function(Offset,TagName) {
						TagsListAppend(TagName, Offset);
					});
					console.log('editor loaded.');
				});
			});
		});
	});
	</script>
	<div class="wrap publish mt20">
		<div class="container">
			<form class="form" name="NewForm" onkeydown="if(event.keyCode==13)return false;">
				<input type="hidden" name="FormHash" value="<?php echo $FormHash; ?>" />
				<input type="hidden" name="ContentHash" value="" />
				<div class="form-group">
					<label for="Title" class="sr-only">标题</label>
					<input class="form-control tagClose input-lg" type="text" name="Title" id="Title" value="<?php echo htmlspecialchars($Title); ?>" placeholder="<?php echo $Lang['Title']; ?>" />
				</div>
				<div class="row" style="margin-left:0;margin-right:0">
					<div class="form-group ">
						<!-- 点击显示标签 -->
						<script type="text/javascript">
							$(document).ready(function() {
								$(".sf-typeHelper-input").click(function(e) {
									$(".techTags").toggle();
									e.stopPropagation();
								})

								$(document).click(function() {
									$(".techTags").hide();
								})
							});
						</script>
						<label for="tags" class="sr-only">标签：至少1个，最多5个</label>
						<div onclick="JavaScript:document.NewForm.AlternativeTag.focus();">
							<input class="tagsInput form-control hidden" type="text">
						</div>
						<div class="sf-typeHelper">
							<span id="SelectTags"></span>
							<input type="text" class="sf-typeHelper-input" name="AlternativeTag" id="AlternativeTag" onfocus="JavaScript:GetTags();" placeholder="<?php echo $Lang['Add_Tags']; ?>" style="width: 20em;">
						</div>
						<div role="tabpanel" class="techTags panel panel-default techTags-panel">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active">
									<ul class="taglist--inline" id="TagsList">
										<!-- 内容调用自 static/js/default/new.function.js 第241行-->
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<style>
					.edui-editor-iframeholder {
						height: 345px !important;
					}
				</style>
				<div id="questionText" class="editor editMode" style="width: 100%;">
					<div id="editor" style="width:100%;height:420px;">编辑器加载中……</div>
					<script type="text/javascript">
						var Content='<?php echo $Content; ?>';
					</script>
					<div class="editor-line"></div>
				</div>
				<div class=" publish-footer">
					<div class="container">
						<div class="operations clearfix">
							<!-- <div class="shareToWeibo checkbox pull-left mr10 mb0">
								<label for="shareToWeibo">
									<input type="checkbox" id="shareToWeibo">
									同步到新浪微博
								</label>
							</div> -->
							<div class="pull-right">
								<button title="" type="button" class="btn btn-primary ml10" id="PublishButton" onclick="JavaScript:CreateNewTopic();">
									<?php echo $Lang['Submit']; ?>(Ctrl+Enter)
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- /.container -->
	</div>
	<!-- main-content end -->