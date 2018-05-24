@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                 <div>Ekipe </div>
                    <a href="{{ url('/teams/create') }}">Nova ekipa</a>
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
                                <th>@sortablelink('created_at', 'Datum kreiranja')</th>
                                <th>@sortablelink('updated_at', 'Datum izmjene')</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($teams as $team)
                            <tr>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->coach->last_name }} {{ $team->coach->first_name }}</td>
                                <td>{{ $team->yearFrom }}</td>
                                <td>{{ $team->yearUntil }}</td>
                                <td>{{ $team->created_at }}</td>
                                <td>{{ $team->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                       
                    </table>
                    <div style="margin-top: 16px; display: flex; justify-content: center;  "> {{ $teams->links() }}</div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
