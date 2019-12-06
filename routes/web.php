<?php

/*------------------------- start Frontend controller Route-------------------------*/

// Homecontroller here.....

Route::group(['namespace' => 'Frontend'], function (){

    // HomeController Route
    Route::get('/','HomeController@index');
    Route::get('category-product/{id}','HomeController@category_widgs_product');
    Route::get('brand-product/{id}','HomeController@product_brand');
    Route::get('view-details/{slug}','HomeController@productDetails')->name('product.details');

    // SearchController Route
    Route::get('product-search','SearchController@ProductSearch')->name('search.product');
    Route::get('live-search-product','SearchController@searchAction')->name('live.search.product');
    Route::post('search-price-product','SearchController@priceRangeSearch')->name('price.range');

// WishListsController Route
    Route::get('wishlist.index','WishListsController@index');
    Route::get('add-wishlist/{slug}','WishListsController@store')->name('add.wishlist');
    Route::get('remove-item/{rowId}','WishListsController@removeItem');
    Route::get('move-to-cart/{rowId}','WishListsController@MoveToCart');



    Route::get('user-profile','HomeController@UserProfile');
    Route::post('update-profile','HomeController@updateProfile')->name('update.profile');
    Route::post('update-profile-password/{id}','HomeController@PasswordUpdate')->name('update.profile.password');


// Frontend Comment and like dislike controller Route
    Route::post('insert-comment','CommentController@insert')->name('insert.comment');
    Route::get('getComment','CommentController@getComment')->name('get.comment.data');
    Route::post('like','CommentController@like')->name('like.comment');
    Route::post('dislike','CommentController@dislike')->name('dislike');

// Cart Route
    Route::post('add-cart','CartController@add_to_cart');
    Route:: get('show-cart','CartController@showCart')->name('cart.index');
    Route:: get('delete-item/{rowId}','CartController@deleteItem');
    Route:: post('update-cart','CartController@updateItem');

// checkout Route
    Route::get('checkout','CheckoutController@checkout')->middleware('auth');
    Route::post('insert-shipping','CheckoutController@insert_shipping')->middleware('auth');
    Route::get('payment','CheckoutController@payment')->name('payment.giveData')->middleware('auth');
    Route::post('insert-payment','CheckoutController@paymentStore')->name('payment.store')->middleware('auth');

// send email route contact-us
    Route::get('contact-us','SendEmailController@index');
    Route::post('send-email','SendEmailController@send')->name('send.email');


});




Auth::routes(['verify' => true]);


/*Route::get('/home', 'HomeController@index')->name('home');*/

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');



/*------------------------- end Frontend controller Route-------------------------*/








/*.............................start the Backend Controller.........................*/

Route::group(['namespace' => 'Backend'], function (){


// Backend controller Route
    Route::get('/admin','Auth\LoginController@showLoginForm')->name('admin.login.get');
    Route::post('admin/login', 'Auth\LoginController@login')->name('admin.login');
    Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::get('admin/dashboard','AdminController@index');

    // category route::
    Route::post('categories/activeUnctive','CategoryController@activeUnactive')->name('categories.activeUnctive');
    Route::resource('categories','CategoryController');

    // Brand route::
    Route::post('brands/activeUnctive','BrandController@ActiveUnactive')->name('brand.active.unactive');
    Route::resource('brands','BrandController');

// Slider route::
    Route::post('slidersActiveUnactive','SliderController@ActiveUnactive')->name('slider.active.unactive');
    Route::resource('sliders','SliderController');


// product route::
    Route::post('products/getCategoryBrand','ProductController@getCategoryBrand')->name('get.categoryBrand.data');
    Route::post('products/status/activeUnactive','ProductController@statusActiveUnactive')->name('status.active.unactive');
    Route::post('products/features/activeUnactive','ProductController@featuresActiveUnactive')->name('features.active.unactive');
    Route::get('products-softdelete/{product}','ProductController@softdelete')->name('product.softdelete');// it is normal delete
    Route::get('products-undo/{product}','ProductController@undoTrash')->name('undo.trash.product');// it is normal delete
    Route::get('recycle-product','ProductController@recycle')->name('product.recycle.bin');
    Route::resource('products','ProductController');

// order Route
    Route::post('orders/changeStatus','OrderController@changeStatus')->name('order.changeStatus');
    Route::get('orders/feedBackResult/{orders}','OrderController@feedBackResult')->name('redirect.to.details.pages');
    Route::resource('orders','OrderController');


});



/*.............................end the Backend Controller.................................*/
