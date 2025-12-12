@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h1 class="display-5">{{ $course->title }}</h1>
                    <p class="text-muted">
                        Instructor: <strong>{{ $course->instructor->name }}</strong>
                    </p>
                </div>
                @auth
                    @if(auth()->user()->isStudent())
                        <div class="d-flex gap-2">
                            <form method="POST" action="{{ route('bookmarks.toggle', $course) }}">
                                @csrf
                                <button type="submit" class="btn {{ $isBookmarked ? 'btn-warning' : 'btn-outline-warning' }}">
                                    {{ $isBookmarked ? '★ Bookmarked' : '☆ Bookmark' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('bookmarks.complete', $course) }}">
                                @csrf
                                <button type="submit" class="btn {{ $isCompleted ? 'btn-success' : 'btn-outline-success' }}">
                                    {{ $isCompleted ? '✓ Completed' : 'Mark Complete' }}
                                </button>
                            </form>
                        </div>
                    @elseif(auth()->user()->id === $course->instructor_id)
                        <div class="d-flex gap-2">
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Edit Course</a>
                            <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Are you sure you want to delete this course?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <hr>

            <div class="mb-4">
                <h4>Course Description</h4>
                <p class="lead">{{ $course->description }}</p>
            </div>

            <hr>

            <div class="mb-4">
                <h4>Course Content</h4>
                <div style="white-space: pre-wrap;">{{ $course->content }}</div>
            </div>

            <hr>

            <div class="text-muted small">
                <p>Created: {{ $course->created_at->format('F d, Y') }}</p>
                <p>Last Updated: {{ $course->updated_at->format('F d, Y') }}</p>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('courses.index') }}" class="btn btn-link">← Back to Courses</a>
    </div>
</div>
@endsection