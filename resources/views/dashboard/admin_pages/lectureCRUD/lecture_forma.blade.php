<form action="  @if($action == "ad_lectures.update") {{ route($action, $ad_lecture->ID) }} @else {{ route($action) }} @endif" 
    method="POST" enctype="multipart/form-data" class="edit-profile m-b30">
    @csrf
    @if($action == "ad_lectures.update")
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-12">
            <div class="ml-auto">
                <h3>1. Basic info</h3>
            </div>
        </div>
        <div class="form-group col-6">
            <input type="hidden" class="form-control" id="ID" name="ID"
            value="{{ $ad_lecture->ID ?? old('ID') }}"/>

            <label class="col-form-label">Lecture name</label>
            <div>
                <input class="form-control" type="text" value="{{ $ad_lecture->lecture_name ?? old('lecture_name') }}" name="lecture_name">
                @error('lecture_name')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group col-6">
            <label class="col-form-label">Duration in minutes</label>
            <div>
                <input class="form-control" type="text" value="{{ $ad_lecture->duration ?? old('duration') }}" name="duration">
                @error('duration')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group col-6">
            <label class="col-form-label">Language</label>
                <select class="form-select" aria-label="Default select example" name="language[]" id="lang-select">
                    <option value="0" selected>
                        Select from below
                    </option>
                    @foreach ($lang as $l)
                            <option value="{{ $l->name }}">
                                <i class="fa fa-clock-o"></i>
                                {{ $l->name }}
                            </option>
                    @endforeach
                </select>
                @error('language.*')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="seperator"></div>
        <div class="form-group col-12">
            <label class="col-form-label">Lecture Learning Outcomes</label>
           
            <div>
                <textarea class="form-control" name="learning_outcomes">{{ $ad_lecture->learning_outcomes ?? old('learning_outcomes') }} </textarea>
                @error('learning_outcomes')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
                <p style="font-size: 12px;color:gray;font-style:italic;">Please note that every Learning outcome must end with ".." as the app display is configured! </p>
            </div>
        </div>
        <div class="col-12 m-t20">
            <div class="ml-auto m-b5">
                <h3>2. Description</h3>
            </div>
        </div>
        <div class="form-group col-12">
            <label class="col-form-label">Lecture description</label>
            <div>
                <textarea class="form-control" name="description">{{ $ad_lecture->lecture_description ?? old('description') }} </textarea>
                @error('description')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>
        <div class="col-12 m-t20">
            <div class="ml-auto">
                <h3 class="m-form__section">3. Selections</h3>
            </div>
        </div>
        <div class="col-12 m-t20">
            <table id="item-add" style="width:100%;">
                <tr class="list-item">
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                @if($action == "ad_lectures.update")
                                <label class="col-form-label">Current Historical Data</label>
                                    <input class="form-control" type="text" name="his_data" id="his_data"
                                     value="{{ $ad_lecture->his_data_name }}" disabled>
                                     <hr>
                                @endif
                                <label class="col-form-label">Available Historical Data</label>
                             
                                <select class="form-select" aria-label="Default select example" name="dataID[]" id="data-select">
                                    <option value="0" selected>Select from below</option>
                                    @foreach ($avalableData as $d)
                                            <option value="{{ $d->ID }}"><i class="fa fa-clock-o"></i>{{ $d->name }}</option>
                                    @endforeach
                                  </select>
                                  @error('dataID.*')
                                  <div class="alert alert-danger">
                                      {{$message}}
                                  </div>
                              @enderror
                                    
                            </div>
                            <div class="col-md-3">

                                <label class="col-form-label">Subscription</label>
                             
                                <select class="form-select" aria-label="Default select example" name="subID[]" id="sub-select">
                                    <option value="0">Select from below</option>
                                    @foreach ($subs as $s)
                                            <option value="{{ $s->ID }}"><i class="fa fa-clock-o"></i>{{ $s->difficulty }} - {{ $s->price }}$</option>
                                    @endforeach
                                  </select>
                                  @error('subID.*')
                                  <div class="alert alert-danger">
                                      {{$message}}
                                  </div>
                              @enderror
                            </div>
                            <div class="col-md-3">
                              
                                <label class="col-form-label">Category</label>
                                 
                                <select class="form-select" aria-label="Default select example" name="catID[]" id="cat-select">
                                    <option value="0" selected>Select from below</option>
                                    @foreach ($cats as $c)
                                            <option 
                                            value="{{ $c->ID }}"
                                            ><i class="fa fa-clock-o"></i>{{ $c->name }}</option>
                                    @endforeach
                                  </select>
                                  @error('catID.*')
                                  <div class="alert alert-danger">
                                      {{$message}}
                                  </div>
                              @enderror
                            </div>
                            <div class="col-md-3">
                                
                                <label class="col-form-label">Skill Level</label>
                               
                                <select class="form-select" aria-label="Default select example" name="skillID[]" id="skill-select">
                                    <option value="0" selected>Select from below</option>
                                    @foreach ($skills as $s)
                                            <option value="{{ $s->ID }}"><i class="fa fa-clock-o"></i>{{ $s->skill_name }}</option>
                                    @endforeach
                                  </select>
                                  @error('skillID.*')
                                  <div class="alert alert-danger">
                                      {{$message}}
                                  </div>
                              @enderror
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-12 m-t20" >
            <button type="submit" class="ud-btn ud-btn-primary">Save changes</button>
            <button type="reset" class="ud-btn ud-btn-secondary">Cancel</button>

        </div>
    </div>
</form>
@if($action == "ad_lectures.update")
<script>
    $(document).ready(function () {
        var specificlangValue = '{{ $ad_lecture->language }}';
        $('#lang-select').val(specificlangValue);

        var specificCatValue = '{{ $ad_lecture->catID }}';
        $('#cat-select').val(specificCatValue);

        var specificSubValue = '{{ $ad_lecture->subID }}';
        $('#sub-select').val(specificSubValue);

        var specificSkillValue = '{{ $ad_lecture->skillID }}';
        $('#skill-select').val(specificSkillValue);

    });
</script>
@endif
