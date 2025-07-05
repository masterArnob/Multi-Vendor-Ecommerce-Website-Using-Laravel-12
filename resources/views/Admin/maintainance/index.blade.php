@extends('admin.layout.master')
@section('content')


<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">

            @if ($mode->mode === 'on')
                    <div class="card">
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                      <div class="d-flex">
                        <div>
                          <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                        </div>
                        <div>
                          <h4 class="alert-title">The Site is in maintainance mode!</h4>
                          <div class="text-secondary">For live please turn of the maiintainance mode</div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            @endif







            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Maintenance Info</h2>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.maintainance.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 align-items-center">
                            <div class="col-md-7">
                                <div class="form-label">Secret Key</div>
                                <input type="text" name="secret_key" value="{{ @$mode->secret_key }}" class="form-control" placeholder="Enter secret key (letters, numbers, hyphens, underscores)">
                                @error('secret_key')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Mode</div>
                                <select name="mode" class="form-select">
                                    <option value="">Select</option>
                                    <option value="on" @selected($mode->mode == 'on')>On</option>
                                    <option value="off" @selected($mode->mode == 'off')>Off</option>
                                </select>
                                @error('mode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($mode->mode === 'on' && $mode->down_url)
                               <div class="col-md-7 mt-3">
    <div class="form-label">Bypass URL</div>
    <div class="input-group">
        <input type="text" class="form-control" id="bypassUrl" value="{{ $mode->down_url }}" readonly>
        <button class="btn btn-outline-secondary" type="button" id="copyButton">
            Copy
        </button>
    </div>
</div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">Update</button>
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
        document.getElementById('copyButton').addEventListener('click', function() {
    const bypassUrl = document.getElementById('bypassUrl');
    
    // Select the text
    bypassUrl.select();
    bypassUrl.setSelectionRange(0, 99999); // For mobile devices
    
    // Copy to clipboard
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            var notyf = new Notyf();
            notyf.success('URL copied to clipboard!');
        } else {
            throw new Error('Copy command failed');
        }
    } catch (err) {
        // Fallback for modern browsers
        navigator.clipboard.writeText(bypassUrl.value)
            .then(() => alert('URL copied to clipboard!'))
            .catch(() => alert('Failed to copy URL'));
    }
});
    </script>
@endpush