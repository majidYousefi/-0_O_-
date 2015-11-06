    <form method="post" id="fileinfo"  >


    <table class="table table-hover table-striped table-condensed" style="width:50%;">

        <tbody>
            <tr >
                <td><label  for="username" class="required"> نام کاربری:</label></td>
                <td><?PHP echo $autoComplete; ?></td>
            </tr>
            <tr>
                <td><label for="password" class="required"> کلمه عبور :</label></td>
                <td><input id="password" name="password" type="password"   class="form-control" required></td>
            </tr>
            <tr>
                <td>    <label for="re_password" class="required"> تکرار کلمه عبور:</label></td>
                <td><input id="re_password" name="re_password" type="password"  class="form-control" required></td>
            </tr>

            <tr>
                <td>    <label for="re_password" class="required"> auto</label></td>
                <td> <?PHP //echo $autoComplete; ?></td>
            </tr>
        </tbody>
    </table>


        <input  class="form-control"  type="file" name="visuat4lMedia"  id="sfj"  accept="image/*" > 
        <label for="vaziat" class="required">vaziat</label>
             <?PHP echo $multiSelect; ?>
    </form>

    <button id="addNewUser" class="btn btn-default" onclick="sendFormAjax(this.id, 'fileinfo')">ارسال</button>

