@extends('dashboard.layouts.layout')

@section('dashboard.content')
    <main class="ttr-wrapper">
        <div class="container-fluid">
            <div class="db-breadcrumb">
                <h4 class="breadcrumb-title">Log File Messages</h4>
                <ul class="db-breadcrumb-list">
                    <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                    <li>Log File Messages</li>
                </ul>
            </div>
            <div class="row">
                <!-- Your Profile Views Chart -->
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <div class="email-wrapper">
                            <div class="email-menu-bar">
                                <div class="compose-mail">
                                </div>
                                <div class="email-menu-bar-inner">
                                    <form action="{{ route('log_file_msg') }}" method="GET">
                                        <ul>
                                            <li class="m-b20">
                                                <select class="form-select" aria-label="Default select example"
                                                    id="sort-item" name="username">
                                                    <option value="0" selected>Pick a User</option>
                                                    @foreach ($users as $u)
                                                        <option value="{{ $u->username }}">
                                                            <i class="fa fa-user"></i>{{ $u->username }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="m-b20">
                                                <select class="form-select" aria-label="Default select example"
                                                     name="current_time">
                                                    <option value="0" selected>Pick a Timeframe</option>
                                                        <option value="month">
                                                            <i class="fa fa-clock"></i>Current Month
                                                        </option>
                                                        <option value="week_span">
                                                            <i class="fa fa-clock"></i>Current Week
                                                        </option>
                                                </select>
                                            </li>
                                            <li  class="m-b20">
                                                <div class="mail-search-bar">
                                                    @csrf
                                                    <label style="font-size: 12px; color:gray;">Pick a Specific Date</label>
                                                    <input type="date" class="form-control" name="sortdate" />
                                                </div>
                                            </li>
                                            <li class="m-b20">
                                                <input type="submit" class="ud-btn ud-btn-primary" value="use filters" style="width: 100%"/>
                                               <a href="{{ route('log_file_msg') }}" >Cancel</a>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <div class="mail-list-container">
                                <div class="mail-toolbar">

                                </div>
                                <div class="mail-box-list">
                                    @foreach ($log_data as $l)
                                        <div class="mail-list-info">
                                            <div class="mail-list-title">
                                                <h6>{{ $l->username }}</h6>
                                            </div>
                                            <div class="mail-list-title-info"
                                                style="display: flex;justify-content:space-evenly;">
                                                <p>{{ $l->role }}</p>
                                                <p>{{ $l->route }}</p>
                                                <p>{{ $l->ip }}</p>
                                                <p>{{ $l->message }}</p>
                                            </div>
                                            <div class="mail-list-time">
                                                <span>{{ $l->date }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Your Profile Views Chart END-->
            </div>
        </div>
    </main>
@endsection
