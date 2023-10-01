<div class="pagination-bx rounded-sm gray clearfix">
    <ul class="pagination">
        {{$lectures->links('vendor.pagination.bootstrap-5')}}
    </ul>
</div>

@foreach ($lectures as  $l)
    <div class="blog-post blog-md clearfix">
        <div class="ttr-post-media"> 
            <a href="#"><img src="{{ asset('assets/images/historical_data/'.$l->cover_image) }}" alt="cover_image"></a> 
        </div>
        <div class="ttr-post-info">
            <ul class="media-post">
                <li><a href="#"><i class="fa fa-calendar"></i>{{ $l->created_at }}</a></li>
                <li><a href="#"><i class="fa fa-file"></i>{{ $l->difficulty }} - {{ $l->price }}$</a></li>
            </ul>
            <h5 class="post-title"><a href="blog-details.html">{{ $l->lecture_name }}</a></h5>
            <p>Knowing that, you’ve optimised your pages countless amount of times, written tons.</p>
            <div class="post-extra">
                <a href="#" class="btn-link">READ MORE</a>
                <a href="#" class="comments-bx"><i class="fa fa-comments-o"></i>05 Comment</a>
            </div>
        </div>
    </div>

@endforeach
