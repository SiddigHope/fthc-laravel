@extends('layouts.app')

@section('title', __('messages.register'))

@section('content')
<x-ui.page-header
    :title="__('messages.register_title')"
    image="assets/images/element/signup.svg"
    imageAlt="Register"
/>

<section class="pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
                <x-ui.card class="p-4 p-sm-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row g-4">
                            <!-- Name Fields -->
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnNameAr"
                                    :label="__('messages.name_ar')"
                                    :value="old('trnNameAr')"
                                    required
                                />
                            </div>
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnNameEn"
                                    :label="__('messages.name_en')"
                                    :value="old('trnNameEn')"
                                    required
                                />
                            </div>

                            <!-- Contact Information -->
                            <div class="col-md-12">
                                <x-ui.form-input
                                    name="usrEmail"
                                    :label="__('messages.email')"
                                    type="email"
                                    :value="old('usrEmail')"
                                    required
                                />
                            </div>

                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnMobile"
                                    :label="__('messages.mobile')"
                                    :value="old('trnMobile')"
                                    required
                                />
                            </div>

                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnWhatsapp"
                                    :label="__('messages.whatsapp')"
                                    :value="old('trnWhatsapp')"
                                    required
                                />
                            </div>

                            <!-- Password Fields -->
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="usrPassword"
                                    :label="__('messages.password')"
                                    type="password"
                                    required
                                />
                            </div>

                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="usrPassword_confirmation"
                                    :label="__('messages.confirm_password')"
                                    type="password"
                                    required
                                />
                            </div>

                            <!-- Personal Information -->
                            <div class="col-md-12">
                                 <x-ui.form-radio
                            name="trnGender"
                            :label="__('messages.gender')"
                            :value="old('trnGender')"
                            :options="[
                                '1' => __('messages.male'),
                                '0' => __('messages.female')
                            ]"
                            required
                        />
                                {{-- <x-ui.form-select
                                    name="trnGender"
                                    :label="__('messages.gender')"
                                    :options="[
                                        ['value' => 1, 'label' => __('messages.male')],
                                        ['value' => 0, 'label' => __('messages.female')]
                                    ]"
                                    :selected="old('trnGender')"
                                    required
                                /> --}}
                            </div>


                            <div class="col-md-6">
                                <x-ui.form-select
                                    name="cntId"
                                    :label="__('messages.country')"
                                    :options="$countries->map(function($country) {
                                        return [
                                            'value' => $country->cntId,
                                            'label' => app()->getLocale() == 'en' ? $country->cntNameEn : $country->cntNameAr
                                        ];
                                    })"
                                    :selected="old('cntId')"
                                    required
                                />
                            </div>

                            <!-- Professional Information -->
                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnJobTitle"
                                    :label="__('messages.job_title')"
                                    :value="old('trnJobTitle')"
                                    required
                                />
                            </div>

                            <div class="col-md-6">
                                <x-ui.form-input
                                    name="trnWorkplace"
                                    :label="__('messages.workplace')"
                                    :value="old('trnWorkplace')"
                                    required
                                />
                            </div>

                            <!-- Specialization Information -->
                            <div class="col-md-6">
                                <x-ui.form-select
                                    name="spcId"
                                    :label="__('messages.specialization')"
                                    :options="$specializations->map(function($spec) {
                                        return [
                                            'value' => $spec->spcId,
                                            'label' => app()->getLocale() == 'en' ? $spec->spcNameEn : $spec->spcNameAr
                                        ];
                                    })"
                                    :selected="old('spcId')"
                                    required
                                />
                            </div>

                            <div class="col-md-6">
                                <x-ui.form-select
                                    name="spcSubId"
                                    :label="__('messages.sub_specialization')"
                                    :options="$subSpecializations->map(function($subSpec) {
                                        return [
                                            'value' => $subSpec->spcSubId,
                                            'label' => app()->getLocale() == 'en' ? $subSpec->spcSubNameEn : $subSpec->spcSubNameAr
                                        ];
                                    })"
                                    :selected="old('spcSubId')"
                                    required
                                />
                            </div>

                            {{-- <div class="col-md-12">
                                <x-ui.form-select
                                    name="unclassId"
                                    :label="__('messages.unclassified')"
                                    :options="$unclassifieds->map(function($unclass) {
                                        return [
                                            'value' => $unclass->unclassId,
                                            'label' => app()->getLocale() == 'en' ? $unclass->unclassNameEn : $unclass->unclassNameAr
                                        ];
                                    })"
                                    :selected="old('unclassId')"
                                    required
                                />
                            </div> --}}

                            <!-- SCFHS Information -->
                            <div class="col-md-6">
                                <x-ui.form-switch
                                    name="trnIsSCFHS"
                                    :label="__('messages.is_scfhs')"
                                    :checked="old('trnIsSCFHS')"
                                />
                            </div>

                            <div class="col-md-6" id="scfhsField" style="display: none;">
                                <x-ui.form-input
                                    name="trnSCFHSNo"
                                    :label="__('messages.scfhs_number')"
                                    :value="old('trnSCFHSNo')"
                                />
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('messages.register') }}
                                </button>
                            </div>
                        </div>

                        {{-- <x-ui.form-radio
                            name="trnGander"
                            :label="__('messages.gender')"
                            :value="old('trnGander')"
                            :options="[
                                '1' => __('messages.male'),
                                '0' => __('messages.female')
                            ]"
                            required
                        />

                        <x-ui.form-select
                            name="cntId"
                            :label="__('messages.country')"
                            :value="old('cntId')"
                            :placeholder="__('messages.select_country')"
                            :options="$countries"
                            required
                        />

                        <x-ui.form-input
                            name="trnMobile"
                            :label="__('messages.mobile')"
                            type="tel"
                            :value="old('trnMobile')"
                            required
                        />

                        <x-ui.form-input
                            name="trnWhatsUp"
                            :label="__('messages.whatsapp')"
                            type="tel"
                            :value="old('trnWhatsUp')"
                            required
                        />

                        <x-ui.form-radio
                            name="isSCFHS"
                            :label="__('messages.scfhs_member')"
                            :value="old('isSCFHS')"
                            :options="[
                                '1' => __('messages.yes'),
                                '0' => __('messages.no')
                            ]"
                            required
                        />

                        <div class="mb-4" id="scfhsNumberField">
                            <x-ui.form-input
                                name="trnSCFHS"
                                :label="__('messages.scfhs_number')"
                                :value="old('trnSCFHS')"
                            />
                        </div>

                        <x-ui.form-select
                            name="spcId"
                            :label="__('messages.specialization')"
                            :value="old('spcId')"
                            :placeholder="__('messages.select_specialization')"
                            :options="$specializations"
                            required
                        />

                        <x-ui.form-select
                            name="spcSubId"
                            :label="__('messages.sub_specialization')"
                            :value="old('spcSubId')"
                            :placeholder="__('messages.select_sub_specialization')"
                            :options="$subSpecializations"
                            required
                        />

                        <x-ui.form-select
                            name="unclassId"
                            :label="__('messages.level')"
                            :value="old('unclassId')"
                            :placeholder="__('messages.select_level')"
                            :options="$unclassifieds"
                            required
                        /> --}}

                        {{-- <div class="row align-items-center">
                            <div class="col-sm-4">
                                <x-ui.button type="submit" class="btn-primary">
                                    {{ __('messages.register') }}
                                </x-ui.button>
                            </div> --}}
                            <div class="col-sm-8 text-sm-end">
                                <span>{{ __('messages.have_account') }}</span>
                                <a href="{{ route('login') }}"><u>{{ __('messages.sign_in') }}</u></a>
                            </div>
                        </div>
                    </form>
                </x-ui.card>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isSCFHSSwitch = document.querySelector('input[name="trnIsSCFHS"]');
        const scfhsField = document.getElementById('scfhsField');

        function updateSCFHSField() {
            scfhsField.style.display = isSCFHSSwitch.checked ? 'block' : 'none';
            const scfhsInput = scfhsField.querySelector('input[name="trnSCFHSNo"]');
            scfhsInput.required = isSCFHSSwitch.checked;
        }

        if (isSCFHSSwitch) {
            updateSCFHSField(); // Initial state
            isSCFHSSwitch.addEventListener('change', updateSCFHSField);
        }

        // Handle specialization dependencies
        const specSelect = document.querySelector('select[name="spcId"]');
        const subSpecSelect = document.querySelector('select[name="spcSubId"]');

        if (specSelect && subSpecSelect) {
            specSelect.addEventListener('change', function() {
                // Reset sub-specialization
                subSpecSelect.innerHTML = '<option value="">{{ __("messages.select_sub_specialization") }}</option>';

                // Filter sub-specializations based on selected specialization
                @json($subSpecializations).filter(subSpec => subSpec.spcId == this.value)
                    .forEach(subSpec => {
                        const option = document.createElement('option');
                        option.value = subSpec.spcSubId;
                        option.textContent = '{{ app()->getLocale() }}' == 'en' ? subSpec.spcSubNameEn : subSpec.spcSubNameAr;
                        subSpecSelect.appendChild(option);
                    });
            });
        }
    });
