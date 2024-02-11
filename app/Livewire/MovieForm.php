<?php

namespace App\Livewire;

use App\Models\Genre;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class MovieForm extends Component
{
    public $title;
    public $searchResults = [];

    public function searchTitle()
    {
        if (strlen($this->title) >= 3) {
            $this->searchResults = Http::withToken(env('TMDB_TOKEN'))
                ->get('https://api.themoviedb.org/3/search/movie', [
                    'query' => $this->title,
                ])->json()['results'];
            $this->searchResults = collect($this->searchResults)->take(3);
        }
    }


    // change title by passing title only
    public function changeTitle($title)
    {
        $this->title = $title;
    }

    public function render()
    {
        $geners = Genre::all();
        return view('livewire.movie-form', ['genres' => $geners]);
    }
}
