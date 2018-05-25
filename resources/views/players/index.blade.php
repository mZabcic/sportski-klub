@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
