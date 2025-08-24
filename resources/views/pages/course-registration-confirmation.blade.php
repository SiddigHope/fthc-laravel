@extends('layouts.app')

@section('title', __('messages.registration_confirmation'))

@section('content')
<section class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card bg-light p-4 text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success fa-3x"></i>
                    </div>

                    <h2 class="mb-3">{{ __('messages.registration_submitted') }}</h2>
                    <p class="lead mb-4">{{ __('messages.registration_confirmation_message') }}</p>

                    <!-- Registration Details -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">{{ __('messages.registration_details') }}</h5>

                            <div class="row g-3">
                                <div class="col-sm-6 text-start">
                                    <p class="mb-1"><strong>{{ __('messages.registration_id') }}:</strong></p>
                                    <p class="text-muted">{{ $registration->regId }}</p>
                                </div>

                                <div class="col-sm-6 text-start">
                                    <p class="mb-1"><strong>{{ __('messages.registration_date') }}:</strong></p>
                                    <p class="text-muted">{{ $registration->created_at->format('Y-m-d H:i') }}</p>
                                </div>

                                <div class="col-sm-6 text-start">
                                    <p class="mb-1"><strong>{{ __('messages.course') }}:</strong></p>
                                    <p class="text-muted">
                                        {{ app()->getLocale() == 'en' ? $registration->course->crsNameEn : $registration->course->crsNameAr }}
                                    </p>
                                </div>

                                <div class="col-sm-6 text-start">
                                    <p class="mb-1"><strong>{{ __('messages.amount') }}:</strong></p>
                                    <p class="text-muted">{{ $registration->regAmount }} {{ __('messages.sar') }}</p>
                                </div>

                                <div class="col-sm-6 text-start">
                                    <p class="mb-1"><strong>{{ __('messages.payment_method') }}:</strong></p>
                                    <p class="text-muted">{{ __("messages.{$registration->regPayMethod}") }}</p>
                                </div>

                                <div class="col-sm-6 text-start">
                                    <p class="mb-1"><strong>{{ __('messages.status') }}:</strong></p>
                                    <p class="mb-0">
                                        <span class="badge bg-warning">{{ __("messages.status_{$registration->regStatus}") }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($registration->regPayMethod == 'bank')
                        <!-- Bank Transfer Instructions -->
                        <div class="alert alert-info mb-4">
                            <h5>{{ __('messages.bank_transfer_instructions') }}</h5>
                            <p class="mb-2">{{ __('messages.bank_details') }}:</p>
                            <ul class="list-unstyled">
                                <li>{{ __('messages.bank_name') }}: XXXXX</li>
                                <li>{{ __('messages.account_name') }}: XXXXX</li>
                                <li>{{ __('messages.account_number') }}: XXXXX</li>
                                <li>{{ __('messages.iban') }}: XXXXX</li>
                            </ul>
                            <p class="mb-0">{{ __('messages.bank_transfer_note') }}</p>
                        </div>
                    @else
                        <!-- Online Payment Instructions -->
                        <div class="alert alert-info mb-4">
                            <h5>{{ __('messages.online_payment_instructions') }}</h5>
                            <p class="mb-0">{{ __('messages.online_payment_note') }}</p>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            {{ __('messages.back_to_home') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
