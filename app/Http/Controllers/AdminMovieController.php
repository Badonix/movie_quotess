<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminMovieController extends Controller
{
    public function store(CreateMovieRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        $attributes['user_id'] = auth()->user()->id;
        Movie::create($attributes);

        return redirect('/');
    }

    public function index(): View
    {
        return view('admin.movies.index', [
            'movies' => Movie::latest()->get()
        ]);
    }

    public function destroy(Movie $movie): RedirectResponse
    {
        $movie->delete();
        return redirect('/');
    }

    public function edit(Movie $movie): View
    {
        return view('admin.movies.edit', [
            'movie' => $movie
        ]);
    }

    public function update(Movie $movie, UpdateMovieRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        $movie->update($attributes);

        return redirect('/');
    }
}
