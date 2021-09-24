@extends('layouts.app')

@section('title', $course->name .' | WebAcquire')

@section('content')

    <div class="d-flex flex-row justify-content-between section-divider">

        @include('layouts.partials._sidebar')

        <div class="container">

            <div class="section courses reveal">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-center mt-3 mb-3 ml-5  mr-5">
                        <h2 class="text-hblack font-weight-bold text-capitalize text-center sub-heading">{{ $course->name }}</h2>
                        <span class="my-underline"></span>
                    </div>
                    <div class="d-flex justify-content-between section-divider align-items-center">
                        <div class="image col-md-6">
                            <img src="{{asset($course->image_path)}}" alt="" width="100%" class="">
                        </div>
                        <div class="content d-flex flex-column col-md-6">
                            <p class="font-italic">
                                <strong
                                    class="text-hblack">
                                    {{$course->description}}
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section subcourses reveal">
                <div class="d-flex flex-column col-md-16">
                    <div class="d-flex flex-row justify-content-center mt-3 mb-3 ml-5  mr-5">
                        <h2 class="text-hblack font-weight-bold text-capitalize sub-heading">Sub Courses</h2>
                        <span class="my-underline"></span>
                    </div>
                    @auth
                        @if(auth()->user()->isAdmin() || auth()->user()->isTeacher())
                            <div class="button d-flex justify-content-end">
                                <a
                                    href="{{ route('courses.subcourses.create', $course->slug) }}"
                                    class="styled-btn styled-rounded text-muted border border-dark " style="text-decoration:none">
                                    <span class="styled-button-text">Create Subcourse</span>
                                </a>
                            </div>
                        @endif
                    @endauth
                    @if ($subcourses->count() > 0)
                        <div class="row justify-content-between section-divider col-md-12 ">
                            @foreach ($subcourses as $subcourse)
                                <div
                                    class="card my-card mt-4 col-md-5 p-2 rounded  my-card-border-radius
                                    d-flex flex-column ">

                                    <img src="{{ asset($subcourse->image_path) }}" alt="{{$subcourse->name}}" width="400px" height="260px" class="p-1 m-auto course-img">

                                    <div class="d-flex justify-content-between flex-row mt-2">
                                        <h6 class=" text-hblack font-weight-bold text-capitalize">
                                            <a
                                                href="{{ route('courses.subcourses.show', [$course->slug , $subcourse->slug])}}" class="text-hblack nav-link my-nav-link-hblack p-0">{{$subcourse->name}}
                                            </a>
                                        </h6>
                                        <h6 class="text-hblack">
                                            <a href="{{ route('courses.subcourses.show', [$course->slug , $subcourse->slug]) }}" class="text-hblack nav-link my-nav-link-hblack p-0">
                                                <i class="fa fa-podcast text-hblack"></i>
                                                Playlists({{ $subcourse->playlists->count()}})</a>
                                        </h6>
                                    </div>
                                    <span class="border-top subcourse-border"></span>

                                    <p class="text-hblack ">{!!Str::limit($subcourse->description, 250)!!}</p>

                                    @auth
                                        <div class="d-flex flex-row justify-content-between">
                                                @can('update', $subcourse)
                                                    <a href="{{ route('courses.subcourses.edit', [ $course->slug, $subcourse->slug ]) }}" class="btn btn-info">
                                                        Edit <i class="fa fa-edit fa-lg"></i>
                                                    </a>
                                                @endcan
                                                @can('delete', $subcourse)
                                                    <button
                                                        class="btn btn btn-danger"
                                                        onclick="displayModalToDeleteSubCourse('{{$course->slug}}', '{{$subcourse->slug}}')"
                                                        data-toggle="modal"
                                                        data-target="#deleteModalForSubCourse"
                                                        title="Delete your Subcourse">
                                                        Delete <i class="fa fa-trash" ></i>
                                                    </button>
                                                @endcan
                                            </div>
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    @else
                        @include('layouts.SubCourse._no-subcourses-found')
                    @endif
                </div>
            </div>
            @include('layouts.subcourse._delete-modal')
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        new RevealScroll($(".reveal"), "60%");
    </script>

    <script>
        function displayModalToDeleteSubCourse(courseSlug, subcourseSlug) {
            var url = "/courses/" + courseSlug + "/subcourses/" + subcourseSlug;
            $("#deleteSubCourseForm").attr('action', url);
        }
    </script>
@endsection
