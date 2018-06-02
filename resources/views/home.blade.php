@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                 <div>Ekipe </div>
                    <a href="{{ url('/teams/create') }}" class="button-success pure-button">Nova ekipa</a>
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
                                <th>@sortablelink('name', 'Naziv')</th>
                                <th>@sortablelink('coach.last_name', 'Trener')</th>
                                <th>@sortablelink('yearFrom', 'Godište od')</th>
                                <th>@sortablelink('yearUntil', 'Godište do')</th>
                                <th>@sortablelink('currentStatus', 'Status')</th>
                                <th>@sortablelink('created_at', 'Datum kreiranja')</th>
                                <th>@sortablelink('updated_at', 'Datum izmjene')</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($teams as $team)
                            <tr>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->coach->last_name }} {{ $team->coach->first_name }}</td>
                                <td>{{ $team->yearFrom }}</td>
                                <td>{{ $team->yearUntil }}</td>
                                <td>{{ ucfirst($team->currentStatus) }}</td>
                                <td>{{ $team->created_at }}</td>
                                <td>{{ $team->updated_at }}</td>
                                <td style="display:flex; justify-content: space-between; text-align: center;">
                                @if ((Auth::user()->board() && $team->currentStatus != 'odobren') || (Auth::user()->coach() && $team->currentStatus == 'nacrt'))
                                    <a href="/teams/{{ $team->id }}" class="button-success pure-button">Uredi</a>
                                @else
                                    <a href="/teams/{{ $team->id }}" style="margin-right: 2px;" class="button-success pure-button">Igrači</a>
                                @endif
                                @if ((Auth::user()->board()) || (Auth::user()->coach() && $team->currentStatus == 'nacrt'))
                                <form action="{{ route('teamDelete', ['id' => $team->id]) }}" method="post">
                                @csrf
                                 <input type="hidden" name="_method" value="delete" />
                                 <button type="submit" class="button-error pure-button">
                                    {{ __('Obriši') }}
                                </button>
                                @endif
                           </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                       
                    </table>
                    <div style="margin-top: 16px; display: flex; justify-content: center;  "> {{ $teams->links() }}</div>                    
                </div>
            </div>
        </div>
  
</div>
@endsection
