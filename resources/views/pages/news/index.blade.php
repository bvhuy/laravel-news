@extends('pages.layouts')

@section('seo')
    {!! SEOMeta::generate() !!}

    <!-- Facebook -->
    {!! OpenGraph::generate() !!}

    <!-- Twitter -->
    {!! Twitter::generate() !!}

    {!! JsonLdMulti::generate() !!}
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
                "@type": "ListItem",
                 "position": 1,
                "item":{
                    "@id": "{{ url($categories->pluck('slug')->implode('/')) }}",
                    "name": "{{ $categories->pluck('name')->implode('/') }}"
                }
             }]
        }
    </script>
    <script type="application/ld+json"> 
        { 
            "@context": "http://schema.org", 
            "@type": "NewsArticle", 
            "mainEntityOfPage": { 
                "@type": "WebPage", 
                "@id": "{{ $canonical }}" 
            }, 
            "headline":"{{ $news->title }}", 
            "description":"{{ $news->description }}", 
            "image": { 
                "@type": "ImageObject", 
                "url":" {{ $news->description }}", 
                "width": 900, 
                "height": 540 
            }, 
            "datePublished": "{{ $news->created_at }}", 
            "dateModified": "{{ $news->updated_at }}", 
            "author": { 
                "@type": "Organization", 
                "name": "{{ $website_name }}" 
            }, 
            "publisher":{ 
                "@type": "Organization", 
                "name": "{{ $website_name }}", 
                "logo": { 
                    "@type": "ImageObject", 
                    "url": "{{ $logo }}", 
                    "width": 500, 
                    "height": 112 
                }
            },
            "about": [{{ $news->meta_keyword }}] 
        } 
    </script>
@endsection

@section('css')

