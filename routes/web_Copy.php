<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {



    $funding = \App\Model\HomePage::where('slug', 'funding')->first();

    $investor = \App\Model\HomePage::where('slug', 'investor')->first();

    $how = \App\Model\HomePage::where('slug', 'how-the-platform-works')->first();

    return view('welcome', compact('funding', 'investor', 'how'));
});


Auth::routes();


Route::get('/user-login/{UserType?}', 'Auth\LoginController@showLoginForm')->name('user-login');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('/registration/{UserType}', 'Auth\RegisterController@showRegistrationForm')->name('registration');

# register email confirmation

Route::get('/user/{user}/send_activation_code', 'Auth\RegisterController@sendActivationCode');
Route::get('/verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');

Route::get('confirmation', 'Auth\RegisterController@confirmation')->name('confirmation');

# seller
Route::get('/full-registration-seller', 'Seller\SellerController@create')->name('full-registration-seller');


# confirm agree

# investor confirm agree
Route::get('seller-confirm', 'Seller\SellerController@confirm')->name('seller-confirm');


Route::post('seller-confirmation', 'Seller\SellerController@update')->name('seller-confirmation');

#Route::get('/registration-complete','Seller\SellerController@create')->name('full-registration-seller');

# send reg details
Route::post('/fully-register', 'Seller\SellerController@store')->name('fully-register');

#Seller updated by Admin
Route::post('/admin/update/seller', 'Seller\SellerController@adminUpdate')->name('admin-update-seller');

# investor
Route::get('/full-registration-investor', 'Investor\InvestorController@create')->name('full-registration-investor');

Route::post('/full-registration-investor', 'Investor\InvestorController@store')->name('store-registration-investor');


# investor confirm agree
Route::get('investor-confirm', 'Investor\InvestorController@confirm')->name('investor-confirm');

Route::any('investor-confirmation', 'Investor\InvestorController@confirmation')->name('investor-confirmation');

# id
Route::get('/identity-verification', 'Investor\IdentificationController@create')->name('identity-verification');

Route::post('/post-identity', 'Investor\IdentificationController@store')->name('post-identity');

# banking
Route::get('enter-bank-details', 'Bank\BankDetailsController@create')->name('enter-bank-details');

Route::post('post-bank-details', 'Bank\BankDetailsController@store')->name('post-bank-details');

# statements
Route::get('upload-bank-statement', 'Bank\BankStatementController@create')->name('upload-bank-statement');


Route::post('post-bank-statement', 'Bank\BankStatementController@store')->name('post-bank-statement');

Route::get('invoice-link/{id}', 'Auction\InvoiceController@download')->name('invoice-link');


Route::get('po-link/{id}','Admin\AdminAuctionsController@getPoFileLinkAttribute')->name('po-link');

Route::group(['middleware' => ['role:admin']], function() {

# admin
    Route::get('users', 'Admin\DisplayUsersController@getUsers')->name('users');

    Route::get('users/export/{id}', 'Admin\DisplayUsersController@onExport')->name('users.export');

    Route::get('admin-filter', 'Admin\DisplayUsersController@getFilter')->name('admin-filter');

    Route::any('admin-edit/{id}', 'Admin\DisplayUsersController@onEdit')->name('admin-edit');


# admin approval
    Route::get('approve-user/{id}/{type}', 'Admin\Approval@approveUser')->name('approve-user');

# admin roles

    Route::get('admin/user-roles', 'Admin\RoleController@index')->name('admin.user.roles');

    Route::get('admin/roles/users', 'Admin\RoleController@index')->name('admin.roles.users');

    Route::get('admin/roles/roles', 'Admin\RoleController@index')->name('admin.roles.roles');


    # admin settings and editor

    Route::any('settings', 'Admin\SettingsController@index')->name('settings.edit');
    Route::any('editor', 'Admin\PagesEditorController@index')->name('editor.index');
    Route::any('editor/home/new', 'Admin\PagesEditorController@newHomeSection')->name('editor.newHomeSection');
    Route::any('editor/home/edit/{id}', 'Admin\PagesEditorController@index')->name('editor.index');
    Route::any('editor/edit/{id}', 'Admin\PagesEditorController@edit')->name('editor.page.edit');
    Route::any('editor/faq/edit/{id}', 'Admin\PagesEditorController@editFaq')->name('faqs.edit');
    Route::any('editor/faq/new', 'Admin\PagesEditorController@newFaq')->name('faqs.edit');
    Route::any('editor/faq/delete/{id}', 'Admin\PagesEditorController@deleteFaq')->name('faqs.delete');
    Route::get('editor/auth','Admin\PagesEditorController@getAuthPages')->name('auth.edit');
    Route::post('editor/auth','Admin\PagesEditorController@postAuthPages');


    Route::any('/auction-investors/{id}', 'Admin\InvestorsRepayment@process')->name('investors.repayment');

    Route::any('/pay-investor/{investor_id}/{auction_id}', 'Admin\InvestorsRepayment@pay')->name('investors.repayment');


});


