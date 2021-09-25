<div class="sidebar section">
    <ul>
        <li class="my-list my-list-shadow my-list-border @if (request()->is('dashboard')) my-list-active @endif ">
            <a  href="{{ route('dashboard') }}"
                class="d-block nav-link">
                <i class="fa fa-th-large pr-2" aria-hidden="true"></i> Dashboard
            </a>
        </li>
        <li class="my-list my-list-shadow my-list-border @if (request()->is('courses')) my-list-active @endif ">
            <a  href="{{ route('courses.index') }}"
                class="d-block nav-link"><i class="fa fa-file-text-o pr-2" aria-hidden="true"></i> Courses
            </a>
        </li>

        <li class="my-list my-list-shadow my-list-border my-list-sub-courses">
            <a  href="{{ route('courses.index') }}"
                class="d-block nav-link"><i class="fa fa-files-o pr-2" aria-hidden="true"></i>Sub Courses
            </a>
            <div class="d-none sub-courses ">
                <ul class="sub-courses-list">
                    @foreach ($courses as $course)
                    <li class="my-list my-list-shadow my-list-border">
                        <a href="{{ route('courses.subcourses.index', $course->slug) }}" class="d-block nav-link text-orange">{{$course->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </li>
        <li class="my-list my-list-shadow my-list-border">
            <a  href="{{ route('qna') }}"
                class="d-block nav-link "><i class="fa fa-globe pr-2" aria-hidden="true"></i> Q & A
            </a>
        </li>
        @if (auth()->user()->isAdmin())
            <li class="my-list my-list-shadow my-list-border">
                <a  href="{{route('user.teachers')}}"
                    class="d-block nav-link "><i class="fa fa-graduation-cap pr-2" aria-hidden="true"></i>Manage Teachers
                </a>
            </li>
        @endif
    </ul>
</div>

