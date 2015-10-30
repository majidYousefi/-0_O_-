        <meta charset="utf-8">
        <script src="ckeditor/ckeditor.js"></script>
        <script src="ckeditor/samples/js/sample.js"></script>
        <link rel="stylesheet" href="ckeditor/samples/css/samples.css">
        <div id="ajForm">
        <select onchange="fill('newPost',this.value)">
             <option >زبان</option>
            <option value="fa">فارسی</option>
            <option value="en">english</option>
        </select>
            <div class="grid-container">
                <div class="grid-width-100">
                    <div id="editor" >

                    </div>
                </div>
            </div>
        <script>
            initSample();
        </script>
        <input type="text" id="title" value="titleAHHHJJ" name="title">
        </div>
        
        <button id="addNewPost" onclick="sendFormAjax(this.id,'ajForm')">ارسال</button>

