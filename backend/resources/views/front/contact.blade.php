@extends('front.layout.app')
@section('content')
    <!-- Start Contact section -->
    <div class="rn-contact-area rn-section-gap section-separator" id="contacts">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <span class="subtitle">Contact</span>
                        <h2 class="title">Contact With Me</h2>
                    </div>
                </div>
            </div>

            <div class="row mt--50 mt_md--40 mt_sm--40 mt-contact-sm">
                <div class="col-lg-5">
                    <div class="contact-about-area">
                        <div class="thumbnail">
                            <img src="assets/images/contact/contact1.png" alt="contact-img">
                        </div>
                        <div class="title-area">
                            <h4 class="title">Muhammad Adil Khan</h4>
                            <span>Php Programmer</span>
                        </div>
                        <div class="description">
                            <p>I am available for freelance work. Connect with me via and call in to my account.
                            </p>
                            <span class="phone">Phone: <a href="tel:03180253146">+923180253146</a></span>
                            <span class="mail">Email: <a href="mailto:adilm0616@gmail.com">adilm0616@gmail.com</a></span>
                        </div>
                        <div class="social-area">
                            <div class="name">FIND WITH ME</div>
                            <div class="social-icone">
                                <a target="_blank" href="https://www.facebook.com/dillawar.hussain.395/?_rdr"><i data-feather="facebook"></i></a>
                                <a target="_blank" href="https://www.linkedin.com/in/muhammadd-adil-7274a1243/"><i data-feather="linkedin"></i></a>
                                <a target="_blank" href="https://www.instagram.com/adi______il/"><i data-feather="instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-aos-delay="600" class="col-lg-7 contact-input">
                    <div class="contact-form-wrapper">
                        <div class="introduce">

                            <form class="rnt-contact-form rwt-dynamic-form row" id="contact-form" method="POST"
                                  action="{{ route('contact.form') }}">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="contact-name">Your Name</label>
                                        <input class="form-control form-control-lg" name="name"
                                               id="contact-name" type="text">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="contact-phone">Phone Number</label>
                                        <input class="form-control" name="phone" id="contact-phone" type="tel">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="contact-email">Email</label>
                                        <input class="form-control form-control-sm" id="contact-email"
                                               name="email" type="email">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="subject">subject</label>
                                        <input class="form-control form-control-sm" id="subject" name="subject"
                                               type="text">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="contact-message">Your Message</label>
                                        <textarea name="message" id="contact-message" cols="30"
                                                  rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button name="submit" type="submit" id="submit" class="rn-btn">
                                        <span>SEND MESSAGE</span>
                                        <i data-feather="arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact section -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#contact-form').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#responseMessage').html('<p>' + response.message + '</p>');
                    },
                    error: function(xhr) {
                        // Handle errors
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '<br>';
                        });
                        $('#responseMessage').html('<p style="color: red;">' + errorMessage + '</p>');
                    }
                });
            });
        });
    </script>
@endsection
