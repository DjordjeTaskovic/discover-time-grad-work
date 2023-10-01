@extends('layouts.layout')

@section('content')
<!-- Inner Content Box ==== -->
<div class="page-content bg-white">
    <!-- Page Heading Box ==== -->
    <div class="page-banner ovbl-dark" style="background-image:url({{ asset('assets/images/banner/ban1.jpg') }});">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Quizzes</h1>
             </div>
        </div>
    </div>
   
    <!-- Page Heading Box END ==== -->
    <!-- Page Content Box ==== -->
    <div class="content-block">
        <!-- Blog Grid ==== -->
        <div class="section-area section-sp1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 heading-bx left">
                        <h2 class="title-head">Check out the awesome quizzes</h2>
                        <h4> Rattle your brain with <span class="counter">{{ $quizzes->count() }}</span> online quizzes and evaluate yourself onto the comunity scoreboard</h4>
                    </div>
                </div>
                <div class="ttr-blog-grid-3 row" id="masonry">
                    @foreach ($quizzes as $q)
                        <div class="post action-card col-lg-4 col-md-6 col-sm-12 col-xs-12 m-b40">
                            <div class="quiz-wrraper">
                                <div class="quiz-inner">
                                    <div class="quiz-image-wrraper">
                                        <a href="{{ route('quiz_details',['id'=>$q->lecture_ID]) }}">
                                            <img src="{{ asset('assets/images/historical_data/'.$q->cover_image) }}" alt="cover_image">
                                        </a>
                                    </div>
                                    <div class="quiz-text-wrraper">
                                        <h5 class="post-title">
                                            <a href="{{ route('quiz_details',['id'=>$q->lecture_ID]) }}">{{$q->lecture_name }}</a></h5>
                                        <ul class="media-post">
                                            <li><a href="#"><i class="fa fa-review"></i>{{ $q->category }}</a></li>
                                            <li><a href="#"><i class="fa fa-review"></i>No. of Questions: {{ $q->num_of_questions }}</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                   
                </div>
                <!-- Pagination ==== -->
                @if (count($quizzes) != 0)
                <div class="pagination-bx gray clearfix">
                    <ul class="pagination">
                        {{$quizzes->links('vendor.pagination.bootstrap-5')}}
                    </ul>
                </div>
        
            @endif
                <!-- Pagination END ==== -->
            </div>
        </div>
        <!-- Blog Grid END ==== -->
    </div>
    <!-- Page Content Box END ==== -->
</div>
<!-- Page Content Box END ==== -->
@endsection