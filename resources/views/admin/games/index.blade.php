@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header"><h3>Lista Giochi</h3></div>

                    <div class="card-body">

                        <div class="mb-3">

                            <a href="{{route('games.create')}}">
                                <button type="button" class="btn btn-success">Aggiungi Gioco</button>
                            </a>

                        </div>

                        <table class="table">

                            <thead>

                            <tr>

                                <th scope="col">#</th>
                                <th scope="col">Titolo</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Azioni</th>

                            </tr>

                            </thead>

                            <tbody>

                                @foreach ($games as $game)

                                    <tr>

                                        <td>{{$game->id}}</td>
                                        <td>{{$game->title}}</td>
                                        <td>{{$game->slug}}</td>
                                        <td>
                                            @if ($game->category)
                                            {{$game->category->name}}                                        
                                            @else
                                            Nessuna
                                            @endif                          
                                        </td>

                                        {{-- azioni --}}
                                        <td>
                                            <a href="{{route('games.show', $game->id)}}">
                                                <button type="button" class="btn btn-primary">Visualizza</button>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{route('games.edit', $game->id)}}">
                                                <button type="button" class="btn btn-warning">Modifica</button>
                                            </a>
                                        </td>

                                        <td>
                                            <form action="{{route('games.destroy', $game->id)}}" method="POST">
                                                {{-- token --}}
                                                @csrf
                                                {{-- method --}}
                                                @method('DELETE')
                        
                                                <button type="submit" class="btn btn-danger">Cancella</button>
                        
                                            </form>
                                        </td>
                                        
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
        
    </div>

@endsection