@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between;">
            <div>{{ $player->first_name }} {{ $player->last_name }} </div>
               <a href="{{ url('/players') }}" class="pure-button pure-button-primary">Nazad</a>
           </div>
                <div class="card-body">
                    <form method="post" action="{{ route('editPlayer', ['id' => $player->id]) }}">
                    <input type="hidden" name="_method" value="put" />
                        @csrf
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Ime') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $player->first_name }}" required autofocus>

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
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $player->last_name }}" required autofocus>

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
                                <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ $player->date_of_birth }}"  autofocus>

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
                                <select id="position_id" class="form-control" name="position_id" value="{{ $player->position_id }}" required>
                                    @foreach ($positions as $position)
                                    @if ($player->position_id === $position->id) 
                                        <option selected value="{{ $position->id}}" >{{ $position->name }}</option>
                                    @else
                                        <option value="{{ $position->id}}">{{ $position->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="team_id" class="col-md-4 col-form-label text-md-right">{{ __('Pozicija') }}</label>

                            <div class="col-md-6">
                                <select id="team_id" class="form-control" name="team_id" value="{{ $player->team_id }}">
                                    @foreach ($teams as $team)
                                    @if ($player->team_id == $team->id) 
                                        <option selected value="{{ $team->id}}" >{{ $team->name }}</option>
                                    @else
                                        <option value="{{ $team->id}}">{{ $team->name }}</option>
                                    @endif
                                    @endforeach
                                    @if ($player->team_id != 0)
                                        <option value="0"  >-- Odaberite ekipu --</option> 
                                    @else
                                        <option value="0"  selected>-- Odaberite ekipu --</option>  
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-4">
                                <button type="submit" class="button-success pure-button">
                                    {{ __('Spremi') }}
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
