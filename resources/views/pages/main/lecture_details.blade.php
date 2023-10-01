@extends("layouts.layout")
@section('content')
 <!-- Content -->
 <div class="page-content bg-white">
    <!-- Breadcrumb row -->
		<div class="breadcrumb-row">
			<div class="container">
				<ul class="list-inline">
					<li><a href="{{ route("lectures") }}">Lectures</a></li>
					<li><a href="#">Lecture Details</a></li>
				</ul>
			</div>
		</div>
		<!-- Breadcrumb row END -->
        @php
            $largeText =  $lecture->learning_outcomes;
            // Check if the text ends with '..', then remove it.
            if (substr($largeText, -2) === '..') {
                $largeText = substr($largeText, 0, -2);
            }
            $segmentsArray = explode('..', $largeText);

         @endphp	
    <!-- inner page banner END -->
    <div class="content-block">
        <!-- About Us -->
        <div class="section-area">
            <div class="container">
                 <div class="row d-flex flex-row-reverse">
                    <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
                        <div class="course-detail-bx">
                            <div class="course-price p-0">
                                <h5 class="">{{ $lecture->difficulty }}</h5>
                                @if (!$lecture->price == 0)
                                    <h4 class="price">${{ $lecture->price }}</h4>
                                @endif
                            </div>	
                            <div class="course-buy-now text-center">
                                    <a href="{{ route("enroll_lecture", ['id'=>$lecture->LectureID]) }}" class="ud-btn ud-btn-primary">Enroll now</a>
                                 
                            </div>
                            <div class="course-info-list scroll-page">
                                <ul class="navbar">
                                    <li><a class="nav-link" href="#overview"><i class="ti-zip"></i>Overview</a></li>
                                    <li><a class="nav-link" href="#rating"><i class="ti-comments"></i>Rating</a></li>
                                    <li><a class="nav-link" href="#reviews"><i class="ti-user"></i>Reviews Section</a></li>
                                    <li><a class="nav-link" href="#comments"><i class="ti-user"></i>Comment Section</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="courses-post">
                            <div class="ttr-post-media media-effect post-details1">
                                <a href="#">
                                    <img src="{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}" alt="cover_image">
                                </a>
                            </div>
                            <div class="ttr-post-info">
                                <div class="ttr-post-title ">
                                    <h2 class="post-title">{{ $lecture->lecture_name }}</h2>
                                </div>
                                <div class="ttr-post-text">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="courese-overview" id="overview">
                            <h4>Overview</h4>
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                                    <ul class="course-features">
                                        <li><i class="ti-help-alt"></i> <span class="label">Quizzes</span> <span class="value">1</span></li>
                                        <li><i class="ti-time"></i> <span class="label">Duration</span> <span class="value">8 - 10 minutes</span></li>
                                        <li><i class="ti-stats-up"></i> <span class="label">Skill Name</span> <span class="value">{{ $lecture->skill_name }}</span></li>
                                        <li><i class="ti-smallcap"></i> <span class="label">Language</span> <span class="value">{{ $lecture->language }}</span></li>
                                     </ul>
                                </div>
                                <div class="col-md-12 col-lg-8">
                                    <h5 class="m-b5">Lecture Description</h5>
                                        <p>{{ \Illuminate\Support\Str::limit($lecture->lecture_description, 400, $end = ' . . . ') }}</p>

                                    <h5 class="m-b5">Learning Outcomes</h5>
                                    <ul class="list-checked primary">
                                        @foreach ($segmentsArray as $segment)
                                            <li>{{ $segment.'.' }}</li>
                                        @endforeach
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="rating">
                            <h4>Rating</h4>
                            <div class="review-bx">
                                <div class="all-review">
                                    <h2 class="rating-type">{{ $lecture->avg->average_review }}</h2>
                                    @if($lecture->avg->average_review != 0)
                                        <ul class="cours-star">
                                        @for ($i = 1; $i <= $lecture->avg->average_review; $i++)
                                        <li class="active" style="color: rgb(230, 167, 50);"><i class="fa fa-star"></i></li>
                                        @endfor
                                        @for ($i = 1; $i <= 5 - $lecture->avg->average_review; $i++)
                                        <li><i class="fa fa-star"></i></li>
                                        @endfor
                                        </ul>
                                    @endif
                                    <span>{{$lecture->avg->average_review }} Rating</span>
                                </div>
                                <div class="review-bar">
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>5 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:calc(10% * {{$lecture->avg->review_count5 }});"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $lecture->avg->review_count5 }}</div>
                                        </div>
                                    </div>
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>4 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:calc(10% * {{$lecture->avg->review_count4 }});"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $lecture->avg->review_count4 }}</div>
                                        </div>
                                    </div>
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>3 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:calc(10% * {{$lecture->avg->review_count3 }});"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $lecture->avg->review_count3 }}</div>
                                        </div>
                                    </div>
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>2 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:calc(10% * {{$lecture->avg->review_count2 }});"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $lecture->avg->review_count2 }}</div>
                                        </div>
                                    </div>
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>1 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:calc(10% * {{$lecture->avg->review_count1 }});"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $lecture->avg->review_count1 }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="reviews">
                            <h4>Reviews Section</h4>
                            @if (count($lecture->reviews) == 0)
                                <div class="instructor-bx">
                                    <span>There are no reviews fro this lecture at the moment.</span>
                                </div>
                                @else
                                @foreach ($lecture->reviews as $c)
                                    <div class="instructor-bx">
                                        <div class="instructor-author">
                                            <img src="{{ asset('assets/images/profile/'.$c->photo) }}" alt="photo">
                                        </div>
                                        <div class="instructor-info">
                                            <h6>{{ $c->username }}</h6> 
                                            <div class="review">
                                                <ul class="cours-star">
                                                    @for ($i = 1; $i <= $c->review_value; $i++)
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                    @endfor
                                                    @for ($i = 1; $i <= 5 - $c->review_value; $i++)
                                                        <li><i class="fa fa-star"></i></li>
                                                    @endfor
                                                </ul>
                                            </div>
                                            <p class="m-b0">{{ $c->text }}</p>
                                        </div>
                                    </div>  
                                @endforeach
                            @endif
                           
                        </div>
                        {{--  --}}
                        <div id="comments">
                            <h4>Comment Section</h4>
                            @if(session()->has('comm-success'))
                                <div class="alert alert-success">
                                    {{ session()->get('comm-success') }}
                                </div>
                            @endif
                            @if(session()->has('comm-warning'))
                                <div class="alert alert-success">
                                    {{ session()->get('comm-warning') }}
                                </div>
                            @endif

                            @if(session()->has("user"))
                                <div class="instructor-bx">
                                    <div class="instructor-author">
                                        <img src="{{ asset('assets/images/profile/'.session('user')->photo) }}" alt="photo">
                                    </div>
                                    <div class="instructor-info" style="width: 100%">
                                    {{-- FORM --}}
                                        <form action="{{ route("u_add_comment") }}" method="POST">
                                            @csrf
                                            <input type="hidden" class="form-control" name="lecture_ID" value="{{ $lecture->LectureID }}"/>
                                            <input type="hidden" class="form-control" name="comment_type" value="base_comment"/>
                                            <input type="text" class="form-control" name="comment" placeholder="Write a comment.." />
                                                @error('comment')
                                                    <div class="alert alert-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            <br>
                                          
                                            <button type="submit" class="ud-btn ud-btn-secondary">Send</button>
                                            <button type="reset" class="ud-btn ud-btn-primary">Cancel</button>
                                         
                                        </form>
                                    </div>
                                </div>
                            @endif
                            @if (count($lecture->comments) == 0)
                                <div class="instructor-bx">
                                    <span>There are no comments for this lecture at the moment.</span>
                                </div>
                            @else
                                @foreach ($lecture->comments as $key => $c) 
                                
                                     <div class="instructor-bx">
                                        <div class="instructor-author">
                                            <img src="{{ asset('assets/images/profile/'.$c['base_user_photo']) }}" alt="photo">
                                        </div>
                                        <div class="instructor-info">
                                            <h6>{{ $c['base_user_username'] }}</h6> 
                                            <p class="m-b0">{{ $c['base_comment_text'] }}</p>
                                            @if (count($c['replies']) > 0)
                                                <a data-toggle="collapse" href="#faq_{{ $key }}"
                                                     class="collapsed" data-parent="#faq_{{ $key }}">
                                                    <i class="ti-arrow-down"></i> ({{ count($c['replies']) }}) Replays  
                                                </a> 
                                            @endif
                                                <a data-toggle="collapse" href="#faq{{ $key + 1 }}" 
                                                    class="collapsed" data-parent="#faq{{ $key + 1}}" style="margin-left: 10px;">
                                                    <i class="ti-comment"></i> Send Replay  
                                                </a> 
                                            @if (count($c['replies']) > 0)
                                                 <div id="faq_{{ $key }}" class="acod-body collapse ">
                                                 @foreach ($c['replies'] as $reply) 
                                                        <div class="acod-content" style="display: flex">
                                                            <div class="instructor-author">
                                                                <img src="{{ asset('assets/images/profile/'.$reply['reply_user_photo']) }}"
                                                                 alt="photo">

                                                            </div>
                                                            <div class="instructor-info">
                                                                <h6>{{ $reply['reply_user_username'] }}</h6> 
                                                                <p>{{ $reply['reply_comment_text'] }}</p>

                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                             @endif
                                                    <div id="faq{{ $key + 1 }}" class="acod-body collapse ">

                                                        <div class="acod-content">
                                                            <div class="instructor-info" style="width: 100%">
                                                                {{-- FORM --}}
                                                                    <form action="{{ route("u_add_comment") }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" class="form-control" name="lecture_ID" value="{{ $lecture->LectureID }}"/>
                                                                        <input type="hidden" class="form-control" name="comment_ID" value="{{$c['base_comment_id'] }}"/>

                                                                        <input type="hidden" class="form-control" name="comment_type" value="replay_comment"/>
                                                                        <input type="text" class="form-control" name="comment" placeholder="Write a comment.." />
                                                                            @error('comment')
                                                                                <div class="alert alert-danger">
                                                                                    {{$message}}
                                                                                </div>
                                                                            @enderror
                                                                        <br>
                                                                    
                                                                        <button type="submit" class="ud-btn ud-btn-secondary">Send</button>
                                                                        <button type="reset" class="ud-btn ud-btn-primary">Cancel</button>
                                                                     
                                                                    </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                           
                                        </div>
                                    </div>  
                                 @endforeach
                            @endif
                           
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- contact area END -->
    
</div>
<!-- Content END-->
@endsection