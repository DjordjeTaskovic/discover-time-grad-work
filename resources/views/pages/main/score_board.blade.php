@extends("layouts.layout")
@section("content")
<!-- Inner Content Box ==== -->
<div class="page-content bg-white">
   
    <!-- Page Content Box ==== -->
    <div class="content-block">
        {{--  --}}
        <div class="section-area section-sp2" style="background: #f7f9fa;">
            <div class="container">
                <div class="row m-t30 m-b30">
                        <div class="col-md-12 heading-bx text-center">
                            @if(session()->has('message'))
                                <div class="alert alert-warning">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @php
                                date_default_timezone_set('Europe/Belgrade');
                                $currentDateTime = new DateTime('now'); 
                                $currentDate = $currentDateTime->format('Y-m-d');
                           @endphp
                                 <h2 class="title-head text-uppercase m-b0">Ranking LeaderBoard <br/>
                                    <span> Last Updated: {{ $currentDate }}, {{ $sortedusers->count() }} results</span>
                                </h2>
                        </div>
                </div>
                <div class="row m-t30">
                    <div class="col-md-12 heading-bx left">
                        <div class="table-responsive">

                            <table class="table table-striped score-table">
                                <thead class="table-header">
                                  <tr>
                                    <th scope="col">Position</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Recent Activity</th>
                                    <th scope="col">Total Points</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sortedusers as $key => $u)
                                        <tr>
                                        <td scope="row"><p>{{ $key + 1 }}.</p></td>
                                        <td class="table-name-wrraper">
                                            <span class="table-image-wrraper">
                                                <img src="{{ asset('assets/images/profile/'.$u->photo) }}" alt="photo" />
                                            </span>
                                            <span class="table-name">
                                               {{ $u->username }}
                                            </span>
                                        </td>
                                        <td>
                                            <button 
                                            class="ud-btn ud-btn-primary"
                                             style="margin: 0 auto;" 
                                             data-toggle="modal" 
                                             data-target="#details-modal{{ $u->userID }}"
                                             >View Details
                                            </button>
                                        </td>
                                        <td>
                                           <p> {{ $u->total[0]->total_score }} p</p>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        {{--  --}}
        <!-- Testimonials ==== -->
        <div class="section-area section-sp2" style="background: #f7f9fa;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 heading-bx left">
                        <h4 class="title-head">Take a look at up to date comments from other users</h4>
                    </div>
                </div>
                    <section id="test1-carousel" class="splide" aria-label="Beautiful Images">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($test as $t)
                                <li class="splide__slide">
                                    <div class="item">
                                        <div class="testimonial-bx text-bx">
                                            <div class="text-card">
                                                <div class="testimonial-content">
                                                    <p>{{ $t->text }}</p>
                                                </div>
                                                <div class="testimonial-info" style="display: flex">
                                                    <span>
                                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                    </span>
                                                    <h5 class="name" style="margin-left: 10px">{{ $t->username }}</h5>
                                                </div>
                                                
                                                <span><a
                                                        href="{{ route('lecture_details', ['ID' => $t->LectureID]) }}">{{ $t->name }}</a>
                                                    <i class="fa fa-angle-right"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
            </div>
        </div>
        <!-- Testimonials END ==== -->
        {{-- modal --}}
        @foreach ($users as $u)
            <div class="modal fade bd-example-modal-lg" id="details-modal{{ $u->userID }}"
                 tabindex="-1"
                  role="dialog"
                   aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ $u->username }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Lecture Name</th>
                                <th scope="col">Latest Attempt</th>
                                <th scope="col">Completion Percent</th>
                                <th scope="col">Points</th>
                                <th scope="col">Date</th>

                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($u->scores as $key => $s)
                                    <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $s->lecture_name }}</td>
                                    <td>Attempt: {{ $s->attempt_num }}</td>
                                    <td>{{ $s->completion_precent }} %</td>
                                    <td>{{ $s->score_value }} p</td>
                                    <td>{{ $s->created_at }}</td>

                                    </tr>
                                @endforeach
                             
                            </tbody>
                          </table>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="ud-btn ud-btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>
        @endforeach
        {{-- modal --}}
    </div>
    <!-- Page Content Box END ==== -->
    <script src="{{ asset('splide-4.1.3/dist/js/splide.min.js') }}"></script>
    <script>
          var splide = new Splide('#test1-carousel', {
                perPage: 3,
                rewind: true,
                gap: '1rem',
                breakpoints: {
                    0: {
                        perPage: 1
                    },
                    720: {
                        perPage: 1
                    },
                    1024: {
                        perPage: 2
                    },
                    1200: {
                        perPage: 3
                    }
                }

            });
            splide.mount();
    </script>
</div>
<!-- Page Content Box END ==== -->
@endsection