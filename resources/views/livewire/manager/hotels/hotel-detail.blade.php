<x-app-layout title="Hotel Detail">
    <div class="container grid px-6 mx-auto mb-6">
        @slot('header')
            Hotel Detail
        @endslot

        <div>
            <a href="{{route('hotels.list')}}" data-turbolinks-action="replace"
            class="block py-8 px-4 rounded transition duration-200 text-blue-600">
            <span aria-hidden="true"><i class="fas fa-hotel"></i></span>
            <span class="ml-2 font-semibold"> Back to Hotel list </span>
            </a>

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">General</h3>
                    {{--<p class="mt-1 text-sm text-gray-600">
                        Use a permanent address where you can receive mail.
                    </p>--}}
                    </div>
                </div>
                <div class="my-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="hotel-name" class="block text-sm font-medium text-gray-700">Hotel Name</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->name}}
                                    </p>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="room-range" class="block text-sm font-medium text-gray-700">Room Range</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->roomRange->name}}
                                    </p>
                                </div>
                
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->category->name}}
                                    </p>
                                </div>

                                <div class="col-span-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->description}}
                                    </p>
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="stars" class="block text-sm font-medium text-gray-700">Stars</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->stars}}
                                    </p>
                                </div>
                    
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="opening-date" class="block text-sm font-medium text-gray-700">Opening Date</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->opening_date}}
                                    </p>
                                </div>
                    
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="floor-number" class="block text-sm font-medium text-gray-700">Floor Number</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->floor_number}}
                                    </p>
                                </div>
                                
                                <div class="col-span-6">
                                    <label for="experiences" class="block text-sm font-medium text-gray-700">Experiences</label>
                                    <div class='px-2 flex flex-wrap -m-1'>
                                        @foreach ($experienceList as $e)
                                            <span class="mx-1 mt-4 bg-blue-200 hover:bg-blue-300 rounded-full px-2 font-bold text-sm leading-loose cursor-none">
                                                    {{$e->name}}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <label for="amenities" class="block text-sm font-medium text-gray-700">Amenities</label>
                                    <div class='px-2 flex flex-wrap -m-1'>
                                        @foreach ($amenityList as $a)
                                            <span class="mx-1 mt-4 bg-blue-200 hover:bg-blue-300 rounded-full px-2 font-bold text-sm leading-loose cursor-none">
                                                    {{$a->name}}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-300"></div>
            </div>
        </div>
  
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Social</h3>
                    {{--<p class="mt-1 text-sm text-gray-600">
                        Use a permanent address where you can receive mail.
                    </p>--}}
                    </div>
                </div>
                <div class="my-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->instagram}}
                                    </p>
                                </div>
                
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->facebook}}
                                    </p>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="linkedin" class="block text-sm font-medium text-gray-700">LinkedIn</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->linkedin}}
                                    </p>
                                </div>
                
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="youtube" class="block text-sm font-medium text-gray-700">Youtube</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->youtube}}
                                    </p>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="twitter" class="block text-sm font-medium text-gray-700">Twitter</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->twitter}}
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-300"></div>
            </div>
        </div>
  
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Location</h3>
                    {{--<p class="mt-1 text-sm text-gray-600">
                        Use a permanent address where you can receive mail.
                    </p>--}}
                    </div>
                </div>
                <div class="my-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->country->name}}
                                    </p>
                                </div>
                    
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->city}}
                                    </p>
                                </div>
                    
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->state}}
                                    </p>
                                </div>
                
                                <div class="col-span-6">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->address}}
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-300"></div>
            </div>
        </div>
  
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Contact</h3>
                    {{--<p class="mt-1 text-sm text-gray-600">
                        Use a permanent address where you can receive mail.
                    </p>--}}
                    </div>
                </div>
                <div class="my-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="frontdesk_phone" class="block text-sm font-medium text-gray-700">Front Desk Phone</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->frontdesk_phone}}
                                    </p>
                                </div>
                
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="frontdesk_email" class="block text-sm font-medium text-gray-700">Front Desk Email</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->frontdesk_email}}
                                    </p>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="reservation_phone" class="block text-sm font-medium text-gray-700">Reservation Phone</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->reservation_phone}}
                                    </p>
                                </div>
                
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="reservation_email" class="block text-sm font-medium text-gray-700">Reservation Email</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->reservation_email}}
                                    </p>
                                </div>
                
                                <div class="col-span-6">
                                    <label for="billing_email" class="block text-sm font-medium text-gray-700">Billing Email</label>
                                    <p class="mt-2 text-sm font-medium text-blue-600">
                                        {{$property->billing_email}}
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
        {{--<div class="sm:block" aria-hidden="true">
            <div class="py-5">
            <div class="border-t border-gray-200"></div>
            </div>
        </div>
  
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Decide which communications you'd like to receive and how.
                </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <fieldset>
                        <legend class="text-base font-medium text-gray-900">By Email</legend>
                        <div class="mt-4 space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                            <input id="comments" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                            <label for="comments" class="font-medium text-gray-700">Comments</label>
                            <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                            <input id="candidates" name="candidates" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                            <label for="candidates" class="font-medium text-gray-700">Candidates</label>
                            <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                            <input id="offers" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                            <label for="offers" class="font-medium text-gray-700">Offers</label>
                            <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                            </div>
                        </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div>
                        <legend class="text-base font-medium text-gray-900">Push Notifications</legend>
                        <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p>
                        </div>
                        <div class="mt-4 space-y-4">
                        <div class="flex items-center">
                            <input id="push-everything" name="push-notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="push-everything" class="ml-3 block text-sm font-medium text-gray-700">
                            Everything
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="push-email" name="push-notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="push-email" class="ml-3 block text-sm font-medium text-gray-700">
                            Same as email
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="push-nothing" name="push-notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="push-nothing" class="ml-3 block text-sm font-medium text-gray-700">
                            No push notifications
                            </label>
                        </div>
                        </div>
                    </fieldset>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>--}}
    </div>

</x-app-layout>