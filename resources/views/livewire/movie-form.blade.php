<div>
    <form method="POST" action="{{ route('movies.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="title" :value="__('Title')" :is_required="true" />
            <x-text-input id="title" name="title" wire:model.live="title" type="text" wire:change="searchTitle"
                class="mt-1 block w-full bg-gray-50"  required autofocus autocomplete="title" />
            <div class="mt-2">
                <div id="suggestions">
                    @foreach ($searchResults as $result)
                    {{-- wire:click="$set('title', '{{$result['title']}}')" --}}
                        <span class="text-indigo-500" wire:click="changeTitle('{{$result['title']}}')">{{ $result['title'] }}</span>
                        @if(!$loop->last)
                            <span class="text-white">,</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="genres" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                :is_required="true">Select a genre</x-input-label>
            <select id="genres" name="genre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-input-label for="release_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                :is_required="true">Select a release date</x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input datepicker datepicker-buttons datepicker-autohide datepicker-format="mm-dd-yyyy" type="text"
                    name="release_date" id="release_date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select release date" required>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
