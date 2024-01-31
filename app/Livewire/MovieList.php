<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Genre;
use App\Models\Movie;

class MovieList extends Component
{
    public $selectedGenre;

    public function render()
    {
        $genres = Genre::all();
        $movies = $this->selectedGenre
            ? Movie::where('genre_id', $this->selectedGenre)->get()
            : Movie::all();
        return view('livewire.movie-list', ['genres' => $genres, 'movies' => $movies]);
    }
}
