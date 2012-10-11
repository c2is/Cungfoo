<!-- End of document -->
	<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
	<script>window.jQuery || document.write('<script src='+templatePath+'"vendor/jquery-1.8.0.min.js">\x3C/script>')</script>

	<script>
		head.js(
			{modernizr: templatePath+"vendor/modernizr-2.6.1.min.js"}, // test support html5 functionality
			{selectivizr: templatePath+"vendor/selectivizr-min.js"}, // extend css selectors for IE
			{jqPlugins: templatePath+"js/vacancesdirectes/plugins.js"},
			{frontJS: templatePath+"js/vacancesdirectes/front.js"}
		);
	</script>

	<!-- Prompt IE 6/7 users to install Chrome Frame -->
	<!--[if lt IE 8 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
</body>
</html>
