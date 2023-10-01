@extends('dashboard.layouts.layout')

@section('dashboard.content')
    <!--Main container start -->
    <main class="ttr-wrapper">
        <div class="container-fluid">
            <div class="db-breadcrumb">
                <h4 class="breadcrumb-title">List Views Calendar</h4>
                <ul class="db-breadcrumb-list">
                    <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                    <li>List Views Calendar</li>

                </ul>
            </div>
            <div class="row">
                <!-- Your Profile Views Chart -->
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <div class="wc-title">
                            <h4>List Views Calendar</h4>
                        </div>
                        <div class="widget-inner">
							<div class="row">
								<div class="col-lg-9 col-sm-12" style="margin: 1rem auto;">
									<a href="{{ route("u_calendar_event_form") }}" class="ud-btn ud-btn-primary"> Add New Event</a>
								</div>
								
                                <div class="col-lg-9 col-sm-12" style="margin: 0 auto;">
                                    <div id="calendar"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Your Profile Views Chart END-->
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            // today = mm + '/' + dd + '/' + yyyy;
            today = yyyy + '-' + mm + "-" + dd;

				var cal_events = @json($calendar);

				const propertiesToExclude = ["created_at"];

				// Function to convert each object in the original array to the desired format
				const convertToObjectFormat = (obj) => {
				const { created_at, ...copyObject } = obj;
				return {
					title: copyObject.name,
					start: `${copyObject.start_date}T${copyObject.start_time}`,
					end: `${copyObject.end_date}T${copyObject.end_time}`,
				};
				};

				// Create a new array with objects in the desired format
				const newArray = cal_events.map(convertToObjectFormat);

				console.log(newArray);

            $('#calendar').fullCalendar({

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month, listWeek, ,listDay'
                },

                // customize the button names,
                // otherwise they'd all just say "list"
                views: {
                    listDay: {
                        buttonText: 'list day'
                    },
                    listWeek: {
                        buttonText: 'list week'
                    }
                },

                defaultView: 'listWeek',
                defaultDate: today,
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events:
				// array givven by the back-end and processed (newArray)
				  newArray
				 
            });

        });
    </script>
@endsection
