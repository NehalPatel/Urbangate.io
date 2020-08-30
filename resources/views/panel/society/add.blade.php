@extends('layouts.admin.default')

<?php if($society->societyId) { ?>
	@section('title', 'Edit Society')
	@section('pageTitle', 'Edit Society')

	@section('navItemSociety', 'kt-menu__item--open')
<?php } else { ?>
	@section('title', 'Add Society')
	@section('pageTitle', 'Add Society')

	@section('navItemSociety', 'kt-menu__item--open')
	@section('navItemSocietyAdd', 'kt-menu__item--active')
<?php } ?>

@section('styles')
<style type="text/css">
.required{ color: #e02222; font-size: 12px; padding-left: 2px;}
</style>
@endsection

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
				Society </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">
					Create New Society </a>
					<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
				</div>
			</div>
		</div>
	</div>
	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<div class="kt-portlet">
			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
					@if($society->societyId)
					{{ __('Update Society') }}
					@else
					{{ __('Create New Society') }}
					@endif
					<small></small></h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<a href="{{ route('admin.panel.society.listing') }}" class="btn btn-clean kt-margin-r-10">
						<i class="la la-arrow-left"></i>
						<span class="kt-hidden-mobile">Back</span>
					</a>
					<div class="btn-group">
						<button type="button" class="btn btn-brand frmSubmit">
							<i class="la la-check"></i>
							<span class="kt-hidden-mobile">Save</span>
						</button>
						<button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<ul class="kt-nav">
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-reload"></i>
										<span class="kt-nav__link-text">Save & continue</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-add-1"></i>
										<span class="kt-nav__link-text">Save & add new</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!--begin::Form-->
			<form class="kt-form kt-form--label-right" id="kt_form" method="post" action="{{ route('admin.panel.society.save') }}">
				<div class="kt-portlet__body">

					<div class="kt-section kt-section--first">
						<h3 class="kt-section__title">{{ __('Basic Informations') }}</h3>
						<div class="kt-section__body">
							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Society Name <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-6">
									<input type="text" class="form-control" id="society_name" name="society_name" placeholder="Society Name" value="{{ $society->name }}">
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter society name.</span>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Society Full Name <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-6">
									<input type="text" class="form-control" id="society_full_name" name="society_full_name" placeholder="Full Name" value="{{ $society->full_name }}">
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter society full name.</span>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Society Phone Number</label>
								<div class="col-lg-3">
									<input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ $society->phone }}">
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter society phone number.</span>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Society Email <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-3">
									<input type="email" class="form-control" id="society_email" name="society_email" placeholder="Email" value="{{ $society->email }}">
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter society email address.</span>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Society Website</label>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="website" name="website" placeholder="Website" value="{{ $society->website }}">
									<div class="invalid-feedback"></div>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Registration Number</label>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="registration_number" name="registration_number" placeholder="Registration Number" value="{{ $society->registration_number }}">
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter society registration number if it has.</span>
								</div>
							</div>

						</div>
						<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
						<h3 class="kt-section__title">{{ __('Setup Locations') }}</h3>
						<div class="kt-section__body">
							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Address Line 1 <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-6">
									<input type="text" class="form-control" id="address1" name="address1" placeholder="Address Line 1" value="{{ $society->address_line_1 }}">
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter your Address.</span>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Address Line 2 <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-6">
									<input type="text" class="form-control" id="address2" name="address2" placeholder="Address Line 2" value="{{ $society->address_line_2 }}">
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter your Address.</span>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Area <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="area" name="area" placeholder="Area" value="{{ $society->area }}">
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter your Area.</span>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">City <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-3">
									<select id="city" name="city" class="form-control">
									@foreach(CommonConstants::$CITIES as $city)
										<?php $checked = ($city==$society->city)?'selected="selected"':''; ?>
										<option value="{{ $city }}" {{$checked}} >{{ $city }}</option>
									@endforeach
									</select>
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter your City.</span>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">State <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-3">
									<select id="state" name="state" class="form-control">
									@foreach(CommonConstants::$STATES as $state)
										<?php $checked = ($state==$society->state)?'selected="selected"':''; ?>
										<option value="{{ $state }}" {{$checked}} >{{ $state }}</option>
									@endforeach
									</select>
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter your State.</span>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Country <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-3">
									<select id="country" name="country" class="form-control">
										<option value="">Select</option>
										<option value="India" selected="selected">India</option>
									</select>
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please select your Country.</span>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Pincode <span class="required" aria-required="true"> * </span></label>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="pincode"  name="pincode" placeholder="Pincode" value="{{ $society->pincode }}">
									<div class="invalid-feedback"></div>
									<span class="form-text text-muted">Please enter your Pincode.</span>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Status</label>
								<div class="col-lg-3">
									<div class="kt-radio-inline">
										<label class="kt-radio kt-radio--bold kt-radio--success">
											<input type="radio" name="status" value="{{ Status::$ACTIVE }}" <?php echo $society->status == Status::$ACTIVE ? 'checked' : ''; ?> > Active
											<span></span>
										</label>
										<label class="kt-radio kt-radio--bold">
											<input type="radio" name="status" value="{{ Status::$INACTIVE }}" <?php echo $society->status == Status::$INACTIVE ? 'checked' : ''; ?>> Inactive
											<span></span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-3"></div>
							<div class="col-lg-6">
								<button type="submit" class="btn btn-success frmSubmit">Submit</button>
								<button type="reset" class="btn btn-secondary">Cancel</button>
							</div>
						</div>
					</div>
				</div>
				@csrf
				<input type="hidden" name="society_id" value="{{ $society->society_id}}" />
			</form>

			<!--end::Form-->
		</div>

	</div>

