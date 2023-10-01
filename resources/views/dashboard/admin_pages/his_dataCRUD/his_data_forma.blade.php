<form action="  @if($action == "ad_his_data.update") {{ route($action, $ad_his_datum->HisID) }} @else {{ route($action) }} @endif" 
        method="POST" enctype="multipart/form-data" class="edit-profile m-b30">
        @csrf
        @if($action == "ad_his_data.update")
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
            value="{{ $ad_his_datum->HisID ?? old('ID') }}"/>
            <label class="col-form-label">Title</label>
            <div>
                <input class="form-control inp" type="text" value="{{ $ad_his_datum->name ?? old('name') }}" name="name">
                @error('name')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>
        <div class="form-group col-6">
            <label class="col-form-label">Period time</label>
            <div>
                <input class="form-control inp" type="text" value="{{ $ad_his_datum->period_time ?? old('period_time') }}" name="period_time">
                @error('period_time')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>
        <div class="form-group col-6">
            <label class="col-form-label">Period Name</label>
            <div>
                <input class="form-control inp" type="text" value="{{ $ad_his_datum->period_name ?? old('period_name') }}" name="period_name">
                @error('period_name')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>
        <div class="form-group col-6">
            <label class="col-form-label">Cover image</label>
            <div>
                <input class="form-control inp" type="file" name="cover_image">
                @error('cover_image')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>
        <div class="seperator"></div>
        
        <div class="col-12 m-t20">
            <div class="ml-auto m-b5">
                <h3>Description</h3>
            </div>
        </div>
        <div class="form-group col-12">
            <label class="col-form-label">Historical Data description</label>
            <div>
                <textarea class="form-control inp" name="description">
                    {{ $ad_his_datum->description ?? old('description') }}
                </textarea>

                @error('description')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>
        <div class="col-12 m-t20">
            <div class="ml-auto">
                <h3 class="m-form__section">2. Add sub info</h3>
            </div>
        </div>
        <div class="col-12 m-t20">
            <table id="item-add" style="max-width:100%;">
                <tr class="list-item m-t-20">
                    <td>
                        <label class="col-form-label">Pick a historical data type</label>
                        <p>Make sure that the checkbox is selected when the final form is submited!</p>
                        <div style="display: flex;">
                            @foreach($types as $type)
                                <div class="ml-3">
                                    <input type="checkbox"
                                        class="insertcat inp"
                                        id="typeID{{ $type->ID }}"
                                        name="typeIDs[]"
                                        value="{{ $type->ID }}"

                                        />

                                    <label class="col-form-label">
                                        {{ $type->type_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('typeIDs')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr class="list-item m-t-20">
                    <td>
                        <div class="row">
                           
                            <div class="col-12" id="container_DD">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                {{-- Inserting Sub-form ELEMENTS FROM JS --}}

                            </div>
                                
                        </div>
                        <br>
                    </td>
                </tr>
            </table>
        </div>
        
        @if($action == "ad_his_data.store")
            <div class="col-12 m-t20">
                <div class="ml-auto">
                    <h3 class="m-form__section">3. Add Images</h3>
                </div>
            </div>
                <div class="col-12 m-b20">
                                <div class="input-group-btn"> 
                                    <button class="ud-btn ud-btn-primary" type="button" id="image_addition">Add +</button>
                                </div>
                                <div class="input-group control-group" id="increment">
                                    <input type="file" name="filename[]" class="form-control inp" id="input">
                                </div>
                </div>
        @endif
        
        <div class="col-12 m-t20">
            <button type="submit" class="ud-btn ud-btn-primary" id="save_changes">Save changes</button>
            <button type="reset" class="ud-btn ud-btn-secondary add-item">Cancel</button>
              
        </div>
    </div>
    {{--  --}}
    @if ($action == "ad_his_data.update")
        <script>
        $(document).ready(function() {

                //set the checkbox to be cheched for send on update element 
            
                $('input:checkbox').removeAttr('checked');
                var checkboxes = $('input:checkbox').val(["{{ $ad_his_datum->type_ID }}"]);
                var typedata = "{{ $ad_his_datum->type_ID }}";
                var cek = $(":checkbox[value="+typedata+"]");
                cek.attr("checked","true");
                // Inserting Sub forms into main form
                var types = document.getElementsByClassName("insertcat");
                    var myFunction = function() {
                        var attr = this.value;
                    // console.log(attr);
                        if ("{{ $ad_his_datum->material }}" != "") {
                            var material = "{{ $ad_his_datum->material }}";
                            var collection_num = "{{ $ad_his_datum->collection_num }}";
                            var current_location = "{{ $ad_his_datum->current_location }}";
                            var finding_place = "{{ $ad_his_datum->finding_place }}";

                        }
                        if("{{ $ad_his_datum->material }}" == ""){
                            var material = "/";
                            var collection_num = "/";
                            var current_location = "/";
                            var finding_place = "/";
                        }
                        if ("{{ $ad_his_datum->most_fam_ach }}" != "") {
                            var most_fam_ach = `{{ $ad_his_datum->most_fam_ach }}`;
                            var ach_desc = `{{ $ad_his_datum->ach_desc }}`;

                        }
                        if("{{ $ad_his_datum->most_fam_ach }}" == ""){
                            var most_fam_ach = "/";
                            var ach_desc = "/";
                        }
                        //elemets to display into DOM
                            var html1 = `  <div class="row dis_DD "> 
                                <div class="col-12">
                                    <h3 class="m-form__section">Input Artifact Data</h3>  
                                    </div>
                                <div class="col-md-4 display_DD">
                
                                <label class="col-form-label">Material</label>
                                <div>
                                <input class="form-control inp" type="text" value="`+material+`" name="material">
                                
                                </div>
                                </div>
                                <div class="col-md-4 display_DD">
                                <label class="col-form-label">Collection Number</label>
                                <div>
                                <input class="form-control inp" type="text" value="`+collection_num+`" name="collection_num">
                                
                                </div>
                                </div>
                                <div class="col-md-4 display_DD">
                                <label class="col-form-label">Current Location</label>
                                <div>
                                <input class="form-control inp" type="text" value="`+current_location+`" name="current_location">
                                
                                </div>
                                </div>
                                <div class="col-md-4 display_DD">
                                <label class="col-form-label">Finding Place</label>
                                <div>
                                <input class="form-control inp" type="text"   value="`+finding_place+`" name="finding_place">
                                
                                </div>
                                </div>
                
                
                                </div>`;
                                
                                //var types = [ "{{ $types }}"];
                                //console.log(types);
                            var html2 = `<div class="row dis_DD">`;
                            
                                html2 += `</div>`;
                            var html3 = `<div class="row dis_DD "> 
                                
                                    <div class="col-12">
                                        <h3 class="m-form__section">Input Figure Data</h3>   
                                        </div>
                                        <div class="col-md-4 display_DD">
                
                                            <label class="col-form-label">Most famous achievement</label>
                                            <div>
                                                <input class="form-control inp" type="text"  value="`+ most_fam_ach+`" name="most_fam_ach">
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4 display_DD">
                                            <label class="col-form-label">Achievement description</label>
                                            <div>
                                                <input class="form-control inp" type="text"  value="`+ach_desc+`" name="ach_desc">
                                            
                                            </div>
                                        </div>
                                    
                                </div> `;
                        if(attr == 1){
                            $("#container_DD").html(html1);
                        }
                        if(attr == 2){
                            $("#container_DD").html(html2);
                        }
                        if(attr == 3){
                            $("#container_DD").html(html3);
                        }
                    };
                    
                for (var i = 0; i < types.length; i++) {
                    types[i].addEventListener('click', myFunction, false);
                    
                }
        
                
        });
        </script>
    @else
     
    <script>
        $(document).ready(function() {

                //set the checkbox to be cheched for send on update element 
                $('input:checkbox').removeAttr('checked');
                // Inserting Sub forms into main form
                var types = document.getElementsByClassName("insertcat");
                    var myFunction = function() {
                        var attr = this.value;
                        //elemets to display into DOM
                            var html1 = `  <div class="row dis_DD "> 
                                <div class="col-12">
                                    <h3 class="m-form__section">Input Artifact Data</h3>  
                                    </div>
                                <div class="col-md-4 display_DD">
                
                                <label class="col-form-label">Material</label>
                                <div>
                                <input class="form-control inp" type="text" value="/" name="material">
                                
                                </div>
                                </div>
                                <div class="col-md-4 display_DD">
                                <label class="col-form-label">Collection Number</label>
                                <div>
                                <input class="form-control inp" type="text" value="/" name="collection_num">
                                
                                </div>
                                </div>
                                <div class="col-md-4 display_DD">
                                <label class="col-form-label">Current Location</label>
                                <div>
                                <input class="form-control inp" type="text" value="/" name="current_location">
                                
                                </div>
                                </div>
                                <div class="col-md-4 display_DD">
                                <label class="col-form-label">Finding Place</label>
                                <div>
                                <input class="form-control inp" type="text"   value="/" name="finding_place">
                                
                                </div>
                                </div>
                
                
                                </div>`;
                                
                            var html2 = `<div class="row dis_DD"></div>`;
                            
                            var html3 = `<div class="row dis_DD "> 
                                
                                    <div class="col-12">
                                        <h3 class="m-form__section">Input Figure Data</h3>   
                                        </div>
                                        <div class="col-md-4 display_DD">
                
                                            <label class="col-form-label">Most famous achievement</label>
                                            <div>
                                                <input class="form-control inp" type="text"  value="/" name="most_fam_ach">
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4 display_DD">
                                            <label class="col-form-label">Achievement description</label>
                                            <div>
                                                <input class="form-control inp" type="text"  value="/" name="ach_desc">
                                            
                                            </div>
                                        </div>
                                    
                                </div> `;
                        if(attr == 1){
                            $("#container_DD").html(html1);
                        }
                        if(attr == 2){
                            $("#container_DD").html(html2);
                        }
                        if(attr == 3){
                            $("#container_DD").html(html3);
                        }
                    };
                    
                for (var i = 0; i < types.length; i++) {
                    types[i].addEventListener('click', myFunction, false);
                    
                }
        });
        </script>
    @endif
   
</form>