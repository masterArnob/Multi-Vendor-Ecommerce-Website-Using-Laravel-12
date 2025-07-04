@extends('frontend.layout.master')
@section('content')

    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>contact us</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">contact us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CONTACT PAGE START
    ==============================-->
    <section id="wsus__contact">
        <div class="container">
            <div class="wsus__contact_area">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="wsus__contact_single">
                                    <i class="fal fa-envelope"></i>
                                    <h5>mail address</h5>
                                    <a href="mailto:{{ @$settings->contact_email }}">{{ @$settings->contact_email }}</a>
                                    <span><i class="fal fa-envelope"></i></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="wsus__contact_single">
                                    <i class="far fa-phone-alt"></i>
                                    <h5>phone number</h5>
                                    <a href="macallto:{{ @$settings->contact_phone }}">{{ @$settings->contact_phone }}</a>
                                    <span><i class="far fa-phone-alt"></i></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="wsus__contact_single">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <h5>contact address</h5>
                                    <a href="mailto:example@gmail.com">{!! @$settings->contact_address !!}</a>
                                    <span><i class="fal fa-map-marker-alt"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="wsus__contact_question">
                            <h5>Send Us a Message</h5>
                            <form class="contact-form">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="text" name="name" placeholder="Your Name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="email" name="email" placeholder="Email">
                                        </div>
                                         @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                               
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="text" name="subject" placeholder="Subject">
                                        </div>
                                         @error('subject')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <textarea cols="3" name="message" rows="5" placeholder="Message"></textarea>
                                        </div>
                                         @error('message')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <button type="submit" class="common_btn">send now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="wsus__con_map">
                            <iframe
                                src="{{ @$settings->map }}"
                                width="1600" height="450" style="border:0;" allowfullscreen="100"
                                loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CONTACT PAGE END
    ==============================-->
@endsection
@push('scripts')
  <script>
    var notyf = new Notyf();
    $(document).on('submit', '.contact-form', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

          $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

        $.ajax({
            url: "{{ route('contact-page.send') }}",
            type: 'POST',
            data: formData,
            success: function(data) {
                if (data.status === 'success') {
                    notyf.success(data.message);
                    $('.contact-form')[0].reset(); // Reset the form after successful submission
                } else {
                    notyf.success(data.message);
                   
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred. Please try again later.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            } else if (xhr.status === 422) {
                // Handle validation errors
                let errors = xhr.responseJSON.errors;
                errorMessage = Object.values(errors).flat().join('<br>');
            }
            notyf.error(errorMessage);
            }
        });
    });
  </script>
@endpush