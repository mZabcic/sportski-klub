
<form method="POST" action="{{ route('editTeam', ['id' => $team->id]) }}" id="edit">
                        @csrf
<input name="role" id="role" value="0" type="hidden">
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
                            <label for="yearFrom" class="col-md-4 col-form-label text-md-right">{{ __('Godina od') }} <span style="font-size: 11px;">(Opcionalno)</span></label>

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
                                    @if ($team->coach_id != 0)
                                        <option value="0"  >-- Odaberite ekipu --</option> 
                                    @else
                                        <option value="0"  selected>-- Odaberite ekipu --</option>  
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="offset-md-4">
                                <button type="submit" class="button-success pure-button">
                                    {{ __('Spremi') }}
                                </button>
                                @if (Auth::user()->coach() && $team->currentStatus == "nacrt")
                                <button type="button" id="start" class="button-success pure-button">
                                    {{ __('Spremi i zatraži pokretanje') }}
                                </button>
                                @endif
                                @if (Auth::user()->board() && $team->currentStatus == "pregled")
                                <button type="button" id="approve" class="button-success pure-button">
                                    {{ __('Spremi i odobri') }}
                                </button>
                                <button type="button" id="block" class="button-error pure-button">
                                    {{ __('Odbij') }}
                                </button>
                                @endif
                                @if ($team->currentStatus == "odbijen")
                                <button type="button" id="restart" class="button-success pure-button">
                                    {{ __('Ponovono pokreni') }}
                                </button>
                                @endif
                            </div>
                           
                        </div>
                    </form>