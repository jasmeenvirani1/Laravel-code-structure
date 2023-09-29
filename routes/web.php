<?php

use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\QuestionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\backend\EmailConfigurationController;
use App\Http\Controllers\backend\FavouriteController;
use App\Http\Controllers\backend\FitnessGoalController;
use App\Http\Controllers\backend\KeywordController;
use App\Http\Controllers\backend\ServiceController;
use App\Http\Controllers\backend\SubscriptionController;
use App\Http\Controllers\backend\UsersController;
use App\Http\Controllers\backend\ManagePagesController;
use App\Http\Controllers\backend\MatchesController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\UserSettingController;
use App\Http\Controllers\backend\WorkoutController;
use App\Http\Controllers\NotificationSendController;

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

Route::get('/show-session', [LoginController::class, 'Show']);

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return redirect()->route('login');
    // return what you want
});

Route::get('refresh-csrf', function () {
    return csrf_token();
});

Route::get('/', function () {
    $arr['site_title'] = 'Slim | Home page';
    return view('admin.index', array_merge($arr));
})->name('dashbord')->middleware('checkpermission:dashbord');

Route::get('/backend/dashboard', [HomeController::class, 'Index'])->name('user.home')->middleware('UserSession');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout')->middleware('UserSession');

Route::prefix('backend/users')
    ->middleware('UserSession')
    ->middleware('checkpermission:users')
    ->group(function () {
        Route::get('/', [UsersController::class, 'Index'])->name('list.users');
        Route::post('featch', [UsersController::class, 'FetchUsers'])->name('admin.user.fetch');
        Route::post('store', [UsersController::class, 'Store'])->name('admin.user.store');
        Route::post('delete', [UsersController::class, 'Delete'])->name('admin.user.delete');
        Route::post('change_status', [UsersController::class, 'ChangeStatus'])->name('admin.user.change_status');
    });

Route::prefix('backend/users')
    ->middleware('UserSession')
    ->group(function () {
        Route::post('update', [UsersController::class, 'UpdateProvider'])->name('admin.provider.update');
        Route::post('update-seeker', [UsersController::class, 'UpdateSeeker'])->name('admin.seeker.update');
        Route::get('edit/{id?}', [UsersController::class, 'Edit'])->name('admin.user.edit');
        Route::post('get_certificate', [UsersController::class, 'GetCertificate'])->name('admin.user.get_certificate');
        Route::post('delete_certificate', [UsersController::class, 'DeleteCertificate'])->name('admin.user.delete_certificate');
        Route::post('upload-profilePictuer', [UsersController::class, 'UploadProfilePictuer'])->name('admin.user.uploadProfilePictuer');
        Route::post('upload-provider-video', [UsersController::class, 'UploadProviderVideo'])->name('admin.user.upload-provider-video');
    });

Route::prefix('backend/question')
    ->middleware('UserSession')
    ->middleware('checkpermission:question')
    ->group(function () {
        Route::get('/', [QuestionController::class, 'Index'])->name('list.question');
        Route::get('featch', [QuestionController::class, 'FetchQuestion'])->name('admin.question.fetch');
        Route::post('store', [QuestionController::class, 'Store'])->name('admin.question.store');
        Route::post('edit', [QuestionController::class, 'Edit'])->name('admin.question.edit');
        Route::post('update', [QuestionController::class, 'Update'])->name('admin.question.update');
        Route::post('delete', [QuestionController::class, 'Delete'])->name('admin.question.delete');
        Route::post('change_status', [QuestionController::class, 'ChangeStatus'])->name('admin.question.change_status');
        Route::get('get-option', [QuestionController::class, 'GetOption'])->name('option.fetch');
        Route::post('store-option', [QuestionController::class, 'StoreOption'])->name('option.store');
        Route::post('delete-option', [QuestionController::class, 'DeleteOption'])->name('option.delete');
    });


Route::prefix('backend/service')
    ->middleware('UserSession')
    ->middleware('checkpermission:service')
    ->group(function () {
        Route::get('/', [ServiceController::class, 'Index'])->name('list.service');
        Route::get('featch', [ServiceController::class, 'FetchQuestion'])->name('admin.service.fetch');
        Route::post('store', [ServiceController::class, 'Store'])->name('admin.service.store');
        Route::post('edit', [ServiceController::class, 'Edit'])->name('admin.service.edit');
        Route::post('update', [ServiceController::class, 'Update'])->name('admin.service.update');
        Route::post('delete', [ServiceController::class, 'Delete'])->name('admin.service.delete');
        Route::post('change_status', [ServiceController::class, 'ChangeStatus'])->name('admin.service.change_status');
    });