//Route::get('who_we_are', 'HomeController@whodata')->name('who_we_are');

# info pages front end

 Route::group(['prefix' => '/'], function () {

    Route::get('/faq', function () {
        $faqs = \App\Model\Faq::all();
        return view('homepage.faq', compact('faqs'));
    })->name('faq');

    Route::get('/how-it-works', function () {
        return view('homepage.how-it-works');
    })->name('howit-works');

    Route::get('/who_we_are', function () {
        dd('hi');
        return view('homepage.who-we-are');
    })->name('who_we_are');

    Route::get('/terms', function () {

        return view('homepage.terms');
    })->name('terms');

    Route::get('/privacy', function () {
        return view('homepage.privacy');
    })->name('privacy');

    Route::get('/disclaimer', function () {
        return view('homepage.disclaimer');
    })->name('disclaimer');

    Route::get('/contact', function () {
        return view('homepage.contact');
    })->name('contact');

    Route::get('/investorHNW', function () {
        if(auth()->user()->getRole() ==="investor" || auth()->user()->getRole()==="admin"){
            return view('homepage.investorHNW');
        }
        else abort(404);

    })->name('investorHNW');
    
Route::post('contact','ContactUs\ContactPageController@sendEmail');

});


Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => ['role:seller']], function () {
        Route::get('my-auctions', 'Auction\SellerAuctionController@index')->name('seller.auctions');
        Route::any('auctions/editFrame/{auction_id}', 'Auction\CreateAuctionController@editIframe')->name('buyers.editIframe');

    });

    Route::group(['middleware' => ['role:investor']], function () {

        Route::get('/my-investments', 'Auction\InvestorAuctionsController@showMyInvestments');
        Route::post('bid/auction/{id}', 'Bid\BidsController@placeBid')->name('investor.bid');
        Route::put('bid/auction/{id}/edit', 'Bid\BidsController@editBid')->name('investor.bid.edit');
    });


    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin/edit/{UserType}/{id}', 'Admin\EditUsersController@getEdit')->name('admin.editUser');
        Route::post('/admin/edit/{UserType}/{id}', 'Admin\EditUsersController@postEdit');
        Route::post('/admin/edit/{UserType}/{id}/experian', 'Admin\EditUsersController@postEditExperianRating')->name('admin.editUser.ER');
        Route::post('/admin/edit/{UserType}/{id}/credit-limit', 'Admin\EditUsersController@postEditCreditLimit')->name('admin.editUser.CL');

        Route::get('/admin/view/{UserType}/{id}/{view?}', 'Admin\ViewUsersController@getView')->name('admin.viewUser');

        Route::get('auctions/', 'Admin\AdminAuctionsController@index')->name('admin.auctions');
        Route::get('auctions/export/{id?}', 'Admin\AdminAuctionsController@onExportAuctions')->name('admin.auctions.export');
        Route::post('auctions/{id}/pending', 'Admin\AdminAuctionsController@pendingAuction')->name('admin.auction.pending');
        Route::post('auctions/{id}/decline', 'Admin\AdminAuctionsController@declineAuction')->name('admin.auction.decline');
        Route::post('auctions/{id}/approve', 'Admin\AdminAuctionsController@approveAuction')->name('admin.auction.approve');
        Route::any('auctions/{id}/release_funds', 'Admin\AdminFundsController@releaseFunds')->name('admin.auction.release_funds');

        Route::get('transactions', 'Admin\AdminTransactionsController@index')->name('admin.transactions');
        Route::post('transactions/confirm/{id}', 'Admin\AdminTransactionsController@confirm')->name('admin.transaction.confirm');
        Route::post('transactions', 'Admin\AdminTransactionsController@createTransaction')->name('admin.transactions.create');
        Route::post('transactions/payseller', 'Admin\AdminTransactionsController@transferFundsToSeller')->name('admin.transactions.payseller');

        Route::get('auctions/','Admin\AdminAuctionsController@index')->name('admin.auctions');
        Route::get('auctions/export/{id?}','Admin\AdminAuctionsController@onExportAuctions')->name('admin.auctions.export');
        Route::post('auctions/{id}/decline','Admin\AdminAuctionsController@declineAuction')->name('admin.auction.decline');
        Route::post('auctions/{id}/approve','Admin\AdminAuctionsController@approveAuction')->name('admin.auction.approve');
        Route::get('auctions/{id}/winners','Admin\AdminAuctionsController@getWinners')->name('admin.auction.winners');

        Route::any('auctions/{id}/approve_invoice','Admin\AdminAuctionsController@approveInvoice')->name('admin.auction.approve_invoice');
        Route::any('auctions/{id}/approve_po','Admin\AdminAuctionsController@approvePurchaseOrder')->name('admin.auction.approve_po');

