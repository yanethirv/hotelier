<x-app-layout title="Resources">
    <div class="container grid px-6 mx-auto">
        
        @slot('header')
            Resources
        @endslot

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto flex flex-wrap">
                <div class="flex flex-wrap -m-4">
                    @foreach ($resources as $resource)
                    <div class="p-4 lg:w-1/2 md:w-full">
                        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                            <div class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 flex-shrink-0">
                                <svg viewBox="0 0 20 20" fill="currentColor" strokeWidth="2" class="w-8 h-8"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div class="flex-grow">
                                <h2 class="text-gray-900 text-lg title-font font-medium mb-3">{{$resource->title}}</h2>
                                <p class="leading-relaxed text-base">{{Str::limit($resource->description, 255)}}</p>
                                <a href="{{ asset('storage/'.$resource->attachment) }}" target="_blank" rel="noopener noreferrer" class="cursor-pointer mt-3 text-blue-500 inline-flex items-center">View attachment
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-app-layout>