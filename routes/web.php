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
Route::post('slidersActiveUnactive','Backend\SliderController@ActiveUnactive')->name('slider.active.unactive');
Route::resource('sliders','Backend\SliderController');


// product route::
Route::post('products/getCategoryBrand','Backend\ProductController@getCategoryBrand')->name('get.categoryBrand.data');
Route::post('products/status/activeUnactive','Backend\ProductController@statusActiveUnactive')->name('status.active.unactive');
Route::post('products/features/activeUnactive','Backend\ProductController@featuresActiveUnactive')->name('features.active.unactive');
Route::get('products-softdelete/{product}','Backend\ProductController@softdelete')->name('product.softdelete');// it is normal delete
Route::get('products-undo/{product}','Backend\ProductController@undoTrash')->name('undo.trash.product');// it is normal delete
Route::get('recycle-product','Backend\ProductController@recycle')->name('product.recycle.bin');
Route::resource('products','Backend\ProductController');

// order Route

    Route::get('all-order','Backend\OrderController@index');
    Route::get('view-order/{order_id}','Backend\OrderController@show');
    Route::get('orders/{id}/delete', 'Backend\OrderController@destroy')->name('orders.delete');

Route::get('orders/feedBackResult/{orders}','OrderController@feedBackResult')->name('redirect.to.details.pages');
Route::resource('orders','OrderController');



/*.............................end the Backend Controller.................................*/



Auth::routes(['verify' => true]);


/*Route::get('/home', 'HomeController@index')->name('home');*/

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');