//        Route::any('auctions/{id}/release_funds', 'Admin\AdminFundsController@releaseFunds')->name('admin.auction.release_funds');


        Route::get('transactions/export', 'Admin\AdminTransactionsController@onExportTransactions')->name('admin.transactions.export');


        Route::post('buyers/approve/{id}', 'Buyers\BuyersController@onApproveBuyer')->name('buyers.approve');
        Route::post('buyers/decline/{id}', 'Buyers\BuyersController@onDeclineBuyer')->name('buyers.decline');
    });


# seller create auction
# STEP 1 create buyer
    Route::any('/create-auction', 'Auction\CreateAuctionController@create')->name('create-auction');
# STEP 2
    Route::any('/create-auction-step-2/{step}/{buyer_id}', 'Auction\CreateAuctionController@steps')->name('create-auction-step-2');
#STEP 3
    Route::any('/create-auction-step-3/{step}/{auction_id}', 'Auction\CreateAuctionController@steps')->name('create-auction-step-3');
#STEP 4
    Route::any('/create-auction-step-4/{step}/{auction_id}', 'Auction\CreateAuctionController@steps')->name('create-auction-step-4');
#STEP confirm
    Route::post('/create-auction-confirm', 'Auction\NewCreateAuctionController@update')->name('create-auction-confirm');

#INVOICE UPLOAD
    Route::post('/upload-invoice', 'Auction\InvoiceController@store')->name('upload-invoice');



    Route::get('profile', 'Profile\UserProfileController@profile')->name('profile.view');
    Route::get('profile/edit', 'Profile\UserProfileController@edit')->name('profile.edit');
    Route::post('profile/edit', 'Profile\UserProfileController@postProfile')->name('profile.edit');
    Route::get('/profile/changepassword', 'Profile\UserProfileController@getChangePassword')->name('profile.password.change');
    Route::post('/profile/changepassword', 'Profile\UserProfileController@postChangePassword')->name('profile.password.change');

    Route::get('dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

    Route::get('marketplace', 'MarketplaceController@index')->name('marketplace');
    Route::get('auctions/{id}', 'MarketplaceController@showAuction')->name('auction.details');


    Route::get('buyers', 'Buyers\BuyersController@index')->name('buyers.index');
    Route::get('buyers/show/{id}', 'Buyers\BuyersController@show')->name('buyers.show');
    Route::get('buyers/export/{id}', 'Buyers\BuyersController@onExport')->name('buyers.export');
    Route::any('buyers/create', 'Buyers\BuyersController@create')->name('buyers.create');
    Route::any('buyers/edit/{id}', 'Buyers\BuyersController@edit')->name('buyers.edit');
    Route::any('buyers/editFrame/{id}', 'Buyers\BuyersController@editIframe')->name('buyers.editIframe');
    Route::any('buyers/edit-rating/{id}', 'Buyers\BuyersController@onEditRating')->name('buyers.edit-rating');


    Route::get('notifications', 'Admin\NotificationsController@index')->name('notifications');
    Route::get('notifications/{id}/markAsRead', 'Admin\NotificationsController@markAsRead')->name('notifications.markAsRead');

    Route::get('account', 'Account\AccountsController@show')->name('user.account');
    Route::post('account/addFunds', 'Account\AccountsController@requestDepositFunds')->name('user.funds.deposit');
    Route::post('account/removeFunds', 'Account\AccountsController@requestWithdrawFunds')->name('user.funds.withdraw');


    Route::get('json/users', 'JSON\JsonOutputsController@users');
    Route::get('json/bankDetails/{user_id}', 'JSON\JsonOutputsController@bankDetails');
    Route::get('json/createreference', 'JSON\JsonOutputsController@createreference');

    Route::get('seller/{seller}/history','Seller\SellerController@history');
    /**
     * Route to download documents by id
     * example download/address/1
     */
    Route::get('/download/document/{id}', 'Documents\DocumentsController@download')->name('download');
    Route::get('/bankstatement/download/{id}', 'Bank\BankStatementController@download')->name('bankstatement.download');

    Route::get('ajax/settings', 'Admin\SettingsController@apiSettings')->name('settings.api');
    Route::get('ajax/auction_summary/{auction}', 'Admin\MarketplaceController@auctionSummary')->name('auction.summary');


    //rewrite the steps
    Route::any('/step-1/', 'Auction\NewCreateAuctionController@first')->name('first');
    Route::any('/step-2/{buyer_id}', 'Auction\NewCreateAuctionController@second')->name('second');
    Route::any('/step-3/', 'Auction\NewCreateAuctionController@third')->name('third');
    Route::any('/step-4/{auction_id?}', 'Auction\NewCreateAuctionController@fourth')->name('fourth');


});
