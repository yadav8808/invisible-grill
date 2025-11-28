<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta
        content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard."
        name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords"
        content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard, bootstrap 5 dashboard, bootstrap5 dashboard" />

    <!-- Title -->
    <title>All India Institute of Hygiene & Public Health</title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset('backend/assets/images/brand/favicon.ico') }}" type="image/x-icon" />

    <!-- Bootstrap css -->
    <link href="{{ asset('backend/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

    <!-- Style css -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/boxed.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('backend/assets/css/animated.css') }}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" />

    <!-- Select2 css -->
    <link href="{{ asset('backend/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{ asset('backend/assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

</head>

<body class="">

    <div class="page relative error-page3">
        <div class="row no-gutters">
            <div class="col-xl-6 h-100vh">
                <div class="cover-image h-100vh"
                    data-image-src="{{ asset('backend/assets/images/login/invisible-grill.jpg') }}">
                    <div class="container">
                        <div class="customlogin-imgcontent">
                            <h2 class="mb-3 fs-35 text-white">Welcome To All India Institute of Hygiene & Public Health
                            </h2>
                            {{-- <p class="text-white-50">All India Institute of Hygiene & Public Health,</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 bg-white h-100vh">
                <div class="container">
                    <div class="customlogin-content">
                        <div class="pt-4 pb-2 ps-2">
                            <a class="header-brand" href="/admin">
                                <img src="{{ asset('frontend/assets/img/logo.png') }}"
                                    class="header-brand-img custom-logo" alt="Dayonelogo">
                                <img src="{{ asset('backend/assets/images/brand/logo-white.png') }}"
                                    class="header-brand-img custom-logo-dark" alt="Dayonelogo">
                            </a>
                        </div>
                        <div class="p-4 pt-6">
                            <h1 class="mb-2">Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                        </div>
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    
                        <form action="{{ route('auth.login') }}" method="post" class="card-body pt-3" id="loginform"
                            autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <div class="input-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fe fe-mail" aria-hidden="true"></i>
                                        </span>
                                        <input class="form-control" name="email" placeholder="Email">
                                    </div>
                                     @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="input-group mb-4">
                                    <div class="input-group" id="Password-toggle">
                                        <a href="#" class="input-group-text password-toggle"
                                            style="cursor: pointer;">
                                            <i class="fe fe-eye-off" aria-hidden="true"></i>
                                        </a>
                                        <input class="form-control" type="password" name="password" id="password"
                                            placeholder="Password">
                                    </div>
                                     @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="captcha" class="form-label">Captcha</label>
                                <div class="d-flex align-items-center">
                                    <img src="{{ captcha_src() }}" alt="captcha" id="captcha-img" style="margin-right: 8px; background-color: black">
                                    <button type="button" id="refresh-captcha" class="btn btn-xs btn-refresh btn-outline-secondary">Refresh</button>
                                    <input type="text" id="captcha" class="form-control" name="captcha"
                                        style="width: auto;">
                                </div>
                                @error('captcha')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="submit">
                                <input type="submit" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery js-->
    <script src="{{ asset('backend/assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('backend/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Select2 js -->
    <script src="{{ asset('backend/assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- P-scroll js-->
    <script src="{{ asset('backend/assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>

    <!-- Custom js-->
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/3.2.0/sha.js"></script>

    <script>
        function encript_pass() {
            return new Promise((resolve, reject) => {
                const enKey = $('input[name="_token"]').val();
                if (enKey != "") {
                    try {
                        let pwd = $('#password').val();
                        let hashObj = new jsSHA("SHA-512", "TEXT", {
                            numRounds: 1
                        });
                        hashObj.update(pwd);
                        let hash = hashObj.getHash("HEX");

                        let hmacObj = new jsSHA("SHA-512", "TEXT");
                        hmacObj.setHMACKey(enKey, "TEXT");
                        hmacObj.update(hash);
                        let hashedPassword = hmacObj.getHMAC("HEX");

                        $('#password').val(hashedPassword);

                        resolve();
                    } catch (error) {
                        reject(error);
                    }
                } else {
                    reject(new Error("Encryption key is missing"));
                }
            });
        }

        $('#loginform').on('submit', function(e) {
            e.preventDefault();

            encript_pass().then(() => {
                this.submit();
            }).catch((err) => {
                console.error("Error submitting the form:", err);
            });
        });
    </script>


    <script>
document.addEventListener('DOMContentLoaded', function() {

    // 1️⃣ Prevent copy-paste in email & password fields
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.getElementById('password');

    // [emailInput, passwordInput].forEach(input => {          yecode comment kiya t
    //     input.addEventListener('paste', e => e.preventDefault());
    //     input.addEventListener('copy', e => e.preventDefault());
    //     input.addEventListener('cut', e => e.preventDefault());
    // });

    // 2️⃣ Password toggle functionality
    const passwordToggle = document.querySelector('.password-toggle');
    const eyeIcon = passwordToggle.querySelector('i');

    passwordToggle.addEventListener('click', function(e) {
        e.preventDefault();
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle icon
        eyeIcon.classList.toggle('fe-eye');
        eyeIcon.classList.toggle('fe-eye-off');
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const refreshButton = document.getElementById('refresh-captcha');
    const captchaImg = document.getElementById('captcha-img');
    const captchaInput = document.getElementById('captcha');

    refreshButton.addEventListener('click', function(e) {
        e.preventDefault();
        captchaInput.value = '';

        captchaImg.src = "{{ captcha_src() }}" + '?t=' + new Date().getTime();
    });
});
</script>




</body>
</html>
