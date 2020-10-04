<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $moviesTopRated = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNmJiODhlNzAyYmQ5NzllYzNhNjQyZDIwYTM1NTgxOSIsInN1YiI6IjVmNmJjYWQyNjg4Y2QwMDAzNzI4ZDVjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.VXJ7h4hlTVVq5PorrxGiOnPIG3N5_XRkH-XDxf6bNIg')
            ->post('https://api.themoviedb.org/3/movie/top_rated')
            ->json();

        $config = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNmJiODhlNzAyYmQ5NzllYzNhNjQyZDIwYTM1NTgxOSIsInN1YiI6IjVmNmJjYWQyNjg4Y2QwMDAzNzI4ZDVjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.VXJ7h4hlTVVq5PorrxGiOnPIG3N5_XRkH-XDxf6bNIg')
            ->get('https://api.themoviedb.org/3/configuration')
            ->json();

        dump($config);

        dump($moviesTopRated);

        $movies = collect($moviesTopRated['results'])->filter(function ($movie) {
            return $movie['adult'] === false
                && $movie['original_language'] === 'en'
                && $movie['popularity'] > 20;
        })->take(6);

        dump($movies);

        return view('index', [
            'movies' => $movies,
            'imgBaseUrl' => $config['images']['base_url'] . $config['images']['backdrop_sizes'][3],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movieDetails = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNmJiODhlNzAyYmQ5NzllYzNhNjQyZDIwYTM1NTgxOSIsInN1YiI6IjVmNmJjYWQyNjg4Y2QwMDAzNzI4ZDVjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.VXJ7h4hlTVVq5PorrxGiOnPIG3N5_XRkH-XDxf6bNIg')
            ->get('https://api.themoviedb.org/3/movie/' . $id)
            ->json();

        $movieCredits = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNmJiODhlNzAyYmQ5NzllYzNhNjQyZDIwYTM1NTgxOSIsInN1YiI6IjVmNmJjYWQyNjg4Y2QwMDAzNzI4ZDVjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.VXJ7h4hlTVVq5PorrxGiOnPIG3N5_XRkH-XDxf6bNIg')
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/credits')
            ->json();

        $movieVideos = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNmJiODhlNzAyYmQ5NzllYzNhNjQyZDIwYTM1NTgxOSIsInN1YiI6IjVmNmJjYWQyNjg4Y2QwMDAzNzI4ZDVjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.VXJ7h4hlTVVq5PorrxGiOnPIG3N5_XRkH-XDxf6bNIg')
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/videos')
            ->json();

        $movieImages = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNmJiODhlNzAyYmQ5NzllYzNhNjQyZDIwYTM1NTgxOSIsInN1YiI6IjVmNmJjYWQyNjg4Y2QwMDAzNzI4ZDVjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.VXJ7h4hlTVVq5PorrxGiOnPIG3N5_XRkH-XDxf6bNIg')
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/images')
            ->json();

        $movieReviews = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNmJiODhlNzAyYmQ5NzllYzNhNjQyZDIwYTM1NTgxOSIsInN1YiI6IjVmNmJjYWQyNjg4Y2QwMDAzNzI4ZDVjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.VXJ7h4hlTVVq5PorrxGiOnPIG3N5_XRkH-XDxf6bNIg')
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/reviews')
            ->json();

        $config = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNmJiODhlNzAyYmQ5NzllYzNhNjQyZDIwYTM1NTgxOSIsInN1YiI6IjVmNmJjYWQyNjg4Y2QwMDAzNzI4ZDVjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.VXJ7h4hlTVVq5PorrxGiOnPIG3N5_XRkH-XDxf6bNIg')
            ->get('https://api.themoviedb.org/3/configuration')
            ->json();

        dump($movieReviews);

        $trailers = collect($movieVideos['results'])->map(function ($video) {
            return $video;
        });

        $trailersFiltered = $trailers->filter(function ($trailer) {
            return $trailer['type'] === 'Trailer';
        });

        $trailersFiltered = $trailersFiltered->first();

        $highestRatedImage = collect($movieImages['backdrops'])->where('vote_count', '>', 1)->first();

        $test = 'asdfasdfasfsda \n asdfdasfdsafsasdfasd\nsafadsfasdfa';
        $test = Str::of($test)->explode('\n');
        dump($test);

        return view('show', [
            'movie' => $movieDetails,
            'cast' => collect($movieCredits['cast'])->take(6),
            'trailers' => $trailersFiltered,
            'images' => collect($movieImages['backdrops'])->take(6),
            'featureImage' => $highestRatedImage,
            'firstReview' => collect($movieReviews['results'])->first(),
            'firstReviewContent' => Str::of($movieReviews['results'][0]['content'])->explode("\r\n"),
            'imgBaseUrl' => $config['images']['base_url'] . $config['images']['poster_sizes'][5],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
