<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
	<div class="row">
		<div class="col-xl-12">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">Society Properties <small>update society properties</small></h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<a href="{{ route('admin.panel.society.edit', ['society_id' => $society->society_id, 'page' => 'properties']) }}" class="btn btn-clean btn-icon-sm">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
							&nbsp;
						</div>
					</div>
				</div>
				<form class="kt-form kt-form--label-right" id="kt_form" method="post">
					@csrf
					<input type="hidden" name="society_id" value="{{ $society->society_id}}" />
					<input type="hidden" name="property_id" value="{{ $property->property_id}}" />
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								<div class="row">
									<div class="col-lg-9 col-xl-6">
										<h3 class="kt-section__title kt-section__title-sm">Society Information:</h3>
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

								<div class="row">
									<div class="col-xl-8">
										<div class="kt-section kt-section--first">
											<div class="kt-section__body">
												<h3 class="kt-section__title kt-section__title-lg">Property Information:</h3>

												<div class="form-group row">
													<label class="col-3 col-form-label">Wing Name</label>
													<div class="col-3">
														<select class="form-control" id="wing_id" name="wing_id">
															<option value="">Select your Wing</option>
															@isset($society->wings)

															@foreach($society->wings as $wing)
															<?php
																$checked = '';
																if($property->wing)
																	$checked = ($wing->wing_id == $property->wing->wing_id)?'selected="selected"':'';
															?>
															<option value="{{ $wing->wing_id }}" {{$checked}} >{{ $wing->name }}</option>
															@endforeach

															@endisset
														</select>
														<div class='invalid-feedback'></div>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Property Number:</label>
													<div class="col-lg-3">
														<input type="number" class="form-control" id="property_number" name="property_number" placeholder="Enter number of floors" value="{{ $property->property_number }}">
														<div class='invalid-feedback'></div>
														<span class="form-text text-muted">Please your property number.</span>
													</div>
													<div class="col-lg-1"></div>
													<label class="col-lg-2 col-form-label">Floor Number:</label>
													<div class="col-lg-3">
														<input type="number" class="form-control" id="floor_number" name="floor_number" placeholder="Enter Flats" value="{{ $property->floor_number }}">
														<div class='invalid-feedback'></div>
														<span class="form-text text-muted">Property Floor Number</span>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-3 col-form-label">Property Type</label>
													<div class="col-3">
														<select class="form-control" id="type" name="type">
															<option value="">Select property type</option>
															@isset(CommonConstants::$PROPERTY_TYPES)

															@foreach(CommonConstants::$PROPERTY_TYPES as $key=>$type)
															<?php $checked = ($key == $property->type)?'selected="selected"':''; ?>
															<option value="{{ $key }}" {{ $checked }}>{{ $type }}</option>
															@endforeach

															@endisset
														</select>
														<div class='invalid-feedback'></div>
														<span class="form-text text-muted">Select the type of your society wing.</span>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Flat Location:</label>
													<div class="col-lg-3">
														<input type="text" class="form-control" id="property_location" name="property_location" placeholder="Property Location" value="{{ $property->property_location }}">
														<div class='invalid-feedback'></div>
														<span class="form-text text-muted">Property location.</span>
													</div>
													<div class="col-lg-1"></div>
													<label class="col-lg-2 col-form-label">Property Size:</label>
													<div class="col-lg-3">
														<input type="number" class="form-control" id="property_size_sqft" name="property_size_sqft" placeholder="Size in sqft." value="{{ $property->property_size_sqft }}">
														<div class='invalid-feedback'></div>
														<span class="form-text text-muted">Property size in sqft.</span>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-3 col-form-label">Property Owner</label>
													<div class="col-3">
														<select class="form-control" id="wing_type" name="wing_type">
															<option value="">Select Property Owner</option>
														</select>
														<div class='invalid-feedback'></div>
														<span class="form-text text-muted">Select primary owner.</span>
													</div>
													<div class="col-lg-1"></div>
													<label class="col-lg-2 col-form-label">Property Owner 2:</label>
													<div class="col-3">
														<select class="form-control" id="wing_type" name="wing_type">
															<option value="">Select Property Secondary Owner</option>
														</select>
														<div class='invalid-feedback'></div>
														<span class="form-text text-muted">Select secondary owner.</span>
													</div>
												</div>

												<div class="form-group form-group-last row">
													<label class="col-lg-3 col-form-label">Status</label>
													<div class="col-lg-3">
														<div class="kt-radio-inline">
															<label class="kt-radio kt-radio--bold kt-radio--success">
																<input type="radio" name="status" value="{{ Status::$ACTIVE }}" <?php echo $property->status == Status::$ACTIVE ? 'checked' : ''; ?> > Active
																<span></span>
															</label>
															<label class="kt-radio kt-radio--bold">
																<input type="radio" name="status" value="{{ Status::$INACTIVE }}" <?php echo $property->status == Status::$INACTIVE ? 'checked' : ''; ?>> Inactive
																<span></span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-2"></div>
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