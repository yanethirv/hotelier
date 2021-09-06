<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RegisterStepTwoController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\WebhookController;
use App\Http\Livewire\Manager\Hotels\HotelList;

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
    return view('welcome');
});

Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::view('forms', 'forms')->name('forms');
    Route::view('cards', 'cards')->name('cards');
    Route::view('charts', 'charts')->name('charts');
    Route::view('buttons', 'buttons')->name('buttons');
    Route::view('modals', 'modals')->name('modals');
    Route::view('tables', 'tables')->name('tables');
    Route::view('calendar', 'calendar')->name('calendar');
    
    //** Home */
    Route::view('launch', 'launch')->name('launch');
    Route::view('dashboard', 'dashboard')->name('dashboard');

    //** Resources */
    Route::get('resources', [ResourceController::class, 'index'])->name('resources');

    //*** Billing */
    Route::get('billing/invoices', [InvoiceController::class, 'index'])->name('invoices');
    Route::get('/user/invoice/{invoice}', function (Request $request, $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId, [
            'vendor' => 'Your Company',
            'product' => 'Your Product',
        ]);
    });
    Route::get('billing/payment-methods', [PaymentMethodController::class, 'index'])->name('payment.methods');
    Route::view('billing/fee-invoices', 'marketplace.fee_invoices.index')->name('fee.invoices.index');
    //** Request Management */
    Route::view('request-management/activation-services-requests', 'request-management.activation-services-requests.index')->name('activation-services-requests');
    Route::view('request-management/plans-requests', 'request-management.plans-requests.index')->name('plans-requests');
    Route::view('request-management/services-requests', 'request-management.services-requests.index')->name('services-requests');
    Route::view('request-management/subscriptions-requests', 'request-management.subscriptions-requests.index')->name('subscriptions-requests');

    //** Marketplace */
    Route::view('marketplace/plans', 'marketplace.plans.marketplace')->name('plans.marketplace');
    Route::view('marketplace/activation-services', 'marketplace.activation-services.marketplace')->name('activation-services');
    Route::view('marketplace/services', 'marketplace.services.marketplace')->name('services');
    Route::get('marketplace/services/{service}/pay', [ServiceController::class, 'pay'])->name('services-pay');
    Route::view('marketplace/subscriptions', 'marketplace.subscriptions.index')->name('subscriptions');
    
    /** Management */
    Route::view('management/resources', 'admin.resources.list')->name('resources.list');

    //*** User Management */
    Route::view('user-management/users', 'admin.users.index')->name('users.index')->middleware('can_view:user');
    Route::view('user-management/roles', 'admin.roles.index')->name('roles.index');
    Route::view('user-management/permissions', 'admin.permissions.index')->name('permissions.index');
    
    //*** Hotel Settings */
    Route::view('hotel-settings/amenities', 'admin.amenities.index')->name('amenities.index');
    Route::view('hotel-settings/categories', 'admin.categories.index')->name('categories.index');
    Route::view('hotel-settings/experiences', 'admin.experiences.index')->name('experiences.index');
    Route::view('hotel-settings/occupancies', 'admin.occupancies.index')->name('occupancies.index');
    Route::view('hotel-settings/photo-locations', 'admin.photo_locations.index')->name('photo-locations.index');
    Route::view('hotel-settings/policy-types', 'admin.policy_types.index')->name('policy-types.index');
    Route::view('hotel-settings/restaurant-locations', 'admin.restaurant_locations.index')->name('restaurant-locations.index');
    Route::view('hotel-settings/restaurant-themes', 'admin.restaurant_themes.index')->name('restaurant-themes.index');
    Route::view('hotel-settings/restaurant-types', 'admin.restaurant_types.index')->name('restaurant-types.index');
    Route::view('hotel-settings/room-ranges', 'admin.room_ranges.index')->name('room-ranges.index');
    Route::view('hotel-settings/room-types', 'admin.room_types.index')->name('room-types.index');

    //*** Marketplace Settings */
    Route::view('marketplace-settings/types', 'admin.types.index')->name('types.index');
    Route::view('marketplace-settings/activation-services', 'admin.activation_services.index')->name('activation-services.index');
    Route::view('marketplace-settings/services', 'admin.services.index')->name('services.index');
    Route::view('marketplace-settings/plans', 'admin.plans.index')->name('plans.index');
    Route::view('marketplace-settings/products', 'admin.products.index')->name('products.index');
    Route::view('marketplace-settings/subscriptions', 'admin.subscriptions.index')->name('subscriptions.index');
    Route::view('invoices/fee-invoices', 'admin.fee_invoices.index')->name('fee-invoices.index');

    //** Reports */

    //** Communication */
    Route::view('communication/notifications', 'communication.notifications.index')->name('notifications.index');

    //** Hotel */
    Route::view('hotel/hotels', 'hotel.hotels.index')->name('hotels.index');
    Route::get('hotel/hotel-pdf/{id}', [HotelList::class, 'downloadProfile'])->name('hotel.hotel-pdf');
    Route::view('hotel/rooms', 'hotel.rooms.index')->name('rooms.index');
    Route::view('hotel/restaurants', 'hotel.restaurants.index')->name('restaurants.index');
    Route::view('hotel/meal-plans', 'hotel.meal_plans.index')->name('meal-plans.index');
    Route::view('hotel/rate-plans', 'hotel.rate_plans.index')->name('rate-plans.index');
    Route::view('hotel/documents', 'hotel.documents.index')->name('documents.index');
    //Route::view('hotel/rates', 'hotel.rates.index')->name('rates.index');
    Route::view('hotel/photos', 'hotel.photos.index')->name('photos.index');
    Route::view('hotel/policies', 'hotel.policies.index')->name('policies.index');

    Route::view('hotels', 'manager.hotels.list')->name('hotels.list');
    Route::get('hotel-pdf/{id}', [HotelList::class, 'downloadProfile'])->name('hotel-pdf');
    Route::get('hotel-detail/{id}', [HotelList::class, 'hotelDetail'])->name('hotel-detail');

});
