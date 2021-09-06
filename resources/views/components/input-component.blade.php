<div>
    <div>
        <label for="{{$name}}" class="block text-md font-semibold pt-4 mx-4">
            <span class="text-gray-700 dark:text-gray-400">{{$label}}</span>
            <input type="{{$type}}" wire:model="{{$name}}" id="{{$name}}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="{{$placeholder}}" />
        </label>
    </div>
    @if ($errors->has($name))
        <small class="text-red-600 ml-4">{{$errors->first($name)}}</small>        
    @endif
</div>