Route::prefix('backend/subscription')
    ->middleware('UserSession')
    ->middleware('checkpermission:subscription')
    ->group(function () {
        Route::get('/', [SubscriptionController::class, 'Index'])->name('list.subscription');
        Route::get('featch', [SubscriptionController::class, 'FetchSubscription'])->name('admin.subscription.fetch');
        Route::post('store', [SubscriptionController::class, 'Store'])->name('admin.subscription.store');
        Route::post('edit', [SubscriptionController::class, 'Edit'])->name('admin.subscription.edit');
        Route::post('update', [SubscriptionController::class, 'Update'])->name('admin.subscription.update');
        Route::post('delete', [SubscriptionController::class, 'Delete'])->name('admin.subscription.delete');
        Route::post('change_status', [SubscriptionController::class, 'ChangeStatus'])->name('admin.subscription.change_status');
    });

Route::prefix('backend/manage-page')
    ->middleware('UserSession')
    ->middleware('checkpermission:manage-page')
    ->group(function () {

        Route::get('/', [ManagePagesController::class, 'Index'])->name('list.manage-page');
        Route::get('featch', [ManagePagesController::class, 'FetchManagePage'])->name('admin.manage-page.fetch');
        Route::post('store', [ManagePagesController::class, 'Store'])->name('admin.manage-page.store');
        Route::post('edit', [ManagePagesController::class, 'Edit'])->name('admin.manage-page.edit');
        Route::post('update', [ManagePagesController::class, 'Update'])->name('admin.manage-page.update');
        Route::post('delete', [ManagePagesController::class, 'Delete'])->name('admin.manage-page.delete');
        Route::post('change_status', [ManagePagesController::class, 'ChangeStatus'])->name('admin.manage-page.change_status');
    });

Route::prefix('backend/favourite')
    ->middleware('UserSession')
    ->middleware('checkpermission:favourite')
    ->group(function () {
        Route::get('/', [FavouriteController::class, 'Index'])->name('list.favourite');
        Route::get('featch', [FavouriteController::class, 'FetchFavourite'])->name('admin.favourite.fetch');
        Route::post('delete', [FavouriteController::class, 'Delete'])->name('admin.favourite.delete');
        Route::post('clear-all-provider', [FavouriteController::class, 'ClearAllFavourite'])->name('admin.clear.all-favourite');
    });

Route::prefix('backend/keyword')
    ->middleware('UserSession')
    ->middleware('checkpermission:keyword')
    ->group(function () {
        Route::get('/', [KeywordController::class, 'Index'])->name('list.keyword');
        Route::get('featch', [KeywordController::class, 'FetchKeyword'])->name('admin.keyword.fetch');
        Route::post('store', [keywordController::class, 'Store'])->name('admin.keyword.store');
        Route::post('edit', [keywordController::class, 'Edit'])->name('admin.keyword.edit');
        Route::post('update', [keywordController::class, 'Update'])->name('admin.keyword.update');
        Route::post('delete', [keywordController::class, 'Delete'])->name('admin.keyword.delete');
        Route::post('change_status', [KeywordController::class, 'ChangeStatus'])->name('admin.keyword.change_status');
    });

Route::prefix('backend/permission')
    ->middleware('UserSession')
    ->middleware('checkpermission:permission')
    ->group(function () {
        Route::get('/', [PermissionController::class, 'Index'])->name('list.permission');
        Route::get('featch', [PermissionController::class, 'FetchPermission'])->name('admin.permission.fetch');
        Route::post('store', [PermissionController::class, 'Store'])->name('admin.permission.store');
        Route::post('edit', [PermissionController::class, 'Edit'])->name('admin.permission.edit');
        Route::post('update', [PermissionController::class, 'Update'])->name('admin.permission.update');
        Route::post('delete', [PermissionController::class, 'Delete'])->name('admin.permission.delete');
        Route::post('change_status', [PermissionController::class, 'ChangeStatus'])->name('admin.permission.change_status');
    });


