@extends('layouts.frontend')

@section('content')
	<!-- Stunning Header -->
	<div class="stunning-header stunning-header-bg-lightviolet">
		<div class="stunning-header-content">
		    <h1 class="stunning-header-title">Category: {{ $category->name }}</h1>
		</div>
	</div>


    <div class="container">
        <div class="row medium-padding120">
            <main class="main"> 
                <div class="row">
                    @if($category->posts->count()) 
                        @foreach($category->posts as $post)
                            <a href="{{ route('main.single-post', ['slug' => $post->slug]) }}">
                                <div class="case-item-wrap">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="case-item">
                                            <div class="case-item__thumb">
                                                <img src="{{ $post->featured }}" alt="{{ $post->featured }}">
                                            </div>
                                            <h6 class="case-item__title">
                                                <a href="{{ route('main.single-post', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php $count+=1; ?>

                        @if( $count >= 3 )
                            <?php $count = 0; ?>
                            </div> <br><br>
                            <div class="row">
                        @endif
                        @endforeach
                    @endif
                    @if( $count < 3 )
                        </div>
                    @endif

                <!-- End Post Details -->
                <br>
                <br>
                <br>
                <!-- Sidebar-->

                <div class="col-lg-12">
                    <aside aria-label="sidebar" class="sidebar sidebar-right">
                        <div  class="widget w-tags">
                            <div class="heading text-center">
                                <h4 class="heading-title">ALL BLOG TAGS</h4>
                                <div class="heading-line">
                                    <span class="short-line"></span>
                                    <span class="long-line"></span>
                                </div>
                            </div>

                            <div class="tags-wrap">
                                @foreach($tags as $tag)
                                    <a href="{{ route('main.tag',['id'=>$tag->id]) }}" class="w-tags-item">{{ $tag->tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </main>
        </div>
    </div>
@stop