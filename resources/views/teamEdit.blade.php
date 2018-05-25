@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between;">
            <div>{{ $team->name }} </div>
               <a href="{{ url('/teams') }}" class="pure-button pure-button-primary">Nazad</a>
           </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('editTeam', ['id' => $team->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Ime') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $team->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="yearFrom" class="col-md-4 col-form-label text-md-right">{{ __('Godina od') }}</label>

                            <div class="col-md-6">
                                <input id="yearFrom" type="text" class="form-control{{ $errors->has('yearFrom') ? ' is-invalid' : '' }}" name="yearFrom" value="{{ $team->yearFrom }}"  autofocus>

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
                                <input id="yearUntil" type="text" class="form-control{{ $errors->has('yearUntil') ? ' is-invalid' : '' }}" name="yearUntil" value="{{ $team->yearUntil }}" required autofocus>

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
                                <select id="coach_id" class="form-control" name="coach_id" value="{{ $team->coach_id }}" required>
                                    @foreach ($coaches as $coach)
                                    @if ($team->coach_id === $coach->id) 
                                        <option selected value="{{ $coach->id}}" >{{ $coach->first_name }} {{ $coach->last_name }}</option>
                                    @else
                                        <option value="{{ $coach->id}}">{{ $coach->first_name }} {{ $coach->last_name }}</option>
                                    @endif
                                    @endforeach
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
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                 <div>Igrači </div>
                    <a href="{{ url('/players/create') }}" class="button-success pure-button">Novi igrač</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                
                   

                    
                    <table style="width: 100%" class="pure-table pure-table-bordered">
                        <thead>
                            <tr>
                                <th>@sortablelink('first_name', 'Ime')</th>
                                <th>@sortablelink('last_name', 'Prezime')</th>
                                <th>@sortablelink('position.name', 'Pozicija')</th>
                                <th>@sortablelink('team.name', 'Ekipa')</th>
                                <th>@sortablelink('date_of_birth', 'Godište do')</th>
                                <th>@sortablelink('created_at', 'Datum kreiranja')</th>
                                <th>@sortablelink('updated_at', 'Datum izmjene')</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($players as $player)
                            <tr>
                                <td>{{ $player->first_name }}</td>
                                <td>{{ $player->last_name }}</td>
                                <td>{{ $player->position->name }} </td>
                                <td>  @if (!is_null($player->team))
                                        {{ $player->team->name }}
                                      @endif </td>
                                <td>{{ $player->date_of_birth }}</td>
                                <td>{{ $player->created_at }}</td>
                                <td>{{ $player->updated_at }}</td>
                                <td style="display:flex; justify-content: space-between; text-align: center;"><a href="/players/{{ $player->id }}" class="button-success pure-button">Uredi</a>
                                <form action="{{ route('playerDelete', ['id' => $player->id]) }}" method="post">
                                @csrf
                                 <input type="hidden" name="_method" value="delete" />
                                 <button type="submit" class="button-error pure-button">
                                    {{ __('Obriši') }}
                                </button>
                           </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                       
                    </table>
                    <div style="margin-top: 16px; display: flex; justify-content: center;  "> {{ $players->links() }}</div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
