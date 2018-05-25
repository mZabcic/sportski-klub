@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between;">
            <div> {{ __('Novi igrač') }} </div>
               <a href="{{ url('/players') }}" class="pure-button pure-button-primary">Nazad</a>
           </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('createTeam') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Ime') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="yearFrom" class="col-md-4 col-form-label text-md-right">{{ __('Prezime') }}</label>

                            <div class="col-md-6">
                                <input id="yearFrom" type="text" class="form-control{{ $errors->has('yearFrom') ? ' is-invalid' : '' }}" name="yearFrom" value="{{ old('yearFrom') }}"  autofocus>

                                @if ($errors->has('yearFrom'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('yearFrom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="yearUntil" class="col-md-4 col-form-label text-md-right">{{ __('Datum rođenja') }}</label>

                            <div class="col-md-6">
                                <input id="yearUntil" type="date" class="form-control{{ $errors->has('yearUntil') ? ' is-invalid' : '' }}" name="yearUntil" value="{{ old('yearUntil') }}" required autofocus>

                                @if ($errors->has('yearUntil'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('yearUntil') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coach_id" class="col-md-4 col-form-label text-md-right">{{ __('Pozicija') }}</label>

                            <div class="col-md-6">
                                <select id="coach_id" class="form-control" name="coach_id" required>
                                            <option value="null">-- Odaberi poziciju --</option>
                                    @foreach ($positions as $position)
                                            <option value="{{ $position->id}}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="coach_id" class="col-md-4 col-form-label text-md-right">{{ __('Ekipa') }}</label>

                            <div class="col-md-6">
                                <select id="coach_id" class="form-control" name="coach_id">
                                            <option value="null">-- Odaberi ekipu --</option>
                                    @foreach ($teams as $team)
                                            <option value="{{ $team->id}}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="button-success pure-button">
                                    {{ __('Kreiraj') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
