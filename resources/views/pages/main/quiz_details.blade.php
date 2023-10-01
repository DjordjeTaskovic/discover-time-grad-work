@extends('layouts.layout')
@section('content')
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="#">Quizzes</a></li>
                    <li>Single Quiz</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <div class="content-block">
            <div class="section-area section-sp1">
                <div class="container">
                    <div class="row">
                        <!-- left part start -->
                        <div class="col-lg-8 col-xl-8">
                            <!-- blog start -->
                            <div class="recent-news blog-lg">
                                <div class="ttr-post-media media-effect post-details1">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}" alt="cover_image">
                                    </a>
                                </div>
                                <div class="info-bx">
                                    <ul class="media-post">
                                        <li><a href="#"><i class="fa fa-calendar"></i>{{ $lecture->category_name }}</a></li>
                                        <li><a href="#"><i class="fa fa-comments-o"></i>{{ $lecture->skill_name }}</a></li>
                                    </ul>
                                    <h5 class="post-title">
                                        <a href="#">{{ $lecture->lecture_name }}</a>
                                        <input type="hidden" name="lecture_ID" value="{{ $lecture->LectureID }}" id="lecture_ID"/>
                                    </h5>
                                    <div class="ttr-divider bg-gray"><i class="icon-dot c-square"></i></div>
                                </div>
                                {{--  --}}
                                <div class="m-b30" id="curriculum">
                                    <h4>Quiz Questions</h4>
                                    <ul class="curriculum-list">
                                        @php
                                           date_default_timezone_set('Europe/Belgrade');
                                           $currentTimestamp = strtotime('now');
                                           $timeLeftSeconds = strtotime($nextAttemptTime) - $currentTimestamp;
                                            $timeLeftMinutes = ceil($timeLeftSeconds / 60);
                                        @endphp
                                        @if ($nextAttemptTime == null ||  $currentTimestamp >= strtotime($nextAttemptTime))
                                                @php
                                                    $counter = 1;
                                                @endphp
                                            @foreach ($questions as $q)
                                                <li class="quiz-line">
                                                    <h5>{{ $q->question }}</h5>
                                                    <input type="hidden" name="question_ID" value="{{ $lecture->LectureID }}"/>
                                                    <ul>
                                                        @foreach ($q->answers as $key => $a)
                                                            <li>
                                                                <div class="curriculum-list-box">
                                                                    <input type="radio" 
                                                                    name="{{ 'group'.$counter }}" 
                                                                    class="answer" 
                                                                    value="{{ $a->ID }}"/>

                                                                    <span>{{ $key + 1 }}.</span> {{ $a->answer }}
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @php
                                                    $counter++;
                                                @endphp
                                            @endforeach
                                        @else
                                        <li class="delay-line">
                                            <div class="quiz-results">
                                                <p>Your already tried to solve this quiz. </p>
                                                <p>Each quiz has a time delay of 5 minutes. </p>
                                                <p>You need to wait ( {{ $timeLeftMinutes }} ) minutes before your next attempt.</p>
                                              </div>
                                          </li>
                                        @endif
                                             
                                    </ul>
                                    <ul class="curriculum-list-results">

                                    </ul>
                                    <div class="quiz-buttons-wrapper">
                                        <button class="ud-btn ud-btn-primary quiz-btn" id="previous">Previous</button>
                                        <button class="ud-btn ud-btn-primary quiz-btn" id="next">Next</button>
                                        <button class="ud-btn ud-btn-primary quiz-btn" id="submit_quiz">Submit Answers</button>

                                    </div>
                                </div>
                                {{--  --}}
                            </div>

                            <!-- blog END -->
                        </div>
                        <!-- left part END -->
                        <!-- Side bar start -->
                        <div class="col-lg-4 col-xl-4 col-md-5 sticky-top">
                            <aside class="side-bar sticky-top">
                                <div class="widget recent-posts-entry">
                                    <h6 class="widget-title">More quizzes</h6>
                                    <div class="widget-post-bx">
                                        @foreach ($quizzes as $q)
                                            <div class="widget-post clearfix">
                                                <div class="ttr-post-media"> 
                                                    <img src="{{ asset('assets/images/historical_data/'.$q->cover_image) }}"
                                                        width="200" height="143" alt="cover_image">
                                                    </div>
                                                <div class="ttr-post-info">
                                                    <div class="ttr-post-header">
                                                        <h6 class="post-title">
                                                            <a href="{{ route('quiz_details',['id'=>$q->lecture_ID]) }}">
                                                                {{ $q->lecture_name }}</a></h6>
                                                    </div>
                                                    <ul class="media-post">
                                                        <li><a href="#"><i class="fa fa-calendar"></i>{{ $q->category }}</a></li>
                                                        <li><a href="#"><i class="fa fa-comments-o"></i>No. of Questions: {{ $q->num_of_questions }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if (count($quizzes) != 0)
                                        <div class="pagination-bx gray clearfix">
                                            <ul class="pagination">
                                                {{$quizzes->links('vendor.pagination.bootstrap-5')}}
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                
                            </aside>
                        </div>
                        <!-- Side bar END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Left & right section END -->
@endsection
