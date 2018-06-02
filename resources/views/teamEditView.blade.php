

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Ime') }}</label>

                            <div class="col-md-6">
                                <input id="name" disabled type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $team->name }}" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="yearFrom" class="col-md-4 col-form-label text-md-right">{{ __('Godina od') }} <span style="font-size: 11px;">(Opcionalno)</span></label>

                            <div class="col-md-6">
                                <input id="yearFrom" type="text" class="form-control{{ $errors->has('yearFrom') ? ' is-invalid' : '' }}" name="yearFrom" value="{{ $team->yearFrom }}"  autofocus disabled>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="yearUntil" class="col-md-4 col-form-label text-md-right">{{ __('Godina do') }}</label>

                            <div class="col-md-6">
                                <input id="yearUntil" type="text" class="form-control{{ $errors->has('yearUntil') ? ' is-invalid' : '' }}" name="yearUntil" value="{{ $team->yearUntil }}" required autofocus disabled>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="coach_id" class="col-md-4 col-form-label text-md-right">{{ __('Trener') }}</label>

                            <div class="col-md-6">
                                <select disabled id="coach_id" class="form-control" name="coach_id" value="{{ $team->coach_id }}" required>
                                      
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