@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
        <article class="card news__detail">
            {{ Breadcrumbs::render('category', $category) }}
            <div class="card-header news__topic">
                <h1>
                    {{ $news->title }}
                </h1>
            </div>
            <div class="card-body news__body">
                <h2 class="card-title news__des">
                    {{ $news->description }}
                </h2>
                <div class="news__content">
                    {!! $news->content !!}
                </div>
            </div>
        </article>
        <div class="fn__detail">
            <div class="d-flex align-items-center bd-highlight">
                <div class="p-2 bd-highlight">
                    {{-- <div class="fn__detail__pagination">
                        <ul class="pagination m-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript:;" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:;" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <div class="ms-auto p-2 bd-highlight">
                    <div class="fn__detail__share d-flex align-items-center">
                        <span>Chia sẻ</span>
                        <div class="btn-group btn-group-lg" role="group" aria-label="Basic outlined example">
                            <a href="//www.facebook.com/sharer.php?u={{ $canonical }}" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" class="fn__detail__share__fb">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><linearGradient id="Ld6sqrtcxMyckEl6xeDdMa" x1="9.993" x2="40.615" y1="9.993" y2="40.615" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#2aa4f4"/><stop offset="1" stop-color="#007ad9"/></linearGradient><title>Chia sẻ bài viết lên Facebook</title><path fill="url(#Ld6sqrtcxMyckEl6xeDdMa)" d="M24,4C12.954,4,4,12.954,4,24s8.954,20,20,20s20-8.954,20-20S35.046,4,24,4z"/><path fill="#fff" d="M26.707,29.301h5.176l0.813-5.258h-5.989v-2.874c0-2.184,0.714-4.121,2.757-4.121h3.283V12.46 c-0.577-0.078-1.797-0.248-4.102-0.248c-4.814,0-7.636,2.542-7.636,8.334v3.498H16.06v5.258h4.948v14.452 C21.988,43.9,22.981,44,24,44c0.921,0,1.82-0.084,2.707-0.204V29.301z"/></svg>
                            </a>
                            {{-- <a href="javascript:;" target="_blank" class="fn__detail__share__zl">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 460.1 436.6"><style>.st0{fill:#fdfefe}.st1{fill:#0180c7}.st2{fill:#0172b1}.st3{fill:none;stroke:#0180c7;stroke-width:2;stroke-miterlimit:10}</style><title>Chia sẻ bài viết lên Zalo</title><path class="st0" d="M82.6 380.9c-1.8-.8-3.1-1.7-1-3.5 1.3-1 2.7-1.9 4.1-2.8 13.1-8.5 25.4-17.8 33.5-31.5 6.8-11.4 5.7-18.1-2.8-26.5C69 269.2 48.2 212.5 58.6 145.5 64.5 107.7 81.8 75 107 46.6c15.2-17.2 33.3-31.1 53.1-42.7 1.2-.7 2.9-.9 3.1-2.7-.4-1-1.1-.7-1.7-.7-33.7 0-67.4-.7-101 .2C28.3 1.7.5 26.6.6 62.3c.2 104.3 0 208.6 0 313 0 32.4 24.7 59.5 57 60.7 27.3 1.1 54.6.2 82 .1 2 .1 4 .2 6 .2H290c36 0 72 .2 108 0 33.4 0 60.5-27 60.5-60.3v-.6-58.5c0-1.4.5-2.9-.4-4.4-1.8.1-2.5 1.6-3.5 2.6-19.4 19.5-42.3 35.2-67.4 46.3-61.5 27.1-124.1 29-187.6 7.2-5.5-2-11.5-2.2-17.2-.8-8.4 2.1-16.7 4.6-25 7.1-24.4 7.6-49.3 11-74.8 6zm72.5-168.5c1.7-2.2 2.6-3.5 3.6-4.8 13.1-16.6 26.2-33.2 39.3-49.9 3.8-4.8 7.6-9.7 10-15.5 2.8-6.6-.2-12.8-7-15.2-3-.9-6.2-1.3-9.4-1.1-17.8-.1-35.7-.1-53.5 0-2.5 0-5 .3-7.4.9-5.6 1.4-9 7.1-7.6 12.8 1 3.8 4 6.8 7.8 7.7 2.4.6 4.9.9 7.4.8 10.8.1 21.7 0 32.5.1 1.2 0 2.7-.8 3.6 1-.9 1.2-1.8 2.4-2.7 3.5-15.5 19.6-30.9 39.3-46.4 58.9-3.8 4.9-5.8 10.3-3 16.3s8.5 7.1 14.3 7.5c4.6.3 9.3.1 14 .1 16.2 0 32.3.1 48.5-.1 8.6-.1 13.2-5.3 12.3-13.3-.7-6.3-5-9.6-13-9.7-14.1-.1-28.2 0-43.3 0zm116-52.6c-12.5-10.9-26.3-11.6-39.8-3.6-16.4 9.6-22.4 25.3-20.4 43.5 1.9 17 9.3 30.9 27.1 36.6 11.1 3.6 21.4 2.3 30.5-5.1 2.4-1.9 3.1-1.5 4.8.6 3.3 4.2 9 5.8 14 3.9 5-1.5 8.3-6.1 8.3-11.3.1-20 .2-40 0-60-.1-8-7.6-13.1-15.4-11.5-4.3.9-6.7 3.8-9.1 6.9zm69.3 37.1c-.4 25 20.3 43.9 46.3 41.3 23.9-2.4 39.4-20.3 38.6-45.6-.8-25-19.4-42.1-44.9-41.3-23.9.7-40.8 19.9-40 45.6zm-8.8-19.9c0-15.7.1-31.3 0-47 0-8-5.1-13-12.7-12.9-7.4.1-12.3 5.1-12.4 12.8-.1 4.7 0 9.3 0 14v79.5c0 6.2 3.8 11.6 8.8 12.9 6.9 1.9 14-2.2 15.8-9.1.3-1.2.5-2.4.4-3.7.2-15.5.1-31 .1-46.5z"/><path class="st1" d="M139.5 436.2c-27.3 0-54.7.9-82-.1-32.3-1.3-57-28.4-57-60.7 0-104.3.2-208.6 0-313C.5 26.7 28.4 1.8 60.5.9c33.6-.9 67.3-.2 101-.2.6 0 1.4-.3 1.7.7-.2 1.8-2 2-3.1 2.7-19.8 11.6-37.9 25.5-53.1 42.7-25.1 28.4-42.5 61-48.4 98.9-10.4 66.9 10.5 123.7 57.8 171.1 8.4 8.5 9.5 15.1 2.8 26.5-8.1 13.7-20.4 23-33.5 31.5-1.4.8-2.8 1.8-4.2 2.7-2.1 1.8-.8 2.7 1 3.5.4.9.9 1.7 1.5 2.5 11.5 10.2 22.4 21.1 33.7 31.5 5.3 4.9 10.6 10 15.7 15.1 2.1 1.9 5.6 2.5 6.1 6.1z"/><path class="st2" d="M139.5 436.2c-.5-3.5-4-4.1-6.1-6.2-5.1-5.2-10.4-10.2-15.7-15.1-11.3-10.4-22.2-21.3-33.7-31.5-.6-.8-1.1-1.6-1.5-2.5 25.5 5 50.4 1.6 74.9-5.9 8.3-2.5 16.6-5 25-7.1 5.7-1.5 11.7-1.2 17.2.8 63.4 21.8 126 19.8 187.6-7.2 25.1-11.1 48-26.7 67.4-46.2 1-1 1.7-2.5 3.5-2.6.9 1.4.4 2.9.4 4.4v58.5c.2 33.4-26.6 60.6-60 60.9h-.5c-36 .2-72 0-108 0H145.5c-2-.2-4-.3-6-.3z"/><path class="st1" d="M155.1 212.4c15.1 0 29.3-.1 43.4 0 7.9.1 12.2 3.4 13 9.7.9 7.9-3.7 13.2-12.3 13.3-16.2.2-32.3.1-48.5.1-4.7 0-9.3.2-14-.1-5.8-.3-11.5-1.5-14.3-7.5s-.8-11.4 3-16.3c15.4-19.6 30.9-39.3 46.4-58.9.9-1.2 1.8-2.4 2.7-3.5-1-1.7-2.4-.9-3.6-1-10.8-.1-21.7 0-32.5-.1-2.5 0-5-.3-7.4-.8-5.7-1.3-9.2-7-7.9-12.6.9-3.8 3.9-6.9 7.7-7.8 2.4-.6 4.9-.9 7.4-.9 17.8-.1 35.7-.1 53.5 0 3.2-.1 6.3.3 9.4 1.1 6.8 2.3 9.7 8.6 7 15.2-2.4 5.7-6.2 10.6-10 15.5-13.1 16.7-26.2 33.3-39.3 49.8-1.1 1.3-2.1 2.6-3.7 4.8z"/><path class="st1" d="M271.1 159.8c2.4-3.1 4.9-6 9-6.8 7.9-1.6 15.3 3.5 15.4 11.5.3 20 .2 40 0 60 0 5.2-3.4 9.8-8.3 11.3-5 1.9-10.7.4-14-3.9-1.7-2.1-2.4-2.5-4.8-.6-9.1 7.4-19.4 8.7-30.5 5.1-17.8-5.8-25.1-19.7-27.1-36.6-2.1-18.3 4-33.9 20.4-43.5 13.6-8.1 27.4-7.4 39.9 3.5zm-35.4 36.5c.2 4.4 1.6 8.6 4.2 12.1 5.4 7.2 15.7 8.7 23 3.3 1.2-.9 2.3-2 3.3-3.3 5.6-7.6 5.6-20.1 0-27.7-2.8-3.9-7.2-6.2-11.9-6.3-11-.7-18.7 7.8-18.6 21.9zM340.4 196.9c-.8-25.7 16.1-44.9 40.1-45.6 25.5-.8 44.1 16.3 44.9 41.3.8 25.3-14.7 43.2-38.6 45.6-26.1 2.6-46.8-16.3-46.4-41.3zm25.1-2.4c-.2 5 1.3 9.9 4.3 14 5.5 7.2 15.8 8.6 23 3 1.1-.8 2-1.8 2.9-2.8 5.8-7.6 5.8-20.4.1-28-2.8-3.8-7.2-6.2-11.9-6.3-10.8-.6-18.4 7.6-18.4 20.1zM331.6 177c0 15.5.1 31 0 46.5.1 7.1-5.5 13-12.6 13.2-1.2 0-2.5-.1-3.7-.4-5-1.3-8.8-6.6-8.8-12.9v-79.5c0-4.7-.1-9.3 0-14 .1-7.7 5-12.7 12.4-12.7 7.6-.1 12.7 4.9 12.7 12.9.1 15.6 0 31.3 0 46.9z"/><path class="st0" d="M235.7 196.3c-.1-14.1 7.6-22.6 18.5-22 4.7.2 9.1 2.5 11.9 6.4 5.6 7.5 5.6 20.1 0 27.7-5.4 7.2-15.7 8.7-23 3.3-1.2-.9-2.3-2-3.3-3.3-2.5-3.5-3.9-7.7-4.1-12.1zM365.5 194.5c0-12.4 7.6-20.7 18.4-20.1 4.7.1 9.1 2.5 11.9 6.3 5.7 7.6 5.7 20.5-.1 28-5.6 7.1-16 8.3-23.1 2.7-1.1-.8-2-1.8-2.8-2.9-3-4.1-4.4-9-4.3-14z"/><path class="st3" d="M66 1h328.1c35.9 0 65 29.1 65 65v303c0 35.9-29.1 65-65 65H66c-35.9 0-65-29.1-65-65V66C1 30.1 30.1 1 66 1z"/></svg>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card news__related">
            <div class="card-header news__related__title">
                <h2><a href="">Tin liên quan</a></h2>
            </div>
            <div class="news__related__content">
                <ul class="list-group list-group-flush">
                    @if (count($news_related))
                        @foreach ($news_related as $new_related)
                        <li class="list-group-item">
                            <div class="news__related__link">
                                <h2><a title="{{ $new_related->title }}" href="{{ route('news', ['slug' => $new_related->slug, 'id' => $new_related->id]) }}">{{ $new_related->title }}</a></h2>
                            </div>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="row">
            @if (count($news_related_other))
            @foreach ($news_related_other as $new_related_other)
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="card news__detail-cl">
                    <a title="{{ $new_related_other->title }}" href="{{ route('news', ['slug' => $new_related_other->slug, 'id' => $new_related_other->id]) }}" class="news__detail-cl__link">
                        <div class="card-header news__detail-cl__title">
                            <h4 class="text-truncate-2-lines">
                                {{ $new_related_other->title }}
                            </h4>
                        </div>
                        <div class="row g-0 d-flex align-items-center">
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="news__detail-cl__thumbnail">
                                    <img alt="{{ $new_related_other->title }}" src="{{ $new_related_other->thumbnail }}">
                                </div>
                            </div>
                            <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                <div class="card-body news__detail-cl__content">
                                    <p class="card-text news__detail-cl__des text-truncate-3-lines">
                                        {{ $new_related_other->description }}
                                    </p>
                                    <p class="card-text news__detail-cl__time">
                                        <small class="text-muted">{{ $new_related_other->created_at->diffForHumans() }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4" id="news-rt__sidebar">
        <div class="card news-right__sidebar">
            <div class="card-header news-right__sidebar__topic">
                <h2><a href="javascript:;">Tin xem nhiều</a></h2>
            </div>
        </div>
        <div class="row">
            @if (isset($news_view_more_first))
            <div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 col-xxl-12">
                <div class="card news-rt__sidebar">
                    <a title="{{ $news_view_more_first->title }}" href="{{ route('news', ['slug' => $news_view_more_first->slug, 'id' => $news_view_more_first->id]) }}">
                        <div class="card-header news-rt__sidebar__title">
                            <h4 class="text-truncate-2-lines">
                                {{ $news_view_more_first->title }}
                            </h4>
                        </div>
                        <div class="row g-0 d-flex align-items-center">
                            <div class="col-4 col-sm-4 col-md-12 col-lg-4 col-xl-5 col-xxl-12">
                                <div class="news-rt__sidebar__thumbnail">
                                    <img alt="{{ $news_view_more_first->title }}" src="{{ $news_view_more_first->thumbnail }}">
                                </div>
                            </div>
                            <div class="col-8 col-sm-8 col-md-12 col-lg-8 col-xl-7 col-xxl-12">
                                <div class="card-body news-rt__sidebar__content">
                                    <p class="card-text news-rt__sidebar__des text-truncate-3-lines">
                                        {{ $news_view_more_first->description }}
                                    </p>
                                    <p class="card-text news-rt__sidebar__time">
                                        <small class="text-muted">{{ $news_view_more_first->created_at->diffForHumans() }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endif
           
            <div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 col-xxl-12">
                <div class="card news-rc__sidebar">
                    <div class="news-rc__sidebar__content">
                        <ul class="list-group list-group-flush">
                            @if (count($news_view_more))
                                @foreach ($news_view_more as $new_view_more)
                                <li class="list-group-item">
                                    <div class="news-rc__sidebar__link">
                                        <h2>
                                            <a title=" {{ $new_view_more->title }}" href="{{ route('news', ['slug' => $new_view_more->slug, 'id' => $new_view_more->id]) }}">
                                                {{ $new_view_more->title }}
                                            </a>
                                        </h2>
                                    </div>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('assets/home/js/ResizeSensor.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/home/js/theia-sticky-sidebar.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/home/js/news/app.js')}}"></script>
@endsection