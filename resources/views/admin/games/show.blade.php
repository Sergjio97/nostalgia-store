@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <h2>{{$game->title}}</h2>
                        
                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <strong>Stato:</strong>

                            @if ($game->published)

                                <span class="badge badge-success">Pubblicato</span>

                            @else

                                <span class="badge badge-secondary">Bozza</span>

                            @endif

                        </div>

                        {{$game->content}}

                        {{-- azioni --}}
                        <div class="mt-3">

                            <a href="{{route('games.edit', $game->id)}}">
                                <button type="button" class="btn btn-warning">Modifica</button>
                            </a>

                            <a href="{{route('games.index')}}">
                                <button type="button" class="btn btn-secondary">Torna ai Giochi</button>
                            </a>

                            <form action="{{route('games.destroy', $game->id)}}" method="POST">
                                {{-- token --}}
                                @csrf
                                {{-- method --}}
                                @method('DELETE')
        
                                <button type="submit" class="btn btn-danger">Cancella</button>
        
                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection