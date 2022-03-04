<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Game;
use App\Category;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();

        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.games.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validazione dei dati
        $request->validate([
            'title' => 'required|string|max:120',
            'content' => 'required',
            'published' => 'sometimes|accepted',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        // creazione del gioco
        $data = $request->all();

        //nuova istanza
        $newGame = new Game();

        //dati istanza
        $newGame->title = $data['title'];
        $newGame->content = $data['content'];

        //
        if( isset($data['published']) ) {
            $newGame->published = true;
        }

        //variabili per lo slug
        $slug = Str::of($newGame->title)->slug("-");
        $count = 1;

        //ciclo slug
        while( Game::where('slug', $slug)->first() ) {
            $slug = Str::of($newGame->title)->slug("-") . "-$count";
            $count++;
        }
       
        $newGame->slug = $slug;

        //foreign
        $newGame->category_id = $data['category_id'];

        //save
        $newGame->save();

        // redirect al game creato
        return redirect()->route('games.show', $newGame->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return view('admin.games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        // validazione dei dati
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required',
            'published' => 'sometimes|accepted'
        ]);

        $data = $request->all();

                // aggiornamento dati

        if ($game->title != $data['title']) {

            $game->title = $data['title'];
            //variabili per lo slug
            $slug = Str::of($game->title)->slug("-");
            $count = 1;

            //ciclo slug
            while( Game::where('slug', $slug)->first() ) {
                $game = Str::of($game->title)->slug("-") . "-$count";
                $count++;
            }

            $game->slug = $slug;
        }

        $game->content = $data['content'];
        
        if( isset($data['published']) ) {
            $game->published = true;
        }else {
            $game->published = false;
        }

        //save
        $game->save();

        return redirect()->route('games.show', $game->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index');
    }
}
