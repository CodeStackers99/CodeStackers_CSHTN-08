<div class=" section d-flex flex-row justify-content-center align-items-center section-divider">
    <div class="text">
        <h2><strong class="text-hblack text-capitalize text-center sub-heading">No Courses found :(</strong></h2>
        @auth
            @if (auth()->user()->isAdmin())
                <div class="button text-center">
                    <a
                        href="{{ route('courses.create') }}"
                        class="styled-btn styled-rounded text-muted border border-dark p-1" style="text-decoration:none">
                        <span class="styled-button-text">Create Course</span>
                    </a>
                </div>
            @endif
        @endauth
    </div>
    <img src="{{asset('images/others/not_found.png')}}" alt="No-Results-Found" class="no-result-found-img">
</div>
