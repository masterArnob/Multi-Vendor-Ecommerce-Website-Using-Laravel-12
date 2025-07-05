@extends('admin.layout.master')
@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Edit Withdraw Methods</h2>

                    <form action="{{ route('admin.withdraw-method.update', $withdraw->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 align-items-center">
                        

                            <div class="col-md-7">
                                <div class="form-label">Name</div>
                                <input type="text" name="name" value="{{ old('name', $withdraw->name) }}" class="form-control">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Minimum Amount</div>
                                <input type="text" name="minimum_amount" class="form-control" value="{{ old('minimum_amount', $withdraw->minimum_amount) }}">
                                <x-input-error :messages="$errors->get('minimum_amount')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Maximum Amount</div>
                                <input type="text" name="maximum_amount" value="{{ old('maximum_amount', $withdraw->maximum_amount) }}" class="form-control">
                                <x-input-error :messages="$errors->get('maximum_amount')" class="mt-2 text-danger" />
                            </div>
                              <div class="col-md-7">
                                <div class="form-label">Witdraw Charge(Per Withdraw) %</div>
                                <input type="text" name="withdraw_charge" value="{{ old('withdraw_charge', $withdraw->withdraw_charge) }}" class="form-control">
                                <x-input-error :messages="$errors->get('withdraw_charge')" class="mt-2 text-danger" />
                            </div>
                            
                            <div class="col-md-7">
                                    <div class="form-label">Description</div>
                                    <textarea name="description" class="form-control summernote">{!! $withdraw->description !!}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2 text-danger" />
                                </div>
                        
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">Update </button>
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
