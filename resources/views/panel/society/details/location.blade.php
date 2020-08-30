<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
	<div class="row">
		<div class="col-xl-12">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">Location Settings <small>update society location settings</small></h3>
					</div>
				</div>
				<form class="kt-form kt-form--label-right" id="kt_form" method="post" action="{{ route('admin.panel.society.saveLocation') }}">
					@csrf
					<input type="hidden" name="society_id" value="{{ $society->society_id}}" />
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								<div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
										<h3 class="kt-section__title kt-section__title-sm">Society Location Informations:</h3>
									</div>
								</div>
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
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-xl-3"></div>
								<div class="col-lg-9 col-xl-6">
									<button type="submit" class="btn btn-success frmSubmit">Save Changes</button>
									<button type="reset" class="btn btn-secondary">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


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

    		console.log(validator);

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
                        		title: "Success",
                        		text: data.message,
                        		type: "success",
                        		showConfirmButton: false,
                				timer: 1500
                        	}).then(function(result){
                        		window.location.href = "{{ route('admin.panel.society.edit', ['society_id' => $society->society_id, 'page' => 'location']) }}";
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