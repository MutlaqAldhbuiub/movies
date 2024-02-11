<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Movie;

class MovieTest extends TestCase
{
    /**
     * A basic unit test for testing creating a movie.
     */
    public function test_create(): void
    {
        // create a movie
        $movie = Movie::create([
            'image_url' => 'https://via.placeholder.com/640x480.png/00ffbb?text=The+Avengers',
            'title' => 'The Avengers',
            'slug' => 'the-avengers',
            'genre_id' => 1,
            'release_date' => '2012-05-04'
        ]);
        $this->assertNotEmpty($movie);
    }

    /**
     * A basic unit test for testing getting all movies.
     */
    public function test_get_all_movies(): void
    {
        // fetch / page through all movies
        $movies = Movie::paginate(10);
        $this->assertNotEmpty($movies);
    }

    /**
     * A basic unit test for testing getting a movie by id.
     */
    public function test_get_by_id(): void
    {
        // fetch a movie by id
        $movie = Movie::find(1);
        $this->assertNotEmpty($movie);
    }
}
