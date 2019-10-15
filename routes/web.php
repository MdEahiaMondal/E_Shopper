<?php

/*------------------------- start Frontend controller Route-------------------------*/

// Homecontroller here.....
Route::get('/','Frontend\HomeController@index');
Route::get('category-product/{id}','Frontend\HomeController@category_widgs_product');
Route::get('brand-product/{id}','Frontend\HomeController@product_brand');
Route::get('view-details/{slug}','Frontend\HomeController@view_product_details');
Route::post('search-product','Frontend\HomeController@ProductSearch');
Route::get('user-profile','Frontend\HomeController@UserProfile');
Route::post('update-profile','Frontend\HomeController@updateProfile')->name('update.profile');
Route::post('update-profile-password/{id}','Frontend\HomeController@PasswordUpdate')->name('update.profile.password');


// Frontend Comment and like dislike controller Route
Route::post('insert-comment','Frontend\CommentController@insert')->name('insert.comment');
Route::get('getComment','Frontend\CommentController@getComment')->name('get.comment.data');
Route::post('like','Frontend\CommentController@like')->name('like');
Route::post('dislike','Frontend\CommentController@dislike')->name('dislike');

// Cart Route
Route::post('add-cart','Frontend\CartController@add_to_cart');
Route:: get('show-cart','Frontend\CartController@showCart')->name('cart.index');
Route:: get('delete-item/{rowId}','Frontend\CartController@deleteItem');
Route:: post('update-cart','Frontend\CartController@updateItem');

// checkout Route
Route::get('checkout','Frontend\CheckoutController@checkout')->middleware('auth');
Route::post('insert-shipping','Frontend\CheckoutController@insert_shipping')->middleware('auth');
Route::get('payment','Frontend\CheckoutController@payment')->middleware('auth');
Route::post('insert-payment','Frontend\CheckoutController@stor_payment')->middleware('auth');

// send email route contact-us
Route::get('contact-us','Frontend\SendEmailController@index');
Route::post('send-email','Frontend\SendEmailController@send')->name('send.email');

// WishListsController Route
Route::get('wishlist.index','Frontend\WishListsController@index');
Route::get('add-wishlist/{slug}','Frontend\WishListsController@store');
Route::get('remove-item/{rowId}','Frontend\WishListsController@removeItem');
Route::get('move-to-cart/{rowId}','Frontend\WishListsController@MoveToCart');

/*------------------------- end Frontend controller Route-------------------------*/








/*.............................start the Backend Controller.........................*/

// Backend controller Route
Route::get('/admin','Backend\Auth\LoginController@showLoginForm');
Route::post('admin/login', 'Backend\Auth\LoginController@login')->name('admin.login');
Route::get('admin/dashboard','Backend\AdminController@index');

    // category route::
Route::post('categories/activeUnctive','Backend\CategoryController@activeUnactive')->name('categories.activeUnctive');
Route::resource('categories','Backend\CategoryController');

    // Brand route::
Route::post('brands/activeUnctive','Backend\BrandController@ActiveUnactive')->name('brand.active.unactive');
Route::resource('brands','Backend\BrandController');

// Slider route::
Route::post('slidersActiveUnactive','SliderController@ActiveUnactive')->name('slider.active.unactive');
Route::resource('sliders','SliderController');
/*Route::post('sliders/update','SliderController@update')->name('sliders.update');*/


// product route::
    /*Route::get('/add-product','Backend\ProductController@index');
    Route::get('/all-product','Backend\ProductController@show');
    Route::post('/insert-product','Backend\ProductController@store');
    Route::get('/edit-product/{id}','Backend\ProductController@edit');
    Route::post('update-product/{id}','Backend\ProductController@update');
    Route::get('/remove-product/{id}','Backend\ProductController@softdelete');
    Route::get('/delete-product/{id}','Backend\ProductController@delete');
    Route::get('/undo-product/{id}','Backend\ProductController@undo');
    Route::get('/recycle-product','Backend\ProductController@recycle');
    Route::get('/unactive-product/{id}','Backend\ProductController@unactive');
    Route::get('/unactive-product-feture/{id}','Backend\ProductController@unactive_product_feture');
    Route::get('/active-product/{id}','Backend\ProductController@active');
    Route::get('active-product-feture/{id}','Backend\ProductController@active_product_features');*/

Route::post('products/getCategoryBrand','ProductController@getCategoryBrand')->name('get.categoryBrand.data');
Route::resource('products','ProductController');



/*// Slider route::
    Route::get('/add-slider','Backend\SliderController@index');
    Route::get('/all-slider','Backend\SliderController@show');
    Route::post('/insert-slider','Backend\SliderController@store');
    Route::get('/edit-slider/{id}','Backend\SliderController@edit');
    Route::post('/update-slider/{id}','Backend\SliderController@update');
    Route::get('/delete-slider/{id}','Backend\SliderController@destroy');
    Route::get('/unactive-slider/{id}','Backend\SliderController@unactive');
    Route::get('/active-slider/{id}','Backend\SliderController@active');*/


// order Route

   /* Route::get('all-order','Backend\OrderController@index');
    Route::get('view-order/{order_id}','Backend\OrderController@show');
    Route::get('orders/{id}/delete', 'Backend\OrderController@destroy')->name('orders.delete');*/

/*.............................end the Backend Controller.................................*/



Auth::routes(['verify' => true]);


/*Route::get('/home', 'HomeController@index')->name('home');*/

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');
