<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create a movie') }}
        </h2>
        {{-- desc --}}
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Fill in the form below to create a new movie.') }}
        </p>
    </header>


    @livewire('movie-form')
</section>
