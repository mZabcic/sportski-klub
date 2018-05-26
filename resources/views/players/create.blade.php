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
                    <form method="POST" action="{{ route('createPlayer') }}">
                        @csrf
                        <input id="redirect" type="hidden" name="redirect" value="players">
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Ime') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Prezime') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}"  autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Datum rođenja') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ old('date_of_birth') }}" required autofocus>

                                @if ($errors->has('date_of_birth'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="position_id" class="col-md-4 col-form-label text-md-right">{{ __('Pozicija') }}</label>

                            <div class="col-md-6">
                                <select id="position_id" class="form-control{{ $errors->has('position_id') ? ' is-invalid' : '' }}" name="position_id" required>
                                        <option value="0">-- Odaberi poziciju --</option>
                                    @foreach ($positions as $position)
                                    @if (old('position_od') == $position->id)
                                            <option selected value="{{ $position->id}}">{{ $position->name }}</option>
                                    @else
                                             <option value="{{ $position->id}}">{{ $position->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('position_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('position_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="team_id" class="col-md-4 col-form-label text-md-right">{{ __('Ekipa') }}</label>

                            <div class="col-md-6">
                                <select id="team_id" class="form-control{{ $errors->has('team_id') ? ' is-invalid' : '' }}" name="team_id">
                                            <option value="0">-- Odaberi ekipu --</option>
                                    @foreach ($teams as $team)
                                    @if (old('team_id') == $team->id)
                                            <option selected value="{{ $team->id}}">{{ $team->name }}</option>
                                    @else
                                            <option value="{{ $team->id}}">{{ $team->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('team_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('team_id') }}</strong>
                                    </span>
                                @endif
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