Route::prefix('backend/setting')
    ->middleware('UserSession')
    ->middleware('checkpermission:setting')
    ->group(function () {
        Route::get('/', [SettingController::class, 'Index'])->name('list.setting');
        Route::get('featch', [SettingController::class, 'Fetchsetting'])->name('admin.setting.fetch');
        Route::post('edit', [SettingController::class, 'Edit'])->name('admin.setting.edit');
        Route::post('update', [SettingController::class, 'Update'])->name('admin.setting.update');
    });

Route::prefix('backend/email-configuration')
    ->middleware('UserSession')
    ->middleware('checkpermission:email-configuration')
    ->group(function () {
        Route::get('/', [EmailConfigurationController::class, 'Index'])->name('list.email-configuration');
        Route::post('update', [EmailConfigurationController::class, 'Update'])->name('admin.email-configuration.update');
    });


Route::prefix('backend/user-setting')
    ->middleware('UserSession')
    // ->middleware('checkpermission:user-setting')
    ->group(function () {
        Route::get('/', [UserSettingController::class, 'Index'])->name('list.user.setting');
        Route::post('update-user', [UserSettingController::class, 'UpdateUser'])->name('user.setting.update');
        Route::post('update-privacy', [UserSettingController::class, 'UpdatePrivacy'])->name('user.privacy.update');
        Route::post('update-notification', [UserSettingController::class, 'UpdateNotification'])->name('user.notification.update');
        Route::post('update-security', [UserSettingController::class, 'UpdateSecurity'])->name('user.security.update');
        Route::post('update-billing', [UserSettingController::class, 'UpdateBilling'])->name('user.billing.update');
    });

Route::prefix('backend/matches')
    ->middleware('UserSession')
    ->middleware('checkpermission:matches')
    ->group(function () {
        Route::get('/', [MatchesController::class, 'Index'])->name('list.user.matches');
        Route::post('clear-recent-all', [MatchesController::class, 'ClearRecentall'])->name('admin.clear.recent-all');
        Route::post('clear-all', [MatchesController::class, 'ClearAll'])->name('admin.clear-all');
    });

Route::prefix('backend/workout')
    ->middleware('UserSession')
    ->middleware('checkpermission:workout')
    ->group(function () {
        Route::get('/', [WorkoutController::class, 'Index'])->name('list.workout');
        Route::get('featch', [WorkoutController::class, 'FetchWorkoutCategory'])->name('admin.workout.fetch');
        Route::post('store', [WorkoutController::class, 'Store'])->name('admin.workout.store');
        Route::post('edit', [WorkoutController::class, 'Edit'])->name('admin.workout.edit');
        Route::post('update', [WorkoutController::class, 'Update'])->name('admin.workout.update');
        Route::post('delete', [WorkoutController::class, 'Delete'])->name('admin.workout.delete');
        Route::post('change_status', [WorkoutController::class, 'ChangeStatus'])->name('admin.workout.change_status');
        Route::get('get-sub-workout', [WorkoutController::class, 'GetSubWorkout'])->name('admin.workout-sub.fetch');
        Route::post('store-sub-workout', [WorkoutController::class, 'StoreSubWorkout'])->name('admin.workout-sub.store');
        Route::post('delete-sub-workout', [WorkoutController::class, 'DeleteSubWorkout'])->name('admin.workout-sub.delete');
    });

Route::prefix('backend/fitness-goal')
    ->middleware('UserSession')
    ->middleware('checkpermission:fitness-goal')
    ->group(function () {
        Route::get('/', [FitnessGoalController::class, 'Index'])->name('list.fitness-goal');
        Route::get('featch', [FitnessGoalController::class, 'FetchFitnessGoal'])->name('admin.fitness-goal.fetch');
        Route::post('store', [FitnessGoalController::class, 'Store'])->name('admin.fitness-goal.store');
        Route::post('edit', [FitnessGoalController::class, 'Edit'])->name('admin.fitness-goal.edit');
        Route::post('update', [FitnessGoalController::class, 'Update'])->name('admin.fitness-goal.update');
        Route::post('delete', [FitnessGoalController::class, 'Delete'])->name('admin.fitness-goal.delete');
        Route::post('change_status', [FitnessGoalController::class, 'ChangeStatus'])->name('admin.fitness-goal.change_status');
    });

Route::post('token-store', [NotificationSendController::class, 'updateDeviceToken'])->name('store.token')->middleware('UserSession');
require __DIR__ . '/front.php';
