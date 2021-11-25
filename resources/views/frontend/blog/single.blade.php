@extends('frontend.layouts.app')
@section('content')

<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">
            <h3>{{$blog->title}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="">
                <img src="{{asset('/admin/upload/blog/avatar/'.$blog->image)}}" alt="">
            </a>
            <p>
                {{$blog->description}}</p> <br>

            {!! $blog->content !!}
            <div class="pager-area">

                <ul class="pager pull-right">
                    @if ($blog->id == $min)
                    <li style="visibility: hidden"><a href="{{URL::to('/blog-single/'.$previous)}}">Pre</a></li>
                    @else
                    <li><a href="{{URL::to('/blog-single/'.$previous)}}">Pre</a></li>
                    @endif
                    </li>
                    @if ($blog->id == $max)
                    <li style="visibility: hidden"><a href="{{URL::to('/blog-single/'.$next)}}">Next</a>
                        @else
                    <li><a href="{{URL::to('/blog-single/'.$next)}}">Next</a>
                        @endif


                </ul>
            </div>
        </div>
    </div>
    <!--/blog-post-area-->

    <div class="rating-area">
        {{-- <ul class="ratings">
            <li class="rate-this">Rate this item:</li>
            <li>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </li>
            <li class="color">(6 votes)</li>
        </ul> --}}
        {{-- <form role="form" action="{{URL::to    ('/vote/'.$blog->id)}}" method="post">
            @csrf
            <div class="rate">
                <div class="vote">
                    <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                    <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                    <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                    <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                    <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                    <span class="rate-np">4.5</span>
                </div>
            </div>
            <button class="btn btn-success">Save Blog</button>
        </form> --}}
        {{-- <ul class="list-inline" title="danh gia">
            @for ($count = 1; $count <= 5; $count++) @php if($count <=$rating){ $color='color:#ffcc00' ; } else {
                $color='color:#ccc' ; } @endphp <li title="danh gi sao" id="" data-index="" data-prodcut_id="
                " data-rating="" class="rating" style="cursor: pointer; {{$color}} font-size: 50px ">
                &#9733
                </li>
                <li style="cursor: pointer; {{$color}} ;fom"></li>
                <li style="font-size: 50px;color: aqua"></li>
                @endfor
        </ul> --}}
        <ul class="list-inline" title="danh gia">
            @for ($count = 1; $count <= 5; $count++) @php if($count <=$rating) { $color='color:#ffcc00' ; } else {
                $color='color:#ccc' ; } @endphp <li id="{{$blog->id}}-{{$count}}" data-index="{{$count}}"
                data-blog_id="{{$blog->id}}" data-rating="{{$rating}}" class="rating"
                style="cursor: pointer; font-size: 30px; {{$color}} "> &#9733
                </li>
                @endfor
        </ul>
        <ul class=" tag">
            <li>TAG:</li>
            <li><a class="color" href="">Pink <span>/</span></a></li>
            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
            <li><a class="color" href="">Girls</a></li>
        </ul>
    </div>
    <!--/rating-area-->

    <div class="socials-share">
        <a href=""><img src="{{asset('frontend/images/blog/socials.png')}}" alt=""></a>
    </div>
    <!--/socials-share-->
    <div class="response-area">
        <h2>3 RESPONSES</h2>
        <ul class="media-list">

            {{-- @foreach ($getBlogDetail['comment'] as $item =>$cmt )
            {{ $cmt["id"] }}
            {{ $cmt['name'] }}
            {{ $cmt['level'] }}
            @endforeach --}}
            @foreach ($comment as $key =>$a)
            <li class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" style="max-height: 80px"
                        src="{{asset('admin/upload/user/avatar/'.$a['image'])}}" alt="">
                </a>
                <div class="media-body">
                    <ul class="sinlge-post-meta">
                        <li><i class="fa fa-user"></i>{{ $a->name }}</li>
                        <li><i class="fa fa-clock-o"></i>{{$a->created_at}}</li>
                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                    </ul>
                    <p>{{ $a->content }}</p>
                    <a id="{{$a->id}}" class="btn btn-primary idcomment" href="#content"><i
                            class="fa fa-reply"></i>Replay</a>
                </div>
            </li>
            @foreach ($comment as $key =>$b)
            @if ($b->level == $a->id )
            <li class="media second-media">
                <a class="pull-left" href="#">
                    <img class="media-object" style="max-height: 80px"
                        src={{asset('admin/upload/user/avatar/'.$b->image)}} alt="">
                </a>
                <div class=" media-body">
                    <ul class="sinlge-post-meta">
                        <li><i class="fa fa-user"></i></li>
                        <li><i class="fa fa-clock-o"></i>{{$b->created_at}}</li>
                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>

                    </ul>
                    <p>{{$b->content}}</p>
                    <a id="{{$b->id}}" class="btn btn-primary idcomment" href="#content"><i
                            class="fa fa-reply"></i>Replay</a>
                </div>
            </li>
            @endif
            @endforeach
            @endforeach


        </ul>
    </div>
    <div class="replay-box">
        <div class="row">
            <div class="col-sm-4">
                <h2>Leave a replay</h2>
            </div>
            <div class="col-sm-12">
                <div class="text-area">
                    <form action="{{URL::to('/post-comment/'.$blog->id)}}" method="post">
                        @csrf
                        <div class="blank-arrow">
                            <label>Your Comment</label>
                        </div>
                        <span>*</span>
                        <input type="hidden" name="id_comment" id="id_comment">
                        <textarea name="content" id="content" rows="11" class="comment">
                        </textarea>
                        <button class="btn btn-primary comment">Post comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/Repaly Box-->
</div>
<script>
    $(document).on('click', '.comment', function(){
            var checkLogin = "{{Auth::check()}}";
                //  console.log(checkLogin)
            if (!checkLogin) {
                alert('Đăng nhập để bình luận');
            } 
        });
    $(document).on('click', '.idcomment', function(){
            var checkLogin = "{{Auth::check()}}";
                //  console.log(checkLogin)
            if (!checkLogin) {
                alert('Đăng nhập để bình luận');
            } else {
                id = $(this).attr('id');
                $("input#id_comment").val(id);
            }
        });
</script>
@endsection