</script>
@endpush
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scfhsField = document.getElementById('scfhsNumberField');
        const scfhsYes = document.getElementById('isSCFHS_1');
        const scfhsNo = document.getElementById('isSCFHS_0');
        const scfhsNumber = document.getElementById('trnSCFHS');

        function toggleSCFHSField() {
            if (scfhsYes.checked) {
                scfhsField.style.display = 'block';
                scfhsNumber.required = true;
            } else {
                scfhsField.style.display = 'none';
                scfhsNumber.required = false;
                scfhsNumber.value = '';
            }
        }

        scfhsYes.addEventListener('change', toggleSCFHSField);
        scfhsNo.addEventListener('change', toggleSCFHSField);

        // Initialize on page load
        toggleSCFHSField();

        // Handle sub-specialization filtering based on specialization
        const spcSelect = document.getElementById('spcId');
        const subSpcSelect = document.getElementById('spcSubId');
        const originalSubSpc = Array.from(subSpcSelect.options);

        spcSelect.addEventListener('change', function() {
            const selectedSpcId = this.value;
            subSpcSelect.innerHTML = '';

            // Add default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.text = "{{ __('messages.select_sub_specialization') }}";
            subSpcSelect.add(defaultOption);

            // Filter and add relevant sub-specializations
            originalSubSpc.forEach(option => {
                if (option.dataset.spcId === selectedSpcId) {
                    subSpcSelect.add(option.cloneNode(true));
                }
            });
        });
    });
</script>
@endsection
