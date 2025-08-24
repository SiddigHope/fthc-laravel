@extends('layouts.app')

@section('title', __('messages.course_registration'))

@section('content')
<section class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card bg-light p-4">
                    <!-- Course info -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h3>{{ app()->getLocale() == 'en' ? $course->crsNameEn : $course->crsNameAr }}</h3>
                            <p class="mb-2">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                {{ __('messages.start_date') }}: {{ $course->crsStartDate->format('Y-m-d') }}
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-clock text-primary me-2"></i>
                                {{ __('messages.duration') }}: {{ $course->crsDuration }} {{ __('messages.hours') }}
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-tag text-primary me-2"></i>
                                {{ __('messages.price') }}: {{ $course->crsPrice }} {{ __('messages.sar') }}
                            </p>
                        </div>
                        @if($course->crsImage)
                            <div class="col-md-4">
                                <img src="{{ asset($course->crsImage) }}" alt="{{ $course->crsNameEn }}" class="img-fluid rounded">
                            </div>
                        @endif
                    </div>

                    <hr class="my-4">

                    <!-- Registration form -->
                    <form action="{{ route('courses.register', $course) }}" method="POST">
                        @csrf

                        <!-- Personal Information (Read-only) -->
                        <h4 class="mb-4">{{ __('messages.personal_information') }}</h4>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnNameEn"
                                    :label="__('messages.name_en')"
                                    :value="$trainee->trnNameEn"
                                    readonly
                                />
                            </div>
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnNameAr"
                                    :label="__('messages.name_ar')"
                                    :value="$trainee->trnNameAr"
                                    readonly
                                />
                            </div>
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnMobile"
                                    :label="__('messages.mobile')"
                                    :value="$trainee->trnMobile"
                                    readonly
                                />
                            </div>
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnWhatsapp"
                                    :label="__('messages.whatsapp')"
                                    :value="$trainee->trnWhatsapp"
                                    readonly
                                />
                            </div>
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="country"
                                    :label="__('messages.country')"
                                    :value="app()->getLocale() == 'en' ? $country->cntNameEn : $country->cntNameAr"
                                    readonly
                                />
                            </div>
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnJobTitle"
                                    :label="__('messages.job_title')"
                                    :value="$trainee->trnJobTitle"
                                    readonly
                                />
                            </div>
                        </div>

                        <!-- Registration Information -->
                        <h4 class="mb-4">{{ __('messages.registration_information') }}</h4>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <x-ui.form-select
                                    name="regPayMethod"
                                    :label="__('messages.payment_method')"
                                    :options="[
                                        ['value' => 'bank', 'label' => __('messages.bank_transfer')],
                                        ['value' => 'online', 'label' => __('messages.online_payment')],
                                    ]"
                                    :value="old('regPayMethod')"
                                    required
                                />
                            </div>
                            <div class="col-12">
                                <x-ui.form-textarea
                                    name="regRemarks"
                                    :label="__('messages.remarks')"
                                    :value="old('regRemarks')"
                                    :placeholder="__('messages.remarks_placeholder')"
                                    rows="4"
                                />
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mb-4">
                            <x-ui.form-checkbox
                                name="terms"
                                :label="__('messages.terms_agreement')"
                                required
                            />
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-light me-2">
                                {{ __('messages.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('messages.submit_registration') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
