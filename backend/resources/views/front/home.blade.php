@extends('front.layout.app')
@section('content')
    <!-- Start Slider Area -->
    <div id="home" class="rn-slider-area">
        <div class="slide slider-style-1">
            <div class="container">
                <div class="row row--30 align-items-center">
                    <div class="order-2 order-lg-1 col-lg-7 mt_md--50 mt_sm--50 mt_lg--30">
                        <div class="content">
                            <div class="inner">
                                <span class="subtitle">Welcome to my world</span>
                                <h1 class="title">Hi, I’m <span>John Lee</span><br>
                                    <span class="header-caption" id="page-top">
                                            <!-- type headline start-->
                                            <span class="cd-headline clip is-full-width">
                                                <span>a </span>
                                                <!-- ROTATING TEXT -->
                                        <span class="cd-words-wrapper">
                                                    <b class="is-visible">Developer.</b>
                                                    <b class="is-hidden">Professional Coder.</b>
                                                    <b class="is-hidden">Programmer.</b>
                                                </span>
                                        </span>
                                        <!-- type headline end -->
                                        </span>
                                </h1>

                                <div>
                                    <p class="description">I use animation as a third dimension by which to simplify
                                        experiences and guiding throw each and every interaction. I’m not adding
                                        motion
                                        just to spruce things up, but doing it in ways that.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12">
                                    <div class="social-share-inner-left">
                                        <span class="title">find with me</span>
                                        <ul class="social-share d-flex liststyle">
                                            <li class="facebook"><a target="_blank" href="https://www.facebook.com/dillawar.hussain.395/?_rdr"><i data-feather="facebook"></i></a>
                                            </li>
                                            <li class="instagram"><a target="_blank" href="https://www.instagram.com/adi______il/"><i data-feather="instagram"></i></a>
                                            </li>
                                            <li class="linkedin"><a target="_blank" href="https://www.linkedin.com/in/muhammadd-adil-7274a1243/"><i data-feather="linkedin"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12 mt_mobile--30">
                                    <div class="skill-share-inner">
                                        <span class="title">best skill on</span>
                                        <ul class="skill-share d-flex liststyle">
                                            <li><img class="php" src="{{ asset('assets/images/icons/icons-04.webp') }}" alt="Icons Images"></li>
                                            <li><img class="laravel" src="{{ asset('assets/images/icons/icons-02.png') }}" alt="Icons Images"></li>
                                            <li><img class="jquery" src="{{ asset('assets/images/icons/icons-03.png') }}" alt="Icons Images"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-1 order-lg-2 col-lg-5">
                        <div class="thumbnail">
                            <div class="inner">
                                <img src="{{ asset('assets/images/slider/mak.jfif') }}" alt="Personal Portfolio Images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Area -->
@endsection
