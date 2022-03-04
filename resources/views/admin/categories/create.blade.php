@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">
                        <h2>Nuova Categoria</h2>
                    </div>

                    <div class="card-body">

                        <form action="{{route('categories.store')}}" method="POST">
                            @csrf

                            {{-- title --}}
                            <div class="form-group">

                                <label for="name">Titolo</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome della categoria" value="{{old('name')}}">

                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            {{-- azioni --}}
                            <div class="mt-3">

                                <button type="submit" class="btn btn-primary">Crea</button>

                                <a href="{{route('categories.index')}}">
                                    <button type="button" class="btn btn-secondary">Torna alle Categorie</button>
                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>
        
    </div>

@endsection