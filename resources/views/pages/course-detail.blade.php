@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? $course->crsNameEn . ' - Course Details' : $course->crsNameAr . ' - تفاصيل الدورة')

@section('content')
<!-- =======================
Page Banner START -->
<section class="pt-0">
	<!-- Main banner background image -->
	<div class="container-fluid px-0">
		<div class="bg-blue h-100px h-md-200px rounded-0" style="background:url({{ asset('assets/images/pattern/04.png') }}) no-repeat center center; background-size:cover;">
		</div>
	</div>
	<div class="container mt-n4">
		<div class="row">
			<!-- Profile banner START -->
			<div class="col-12">
				<div class="card bg-transparent card-body p-0">
					<div class="row d-flex justify-content-between">
						<!-- Avatar -->
						<div class="col-auto mt-4 mt-md-0">
							<div class="avatar avatar-xxl mt-n3">
								<img class="avatar-img rounded-circle border border-white border-3 shadow" src="{{ $course->crsImage }}" alt="">
							</div>
						</div>
						<!-- Profile info -->
						<div class="col d-md-flex justify-content-between align-items-center mt-4">
							<div>
								<h1 class="my-1 fs-4">{{ app()->getLocale() === 'en' ? $course->crsNameEn : $course->crsNameAr }}<i class="bi bi-patch-check-fill text-info small ms-2"></i></h1>
								<ul class="list-inline mb-0">
									<li class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0">
                                        <i class="fas fa-building text-primary me-2"></i>{{ app()->getLocale() === 'en' ? $course->type->typNameEn : $course->type->typNameAr }}
                                    </li>
									<li class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0">
                                        <i class="fas fa-calendar text-primary me-2"></i>{{ $course->crsDate->format('d M Y') }}
                                    </li>
									<li class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0">
                                        <i class="fas fa-money-bill-alt text-primary me-2"></i>{{ number_format($course->crsPrice, 2) }} SAR
                                    </li>
								</ul>
							</div>
							<!-- Button -->
							<div class="mt-2 mt-md-0">
								<a href="#" class="btn btn-primary" id="registerButton" data-bs-toggle="modal" data-bs-target="#courseRegistrationModal">
                                    <i class="bi bi-person-check me-2"></i>{{ __('messages.register_now') }}
                                </a>
							</div>
						</div>
					</div>
				</div>

				<!-- Course details card with new design -->
				<div class="card shadow mt-4">
					<div class="card-body p-4">
						<div class="row">
							<!-- Left column - Course info -->
							<div class="col-lg-8">
								<div class="mb-4">
									<h2 class="mb-2">{{ app()->getLocale() === 'en' ? $course->crsNameEn : $course->crsNameAr }}</h2>
									<p class="text-muted mb-4">{{ app()->getLocale() === 'en' ? $course->crsDescriptionEn : $course->crsDescriptionAr }}</p>

									<!-- Rating and stats -->
									<div class="d-flex flex-wrap align-items-center mb-4">
										<div class="d-flex align-items-center me-4">
											<div class="text-warning me-2">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star-half-alt"></i>
											</div>
											<span class="fw-bold">4.5</span>
											<span class="text-muted ms-1">(120 reviews)</span>
										</div>
										<div class="d-flex align-items-center me-4">
											<i class="far fa-clock text-primary me-2"></i>
											<span>28.4 hours</span>
										</div>
										<div class="d-flex align-items-center">
											<i class="far fa-file-alt text-primary me-2"></i>
											<span>7 practice exercises</span>
										</div>
									</div>

									<!-- Learner count -->
									<div class="d-flex align-items-center mb-4">
										<div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px;">
											<i class="fas fa-users text-white small"></i>
										</div>
										<span class="text-muted">18K learners already enrolled</span>
									</div>
								</div>

								<!-- Course details section -->
								@if($course->inPersonDetails)
								<div class="mb-4">
									<h4 class="mb-3">{{ __('messages.course_details') }}</h4>
									<p class="mb-3">{{ app()->getLocale() === 'en' ? $course->inPersonDetails->crsInDetailsEn : $course->inPersonDetails->crsInDetailsAr }}</p>

									<div class="row g-4 mt-3">
										<!-- Location -->
										<div class="col-md-6">
											<div class="card bg-light p-3 h-100">
												<h6 class="mb-3"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ __('messages.location') }}</h6>
												<p class="mb-0">{{ $course->inPersonDetails->crsInLocation }}</p>
											</div>
										</div>
										<!-- Schedule -->
										<div class="col-md-6">
											<div class="card bg-light p-3 h-100">
												<h6 class="mb-3"><i class="fas fa-calendar-alt text-primary me-2"></i>{{ __('messages.schedule') }}</h6>
												<ul class="list-unstyled mb-0">
													<li>{{ __('messages.start_date') }}: {{ $course->inPersonDetails->lctDateStart->format('d M Y') }}</li>
													<li>{{ __('messages.end_date') }}: {{ $course->inPersonDetails->lctDateEnd->format('d M Y') }}</li>
													<li>{{ __('messages.time') }}: {{ $course->inPersonDetails->lctTimeStart }} - {{ $course->inPersonDetails->lctTimeEnd }}</li>
												</ul>
											</div>
										</div>

										@if($course->inPersonDetails->crsInCreditHoursNumber || $course->inPersonDetails->crsInAccreditationNumber)
										<!-- Additional Info -->
										<div class="col-12">
											<div class="card bg-light p-3">
												<h6 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>{{ __('messages.additional_info') }}</h6>
												<ul class="list-unstyled mb-0">
													@if($course->inPersonDetails->crsInCreditHoursNumber)
													<li class="mb-2">{{ __('messages.credit_hours') }}: {{ $course->inPersonDetails->crsInCreditHoursNumber }}</li>
													@endif
													@if($course->inPersonDetails->crsInAccreditationNumber)
													<li>{{ __('messages.accreditation_number') }}: {{ $course->inPersonDetails->crsInAccreditationNumber }}</li>
													@endif
												</ul>
											</div>
										</div>
										@endif
									</div>
								</div>
								@endif

								<!-- Instructor section -->
								@if($course->inPersonDetails && isset($course->inPersonDetails->crsInLecturer))
								<div class="mb-4">
									<h4 class="mb-3">{{ __('messages.course_instructor') }}</h4>
									<div class="row g-4">
										@foreach(json_decode($course->inPersonDetails->crsInLecturer) as $lecturerId)
											@php
												$lecturer = \App\Models\Lecturer::with('user')->find($lecturerId);
											@endphp
											@if($lecturer)
											<div class="col-md-6">
												<div class="card shadow-sm p-2">
													<div class="row g-0">
														<div class="col-4">
															<img src="{{ $lecturer->user->usrImage ? asset('storage/' . $lecturer->user->usrImage) : asset('assets/images/instructor/default.jpg') }}"
																 class="rounded-3 h-100 w-100 object-fit-cover" alt="">
														</div>
														<div class="col-8">
															<div class="card-body p-2">
																<h6 class="card-title mb-0">
																	{{ app()->getLocale() === 'en' ? $lecturer->user->usrNameEn : $lecturer->user->usrNameAr }}
																</h6>
																<p class="mb-0 small">{{ $lecturer->lctSpecialty }}</p>
																@if($lecturer->lctBio)
																<p class="small mt-2 mb-0 text-truncate">{{ $lecturer->lctBio }}</p>
																@endif
															</div>
														</div>
													</div>
												</div>
											</div>
											@endif
										@endforeach
									</div>
								</div>
								@endif
							</div>

							<!-- Right column - Pricing and registration -->
							<div class="col-lg-4">
								<div class="card shadow-sm border-0">
									<div class="card-body p-4">
										<h4 class="card-title mb-3">{{ __('messages.get_started') }}</h4>
										<div class="d-flex align-items-baseline mb-3">
											<h2 class="text-primary me-2">$144.97</h2>
											<del class="text-muted">$199.99</del>
										</div>

										<ul class="list-unstyled mb-4">
											<li class="mb-2"><i class="fas fa-check text-success me-2"></i> Full lifetime access</li>
											<li class="mb-2"><i class="fas fa-check text-success me-2"></i> Certificate of completion</li>
											<li class="mb-2"><i class="fas fa-check text-success me-2"></i> 7 practice exercises</li>
											<li><i class="fas fa-check text-success me-2"></i> 28.4 hours of content</li>
										</ul>

										<a href="#" class="btn btn-primary w-100 mb-3" id="registerButton" data-bs-toggle="modal" data-bs-target="#courseRegistrationModal">
											{{ __('messages.register_now') }}
										</a>

										<div class="text-center">
											<small class="text-muted">30-day money-back guarantee</small>
										</div>
									</div>
								</div>

								<!-- Learner count badge -->
								<div class="d-flex align-items-center mt-3 p-3 bg-light rounded">
									<div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px;">
										<i class="fas fa-users text-white small"></i>
									</div>
									<span class="text-muted">18K learners already enrolled</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Course details card END -->
			</div>
		</div>
	</div>
