<select wire:model="{{$name}}" class="block text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-indigo-400 focus:outline-none focus:shadow-outline-indigo dark:focus:shadow-outline-gray">
    <option value="">Select</option>
    @foreach ($options as $key => $option)
        <option value="{{$key}}">{{$option}}</option>
    @endforeach
</select>