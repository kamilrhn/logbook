<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\IconsController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ExComponentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ExtensionsController;
use App\Http\Controllers\LanguageController;

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


$controller_path = 'App\Http\Controllers';

// dashboard Routes
Route::get('/', $controller_path. '\Auth\LoginController@showLoginForm')->name('login-view')->middleware('guest');
Route::post('/login', $controller_path. '\Auth\LoginController@actionlogin')->name('login');

Route::middleware(['auth'])->group(function () {
    $controller_path = 'App\Http\Controllers';
    
    
    Route::get('/logout', $controller_path . '\Auth\LoginController@actionlogout')->name('logout-action');

    // Route::get('/', $controller_path. '\Beranda\Beranda@index')->name('beranda');
    Route::get('/beranda', $controller_path. '\Beranda\Beranda@index')->name('beranda');

    //dokumen
    Route::get('/dokumen-selesai', $controller_path. '\Dokumen\View@dokumen_selesai')->name('dokumen-selesai');
    Route::get('/daftar-dokumen', $controller_path. '\Dokumen\View@daftar')->name('daftar-dok');
    Route::get('/daftar-bapl', $controller_path. '\Dokumen\View@daftar_bapl')->name('daftar-bapl');
    Route::get('/daftar-bak', $controller_path. '\Dokumen\View@daftar_bak')->name('daftar-bak');
    Route::get('/submit-dokumen', $controller_path. '\Dokumen\View@submit_dokumen')->name('submit-dok');
    Route::get('/ambil-dokumen/{id}', $controller_path. '\Dokumen\View@ambil_dokumen')->name('ambil-dok');

    //transaksi dokumen
    Route::post('/store-dokumen', $controller_path. '\Dokumen\Transaction@store')->name('store-dok');
    Route::post('/store-kl', $controller_path. '\Dokumen\Transaction@store_kl')->name('store-kl');
    Route::post('/store-ambil/{id}', $controller_path. '\Dokumen\Transaction@store_ambil')->name('store-ambil');

    //surat
    Route::get('/req-nomor', $controller_path. '\Surat\Index@request')->name('req-nomor');
    Route::post('/store-bapla', $controller_path. '\Surat\Index@store_bapla')->name('store-bapla');
    Route::post('/store-lainnya', $controller_path. '\Surat\Index@store_lainnya')->name('store-lainnya');
    Route::get('/inbox-nomor', $controller_path. '\Surat\Index@inbox')->name('inbox-nomor');
    Route::get('/generate-nomor/{id}', $controller_path. '\Surat\Index@generate')->name('generate-nomor');

    //status dokumen
    Route::get('/update-received/{id}', $controller_path. '\Dokumen\Status@received')->name('update-received');
    Route::get('/update-proses_manager/{id}', $controller_path. '\Dokumen\Status@proses_manager')->name('update-proses_manager');
    Route::get('/update-done-ttd-manager/{id}', $controller_path. '\Dokumen\Status@done_ttd_manager')->name('update-done_ttd_manager');
    Route::get('/update-done_paraf_manager/{id}', $controller_path. '\Dokumen\Status@done_paraf_manager')->name('update-done_paraf_manager');
    Route::get('/update-received_sm/{id}', $controller_path. '\Dokumen\Status@received_sm')->name('update-received_sm');
    Route::get('/update-proses_sm/{id}', $controller_path. '\Dokumen\Status@proses_sm')->name('update-proses_sm');
    Route::get('/update-done_sm/{id}', $controller_path. '\Dokumen\Status@done_sm')->name('update-done_sm');
});