</section>
<!-- =======================
Page Banner END -->

<!-- Registration Modal START -->
<div class="modal fade" id="courseRegistrationModal" tabindex="-1" aria-labelledby="courseRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title" id="courseRegistrationModalLabel">{{ __('messages.course_registration') }}</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        @auth
                            <!-- Registered User Form -->
                            <form id="courseRegistrationForm" class="row g-4" action="{{ route('courses.register', $course->crsId) }}" method="POST">
                                @csrf
                                <!-- Personal Information (Read-only) -->
                                <div class="col-12">
                                    <h5 class="mb-3">{{ __('messages.personal_information') }}</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.name_en') }}</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->traineeProfile->trnNameEn }}" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.name_ar') }}</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->traineeProfile->trnNameAr }}" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.email') }}</label>
                                            <input type="email" class="form-control" value="{{ Auth::user()->usrEmail }}" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.mobile') }}</label>
                                            <input type="tel" class="form-control" value="{{ Auth::user()->traineeProfile->trnMobile }}" readonly>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">{{ __('messages.whatsapp') }}</label>
                                            <input type="tel" class="form-control" value="{{ Auth::user()->traineeProfile->trnWhatsapp }}" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.specialization') }}</label>
                                            <input type="text" class="form-control" value="{{ app()->getLocale() === 'en' ? Auth::user()->traineeProfile->specialization->spcNameEn : Auth::user()->traineeProfile->specialization->spcNameAr }}" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.scfhs_number') }}</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->traineeProfile->trnSCFHSNo }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                @if(Auth::user()->traineeProfile->spcId != $course->spcId)
                                    <div class="col-12">
                                        <div class="alert alert-danger">
                                            {{ __('messages.specialization_mismatch') }}
                                        </div>
                                    </div>
                                @else
                                    <!-- Payment Method -->
                                    <div class="col-12">
                                        <h5 class="mb-3">{{ __('messages.payment_details') }}</h5>
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('messages.payment_method') }}</label>
                                            <select class="form-select" name="regPayMethod" required>
                                                <option value="">{{ __('messages.select_payment_method') }}</option>
                                                <option value="bank">{{ __('messages.bank_transfer') }}</option>
                                                <option value="online">{{ __('messages.online_payment') }}</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('messages.remarks') }}</label>
                                            <textarea class="form-control" name="regRemarks" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <!-- Terms and Submit -->
                                    <div class="col-12">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                            <label class="form-check-label" for="terms">
                                                {{ __('messages.agree_to_terms') }}
                                            </label>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('messages.confirm_registration') }}
                                        </button>
                                    </div>
                                @endif
                            </form>
                        @else
                            <!-- Guest Message -->
                            <div class="text-center py-4">
                                <i class="fas fa-user-lock fa-3x text-muted mb-3"></i>
                                <h5>{{ __('messages.login_required') }}</h5>
                                <p class="mb-3">{{ __('messages.login_to_register') }}</p>
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    {{ __('messages.login') }}
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Registration Modal END -->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap modal
    var myModal = new bootstrap.Modal(document.getElementById('courseRegistrationModal'), {
        keyboard: false
    });

    // Handle registration button click
    document.querySelectorAll('[data-bs-target="#courseRegistrationModal"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            @auth
                @if(Auth::user()->traineeProfile->spcId != $course->spcId)
                    alert('{{ __("messages.specialization_mismatch") }}');
                    return;
                @endif
            @endauth
            myModal.show();
        });
    });

    @auth
    // Form validation for authenticated users
    const form = document.getElementById('courseRegistrationForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate payment method
            const paymentMethod = document.querySelector('select[name="regPayMethod"]');
            if (!paymentMethod.value) {
                alert('{{ __("messages.payment_method_required") }}');
                return;
            }

            // Validate terms
            const terms = document.querySelector('input[name="terms"]');
            if (!terms.checked) {
                alert('{{ __("messages.terms_required") }}');
                return;
            }

            // Submit the form if all validations pass
            this.submit();
        });
    }
    @endauth

    // Display success/error messages
    @if(session('success'))
        alert('{{ session('success') }}');
    @endif

    @if(session('error'))
        alert('{{ session('error') }}');
    @endif

    @if($errors->any())
        alert('{{ __("messages.form_has_errors") }}');
    @endif
});
</script>
@endpush
