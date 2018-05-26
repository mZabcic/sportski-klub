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
                            <select id="position_id" class="form-control{{ $errors->has('position_id') ? ' is-invalid' : '' }}" name="position_id" required>
                                    <option value="0">-- Odaberi poziciju --</option>
                                @foreach ($positions as $position)
                                @if ($player->position_id == $position->id)
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
                                @if ($player->team_id == $team->id)
                                        <option selected value="{{ $team->id}}">{{ $team->name }}  </option>
                                @else
                                        <option value="{{ $team->id}}">{{ $team->name }} </option>
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
                            <div class="col-md-2 offset-md-4">
                                <button type="submit" class="button-success pure-button">
                                    {{ __('Spremi') }}
                                </button>
                            </div>
                            
                        </div>
                    </form>