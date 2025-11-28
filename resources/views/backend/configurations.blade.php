@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Configuration
                <span class="font-weight-normal text-muted ms-2">Manage Site Configuration</span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="feather feather-arrow-left fs-15 my-auto me-2"></i>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom-0">
                    <h3 class="card-title">Site Configuration</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('configurations.storeOrUpdate') }}" method="POST" enctype="multipart/form-data"
                        id="configuration-form">
                        @csrf

                        <div class="row">
                            {{-- Header Section --}}
                            <div class="col-md-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <h4 class="card-title">Header Configuration</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Header Title (English) <span class="text-red">*</span></label>
                                                    <input type="text" name="header_title"
                                                        value="{{ old('header_title', $configuration->header_title ?? '') }}"
                                                        class="form-control" placeholder="Enter header title in English">
                                                    @error('header_title')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Header Title (Hindi)<span class="text-red">*</span></label>
                                                    <input type="text" name="header_title_hindi"
                                                        value="{{ old('header_title_hindi', $configuration->header_title_hindi ?? '') }}"
                                                        class="form-control" placeholder="हिंदी में हेडर शीर्षक">
                                                    @error('header_title_hindi')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Header Logo<span class="text-red">*</span></label>
                                                    <input type="file" name="header_logo" class="form-control"
                                                        accept=".jpg, .jpeg, .png, .svg">
                                                    @error('header_logo')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror

                                                    @if (isset($configuration) && $configuration->header_logo)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('storage/' . $configuration->header_logo) }}"
                                                                alt="Header Logo" height="60">
                                                            <div class="form-check mt-2">
                                                                <input type="checkbox" name="remove_header_logo"
                                                                    value="1" class="form-check-input"
                                                                    id="removeHeaderLogo">
                                                                <label class="form-check-label text-danger"
                                                                    for="removeHeaderLogo">Remove Header Logo</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Section --}}
                            <div class="col-md-12 mt-4">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <h4 class="card-title">Footer Configuration</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Footer Title (English)<span class="text-red">*</span></label>
                                                    <input type="text" name="footer_title"
                                                        value="{{ old('footer_title', $configuration->footer_title ?? '') }}"
                                                        class="form-control" placeholder="Enter footer title in English">
                                                    @error('footer_title')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Footer Title (Hindi)<span class="text-red">*</span></label>
                                                    <input type="text" name="footer_title_hindi"
                                                        value="{{ old('footer_title_hindi', $configuration->footer_title_hindi ?? '') }}"
                                                        class="form-control" placeholder="हिंदी में फुटर शीर्षक">
                                                    @error('footer_title_hindi')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Footer Logo<span class="text-red">*</span></label>
                                                    <input type="file" name="footer_logo" class="form-control"
                                                        accept=".jpg, .jpeg, .png, .svg">
                                                    @error('footer_logo')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror

                                                    @if (isset($configuration) && $configuration->footer_logo)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('storage/' . $configuration->footer_logo) }}"
                                                                alt="Footer Logo" height="60">
                                                            <div class="form-check mt-2">
                                                                <input type="checkbox" name="remove_footer_logo"
                                                                    value="1" class="form-check-input"
                                                                    id="removeFooterLogo">
                                                                <label class="form-check-label text-danger"
                                                                    for="removeFooterLogo">Remove Footer Logo</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Copyright Text<span class="text-red">*</span></label>
                                                    <input type="text" name="copy_rights"
                                                        value="{{ old('copy_rights', $configuration->copy_rights ?? '') }}"
                                                        class="form-control" placeholder="Enter copyright text">
                                                    @error('copy_rights')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                             <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Copyright Text Hindi<span class="text-red">*</span></label>
                                                    <input type="text" name="copy_rights_hindi"
                                                        value="{{ old('copy_rights_hindi', $configuration->copy_rights_hindi ?? '') }}"
                                                        class="form-control" placeholder="Enter copyright text">
                                                    @error('copy_rights_hindi')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Footer Phone<span class="text-red">*</span></label>
                                                    <input type="text" name="footer_phone"
                                                        value="{{ old('footer_phone', $configuration->footer_phone ?? '') }}"
                                                        class="form-control" placeholder="Enter footer phone">
                                                    @error('footer_phone')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Footer Email<span class="text-red">*</span></label>
                                                    <input type="email" name="footer_email"
                                                        value="{{ old('footer_email', $configuration->footer_email ?? '') }}"
                                                        class="form-control" placeholder="Enter footer email">
                                                    @error('footer_email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Footer Address<span class="text-red">*</span></label>
                                                    <input type="text" name="footer_address"
                                                        value="{{ old('footer_address', $configuration->footer_address ?? '') }}"
                                                        class="form-control" placeholder="Enter footer address">
                                                    @error('footer_address')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Footer Address Hindi<span class="text-red">*</span></label>
                                                    <input type="text" name="footer_address_hindi"
                                                        value="{{ old('footer_address_hindi', $configuration->footer_address_hindi ?? '') }}"
                                                        class="form-control" placeholder="Enter footer address">
                                                    @error('footer_address_hindi')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Footer Timing<span class="text-red">*</span></label>
                                                    <input type="text" name="footer_timing"
                                                        value="{{ old('footer_timing', $configuration->footer_timing ?? '') }}"
                                                        class="form-control" placeholder="Enter footer timing">
                                                    @error('footer_timing')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                              <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Footer Timing Hindi<span class="text-red">*</span></label>
                                                    <input type="text" name="footer_timing_hindi"
                                                        value="{{ old('footer_timing_hindi', $configuration->footer_timing_hindi ?? '') }}"
                                                        class="form-control" placeholder="Enter footer timing">
                                                    @error('footer_timing_hindi')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Social Media Links --}}
                            <div class="col-md-12 mt-4">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <h4 class="card-title">Social Media Links</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Facebook Link<span class="text-red">*</span></label>
                                                    <input type="url" name="facebook_link"
                                                        value="{{ old('facebook_link', $configuration->facebook_link ?? '') }}"
                                                        class="form-control" placeholder="https://facebook.com/yourpage">
                                                    @error('facebook_link')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Twitter Link<span class="text-red">*</span></label>
                                                    <input type="url" name="twitter_link"
                                                        value="{{ old('twitter_link', $configuration->twitter_link ?? '') }}"
                                                        class="form-control" placeholder="https://twitter.com/yourpage">
                                                    @error('twitter_link')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">YouTube Link<span class="text-red">*</span></label>
                                                    <input type="url" name="youtube_link"
                                                        value="{{ old('youtube_link', $configuration->youtube_link ?? '') }}"
                                                        class="form-control"
                                                        placeholder="https://youtube.com/yourchannel">
                                                    @error('youtube_link')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Instagram Link<span class="text-red">*</span></label>
                                                    <input type="url" name="instagram_link"
                                                        value="{{ old('instagram_link', $configuration->instagram_link ?? '') }}"
                                                        class="form-control" placeholder="https://instagram.com/yourpage">
                                                    @error('instagram_link')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">linkedin Link<span class="text-red">*</span></label>
                                                    <input type="url" name="linkedin_link"
                                                        value="{{ old('linkedin_link', $configuration->linkedin_link ?? '') }}"
                                                        class="form-control" placeholder="https://linkedin.com/yourpage">
                                                    @error('linkedin_link')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="feather feather-save me-2"></i>
                                {{ isset($configuration) ? 'Update Configuration' : 'Save Configuration' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Form validation
        document.getElementById('configuration-form').addEventListener('submit', function(e) {
            const form = this;
            let isValid = true;

            // Basic validation example
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill all required fields.');
            }
        });

        // Image preview functionality
        function previewImage(input, previewId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        // Add preview for new image uploads
        document.querySelector('input[name="header_logo"]')?.addEventListener('change', function() {
            previewImage(this, 'headerLogoPreview');
        });

        document.querySelector('input[name="footer_logo"]')?.addEventListener('change', function() {
            previewImage(this, 'footerLogoPreview');
        });
    </script>
@endpush
