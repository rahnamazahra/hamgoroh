<?php

use App\Exports\ExportUsers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StepController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ScoreController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ChallengeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TechniqueController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\CompetitionController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\TestQuestionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Admin Panel
Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'adminIndex')->name('admin.dashboard');
    Route::get('/general-dashboard', 'generalIndex')->name('admin.dashboard.general');
    Route::get('/provincial-dashboard', 'provincialIndex')->name('admin.dashboard.provincial');
    Route::post('/charts/chartNumberUsersProvince', 'chartNumberUsersProvince')->name('charts.chartNumberUsersProvince');
});

// Roles
Route::controller(RoleController::class)->group(function () {
    Route::get('/roles', 'index')->name('admin.roles.index');
    Route::get('/roles/create', 'create')->name('admin.roles.create');
    Route::post('/roles', 'store')->name('admin.roles.store');
    Route::get('/roles/{role}/edit', 'edit')->name('admin.roles.edit');
    Route::patch('/roles/{role}', 'update')->name('admin.roles.update');
    Route::delete('/roles/{role}/delete', 'delete')->name('admin.roles.delete');
});

// Permissions
Route::controller(PermissionController::class)->group(function () {
    Route::get('/permissions', 'index')->name('admin.permissions.index');
    Route::get('/permissions/create', 'create')->name('admin.permissions.create');
    Route::post('/permissions', 'store')->name('admin.permissions.store');
    Route::get('/permissions/{permission}/edit', 'edit')->name('admin.permissions.edit');
    Route::patch('/permissions/{permission}', 'update')->name('admin.permissions.update');
    Route::delete('/permissions/{permission}/delete', 'delete')->name('admin.permissions.delete');
});

// Users
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('admin.users.index');
    Route::get('/users/create', 'create')->name('admin.users.create');
    Route::post('/users', 'store')->name('admin.users.store');
    Route::get('/users/{user}/edit', 'edit')->name('admin.users.edit');
    Route::patch('/users/{user}', 'update')->name('admin.users.update');
    Route::delete('/users/{user}/delete', 'delete')->name('admin.users.delete');
    Route::get('/users/exportUsers', 'exportUsers')->name('admin.users.exporUsers');
});

// Provinces
Route::controller(ProvinceController::class)->group(function () {
    Route::get('/provinces', 'index')->name('admin.provinces.index');
    Route::post('/provinces', 'store')->name('admin.provinces.store');
    Route::patch('/provinces/{province}', 'update')->name('admin.provinces.update');
    Route::delete('/provinces/{province}/delete', 'delete')->name('admin.provinces.delete');
});

// Cities
Route::controller(CityController::class)->group(function () {
    Route::get('/cities', 'index')->name('admin.cities.index');
    Route::post('/cities', 'store')->name('admin.cities.store');
    Route::patch('/cities/{city}', 'update')->name('admin.cities.update');
    Route::delete('/cities/{city}/delete', 'delete')->name('admin.cities.delete');
});

// Fields
Route::controller(FieldController::class)->group(function () {
    Route::get('/fields', 'index')->name('admin.fields.index');
    Route::get('/fields/create', 'create')->name('admin.fields.create');
    Route::post('/fields', 'store')->name('admin.fields.store');
    Route::get('/fields/{field}/edit', 'edit')->name('admin.fields.edit');
    Route::patch('/fields/{field}', 'update')->name('admin.fields.update');
    Route::delete('/fields/{field}/delete', 'delete')->name('admin.fields.delete');
});

// Competitions
Route::controller(CompetitionController::class)->group(function () {
    Route::get('/competitions', 'index')->name('admin.competitions.index');
    Route::get('/competitions/store', 'store')->name('admin.competitions.create');
    Route::post('/competitions', 'store')->name('admin.competitions.store');
    Route::get('/competitions/{competition}/show', 'show')->name('admin.competitions.show');
    Route::get('/competitions/{competition}/edit', 'edit')->name('admin.competitions.edit');
    Route::patch('/competitions/{competition}', 'update')->name('admin.competitions.update');
    Route::delete('/competitions/{competition}/delete', 'delete')->name('admin.competitions.delete');
    Route::get('/competitions/{competition}/charts', 'charts')->name('admin.competitions.charts');
    Route::get('/competitions/{competition}/results', 'result')->name('admin.competitions.result');

});

// Groups
Route::controller(GroupController::class)->group(function () {
    Route::get('/groups', 'index')->name('admin.groups.index');
    Route::get('/competition/{competition}/groups/create', 'create')->name('admin.groups.create');
    Route::post('/competition/{competition}/groups', 'store')->name('admin.groups.store');
    Route::patch('/competition/{competition}/groups', 'update')->name('admin.groups.update');
});

