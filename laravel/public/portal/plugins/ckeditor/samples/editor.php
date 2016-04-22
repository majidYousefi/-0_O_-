    <meta charset="utf-8">
	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/old/assets/uilanguages/languages.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/old/sample.css">

		
			<script>

				document.write( '<select disabled="disabled" id="languages" onchange="createEditor( this.value );">' );

				// Get the language list from the _languages.js file.
				for ( var i = 0 ; i < window.CKEDITOR_LANGS.length ; i++ ) {
					document.write(
						'<option value="' + window.CKEDITOR_LANGS[i].code + '">' +
							window.CKEDITOR_LANGS[i].name +
						'</option>' );
				}

				document.write( '</select>' );

			</script>

			<textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>
			<script>

				// Set the number of languages.
				document.getElementById( 'count' ).innerHTML =66;

				var editor;

				function createEditor( languageCode ) {
					if ( editor )
						editor.destroy();

					// Replace the <textarea id="editor"> with an CKEditor
					// instance, using default configurations.
					editor = CKEDITOR.replace( 'editor1', {
						language: languageCode,

						on: {
							instanceReady: function() {
								// Wait for the editor to be ready to set
								// the language combo.
								var languages = document.getElementById( 'languages' );
								languages.value = this.langCode;
								languages.disabled = false;
							}
						}
					});
				}

				// At page startup, load the default language:
				createEditor( '' );

			</script>
		


