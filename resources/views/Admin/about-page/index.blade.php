@extends('admin.layout.master')
@section('content')
    <!-- Page body -->

    @php
        $content = json_decode(@$content->value);
        //dd($content);
    @endphp

    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Create About Page Contents</h2>

                        <form action="{{ route('admin.about-page.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf




                            <div class="row g-3 align-items-center">
                                

              
                           

                                


                                <div class="col-md-7">
                                    <div class="form-label">Content</div>
                              <textarea name="content" class="form-control summernote">{!! @$content[0]->content !!}</textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2 text-danger" />
                                </div>

                    

                                <div class="mt-4">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection

@push('scripts')
    <script>
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']]
            ]
        });

     
         
    </script>
@endpush


