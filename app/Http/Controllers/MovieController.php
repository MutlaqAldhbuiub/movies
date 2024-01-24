<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{

    public function search($query){
        $searchResults = Http::withToken(env('TMDB_TOKEN'))
        ->get('https://api.themoviedb.org/3/search/movie?query='.$query)
        ->json()['results'];

        return $searchResults;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $geners = Genre::all();
        return view('movie.create', ['genres' => $geners]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $movie = new Movie();
        $movie->title = $request->title;
        $movie->genre_id = $request->genre;
        $movie->release_date = \Carbon\Carbon::parse($request->release_date);
        $movie->image_url = 'https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg';

        if($movie->save()){
            $request->session()->flash('success', 'Movie was added successfully');
            return redirect()->route('movies.create');
        }else{
            $request->session()->flash('error', 'There was an error adding the movie');
            return redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
