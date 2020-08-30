<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
	<div class="row">
		<div class="col-xl-12">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">Basic Settings <small>update society basic settings</small></h3>
					</div>
				</div>
				<form class="kt-form kt-form--label-right" id="kt_form" method="post" action="{{ route('admin.panel.society.saveBasic') }}">
					@csrf
					<input type="hidden" name="society_id" value="{{ $society->society_id}}" />
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								<div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
										<h3 class="kt-section__title kt-section__title-sm">Society Info:</h3>
									</div>
								</div>
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
               	society_name: {
               		required: true
               	},
               	society_full_name: {
               		required: true
               	}
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
                        		window.location.href = "{{ route('admin.panel.society.edit', ['society_id' => $society->society_id, 'page' => 'basic']) }}";
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