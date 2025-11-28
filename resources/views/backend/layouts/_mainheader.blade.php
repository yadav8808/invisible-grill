	<!--app header-->
	<div class="app-content main-content">
					<div class="side-app">
    <div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="index.html">
										<img src="{{asset('backend/assets/images/brand/logo.png')}}" class="header-brand-img desktop-lgo" alt="Dayonelogo">

										<img src="{{asset('backend/assets/images/brand/logo-white.png')}}" class="header-brand-img dark-logo" alt="Dayonelogo">

										<img src="{{asset('backend/assets/images/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="Dayonelogo">

										<img src="{{asset('backend/assets/images/brand/favicon1.png')}}" class="header-brand-img darkmobile-logo" alt="Dayonelogo">
									</a>
									<div class="app-sidebar__toggle" data-bs-toggle="sidebar">
										<a class="open-toggle" href="#">
											<i class="feather feather-menu"></i>
										</a>
										<a class="close-toggle" href="#">
											<i class="feather feather-x"></i>
										</a>
									</div>
									<div class="mt-0">
										<form class="form-inline">
											<div class="search-element">
												<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
												<button class="btn btn-primary-color" >
													<i class="feather feather-search"></i>
												</button>
											</div>
										</form>
									</div><!-- SEARCH -->
									<div class="d-flex order-lg-2 my-auto ms-auto">
										<button class="navbar-toggler nav-link icon navresponsive-toggler vertical-icon ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
											<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
										</button>
										<div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
											<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
												<div class="d-flex ms-auto">
													<a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#" data-bs-toggle="search">
														<i class="feather feather-search search-icon header-icon"></i>
													</a>

													<div class="dropdown header-fullscreen">
														<a class="nav-link icon full-screen-link">
															<i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
															<i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
														</a>
													</div>


													<div class="dropdown profile-dropdown">
														<a href="#" class="nav-link pe-1 ps-0 leading-none" data-bs-toggle="dropdown">
															<span>
																<img src="{{asset('backend/assets/images/users/16.jpg')}}" alt="img" class="avatar avatar-md bradius">
															</span>
														</a>
														<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
															<div class="p-3 text-center border-bottom">
																<a href="profile-1.html" class="text-center user pb-0 font-weight-bold">{{Auth::user()->name}}</a>
																<p class="text-center user-semi-title">{{Auth::user()->email}}</p>
															</div>


															<a class="dropdown-item d-flex" href="#" data-bs-toggle="modal" data-bs-target="#changepasswordnmodal">
																<i class="feather feather-edit-2 me-3 fs-16 my-auto"></i>
																<div class="mt-1">Change Password</div>
															</a>
															<a class="dropdown-item d-flex" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                <i class="feather feather-power me-3 fs-16 my-auto"></i>
                                                                <div class="mt-1">Log Out</div>
                                                            </a>

                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                @csrf
                                                            </form>

														</div>
													</div>

												</div>

											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->
                        <!--Page header-->

						<!--End Page header-->
