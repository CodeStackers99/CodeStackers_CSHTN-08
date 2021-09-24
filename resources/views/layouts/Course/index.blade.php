@extends('layouts.app')

@section('title', 'Courses | WebAcquire')

@section('content')

    <div class="d-flex flex-row justify-content-between section-divider">

        @include('layouts.partials._sidebar')

        <div class="container">

            <div class="section courses reveal">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-center mt-3 mb-3 ml-5  mr-5">
                        <h2 class="text-hblack font-weight-bold text-capitalize text-center sub-heading">Learn anything, anytime, anywhere to do discover yourself</h2>
                        <span class="my-underline"></span>
                    </div>
                    <div class="d-flex justify-content-between section-divider align-items-center">
                        <div class="image col-md-6">
                            <img src="{{asset('images/others/courses.png')}}" alt="" width="100%" class="">
                        </div>
                        <div class="content d-flex flex-column col-md-6">
                            <h1>
                                <strong
                                    class="font-weight-bolder text-orange">
                                        Unleash
                                </strong>
                            </h1>
                            <h1>
                                <strong
                                    class="font-weight-bolder text-hblack">
                                        Your Learning
                                </strong>
                            </h1>
                            <h1>
                                <strong
                                    class="font-weight-bolder text-hblack">
                                        Online
                                </strong>
                            </h1>
                            <p class="font-italic">
                                <strong
                                    class="text-hblack">
                                    Online courses by certified and verified intructors. Sign up for free, and discover the new YOU.
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section courses reveal">
                <div class="d-flex flex-column col-md-16">
                    <div class="d-flex flex-row justify-content-center mt-3 mb-3 ml-5  mr-5">
                        <h2 class="text-hblack font-weight-bold text-capitalize sub-heading">Courses</h2>
                        <span class="my-underline"></span>
                    </div>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="button d-flex justify-content-end">
                                <a
                                    href="{{ route('courses.create') }}"
                                    class="styled-btn styled-rounded text-muted border border-dark " style="text-decoration:none">
                                    <span class="styled-button-text">Create Course</span>
                                </a>
                            </div>
                        @endif
                    @endauth
                    @if ($courses->count() > 0)
                        <div class="row justify-content-between section-divider col-md-12 ">
                            @foreach ($courses as $course)
                                <div
                                    class="card my-card mt-4 col-md-5 p-2 pt-3 pb-3 rounded  my-card-border my-card-border-radius
                                    d-flex flex-column ">
                                    <div class="image text-center p-1">
                                        <img src="{{ $course->image_path }}" alt="{{$course->name}}" width="420px" height="260px" class="course-img">
                                    </div>
                                    <h4 class="mt-3 text-hblack font-weight-bold text-center text-capitalize border-bottom pb-2">
                                        <a href="{{ route('courses.show', $course->slug)}}" class="text-hblack nav-link my-nav-link-hblack p-0">{{$course->name}}</a>
                                    </h4>
                                    <p class="m-0 p-2 text-hblack">{{ Str::limit($course->description, 250 ) }}</p>
                                    @auth
                                        @if (auth()->user()->isAdmin())
                                            <div class="d-flex flex-row justify-content-between">
                                                @can('update', $course)
                                                    <a href="{{ route('courses.edit', $course->slug) }}" class="btn btn-info">
                                                        Edit <i class="fa fa-edit fa-lg"></i>
                                                    </a>
                                                @endcan
                                                @can('delete', $course)
                                                    <button
                                                        class="btn btn btn-danger"
                                                        onclick="displayModalToDeleteCourse('{{ $course->slug }}')"
                                                        data-toggle="modal"
                                                        data-target="#deleteModalForCourse"
                                                        title="Delete your Course">
                                                        Delete <i class="fa fa-trash" ></i>
                                                    </button>
                                                @endcan
                                            </div>
                                        @endif
                                        <a href="{{ route('courses.subcourses.index', $course->slug) }}" class="btn btn-orange mt-2">
                                            View Subcourses <i class="fa fa-files-o fa-lg"></i>
                                        </a>
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    @else
                        @include('layouts.Course._no-courses-found')
                    @endif
                </div>
            </div>
            @include('layouts.Course._delete-modal')
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        new RevealScroll($(".reveal"), "60%");
    </script>

    <script>
        function displayModalToDeleteCourse(courseSlug) {
            var url = "/courses/" + courseSlug;
            $("#deleteCourseForm").attr('action', url);
        }
    </script>
@endsection
