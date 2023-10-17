<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $albumPerArtists = DB::table('artists')
            ->leftJoin('albums', 'albums.id', '=', 'artists.id')
            ->select('artists.name', 'artists.code', 'albums.album_name','albums.sales','albums.date')
            ->selectRaw('count(albums.id) as album_count')
            ->groupBy('artists.name')
            ->orderBy(DB::raw('count(*)'), 'DESC')
            ->paginate(10);

            $albumSalesPerArtists = DB::table('artists')
            ->leftJoin('albums', 'albums.id', '=', 'artists.id')
            ->select('artists.name', 'artists.code', 'albums.album_name','albums.sales','albums.date')
            ->selectRaw('sum(albums.sales) as album_sales')
            ->groupBy('artists.name')
            ->orderBy(DB::raw('sum(albums.sales)'), 'DESC')
            ->paginate(10);

            $topArtists = DB::table('artists')
            ->leftJoin('albums', 'albums.id', '=', 'artists.id')
            ->select('artists.name', 'artists.code', 'albums.album_name','albums.sales','albums.date')
            ->orderBy('albums.sales', 'DESC')
            ->first();

            $searchedArtists = DB::table('artists')
            ->leftJoin('albums', 'albums.id', '=', 'artists.id')
            ->where([
                ['name', '!=', Null],
                [function ($query) use ($request) {
                    if (($s = $request->s)) {
                        $query->orWhere('name', 'LIKE', '%' . $s . '%')
                        ->get();
                    }
                }]
            ])
            ->paginate(10);

            // dd($albumPerArtists);
            // die();
 
        return view('artists.index', compact('albumPerArtists','albumSalesPerArtists','topArtists','searchedArtists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        // return view('artists.show', compact('artist'));

        return response()->view('artists.show', [
            'post' => Artist::findOrFail($artist),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        //
    }
}