</div>

<!-- end:: Content -->
@endsection

@section('scripts')
<script type="text/javascript">

var KTForm = function () {

    var formEl;
    var validator;

    var initValidation = function() {
    	validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
               	society_name: {
               		required: true
               	},
               	society_full_name: {
               		required: true
               	},
				address1: {
					required: true
				},
				address2: {
					required: true
				},
				area: {
					required: true
				},
				city: {
					required: true
				},
				state: {
					required: true
				},
				country: {
					required: true
				},
				pincode: {
					required: true
				},
			},

            // Display error
            invalidHandler: function(event, validator) {
            	KTUtil.scrollTop();
            	$.each(validator.invalid, function(key, message){
            		$('#'+key).addClass('is-invalid').next(".invalid-feedback").html(message);
            	});
            },

            // Submit valid form
            submitHandler: function (form) {
            	$(".form-control").removeClass(['is-invalid', 'is-valid']);
            }
        });
    }

    var initSubmit = function() {
    	var btn = $('.frmSubmit');

    	btn.on('click', function(e) {
    		e.preventDefault();

    		if (validator.form()) {
                // See: src\js\framework\base\app.js
                KTApp.progress(btn);
                KTApp.block(formEl);
                $(".form-control").removeClass(['is-invalid', 'is-valid']);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                	success: function(data, status) {

                		KTApp.unprogress(btn);
                		KTApp.unblock(formEl);


                        if(data.status){ //success
                        	swal.fire({
                        		"title": "Success",
                        		"text": data.message,
                        		"type": "success",
                        		"confirmButtonClass": "btn btn-brand"
                        	}).then(function(result){
                        		window.location.href = "{{ route('admin.panel.society.listing') }}";
                        	});
                        } else {
                        	swal.fire({
                        		"title": "Error",
                        		"text": data.message,
                        		"type": "error",
                        		"confirmButtonClass": "btn btn-danger"
                        	}).then(function(result) {
                        		$.each(data.result, function(key, element){
                        			$('#'+key).addClass('is-invalid').after("<div class='invalid-feedback'>"+element[0]+"</div>");
                        		});
                        	});
                        }
                    }
                });
            }
        });
    }

    return {
        // public functions
        init: function() {
        	formEl = $('#kt_form');
        	initValidation();
        	initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
	KTForm.init();
});
</script>
@endsection
