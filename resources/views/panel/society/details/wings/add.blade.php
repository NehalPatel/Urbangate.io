<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
	<div class="row">
		<div class="col-xl-12">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">Society Wings <small>update society Wings</small></h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<a href="{{ route('admin.panel.society.edit', ['society_id' => $society->society_id, 'page' => 'wings']) }}" class="btn btn-clean btn-icon-sm">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
							&nbsp;
						</div>
					</div>
				</div>
				<form class="kt-form kt-form--label-right" id="kt_form" method="post" action="{{ route('admin.panel.society.saveBasic') }}">
					@csrf
					<input type="hidden" name="society_id" value="{{ $society->society_id}}" />
					<input type="hidden" name="wing_id" value="{{ $wing->wing_id}}" />
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								<div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
										<h3 class="kt-section__title kt-section__title-sm">Society Wings:</h3>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Society Name <span class="required" aria-required="true"></span></label>
									<div class="col-lg-6">
										<input type="text" class="form-control" id="society_name" name="society_name" placeholder="Society Name" value="{{ $society->name }}" disabled="disabled">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Society Full Name <span class="required" aria-required="true"></span></label>
									<div class="col-lg-6">
										<input type="text" class="form-control" id="society_full_name" name="society_full_name" placeholder="Full Name" value="{{ $society->full_name }}" disabled="disabled">
									</div>
								</div>

								<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>

								<div class="form-group row">
									<label class="col-3 col-form-label">Wing Name</label>
									<div class="col-6">
										<input class="form-control" type="text" id="wing_name" name="wing_name" value="{{ $wing->name }}">
										<div class='invalid-feedback'></div>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-3 col-form-label">Wing Type</label>
									<div class="col-3">
										<select class="form-control" id="wing_type" name="wing_type">
											<option value="">Select wing type</option>
											@isset(CommonConstants::$WING_TYPES)

											@foreach(CommonConstants::$WING_TYPES as $key=>$type)
											<?php $checked = ($key == $wing->type)?'selected="selected"':''; ?>
											<option value="{{ $key }}" {{ $checked }}>{{ $type }}</option>
											@endforeach

											@endisset
										</select>
										<div class='invalid-feedback'></div>
										<span class="form-text text-muted">Select the type of your society wing.</span>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Number of floors:</label>
									<div class="col-lg-3">
										<input type="number" class="form-control" id="number_of_floors" name="number_of_floors" placeholder="Enter number of floors" value="{{ $wing->number_of_floors }}">
										<div class='invalid-feedback'></div>
										<span class="form-text text-muted">Please enter floors the wing have</span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Flats per floor:</label>
									<div class="col-lg-3">
										<input type="number" class="form-control" id="flats_per_floor" name="flats_per_floor" placeholder="Enter Flats" value="{{ $wing->number_of_flats }}">
										<div class='invalid-feedback'></div>
										<span class="form-text text-muted">Please enter flats per floor. ie. 4 flats per floor.</span>
									</div>
								</div>

								<div class="form-group form-group-last row">
									<label class="col-lg-3 col-form-label">Status</label>
									<div class="col-lg-3">
										<div class="kt-radio-inline">
											<label class="kt-radio kt-radio--bold kt-radio--success">
												<input type="radio" name="status" value="{{ Status::$ACTIVE }}" <?php echo $wing->status == Status::$ACTIVE ? 'checked' : ''; ?> > Active
												<span></span>
											</label>
											<label class="kt-radio kt-radio--bold">
												<input type="radio" name="status" value="{{ Status::$INACTIVE }}" <?php echo $wing->status == Status::$INACTIVE ? 'checked' : ''; ?>> Inactive
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
	    // Base elements
	    var formEl;
	    var validator;

	    var initValidation = function() {
	    	validator = formEl.validate({
	            // Validate only visible fields
	            ignore: ":hidden",

	            // Validation rules
	            rules: {
	               	society_id: {
						required: true
					},
					wing_name: {
						required: true
					},
					wing_type: {
						required: true
					},
					number_of_floors: {
						required: true
					},
					flats_per_floor: {
						required: true
					}
	            },

	            // Display error
	            invalidHandler: function(event, validator) {

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
	                	type: 'POST',
	                	url: "{{ route('admin.panel.wing.save') }}",
	                    success: function(data, status) {

	                    	KTApp.unprogress(btn);
	                        KTApp.unblock(formEl);


	                        if(data.status){ //success
		                        swal.fire({
		                            "title": "Success",
		                            "text": data.message,
		                            "type": "success",
		                            showConfirmButton: false,
            						timer: 1500
		                        }).then(function(result){
		                        	window.location.href = "{{ route('admin.panel.society.edit', ['society_id' => $society->society_id, 'page' => 'wings']) }}";
		                        });
	                        } else {
	                        	swal.fire({
		                            "title": "Error",
		                            "text": data.message,
		                            "type": "error",
		                            "confirmButtonClass": "btn btn-danger"
		                        }).then(function(result) {
					                $.each(data.result, function(element){
					                	$('input[name="'+element+'"]').addClass('is-invalid').after("<div class='invalid-feedback'>"+ data.result[element][0] +"</div>");
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