@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('message')


<div class="bg-gradient-to-r from-purple-300 to-blue-200">
<div class="w-9/12 m-auto py-16 min-h-screen flex items-center justify-center">
<div class="bg-white shadow overflow-hidden sm:rounded-lg pb-8">
<div class="border-t border-gray-200 text-center pt-8">
<h1 class="text-9xl font-bold text-purple-400">403</h1>
<h1 class="text-6xl font-medium py-8">Forbidden</h1>
<p class="text-2xl pb-8 px-12 font-medium">{{__($exception->getMessage() ?: 'Forbidden')}}</p>
<br>
<br>
<a class="focus:outline-none cursor-pointer mb-2 md:mb-0 bg-indigo-100 text-indigo-600 px-5 py-2 shadow-sm tracking-wider rounded-lg hover:bg-indigo-600 hover:text-white" 
    href="{{route('dashboard')}}"">Dashboard</a>

</div>
</div>
</div>
</div>

@endsection