// Challenges
Route::controller(ChallengeController::class)->group(function () {
    Route::get('/competition/{competition}/challenges/create', 'create')->name('admin.challenges.create');
    Route::post('/competition/{competition}/challenges/store', 'store')->name('admin.challenges.store');
    Route::get('/competition/{competition}/challenges/edit', 'edit')->name('admin.challenges.edit');
    Route::patch('/competition/{competition}/challenges/update', 'update')->name('admin.challenges.update');
    Route::delete('/competition/{competition}/challenges/{challenge}/delete', 'delete')->name('admin.challenges.delete');
    Route::get('/competition/{competition}/challenge/{challenge}/info/create', 'createInfo')->name('admin.challenges.info.create');
    Route::post('/competition/{competition}/challenge/{challenge}/info/store', 'storeInfo')->name('admin.challenges.info.store');
    Route::get('/competition/{competition}/challenge/{challenge}/schedule/create', 'createSchedule')->name('admin.challenges.schedule.create');
    Route::post('/competition/challenge/{challenge}/schedule/store', 'StoreSchedule')->name('admin.challenges.schedule.store');
    Route::delete('/challenges/{challenge}/results', 'result')->name('admin.challenges.result');
});

// steps
Route::controller(StepController::class)->group(function () {
    Route::get('/competition/{competition}/steps/create', 'create')->name('admin.steps.create');
    Route::post('/competition/{competition}/steps/store', 'store')->name('admin.steps.store');
    Route::get('/competition/{competition}/steps/edit', 'edit')->name('admin.steps.edit');
    Route::patch('/competition/{competition}/steps/update', 'update')->name('admin.steps.update');
    Route::get('/steps/{step}/results', 'result')->name('admin.steps.result');
});

// Techniques
Route::controller(TechniqueController::class)->group(function () {
    Route::get('/challenge/{challenge}/techniques/', 'index')->name('admin.techniques.index');
    Route::get('/challenge/{challenge}/techniques/create', 'create')->name('admin.techniques.create');
    Route::post('/challenge/{challenge}/techniques/store', 'store')->name('admin.techniques.store');
    Route::get('/challenge/{challenge}/techniques/{technique}/edit', 'edit')->name('admin.techniques.edit');
    Route::patch('/challenge/{challenge}/techniques/{technique}/update', 'update')->name('admin.techniques.update');
    Route::delete('/techniques/{technique}/delete', 'delete')->name('admin.techniques.delete');
});

//Evaluations
Route::controller(EvaluationController::class)->group(function () {
    Route::get('/step/{step}/evaluations', 'index')->name('admin.evaluations.index');
    Route::get('/step/{step}/evaluations/create', 'create')->name('admin.evaluations.create');
    Route::post('/step/{step}/evaluations/store', 'store')->name('admin.evaluations.store');
    Route::get('/step/{step}evaluations/{evaluation}//edit', 'edit')->name('admin.evaluations.edit');
    Route::patch('/step/{step}/evaluations/{evaluation}/update', 'update')->name('admin.evaluations.update');
    Route::delete('/evaluations/{evaluation}/delete', 'delete')->name('admin.evaluations.delete');

});

// News
Route::controller(NewsController::class)->group(function () {
    Route::get('/news', 'index')->name('admin.news.index');
    Route::get('/news/create', 'create')->name('admin.news.create');
    Route::post('/news', 'store')->name('admin.news.store');
    Route::get('/news/{news}/show', 'show')->name('admin.news.show');
    Route::get('/news/{news}/edit', 'edit')->name('admin.news.edit');
    Route::patch('/news/{news}', 'update')->name('admin.news.update');
    Route::delete('/news/{news}/delete', 'delete')->name('admin.news.delete');
});

// Category News
Route::controller(NewsCategoryController::class)->group(function () {
    Route::get('/newsCategories', 'index')->name('admin.newsCategories.index');
    Route::get('/newsCategories/create', 'create')->name('admin.newsCategories.create');
    Route::post('/newsCategories', 'store')->name('admin.newsCategories.store');
    Route::get('/newsCategories/{newsCategory}/edit', 'edit')->name('admin.newsCategories.edit');
    Route::patch('/newsCategories/{newsCategory}', 'update')->name('admin.newsCategories.update');
    Route::delete('/newsCategories/{newsCategory}/delete', 'delete')->name('admin.newsCategories.delete');
});

// About us
Route::controller(AboutController::class)->group(function () {
    Route::get('/abouts', 'index')->name('admin.abouts.index');
    Route::post('/abouts', 'store')->name('admin.abouts.store');
    Route::patch('/abouts/{about}', 'update')->name('admin.abouts.update');
});

//Contacts
Route::controller(ContactController::class)->group(function () {
    Route::get('/contacts', 'index')->name('admin.contacts.index');
    Route::post('/contacts', 'store')->name('admin.contacts.store');
    Route::patch('/contacts/{contact}', 'update')->name('admin.contacts.update');
});