Route::group(['prefix' => 'dashboard'], function () {
    Route::get('ecommerce', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
    Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
});

//Application Routes
Route::group(['prefix' => 'app'], function () {
    Route::get('email', [ApplicationController::class, 'emailApplication'])->name('app-email');
    Route::get('chat', [ApplicationController::class, 'chatApplication'])->name('app-chat');
    Route::get('todo', [ApplicationController::class, 'todoApplication'])->name('app-todo');
    Route::get('calendar', [ApplicationController::class, 'calendarApplication'])->name('app-calendar');
    Route::get('kanban', [ApplicationController::class, 'kanbanApplication'])->name('app-kanban');
    Route::get('invoice/view', [ApplicationController::class, 'invoiceApplication'])->name('app-invoice-view');
    Route::get('invoice/list', [ApplicationController::class, 'invoiceListApplication'])->name('app-invoice-list');
    Route::get('invoice/edit', [ApplicationController::class, 'invoiceEditApplication'])->name('app-invoice-edit');
    Route::get('invoice/add', [ApplicationController::class, 'invoiceAddApplication'])->name('app-invoice-add');
    Route::get('file-manager', [ApplicationController::class, 'fileManagerApplication'])->name('app-file-manager');
    // User Route
    Route::get('users/list', [UsersController::class, 'listUser'])->name('app-users-list');
    Route::get('users/view', [UsersController::class, 'viewUser'])->name('app-users-view');
    Route::get('users/edit', [UsersController::class, 'editUser'])->name('app-users-edit');
});

// Content Page Routes
Route::group(['prefix' => 'content'], function () {
    Route::get('grid', [ContentController::class, 'gridContent'])->name('content-grid');
    Route::get('typography', [ContentController::class, 'typographyContent'])->name('content-typography');
    Route::get('text-utilities', [ContentController::class, 'textUtilitiesContent'])->name('content-text-utilities');
    Route::get('syntax-highlighter', [ContentController::class, 'contentSyntaxHighlighter'])->name('content-syntax-highlighter');
    Route::get('helper-classes', [ContentController::class, 'contentHelperClasses'])->name('content-helper-classes');
    Route::get('colors', [ContentController::class, 'colorContent'])->name('content-colors');
});

// icons
Route::group(['prefix' => 'icons'], function () {
    Route::get('livicons', [IconsController::class, 'liveIcons'])->name('icons-livicons');
    Route::get('boxicons', [IconsController::class, 'boxIcons'])->name('icons-boxicons');
});

// card
Route::group(['prefix' => 'card'], function () {
    Route::get('basic', [CardController::class, 'basicCard'])->name('card-basic');
    Route::get('actions', [CardController::class, 'actionCard'])->name('card-actions');
    Route::get('widgets', [CardController::class, 'widgets'])->name('card-widgets');
});


// component route
Route::group(['prefix' => 'component'], function () {
    Route::get('alerts', [ComponentController::class, 'alertComponenet'])->name('component-alerts');
    Route::get('buttons-basic', [ComponentController::class, 'buttonComponenet'])->name('component-buttons-basic');
    Route::get('breadcrumbs', [ComponentController::class, 'breadcrumbsComponenet'])->name('component-breadcrumbs');
    Route::get('carousel', [ComponentController::class, 'carouselComponenet'])->name('component-carousel');
    Route::get('collapse', [ComponentController::class, 'collapseComponenet'])->name('component-collapse');
    Route::get('dropdowns', [ComponentController::class, 'dropdownComponenet'])->name('component-dropdowns');
    Route::get('list-group', [ComponentController::class, 'listGroupComponenet'])->name('component-list-group');
    Route::get('modals', [ComponentController::class, 'modalComponenet'])->name('component-modals');
    Route::get('pagination', [ComponentController::class, 'paginationComponenet'])->name('component-pagination');
    Route::get('navbar', [ComponentController::class, 'navbarComponenet'])->name('component-navbar');
    Route::get('tabs-component', [ComponentController::class, 'tabsComponenet'])->name('component-tabs-component');
    Route::get('pills-component', [ComponentController::class, 'pillComponenet'])->name('component-pills-component');
    Route::get('tooltips', [ComponentController::class, 'tooltipsComponenet'])->name('component-tooltips');
    Route::get('popovers', [ComponentController::class, 'popoversComponenet'])->name('component-popovers');
    Route::get('badges', [ComponentController::class, 'badgesComponenet'])->name('component-badges');
    Route::get('pill-badges', [ComponentController::class, 'pillBadgesComponenet'])->name('component-pill-badges');
    Route::get('progress', [ComponentController::class, 'progressComponenet'])->name('component-progress');
    Route::get('media-objects', [ComponentController::class, 'mediaObjectComponenet'])->name('component-media-objects');
    Route::get('spinner', [ComponentController::class, 'spinnerComponenet'])->name('component-spinner');
    Route::get('bs-toast', [ComponentController::class, 'toastsComponenet'])->name('component-bs-toast');
});

// extra component
Route::group(['prefix' => 'extra-component'], function () {
    Route::get('avatar', [ExComponentController::class, 'avatarComponent'])->name('extra-component-avatar');
    Route::get('chips', [ExComponentController::class, 'chipsComponent'])->name('extra-component-chips');
    Route::get('divider', [ExComponentController::class, 'dividerComponent'])->name('extra-component-divider');
});

// form elements
Route::group(['prefix' => 'form'], function () {
    Route::get('inputs', [FormController::class, 'inputForm'])->name('form-inputs');
    Route::get('input-groups', [FormController::class, 'inputGroupForm'])->name('form-input-groups');
    Route::get('number-input', [FormController::class, 'numberInputForm'])->name('form-number-input');
    Route::get('select', [FormController::class, 'selectForm'])->name('form-select');
    Route::get('radio', [FormController::class, 'radioForm'])->name('form-radio');
    Route::get('checkbox', [FormController::class, 'checkboxForm'])->name('form-checkbox');
    Route::get('switch', [FormController::class, 'switchForm'])->name('form-switch');
    Route::get('textarea', [FormController::class, 'textareaForm'])->name('form-textarea');
    Route::get('quill-editor', [FormController::class, 'quillEditorForm'])->name('form-quill-editor');
    Route::get('file-uploader', [FormController::class, 'fileUploaderForm'])->name('form-file-uploader');
    Route::get('date-time-picker', [FormController::class, 'datePickerForm'])->name('form-date-time-picker');
    Route::get('layout', [FormController::class, 'formLayout'])->name('form-layout');
    Route::get('wizard', [FormController::class, 'formWizard'])->name('form-wizard');
    Route::get('validation', [FormController::class, 'formValidation'])->name('form-validation');
    Route::get('repeater', [FormController::class, 'formRepeater'])->name('form-repeater');
});

// table route
Route::group(['prefix' => 'table'], function () {
    Route::get('', [TableController::class, 'basicTable'])->name('table');
    Route::get('extended', [TableController::class, 'extendedTable'])->name('table-extended');
    Route::get('datatable', [TableController::class, 'dataTable'])->name('table-datatable');
});

// page Route
Route::group(['prefix' => 'page'], function () {
    Route::get('user/profile', [PageController::class, 'userProfilePage'])->name('page-user-profile');
    Route::get('faq', [PageController::class, 'faqPage'])->name('page-faq');
    Route::get('knowledge-base', [PageController::class, 'knowledgeBasePage'])->name('page-knowledge-base');
    Route::get('knowledge-base/categories', [PageController::class, 'knowledgeCatPage'])->name('page-knowledge-base');
    Route::get('knowledge-base/categories/question', [PageController::class, 'knowledgeQuestionPage'])->name('page-knowledge-base');
    Route::get('search', [PageController::class, 'searchPage'])->name('page-search');
    Route::get('account-settings', [PageController::class, 'accountSettingPage'])->name('page-account-settings');
});

// Authentication  Route
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthenticationController::class, 'loginPage'])->name('auth-login');
    Route::get('register', [AuthenticationController::class, 'registerPage'])->name('auth-register');
    Route::get('forgot-password', [AuthenticationController::class, 'forgetPasswordPage'])->name('auth-forgot-password');
    Route::get('reset-password', [AuthenticationController::class, 'resetPasswordPage'])->name('auth-reset-password');
    Route::get('lock-screen', [AuthenticationController::class, 'authLockPage'])->name('auth-lock-screen');
});

