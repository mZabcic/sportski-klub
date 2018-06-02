@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between;">
            <div> {{ __('Nova ekipa') }} </div>
               <a href="{{ url('/teams') }}" class="pure-button pure-button-primary">Nazad</a>
           </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('createTeam') }}" id="create">
                        @csrf

                        @if (Auth::user()->board())
                          <input hidden id="role" name="role" value="1">
                        @else
                          <input hidden id="role" name="role" value="0">
                        @endif
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
                            <label for="yearFrom" class="col-md-4 col-form-label text-md-right">{{ __('Godina od') }} <span style="font-size: 11px;">(Opcionalno)</span></label>

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
                            <label for="yearUntil" class="col-md-4 col-form-label text-md-right">{{ __('Godina do') }}</label>

                            <div class="col-md-6">
                                <input id="yearUntil" type="text" class="form-control{{ $errors->has('yearUntil') ? ' is-invalid' : '' }}" name="yearUntil" value="{{ old('yearUntil') }}" required autofocus>

                                @if ($errors->has('yearUntil'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('yearUntil') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="coach_id" class="col-md-4 col-form-label text-md-right">{{ __('Trener') }}</label>

                            <div class="col-md-6">
                                <select id="coach_id" class="form-control{{ $errors->has('coach_id') ? ' is-invalid' : '' }}" name="coach_id">
                                             <option value="0">-- Odaberite trenera --</option>
                                    @foreach ($coaches as $coach)
                                    @if (old('coach_id') == $coach->id)
                                            <option selected value="{{ $coach->id}}">{{ $coach->first_name }} {{ $coach->last_name }}</option>
                                    @else
                                        <option value="{{ $coach->id}}">{{ $coach->first_name }} {{ $coach->last_name }}</option> 
                                    @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('coach_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('coach_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class=" offset-md-4">
                                <button type="submit" class="button-success pure-button">
                                @if (Auth::user()->board())
                                    {{ __('Kreiraj i odobri') }}
                                @else 
                                    {{ __('Kreiraj nacrt ekipe') }} 
                                @endif
                                </button>
                                @if (Auth::user()->coach())
                                <button type="button" id="create_start" class="button-success pure-button">
                                {{ __('Kreiraj i pokreni odobravanje') }}
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