// Setting
Route::controller(SettingController::class)->group(function () {
    Route::get('/settings', 'index')->name('admin.settings.index');
    Route::post('/settings', 'store')->name('admin.settings.store');
    Route::patch('/settings/{setting}', 'update')->name('admin.settings.update');
});

// Criterias
Route::controller(CriteriaController::class)->group(function () {
    Route::get('/criterias', 'index')->name('admin.criteria.index');
    Route::get('/criterias/create', 'create')->name('admin.criteria.create');
    Route::post('/criterias', 'store')->name('admin.criteria.store');
    Route::get('/criterias/{criteria}/show', 'show')->name('admin.criteria.show');
    Route::get('/criterias/{criteria}/edit', 'edit')->name('admin.criteria.edit');
    Route::patch('/criterias/{criteria}', 'update')->name('admin.criteria.update');
    Route::delete('/criterias/{criteria}/delete', 'delete')->name('admin.criteria.delete');
});

// Tests
Route::controller(TestController::class)->group(function () {
    Route::get('/tests', 'index')->name('admin.tests.index');
    Route::get('/tests/create', 'create')->name('admin.tests.create');
    Route::post('/tests', 'store')->name('admin.tests.store');
    Route::get('/tests/{test}/show', 'show')->name('admin.tests.show');
    Route::get('/tests/{test}/edit', 'edit')->name('admin.tests.edit');
    Route::patch('/tests/{test}', 'update')->name('admin.tests.update');
    Route::delete('/tests/{test}/delete', 'delete')->name('admin.tests.delete');
});

// Test Questions
Route::controller(TestQuestionController::class)->group(function () {
    Route::get('/testQuestions', 'index')->name('admin.testQuestions.index');
    Route::get('/test/{test}/testQuestions/create', 'create')->name('admin.testQuestions.create');
    Route::post('/test/{test}/testQuestions', 'store')->name('admin.testQuestions.store');
    Route::get('/test/{test}/testQuestions/{testQuestion}/show', 'show')->name('admin.testQuestions.show');
    Route::get('/test/{test}/testQuestions/{testQuestion}/edit', 'edit')->name('admin.testQuestions.edit');
    Route::patch('/test/{test}/testQuestions/{testQuestion}', 'update')->name('admin.testQuestions.update');
    Route::delete('/testQuestions/{testQuestion}/delete', 'delete')->name('admin.testQuestions.delete');
});

// Notices
Route::controller(NoticeController::class)->group(function () {
    Route::get('/notices', 'index')->name('admin.notices.index');
    Route::get('/notices/create', 'create')->name('admin.notices.create');
    Route::post('/notices', 'store')->name('admin.notices.store');
    Route::get('/notices/{notice}/show', 'show')->name('admin.notices.show');
    Route::get('/notices/{notice}/edit', 'edit')->name('admin.notices.edit');
    Route::patch('/notices/{notice}', 'update')->name('admin.notices.update');
    Route::delete('/notices/{notice}/delete', 'delete')->name('admin.notices.delete');
});

// Ajax
Route::controller(AjaxController::class)->group(function () {
    Route::post('/province/cities', 'showCitiesByProvince')->name('admin.ajax.cities');
    Route::post('/referees', 'showReferees')->name('admin.ajax.referees');
    Route::post('/generals', 'showGenerals')->name('admin.ajax.generals');
    Route::post('/provincials', 'showProvincials')->name('admin.ajax.provincials');
});

// Step Schedules
Route::controller(ScheduleController::class)->group(function () {
    Route::get('/steps/{step}/schedules', 'index')->name('admin.schedules.index');
    Route::get('/step/{step}/schedules/create', 'create')->name('admin.schedules.create');
    Route::post('/step/{step}/schedules/store', 'store')->name('admin.schedules.store');
    Route::get('/step/{step}/schedules/{schedule}/edit', 'edit')->name('admin.schedules.edit');
    Route::patch('/step/{step}/schedules/{schedule}/update', 'update')->name('admin.schedules.update');
    Route::delete('/schedules/{schedule}/delete', 'delete')->name('admin.schedules.delete');
});

// Scores
Route::controller(ScoreController::class)->group(function () {
    Route::get('/step/{step}/scores', 'index')->name('admin.scores.index');
    Route::get('/step/{step}/scores/create', 'create')->name('admin.scores.create');
    Route::post('/step/{step}/scores', 'store')->name('admin.scores.store');
    Route::get('/step/{step}/scores/{score}/show', 'show')->name('admin.scores.show');
    Route::get('/step/{step}/scores/{score}/edit', 'edit')->name('admin.scores.edit');
    Route::patch('/step/{step}/scores/{score}', 'update')->name('admin.scores.update');
    Route::delete('/step/{step}/scores/{score}/delete', 'delete')->name('admin.scores.delete');
});
