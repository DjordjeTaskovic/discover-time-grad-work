@extends("dashboard.layouts.layout")
@section("dashboard.content")

<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Historical Data</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                <li>Historical Data</li>
            </ul>
        </div>	
        <div class="row">
            <!-- Your Profile Views Chart -->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Historical Data</h4>
                        <div class="pagination-bx rounded-sm gray clearfix">
                            <ul class="pagination">
                                {{$data->links('vendor.pagination.bootstrap-5')}}
                            </ul>
                        </div>
                    </div>
                    <div class="widget-inner">
                        @foreach ($data as $d)
                        <div class="card-courses-list bookmarks-bx">
                            <div class="card-courses-media">
                                <img src="assets/images/historical_data/{{ $d->cover_image  }}" alt="image"/>
                            </div>
                            <div class="card-courses-full-dec">
                                <div class="card-courses-title">
                                    <h4 class="m-b5">{{ $d->name  }}</h4>
                                </div>
                                <div class="card-courses-list-bx">
                                    <ul class="card-courses-view">
                                        <li class="card-courses-categories">
                                            <h5>Period Name</h5>
                                            <h4>{{ $d->period_name  }}</h4>
                                        </li>
                                        <li class="card-courses-categories">
                                            <h5>Period Time</h5>
                                            <h4>{{ $d->period_time  }}</h4>
                                        </li>
                                        <li class="card-courses-stats">
											<a href="{{route('ad_his_data.show', ["ad_his_datum" => $d->HisID])}}" 
												class="btn button-sm green radius-xl">
												Details
											</a>
										</li>
                                    </ul>
                                </div>
                                <div class="row card-courses-dec">
                                    <div class="col-md-12">
                                        <p>{{ \Illuminate\Support\Str::limit($d->description, 550, $end='...') }}</p>
                                    </div>
                                    @if ($d->most_fam_ach != null)
                                        <div class="col-md-12">
                                            <h4>{{ $d->most_fam_ach }}</h4>
                                            <p>{{ \Illuminate\Support\Str::limit($d->ach_desc, 550, $end='...') }}</p>
                                        </div>
                                    @endif

                                    @if ($d->material != null)
                                    <div class="col-md-12 artifact_admin_data">
                                        <h4>Material</h4>
                                        <p>{{ $d->material }}</p>
                                        <br>
                                        <h4>Collection</h4>
                                        <p>{{ $d->collection_num }}</p>
                                        <br>
                                        <h4>Current Location</h4>
                                        <p>{{ $d->current_location }}</p>
                                        <br>
                                        <h4>Finding Place</h4>
                                        <p>{{ $d->finding_place }}</p>
                                    </div>
                                     @endif
                                    <div class="col-md-12" style="display: flex">
                                        <a href="{{ route('ad_his_data.edit',["ad_his_datum" => $d->HisID]) }}" class="btn radius-xl">Update</a>

                                            <form 
                                            class="del-btn" 
                                            method="POST" 
                                            action="{{route('ad_his_data.destroy',["ad_his_datum" => $d->HisID]) }}"
                                            >  
                                            @method('DELETE')
                                            @csrf
                                                <button
                                                 onclick="return confirm('Are you sure you want to delete item?')"
                                                class="btn red outline radius-xl"
                                                type="submit"> Remove </button>
                                            </form>
                                       
                                    </div>
                                </div>
                                
                            </div>
                            </div>
                            
                        @endforeach
                      
                    </div>
                </div>
            </div>
            <!-- Your Profile Views Chart END-->
        </div>
    </div>
    <div class="pagination-bx rounded-sm gray clearfix">
		<ul class="pagination">
			{{$data->links('vendor.pagination.bootstrap-5')}}
		</ul>
	</div>
</main>
@endsection