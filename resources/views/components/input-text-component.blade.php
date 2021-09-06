<div>
    <div>
        <label for="{{$name}}" class="block text-md font-semibold pt-4 mx-4">
            <span class="text-gray-700 dark:text-gray-400">{{$label}}</span>
            <textarea wire:model="{{$name}}" id="{{$name}}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray" rows="3" placeholder="Enter {{$name}}"></textarea>
        </label>
    </div>
    @if ($errors->has($name))
        <small class="text-red-600 ml-4">{{$errors->first($name)}}</small>        
    @endif
</div>