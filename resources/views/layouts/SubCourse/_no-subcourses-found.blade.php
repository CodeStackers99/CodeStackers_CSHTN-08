<div class=" section d-flex flex-row justify-content-center align-items-center section-divider">
    <div class="text">
        <h2><strong class="text-hblack text-capitalize text-center sub-heading">No Subcourses found :(</strong></h2>
        @auth
            @if (auth()->user()->isAdmin()||auth()->user()->isTeacher())
                <div class="button text-center">
                    <a
                        href="{{ route('courses.subcourses.create', $course->slug) }}"
                        class="styled-btn styled-rounded text-muted border border-dark p-1" style="text-decoration:none">
                        <span class="styled-button-text">Create Subcourse</span>
                    </a>
                </div>
            @endif
        @endauth
    </div>
    <img src="{{asset('images/others/not_found.png')}}" alt="No-Results-Found" class="no-result-found-img">
</div>
