<footer class="bg-light p-0 pt-4 m-0">
    <div class="container">
        <div class="d-flex flex-column ">
            <div class="d-flex flex-row justify-content-between section-divider">
                <div class="about-us col-5 p-0">
                    <div class="footer-logo">
                        <h4>
                            <a class="text-hblack nav-link my-nav-link-hblack footer-logo-text p-0 pb-1" href="{{ url('/') }}" style="font-family: 'Rubik', sans-serif;">
                                &lt;/&gt; WebAcquire
                            </a>
                        </h4>
                    </div>
                    <p class="font-italic">
                        <strong
                            class="text-hblack">
                                <span class="text-orange">Acquire</span> the skill of <span class="text-orange">Web Development</span> with us. Whether you are <span class="text-orange">beginner, intermediate or experienced developer,</span> this is a place where you can share your knowledge and can learn to build amazing websites .
                        </strong>
                    </p>
                </div>
                <div class="navigations col-4">
                    <h5 class="text-center"><strong class="text-hblack">Navigations</strong></h5>
                    <ul class="nav nav-pills nav-fill">
                        @if (! request()->is('/'))
                            <li class="nav-item my-list border-orange shadow-none rounded ">
                                <a href="{{ route('home') }}" class="nav-link btn btn-link p-1 ">Home</a>
                            </li>
                        @endif
                        @if (!  request()->is('courses'))
                            <li class="nav-item my-list border-orange shadow-none rounded ">
                                <a href="{{ route('courses.index') }}" class="nav-link btn btn-link p-1 ">Courses</a>
                            </li>
                        @endif
                        @if (!  request()->is('qna'))
                            <li class="nav-item my-list border-orange shadow-none rounded ">
                                <a href="{{ route('qna') }}" class="nav-link btn btn-link p-1 ">Q & A</a>
                            </li>
                        @endif

                        @if (! request()->is('/testimonials/create'))
                            <li class="nav-item my-list border-orange shadow-none rounded ">
                                <a href="{{ route('testimonials.create') }}" class="nav-link btn btn-link p-1 ">Rate us</a>
                            </li>
                        @endif

                        @auth
                            @if (! request()->is('/dashboard'))
                                <li class="nav-item my-list border-orange shadow-none rounded ">
                                    <a href="{{route('dashboard')}}" class="nav-link btn btn-link p-1 ">Dashboard</a>
                                </li>
                            @endif
                            @if (auth()->user()->isAdmin() && !(request()->is('/dashboard') ))
                                <li class="nav-item my-list border-orange shadow-none rounded ">
                                    <a href="#" class="nav-link btn btn-link p-1 ">Admin Panel</a>
                                </li>
                            @endif
                        @endauth
                      </ul>
                </div>
                <div class="contact-us col-4">
                    <div class="number">
                        <i class="fa fa-phone m-1 fa-lg text-hblack"></i>
                        <strong>Phone</strong>
                        <div class="mob">
                            <a href="tel:+913855118245" class="d-block nav-link  p-0">+91 3855118245</a>
                            <a href="tel:+913854814003" class="d-block nav-link  p-0">+91 3854814003</a>
                        </div>
                    </div>
                    <div class="email">
                        <i class="fa fa-envelope m-1 fa-lg text-hblack" ></i>
                        <strong>Email</strong>
                        <div class="email d-block">
                            <a href="mailto:enquiry@webacquire.com" class="d-block nav-link  p-0">enquiry@webacquire.com</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between bg-hblack p-4">
                <div class="copyright">
                    <strong class="text-white">&copy; {{ now()->year }} WebAcquire. All rights reserved.</strong>
                </div>
                <div class="social-links d-flex">
                    <ul class="d-flex">
                        <li class="pl-2 pr-2"><a href="https://www.facebook.com/" class="text-white"><i class="fa fa-lg fa-facebook" ></i></a></li>
                        <li class="pl-2 pr-2"><a href="https://www.instagram.com/" class="text-white"><i class="fa fa-lg fa-instagram" ></i></a></li>
                        <li class="pl-2 pr-2"><a href="https://twitter.com/" class="text-white"><i class="fa fa-lg fa-twitter" ></i></a></li>
                        <li class="pl-2 pr-2"><a href="https://www.linkedin.com/signup" class="text-white"><i class="fa fa-lg fa-linkedin" ></i></a></li>
                        <li class="pl-2 pr-2"><a href="https://github.com/CodeStackers99/Web-Acquire" class="text-white"><i class="fa fa-lg fa-github" ></i></a></li>
                      </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
