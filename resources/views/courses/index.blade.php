@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h1 class="display-4">Browse Courses</h1>
        <p class="text-muted">Explore our collection of courses</p>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <form method="GET" action="{{ route('courses.index') }}" class="row g-2">
            <div class="col-md-10">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search courses..." 
                    class="form-control"
                >
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
            @if(request('search'))
                <div class="col-12">
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">Clear Search</a>
                </div>
            @endif
        </form>
    </div>

    <!-- Courses Grid -->
    @if($courses->count() > 0)
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="text-muted small mb-2">By {{ $course->instructor->name }}</p>
                            <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <small class="text-muted">Created {{ $course->created_at->diffForHumans() }}</small>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary btn-sm float-end">
                                View Course
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            <h4>No courses found.</h4>
            @if(request('search'))
                <p>Try a different search term.</p>
            @endif
        </div>
    @endif
</div>
@endsection