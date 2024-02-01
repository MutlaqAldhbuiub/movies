<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class MovieController extends Controller
{

    public function search($query){
        $searchResults = Http::withToken(config('TMDB_TOKEN'))
        ->get('https://api.themoviedb.org/3/search/movie?query='.$query)
        ->json()['results'];

        return $searchResults;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        $movie->release_date = $request->release_date;
        $movie->image_url = 'https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg';

        if($movie->save()){
            Alert::success('Success', 'Movie was added successfully');
            return redirect()->route('dashboard');
        }else{
            Alert::error('Error', 'There was an error adding the movie');
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
        $genres = Genre::all();
        return view('movie.edit', ['movie' => $movie, 'genres' => $genres]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $movie)
    {
        $movie = Movie::findOrFail($movie);
        $movie->title = $request->title;
        $movie->genre_id = $request->genre_id;
        $movie->slug = Str::slug($request->title);
        $movie->release_date = $request->release_date;
        if($movie->save()){
            Alert::success('Success', 'Movie was updated successfully');
            return redirect()->route('dashboard');
        }else{
            Alert::error('Error', 'There was an error updating the movie');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        // TOODO::delete the movie
        // Check the roles and permission if the user eligable to delete?
        if($movie->delete()){
            Alert::success('Success', 'Movie was deleted successfully');
            return redirect()->route('dashboard');
        }else{
            Alert::error('Error', 'There was an error deleting the movie');
            return redirect()->route('dashboard');
        }
    }
}
