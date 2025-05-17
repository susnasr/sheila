@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="mb-4">Sheila Blog</h1>

                @foreach($posts as $post)
                    <div class="card mb-4">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text text-muted">
                                Posted on {{ $post->published_at->format('F j, Y') }} by {{ $post->author->name }} in
                                <a href="{{ route('blog.category', $post->category->slug) }}">{{ $post->category->name }}</a>
                            </p>
                            <p class="card-text">{{ Str::limit(strip_tags($post->content), 200) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links() }}
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog.category', $category->slug) }}">
                                        {{ $category->name }} ({{ $category->posts_count }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
