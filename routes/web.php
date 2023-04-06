<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\FCMController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BreadController;
use App\Http\Controllers\Admin\ServerController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SandboxController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ErrorLogController;
use App\Http\Controllers\Admin\FacebookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Shoppee\ProductController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Shoppee\FirebaseController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\FilemanagerController;
use App\Http\Controllers\Admin\ImpersonateController;
use App\Http\Controllers\Admin\MailTemplateController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Shoppee\DashboardController as ShoppeeDashboardController;

Route::get('/mail', function(){

    $to = 'amitvishwa19@gmail.com';
    $subject = 'Test Mail Subject with job mail';
    $body = 'test body';
    $data = 'test data';
    $view = 'mails.subscription';

    return appmail($to,$subject,$body,$data,$view,true);

});

Route::prefix('/')->group(base_path('routes/client.php'));

Route::middleware(['auth'])->prefix('admin')->group(base_path('routes/admin.php'));

Route::middleware(['auth'])->prefix('shoppee')->as('shoppee.')->group(base_path('routes/shoppee.php'));

Route::middleware(['auth','sandbox'])->prefix('sandbox')->group(base_path('routes/sandbox.php'));

//Route::middleware('auth')->prefix('devlearn')->group(base_path('routes/devlearn.php'));

//Route::middleware('auth')->group(base_path('routes/devcomm.php'));


Auth::routes();

// Route::group(['middleware'=>['auth'],'prefix'=>'admin'],function(){

    

// });



