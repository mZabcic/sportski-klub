@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between;">
            <div>
                {{ $team->name }} ({{ ucfirst($team->currentStatus) }})
            </div>
            <form method="POST" action="{{ route('navigateBack') }}">
                        @csrf
                        <input id="id" value="{{$team->id}}" name="id" type="hidden">
                        <button type="submit" 
           class="pure-button pure-button-primary"><i class="fas fa-angle-left"></i></button>
            </form>
            <form method="POST" action="{{ route('navigateForward') }}">
                        @csrf
                        <input id="id" value="{{$team->id}}" name="id" type="hidden">
                        <button type="submit" 
           class="pure-button pure-button-primary"><i class="fas fa-angle-right"></i></button>
            </form>
               <a href="{{ url('/teams') }}" class="pure-button pure-button-primary">Nazad</a>
           </div>
                <div class="card-body">
                @if ((Auth::user()->board() && $team->currentStatus != 'odobren') || (Auth::user()->coach() && $team->currentStatus == 'nacrt'))
                     @include('teamEditForm')
                @else
                     @include('teamEditView')
                @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                 <div>Igrači </div>
                 <div>
                 @if (((Auth::user()->board() && $team->currentStatus == 'odobren') || (Auth::user()->coach() && $team->currentStatus == 'odobren')))
                 <button 
                        type="button" 
                        class="button-success pure-button" 
                        data-toggle="modal" 
                        data-target="#favoritesModal">
                        Dodaj postoječeg igrača
                </button>

                <button 
                        type="button" 
                        class="button-success pure-button" 
                        data-toggle="modal" 
                        data-target="#createModal">
                        Dodaj novog igrača
                </button>
                @endif
</div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                
                    @if ($errors->has('team_id'))
                                    <div style="cursor: pointer" class="alert alert-warning" role="alert" data-toggle="modal" 
                        data-target="#createModal">
                                       {{ $errors->first('team_id') }} 
                                    </div>
                    @endif 

                    @if (session('yearError'))
                                    <div style="cursor: pointer" class="alert alert-warning" role="alert" data-toggle="modal" 
                        data-target="#favoritesModal">
                                       Igrač je premlad ili prestar za ovu ekipu
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
                                <form action="{{ route('playerKick', ['id' => $player->id]) }}" method="post">
                                @csrf
                                 <input type="hidden" name="_method" value="delete" />
                                 <button type="submit" class="button-error pure-button">
                                    {{ __('Izbaci') }}
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

<!-- Create player modal-->
<div class="modal fade" id="createModal" 
     tabindex="-1" role="dialog" 
     aria-labelledby="createModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <form method="POST" action="{{ route('createPlayer') }}">
                        @csrf
      <div class="modal-body">
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
                                <select id="position_id" class="form-control" name="position_id" required>
                                        <option value="0">-- Odaberi poziciju --</option>
                                    @foreach ($positions as $position)
                                            <option value="{{ $position->id}}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input id="redirect" type="hidden" name="redirect" value="teams/{{ $team->id }}">
                        <input id="team_id" name="team_id" value="{{ $team->id }}" type="hidden" />
      </div>
      <div class="modal-footer">
        <button type="button" 
           class="pure-button pure-button-primary" 
           data-dismiss="modal">Close</button>
        <span class="pull-right">
          <button type="submit"  class="button-success pure-button">
            Kreiraj igrača
          </button>
        </span>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Select player modal-->
<div class="modal fade" id="favoritesModal" 
     tabindex="-1" role="dialog" 
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <form method="post" action="{{ route('addPlayer', ['id' => $team->id]) }}">
                    <input type="hidden" name="_method" value="put" />
                        @csrf
      <div class="modal-body">
      <div class="form-group row">
                            <label for="position_id" class="col-md-4 col-form-label text-md-right">{{ __('Igrač (Godište)') }}</label>

                            <div class="col-md-6">
                                <select id="player_id" class="form-control" name="player_id" >
                                    @foreach ($selectPlayers as $player)
                                      <option value="{{ $player->id }}">{{ $player->first_name }} {{ $player->last_name }} ({{  Carbon\Carbon::parse($player->date_of_birth)->format('Y') }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" 
           class="pure-button pure-button-primary" 
           data-dismiss="modal">Close</button>
        <span class="pull-right">
          <button type="submit"  class="button-success pure-button">
            Dodaj
          </button>
        </span>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
