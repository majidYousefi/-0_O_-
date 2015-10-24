<!DOCTYPE html>
<!--
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or http://ckeditor.com/license
-->
<html>
<head>
	
	<meta charset="utf-8">
	<script src="../ckeditor.js"></script>
	<link rel="stylesheet" href="sample.css">
</head>
<body>
	
	
	<form action="x.php" method="post">
	
	
	
	<p>
		<textarea cols="80" id="body" name="body" rows="10"></textarea>
	
	</p>
	<p>
		<input type="submit" value="Submit">
	</p>
	</form>

	
</body>
	<script >

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'body', {
				uiColor: '#1238C4',
				toolbar: [
					[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
					[ 'FontSize', 'TextColor', 'BGColor' ]
				]
			});

		</script>
</html>