// Miscellaneous
Route::group(['prefix' => 'misc'], function () {
    Route::get('coming-soon', [MiscellaneousController::class, 'comingSoonPage'])->name('misc-coming-soon');
    Route::get('error-404', [MiscellaneousController::class, 'error404Page'])->name('misc-error-404');
    Route::get('error-500', [MiscellaneousController::class, 'error500Page'])->name('misc-error-500');
    Route::get('not-authorized', [MiscellaneousController::class, 'notAuthPage'])->name('misc-not-authorized');
    Route::get('maintenance', [MiscellaneousController::class, 'maintenancePage'])->name('misc-maintenance');
});

// Charts Route
Route::group(['prefix' => 'chart'], function () {
    Route::get('apex', [ChartController::class, 'apexChart'])->name('chart-apex');
    Route::get('chartjs', [ChartController::class, 'chartJs'])->name('chart-chartjs');
    Route::get('chartist', [ChartController::class, 'chartist'])->name('chart-chartist');
});

Route::get('maps/leaflet', [ChartController::class, 'leafletMap'])->name('maps-leaflet');

// extension route
Route::group(['prefix' => 'extension'], function () {
    Route::get('sweet-alerts', [ExtensionsController::class, 'sweetAlert'])->name('extension-sweet-alerts');
    Route::get('toastr', [ExtensionsController::class, 'toastr'])->name('extension-toastr');
    Route::get('noui-slider', [ExtensionsController::class, 'noUiSlider'])->name('extension-noui-slider');
    Route::get('drag-drop', [ExtensionsController::class, 'dragComponent'])->name('extension-drag-drop');
    Route::get('tour', [ExtensionsController::class, 'tourComponent'])->name('extension-tour');
    Route::get('swiper', [ExtensionsController::class, 'swiperComponent'])->name('extension-swiper');
    Route::get('treeview', [ExtensionsController::class, 'treeviewComponent'])->name('extension-treeview');
    Route::get('block-ui', [ExtensionsController::class, 'blockUIComponent'])->name('extension-block-ui');
    Route::get('media-player', [ExtensionsController::class, 'mediaComponent'])->name('extension-media-player');
    Route::get('miscellaneous', [ExtensionsController::class, 'miscellaneous'])->name('extension-miscellaneous');
    Route::get('locale', [ExtensionsController::class, 'locale'])->name('extension-locale');
    Route::get('ratings', [ExtensionsController::class, 'ratings'])->name('extension-ratings');
});

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('lang-locale');
