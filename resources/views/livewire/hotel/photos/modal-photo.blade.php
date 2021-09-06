<div>
    <form wire:submit.prevent="{{$method}}" id="form-user">
        <x-modal-component :showModal="$showModal" :action="$action">
            <div class="pb-6">

                <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">

                    <div class="flex">
                        <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                            {{$action}} Photo
                        </h3>
                    </div>
                    <div class="mt-2">
                        {{--<p class="text-sm text-gray-500">
                        Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.
                        </p>--}}
                        
                        <div>
                            <x-input-component label="Title" name="title" placeholder="Enter title" type="text" />
                        </div>

                        <div>
                            <x-input-select-component label="Hotel" name="property_id" 
                                :options="$properties"/>
                        </div>
                        <div>
                            <x-input-select-component label="Location" name="photo_location_id" 
                                :options="$photoLocations"/>
                        </div>
                        <div>
                            <div class="pt-4 mx-4" wire:ignore x-data
                                x-init="
                                    FilePond.registerPlugin(FilePondPluginImagePreview);
                                    FilePond.setOptions({
                                        server: {
                                            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                                @this.upload('photo_path', file, load, error, progress)
                                            },
                                            revert: (filename, load) => {
                                                @this.removeUpload('photo_path', filename, load)
                                            },
                                        },
                                    });
                                    FilePond.create($refs.input);
                                ">
                                <input type="file" id="photo_path" x-ref="input" />
                            </div>
                            @if ($errors->has('photo_path'))
                                    <small class="text-red-600 ml-4">{{$errors->first('photo_path')}}</small>        
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </x-modal-component>
    </form>
    @push('scripts')
        <script>
            // Get a reference to the file input element
            const inputElement = document.querySelector('input[id="photo_path"]');
        
            // Create a FilePond instance
            const pond = FilePond.create(inputElement);

            window.addEventListener('pondReset', e => {
                pond.removeFile();
                document.getElementById('photo_path').value = "";
                //console.log('modal', e.detail);
            });
        </script>
    @endpush
</div>

