<?php


use App\Http\Controllers\AboutUsController as ControllersAboutUsController;
use App\Http\Controllers\admin\AboutUsController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\RegionController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\GlobalNetworksController;
use App\Http\Controllers\admin\HistoryController;
use App\Http\Controllers\admin\HomeAboutController;
use App\Http\Controllers\admin\HomePropertiesController;
use App\Http\Controllers\admin\IntegratedServiceController;
use App\Http\Controllers\admin\OurTeamController;
use App\Http\Controllers\admin\PropertyController;
use App\Http\Controllers\admin\ServiceConsultantsController;
use App\Http\Controllers\admin\ServiceExlporeController;
use App\Http\Controllers\admin\ServiceInsightController;
use App\Http\Controllers\admin\ServiceSlideController;
use App\Http\Controllers\admin\ServiceValutionController;
use App\Http\Controllers\admin\StoryController;
use App\Http\Controllers\admin\OfficesController;
use App\Http\Controllers\admin\ContactUsController as ControllersContactUsController;
use App\Http\Controllers\admin\GlobalNetworkIntegratedController;
use App\Http\Controllers\admin\ResearchandInsightController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ResearchDetailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\GlobalNetworkController;
use App\Http\Controllers\HistoryController as ControllersHistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ResearchInsightController;
use App\Http\Controllers\admin\CareerDetailController;
use App\Http\Controllers\admin\CareerDetailPageController;
use App\Http\Controllers\PopularCitySearchController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\CareerDetailPageController as ControllersCareerDetailPageController;
use App\Http\Controllers\admin\TimelineController;
use App\Http\Controllers\admin\HistoryDetailController;
use App\Http\Controllers\CareerDetailExploreController;
use App\Http\Controllers\ExpressInterestController;
// use App\Http\Controllers\GlobalNetworkIntegratedController;
use App\Http\Controllers\ServiceMainSlideController;
use App\Http\Controllers\StoryController as ControllersStoryController;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Admin Routes
Route::get('/files/{path}', FilesController::class)->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [UserController::class, 'index'])->name('login');
    Route::post('custom-login', [UserController::class, 'customLogin'])->name('login.custom');
    Route::get('registration', [UserController::class, 'registration'])->name('register-user');
    Route::post('custom-registration', [UserController::class, 'customRegistration'])->name('register.custom');
    Route::get('signout', [UserController::class, 'signOut'])->name('signout');
    Route::get('/forgot-password', [UserController::class, 'forgotPasswordView'])->name('forgotPassword.view');
    Route::post('/forgot-password', [UserController::class, 'forgotPasswordAction'])->name('forgotPassword.action');
    Route::get('reset-password/{id}', [UserController::class, 'resetPasswordView'])->name('resetPassword.view');
    Route::post('/reset-password/create/{id}', [UserController::class, 'createPasswordAction'])->name('resetPassword.action');

    Route::middleware(['auth' , 'role:admin'])->group(function () {

        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('mega-menu-list', [DashboardController::class, 'megaMenu'])->name('mega-menu-list');
        Route::post('add-mega-menu', [DashboardController::class, 'addMegaMenu'])->name('add-mega-menu');
        Route::get('mega-menu-status', [DashboardController::class, 'changeStatus'])->name('megaMenu.status');
       

        Route::get('create-property', [PropertyController::class, 'create'])->name('create-property');
        Route::get('properties-list', [PropertyController::class, 'index'])->name('properties-list');
        Route::get('express-interest-list', [ExpressInterestController::class, 'expInterestList'])->name('express-interest-list');
        Route::get('property-status', [PropertyController::class, 'changeStatus'])->name('property.status');
        Route::get('create-home', [AboutUsController::class, 'home'])->name('create-home');

        Route::resource('home-properties', HomePropertiesController::class);
        Route::post('delete-properties/{id}', [HomePropertiesController::class, 'destroy'])->name('delete-properties');

        Route::resource('service-main', ServiceSlideController::class);
        Route::post('delete-service-main/{id}', [ServiceSlideController::class, 'destroy'])->name('delete-service-main');
        Route::get('service-list', [ServiceSlideController::class, 'serviceIndex'])->name('service-list');
        Route::get('edit-service/{id}', [ServiceSlideController::class, 'editService'])->name('edit-service');
        Route::put('update-service/{id}', [ServiceSlideController::class, 'updateService'])->name('update-service');
        Route::get('create-service', [ServiceSlideController::class, 'createService'])->name('create-service');
        Route::POST('store-service', [ServiceSlideController::class, 'storeMainService'])->name('store-mainservice');

        Route::resource('service-insight', ServiceInsightController::class);
        Route::post('delete-insight/{id}', [ServiceInsightController::class, 'destroy'])->name('delete-insight');

        Route::resource('service-explore', ServiceExlporeController::class);
        Route::post('delete-explore/{id}', [ServiceExlporeController::class, 'destroy'])->name('delete-explore');

        Route::resource('service-valution', ServiceValutionController::class);
        Route::post('delete-valution/{id}', [ServiceValutionController::class, 'destroy'])->name('delete-valution');

        Route::resource('service-consultants', ServiceConsultantsController::class);
        Route::post('delete-consultants/{id}', [ServiceConsultantsController::class, 'destroy'])->name('delete-consultants');

        Route::resource('home-about', HomeAboutController::class);
        Route::get('main-list', [HomeAboutController::class, 'getBanner'])->name('main-list');
        Route::get('edit-slide/{id}', [HomeAboutController::class, 'slideEdit'])->name('edit-slide');
        Route::put('update-slide/{id}', [HomeAboutController::class, 'updateSlide'])->name('update-slide');

        //Routes for User
        Route::get('user-list', [UserController::class, 'userList'])->name('user-list');
        Route::get('create-user', [UserController::class, 'create'])->name('create-user');
        Route::post('add-user', [UserController::class, 'store'])->name('add-user');
        Route::get('edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
        Route::put('update-user/{id}', [UserController::class, 'update'])->name('update-user');
        Route::post('delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');

        //Customers Routes
        Route::get('/members', [\App\Http\Controllers\admin\CustomersController::class, 'index'])->name('members.index');
        Route::get('/members/create', [App\Http\Controllers\admin\CustomersController::class, 'create'])->name('members.create');
        Route::post('/members/store', [App\Http\Controllers\admin\CustomersController::class, 'store'])->name('members.store');
        Route::get('/members/edit/{id}', [App\Http\Controllers\admin\CustomersController::class, 'edit'])->name('members.edit');
        Route::put('/members/update/{id}', [App\Http\Controllers\admin\CustomersController::class, 'update'])->name('members.update');
        Route::get('/members/destroy/{id}', [App\Http\Controllers\admin\CustomersController::class, 'destroy'])->name('members.destroy');
        Route::get('/members/changeStatus{status}/{id}', [App\Http\Controllers\admin\CustomersController::class, 'changeStatus'])->name('members.changeStatus');


        //categories Routes
        Route::get('/categories', [\App\Http\Controllers\admin\CategoriesController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [App\Http\Controllers\admin\CategoriesController::class, 'create'])->name('categories.create');
        Route::post('/categories/store', [App\Http\Controllers\admin\CategoriesController::class, 'store'])->name('categories.store');
        Route::get('/categories/edit/{id}', [App\Http\Controllers\admin\CategoriesController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/update/{id}', [App\Http\Controllers\admin\CategoriesController::class, 'update'])->name('categories.update');
        Route::post('/categories/destroy/{id}', [App\Http\Controllers\admin\CategoriesController::class, 'destroy'])->name('categories.destroy');
        Route::get('/categories/changeStatus', [App\Http\Controllers\admin\CategoriesController::class, 'changeStatus'])->name('categories.changeStatus');

        //subcategories Routes
        Route::get('/subcategories', [\App\Http\Controllers\admin\SubCategoryController::class, 'index'])->name('subcategories.index');
        Route::get('/subcategories/create', [App\Http\Controllers\admin\SubCategoryController::class, 'create'])->name('subcategories.create');
        Route::post('/subcategories/store', [App\Http\Controllers\admin\SubCategoryController::class, 'store'])->name('subcategories.store');
        Route::get('/subcategories/edit/{id}', [App\Http\Controllers\admin\SubCategoryController::class, 'edit'])->name('subcategories.edit');
        Route::put('/subcategories/update/{id}', [App\Http\Controllers\admin\SubCategoryController::class, 'update'])->name('subcategories.update');
        Route::post('/subcategories/destroy/{id}', [App\Http\Controllers\admin\SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
        Route::get('/subcategories/changeStatus', [App\Http\Controllers\admin\SubCategoryController::class, 'changeStatus'])->name('subcategories.changeStatus');

        //Gallery Routes
        Route::get('/gallery', [\App\Http\Controllers\admin\GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/gallery/create', [App\Http\Controllers\admin\GalleryController::class, 'create'])->name('gallery.create');
        Route::post('/gallery/store', [App\Http\Controllers\admin\GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/gallery/edit/{id}', [App\Http\Controllers\admin\GalleryController::class, 'edit'])->name('gallery.edit');
        Route::put('/gallery/update/{id}', [App\Http\Controllers\admin\GalleryController::class, 'update'])->name('gallery.update');
        Route::post('/gallery/destroy/{id}', [App\Http\Controllers\admin\GalleryController::class, 'destroy'])->name('gallery.destroy');
        Route::get('/gallery/changeStatus', [App\Http\Controllers\admin\GalleryController::class, 'changeStatus'])->name('gallery.changeStatus');
        Route::post('/gallery/get-subcategories-by-category-id', [App\Http\Controllers\admin\GalleryController::class, 'getSubcategoriesByCategoryId'])->name('gallery.getSubcategoriesByCategoryId');

        //Tool and Assets Routes

        Route::get('/toolAndAssets', [\App\Http\Controllers\ToolAndAssetController::class, 'index'])->name('toolAndAssets.index');
        Route::get('/toolAndAssets/create', [App\Http\Controllers\ToolAndAssetController::class, 'create'])->name('toolAndAssets.create');
        Route::post('/toolAndAssets/store', [App\Http\Controllers\ToolAndAssetController::class, 'store'])->name('toolAndAssets.store');
        Route::get('/toolAndAssets/edit/{id}', [App\Http\Controllers\ToolAndAssetController::class, 'edit'])->name('toolAndAssets.edit');
        Route::put('/toolAndAssets/update/{id}', [App\Http\Controllers\ToolAndAssetController::class, 'update'])->name('toolAndAssets.update');
        Route::post('/toolAndAssets/destroy/{id}', [App\Http\Controllers\ToolAndAssetController::class, 'destroy'])->name('toolAndAssets.destroy');



        //Routes for Career
        Route::get('applicant', [CareerDetailController::class, 'applicant'])->name('applicant');
        Route::get('career-details', [CareerDetailController::class, 'careerDetails'])->name('career-details');
        Route::get('edit-career-description/{id}', [CareerDetailController::class, 'edit'])->name('edit-career-description');
        Route::put('update-career-details/{id}', [CareerDetailController::class, 'update'])->name('update-career-details');
        Route::post('delete-applicant/{id}', [CareerDetailController::class, 'destroy'])->name('delete-applicant');
        Route::post('delete-career-image/{id}/{index}',[CareerDetailController::class, 'deleteImg'])->name('delete-career-image');

        //Routes for Career Detail
        Route::get('career-detail-list', [CareerDetailPageController::class, 'index'])->name('career-detail-list');
        Route::get('create-career-detail', [CareerDetailPageController::class, 'create'])->name('create-career-detail');
        Route::post('add-career-detail', [CareerDetailPageController::class, 'store'])->name('add-career-detail');
        Route::get('edit-career-detail/{id}', [CareerDetailPageController::class, 'edit'])->name('edit-career-detail');
        Route::put('update-career-detail/{id}', [CareerDetailPageController::class, 'update'])->name('update-career-detail');
        Route::post('delete-career-detail/{id}', [CareerDetailPageController::class, 'destroy'])->name('delete-career-detail');
        
        // Routes for Career Explore More
        Route::get('career-explore-list', [CareerDetailExploreController::class, 'careerExplore'])->name('career-explore-list');
        Route::get('edit-career-explore-detail/{id}', [CareerDetailExploreController::class, 'editExplore'])->name('edit-career-explore-detail');
        Route::put('update-career-explore-detail/{id}', [CareerDetailExploreController::class, 'update'])->name('update-career-explore-detail');

         // Routes for Region
         Route::get('region-list', [RegionController::class, 'regionList'])->name('region-list');
        Route::get('create-region', [RegionController::class, 'createRegion'])->name('create-region');
        Route::post('add-region', [RegionController::class, 'storeRegion'])->name('add-region');
        Route::get('edit-region/{id}', [RegionController::class, 'editRegion'])->name('edit-region');
        Route::put('update-region/{id}', [RegionController::class, 'updateRegion'])->name('update-region');
        Route::post('delete-region/{id}', [RegionController::class, 'destroy'])->name('delete-region');

         // Routes for Country
        Route::get('country-list', [CountryController::class, 'index'])->name('country-list');
        Route::get('create-country', [CountryController::class, 'create'])->name('create-country');
        Route::post('add-country', [CountryController::class, 'store'])->name('add-country');
        Route::get('edit-country/{id}', [CountryController::class, 'edit'])->name('edit-country');
        Route::put('update-country/{id}', [CountryController::class, 'update'])->name('update-country');
        Route::post('delete-country/{id}', [CountryController::class, 'destroy'])->name('delete-country');

        //Routes for Story
        Route::get('story-list', [StoryController::class, 'index'])->name('story-list');
        Route::get('create-story', [StoryController::class, 'create'])->name('create-story');
        Route::post('add-story', [StoryController::class, 'store'])->name('add-story');
        Route::get('edit-story/{id}', [StoryController::class, 'edit'])->name('edit-story');
        Route::put('update-story/{id}', [StoryController::class, 'update'])->name('update-story');
        Route::post('delete-story/{id}', [StoryController::class, 'destroy'])->name('delete-story');

        Route::post('delete-mltiimg-story/{id}/{index}',[StoryController::class, 'deleteImg'])->name('delete-mltiimg-story');

        // Routes for global-network
        Route::get('global-network-list', [GlobalNetworksController::class, 'index'])->name('global-network-list');
        Route::get('create-global-network', [GlobalNetworksController::class, 'create'])->name('create-global-network');
        Route::post('add-global-network', [GlobalNetworksController::class, 'store'])->name('add-global-network');
        Route::get('edit-global-network/{id}', [GlobalNetworksController::class, 'edit'])->name('edit-global-network');
        Route::put('update-global-network/{id}', [GlobalNetworksController::class, 'update'])->name('update-global-network');
        Route::post('delete-global-network/{id}', [GlobalNetworksController::class, 'destroy'])->name('delete-global-network');

        Route::post('delete-mltiimg-gbl/{id}/{index}',[GlobalNetworksController::class, 'deleteImg'])->name('delete-mltiimg-gbl');

        // Routes for global-network-integrated-service
        Route::get('global-integrated-service-list', [GlobalNetworkIntegratedController::class, 'index'])->name('global-integrated-service-list');
        Route::get('create-global-integrated-service', [GlobalNetworkIntegratedController::class, 'create'])->name('create-global-integrated-service');
        Route::post('add-global-integrated-service', [GlobalNetworkIntegratedController::class, 'store'])->name('add-global-integrated-service');
        Route::get('edit-global-integrated-service/{id}', [GlobalNetworkIntegratedController::class, 'edit'])->name('edit-global-integrated-service');
        Route::put('update-global-integrated-service/{id}', [GlobalNetworkIntegratedController::class, 'update'])->name('update-global-integrated-service');
        Route::post('delete-global-integrated-service/{id}', [GlobalNetworkIntegratedController::class, 'destroy'])->name('delete-global-integrated-service');

        // Routes for Integrated service
        Route::get('integrated-service-list', [IntegratedServiceController::class, 'index'])->name('integrated-service-list');
        Route::get('create-integrated-service', [IntegratedServiceController::class, 'create'])->name('create-integrated-service');
        Route::post('add-integrated-service', [IntegratedServiceController::class, 'store'])->name('add-integrated-service');
        Route::get('edit-integrated-service/{id}', [IntegratedServiceController::class, 'edit'])->name('edit-integrated-service');
        Route::put('update-integrated-service/{id}', [IntegratedServiceController::class, 'update'])->name('update-integrated-service');
        Route::post('delete-integrated-service/{id}', [IntegratedServiceController::class, 'destroy'])->name('delete-integrated-service');

        //Routes for About-us
        Route::get('about-us-list', [AboutUsController::class, 'index'])->name('about-us-list');
        Route::get('create-about-us', [AboutUsController::class, 'create'])->name('create-about-us');
        Route::post('add-about-us', [AboutUsController::class, 'store'])->name('add-about-us');
        Route::get('edit-about-us/{id}', [AboutUsController::class, 'edit'])->name('edit-about-us');
        Route::put('update-about-us/{id}', [AboutUsController::class, 'update'])->name('update-about-us');
        Route::post('delete-about-us/{id}', [AboutUsController::class, 'destroy'])->name('delete-about-us');

        Route::post('delete-mltiimg-about/{id}/{index}',[AboutUsController::class, 'deleteImg'])->name('delete-mltiimg-about');


        //Routes for Our Team
        Route::get('our-team-list', [OurTeamController::class, 'index'])->name('our-team-list');
        Route::get('create-our-team', [OurTeamController::class, 'create'])->name('create-our-team');
        Route::post('add-our-team', [OurTeamController::class, 'store'])->name('add-our-team');
        Route::get('edit-our-team/{id}', [OurTeamController::class, 'edit'])->name('edit-our-team');
        Route::put('update-our-team/{id}', [OurTeamController::class, 'update'])->name('update-our-team');
        Route::post('delete-our-team/{id}', [OurTeamController::class, 'destroy'])->name('delete-our-team');

        //Routes for History
        Route::get('history-list', [HistoryController::class, 'index'])->name('history-list');
        Route::get('create-history', [HistoryController::class, 'create'])->name('create-history');
        Route::post('add-history', [HistoryController::class, 'store'])->name('add-history');
        Route::get('edit-history/{id}', [HistoryController::class, 'edit'])->name('edit-history');
        Route::put('update-history/{id}', [HistoryController::class, 'update'])->name('update-history');
        Route::post('delete-history/{id}', [HistoryController::class, 'destroy'])->name('delete-history');

        //Routes for Timeline
        Route::get('timeline-list', [TimelineController::class, 'index'])->name('timeline-list');
        Route::get('create-timeline', [TimelineController::class, 'create'])->name('create-timeline');
        Route::post('add-timeline', [TimelineController::class, 'store'])->name('add-timeline');
        Route::get('edit-timeline/{id}', [TimelineController::class, 'edit'])->name('edit-timeline');
        Route::put('update-timeline/{id}', [TimelineController::class, 'update'])->name('update-timeline');
        Route::post('delete-timeline/{id}', [TimelineController::class, 'destroy'])->name('delete-timeline');

        //Routes for Offices
        Route::get('offices-list', [OfficesController::class, 'index'])->name('offices-list');
        Route::get('create-offices', [OfficesController::class, 'create'])->name('create-offices');
        Route::post('add-offices', [OfficesController::class, 'store'])->name('add-offices');
        Route::get('edit-offices/{id}', [OfficesController::class, 'edit'])->name('edit-offices');
        Route::put('update-offices/{id}', [OfficesController::class, 'update'])->name('update-offices');
        Route::post('delete-offices/{id}', [OfficesController::class, 'destroy'])->name('delete-offices');

        //Routes for Reasearch and Insights
        Route::get('research-and-insight-list', [ResearchandInsightController::class, 'index'])->name('research-and-insight-list');
        Route::get('create-research-and-insight', [ResearchandInsightController::class, 'create'])->name('create-research-and-insight');
        Route::post('add-research-and-insight', [ResearchandInsightController::class, 'store'])->name('add-research-and-insight');
        Route::get('edit-research-and-insight/{id}', [ResearchandInsightController::class, 'edit'])->name('edit-research-and-insight');
        Route::put('update-research-and-insight/{id}', [ResearchandInsightController::class, 'update'])->name('update-research-and-insight');
        Route::post('delete-research-and-insight/{id}', [ResearchandInsightController::class, 'destroy'])->name('delete-research-and-insight');

        //Routes for Reasearch and Insights Detail
        Route::get('research-detail-list', [ResearchDetailController::class, 'index'])->name('research-detail-list');
        Route::get('create-research-detail', [ResearchDetailController::class, 'create'])->name('create-research-detail');
        Route::post('add-research-detail', [ResearchDetailController::class, 'store'])->name('add-research-detail');
        Route::get('edit-research-detail/{id}', [ResearchDetailController::class, 'edit'])->name('edit-research-detail');
        Route::put('update-research-detail/{id}', [ResearchDetailController::class, 'update'])->name('update-research-detail');
        Route::post('delete-research-detail/{id}', [ResearchDetailController::class, 'destroy'])->name('delete-research-detail');

        Route::get('research-status', [ResearchDetailController::class, 'changefeatureStatus'])->name('research-status');
        Route::post('delete-mltiimg-research/{id}/{index}',[ResearchDetailController::class, 'deleteImg'])->name('delete-mltiimg-research');

        // //Routes for History Detail
        // Route::get('history-detail-list', [HistoryDetailController::class, 'index'])->name('history-detail-list');
        // Route::get('create-history-detail', [HistoryDetailController::class, 'create'])->name('create-history-detail');
        // Route::post('add-history-detail', [HistoryDetailController::class, 'store'])->name('add-history-detail');
        // Route::get('edit-history-detail/{id}', [HistoryDetailController::class, 'edit'])->name('edit-history-detail');
        // Route::put('update-history-detail/{id}', [HistoryDetailController::class, 'update'])->name('update-history-detail');
        // Route::post('delete-history-detail/{id}', [HistoryDetailController::class, 'destroy'])->name('delete-history-detail');

        // //Routes for Contact Us Detail
        // Route::get('contact-us-detail-list', [ContactUsDetailController::class, 'index'])->name('contact-us-detail-list');
        // Route::get('create-contact-us-detail', [ContactUsDetailController::class, 'create'])->name('create-contact-us-detail');
        // Route::post('add-contact-us-detail', [ContactUsDetailController::class, 'store'])->name('add-contact-us-detail');
        // Route::get('edit-contact-us-detail/{id}', [ContactUsDetailController::class, 'edit'])->name('edit-contact-us-detail');
        // Route::put('update-contact-us-detail/{id}', [ContactUsDetailController::class, 'update'])->name('update-contact-us-detail');
        // Route::post('delete-contact-us-detail/{id}', [ContactUsDetailController::class, 'destroy'])->name('delete-contact-us-detail');

        //Routes for Contact Us
        Route::get('contact-us-list', [ControllersContactUsController::class, 'contactList'])->name('contact-us-list');
        Route::get('view-contact-us/{id}', [ControllersContactUsController::class, 'viewContact'])->name('view-contact-us');



    });
});

//User Routes

Route::get('/', [HomeController::class, 'index']);

Route::get('property-listing', [PropertiesController::class, 'index']);
Route::get('search-property', [PropertiesController::class, 'searchProperty']);
Route::get('property-type-residential', [PropertiesController::class, 'propertyTypeResidential']);
Route::get('property-type-commercial', [PropertiesController::class, 'propertyTypeCommercial']);
Route::get('property-rent-listing', [PropertiesController::class, 'propertyRentListing']);
Route::get('property-sale-listing', [PropertiesController::class, 'propertySaleListing']);
Route::get('property-get-location', [PropertiesController::class, 'propertyGetLocation'])->name('property-get-location');
Route::get('property-detail/{id}/{propertySlug}/{country}', [PropertiesController::class, 'propertyDetail']);
Route::post('store-express-interest', [ExpressInterestController::class, 'storeExpInt']);
Route::get('property-store', [PropertiesController::class, 'store']);
Route::get('location-store', [PropertiesController::class, 'locationStore']);

Route::get('/popular-city-search', [PopularCitySearchController::class, 'index']);

Route::get('/stories-listing', [ControllersStoryController::class, 'index']);
Route::get('/stories-detail/{slug}', [ControllersStoryController::class, 'stories_detail']);

Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us');
Route::get('/contact-us/press-enquiry', [ContactUsController::class, 'pressEnquiryView'])->name('press-enquiry');
Route::get('/contact-us/network-partner', [ContactUsController::class, 'networkPartnerView'])->name('network-partner');
Route::post('add-inquiry', [ContactUsController::class, 'add_inquiry'])->name('add_inquiry');

Route::get('service', [HomeController::class, 'service'])->name('service');
Route::get('service/{service_name}', [HomeController::class, 'get_service'])->name('get_service');
Route::get('search-service', [HomeController::class, 'searchService'])->name('search_service');

Route::get('/about-us', [ControllersAboutUsController::class, 'index'])->name('about-us');

Route::get('/research-insights',[ResearchInsightController::class, 'researchInsight'])->name('research-insights');




Route::get('/history', [ControllersHistoryController::class, 'index']);
Route::get('/history-brochure', [ControllersHistoryController::class, 'downloadBrochure']);

Route::get('/foundations', function () {
    return view('foundations');
});

// Route::get('/career', function () {
//     return view('career');
// });
Route::get('/career', [CareerController::class, 'index']);
//Route::post('/career/apply-job', [CareerController::class, 'store']);

Route::post('/career-detail/apply-job', [ControllersCareerDetailPageController::class, 'store']);
Route::get('career-detail/{slug}', [ControllersCareerDetailPageController::class, 'careerDetail']);

// Route::get('career-detail', function () {
//     return view('career-detail');
// });

//Route::get('/global-network', [GlobalNetworkController::class, 'index']);
Route::get('/global-network/{country}', [GlobalNetworkController::class, 'globalDetail']);

// Route::get('/services-detail', [ServiceMainSlideController::class, 'index']);

//Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
Route::get('/login', [AuthController::class, 'index'])->name('user.login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login');
Route::get('/the-way-login', [AuthController::class, 'dashboard'])->middleware('auth');
Route::get('/gallery', [AuthController::class, 'gallery'])->middleware('auth');
Route::get('/galleryBySubCategoryId/{id}', [AuthController::class, 'galleryBySubCategoryId'])->name('user.galleryBySubCategoryId')->middleware('auth');
Route::get('/user/update-profile/{id}', [AuthController::class, 'userUpdateProfileView'])->name('user.updateProfile.view')->middleware('auth');;
Route::post('/user/update-profile/update/{id}', [AuthController::class, 'userUpdateProfileAction'])->name('user.updateProfile.action');

Route::get('logout', [AuthController::class, 'logout']);
Route::get('/user/forget-password', [AuthController::class, 'userForgotPasswordView'])->name('user.forgot.password.view');
Route::post('/user/forget-password', [AuthController::class, 'userForgotPasswordAction'])->name('user.forgot.password.action');
Route::get('/user/reset-password/{id}', [AuthController::class, 'userresetPasswordView'])->name('user.resetPassword.view');
Route::post('/user/reset-password/create/{id}', [AuthController::class, 'usercreatePasswordAction'])->name('user.resetPassword.action');

Route::get('/page_not_found', function () {
    return view('404');
});
