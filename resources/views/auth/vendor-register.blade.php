<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign up - Tabler</title>
    <link href="{{ asset('vendo/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('vendo/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('vendo/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('vendo/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('vendo/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
<body class="d-flex flex-column">
    <script src="{{ asset('vendo/dist/js/demo-theme.min.js?1692870487') }}" defer></script>
    <div class="page page-center">
        <div class="container container-narrow py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                </a>
            </div>


              <div class="text-center mb-4">
              <div class="card card-md card-body">
                 <h2 class="card-title text-center mb-4"> Vendor Terms and conditions </h2>
                 @forelse (@$conditions as $condition)
                     {!! $conditions[0]->content !!}
                 @empty
                     No Data Available
                 @endforelse
    
              </div>
            </div>


            <form class="card card-md" method="POST" action="{{ route('vendor.register.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h2 class="card-title text-center mb-4">Vendor Register</h2>
                    <div class="mb-3">
                        <label class="form-label">Document</label>
                        <input type="file" name="document" class="form-control" required>
                        <x-input-error :messages="$errors->get('document')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ old('name') }}" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email address" value="{{ old('email') }}" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact</label>
                        <input type="number" name="contact" class="form-control" placeholder="Enter contact number" value="{{ old('contact') }}" required>
                        <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input id="password" type="password" name="password" class="form-control" required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-check">
                            <input type="checkbox" name="terms" class="form-check-input" />
                            <span class="form-check-label">Agree the <a href="./terms-of-service.html" tabindex="-1">terms and policy</a>.</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Create new account</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-secondary mt-3">
                Already have account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendo/dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('vendo/dist/js/demo.min.js?1692870487') }}" defer></script>
</body>
</html>