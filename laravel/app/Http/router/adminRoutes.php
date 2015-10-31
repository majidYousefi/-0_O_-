<?PHP

Route::group(['middleware' => 'auth'], function () {
    Route::any("getView/{page}", function ($page) {
        return view("$page");
    });
});
