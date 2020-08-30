@extends('layouts.admin.default')

<?php if($property->property_id) { ?>
	@section('title', 'Edit Property')
	@section('pageTitle', 'Edit Property')

	@section('navItemProperty', 'kt-menu__item--open')
<?php } else { ?>
	@section('title', 'Add Property')
	@section('pageTitle', 'Add Property')

	@section('navItemProperty', 'kt-menu__item--open')
	@section('navItemPropertyAdd', 'kt-menu__item--active')
<?php } ?>


@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">
			<div class="col-lg-12">

				<!--begin::Portlet-->
				<form class="kt-form" id="kt_form" method="post" action="{{ route('admin.panel.property.save') }}">
					<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
						<div class="kt-portlet__head kt-portlet__head--lg">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">Add New Property <small></small></h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<a href="{{ route('admin.panel.property.listing') }}" class="btn btn-clean kt-margin-r-10">
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
						<div class="kt-portlet__body">

							<div class="row">
								<div class="col-xl-2"></div>
								<div class="col-xl-8">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											<h3 class="kt-section__title kt-section__title-lg">Wing Info:</h3>
											<div class="form-group row">
												<label class="col-3 col-form-label">Select Society</label>
												<div class="col-9">
													<select class="form-control" id="society_id" name="society_id">
														<option value="">Select your Society</option>
														@isset($societies)

														@foreach($societies as $society)
														<?php
															$checked = '';
															if($property->society)
																$checked = ($society->society_id == $property->society->society_id)?'selected="selected"':'';
														?>
														<option value="{{ $society->society_id }}" {{$checked}} >{{ $society->name }}</option>
														@endforeach

														@endisset
													</select>
													<div class='invalid-feedback'></div>
												</div>

											</div>

											<div class="form-group row">
												<label class="col-3 col-form-label">Wing Name</label>
												<div class="col-3">
													<select class="form-control" id="wing_id" name="wing_id">
														<option value="">Select your Wing</option>
														@isset($wings)

														@foreach($wings as $wing)
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
					</div>

					@csrf
					<input type="hidden" name="property_id" value="{{ $property->property_id}}" />
				</form>

				<!--end::Portlet-->
			</div>
		</div>
	</div>


</div>

	<!-- end:: Content -->
@endsection

@section('scripts')
<script type="text/javascript">

var token = '<?php echo csrf_token(); ?>';

var KTForm = function () {

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
               	wing_id: {
               		required: true
               	},
				property_number: {
					required: true
				},
				floor_number: {
					required: true
				},
				type: {
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

    var initWings = function() {
	    $("#society_id").bind('change', function(){
			var requestData = {
				'society_id': $(this).val(),
				'_token': token
			}
			post_data('<?php echo route('admin.panel.society.wings'); ?>', requestData, function(response) {
				$("#wing_id").find('option').remove().end().append('<option value="">Select your Wing</option>');

				$.each(response.result, function(index, value){
					$("#wing_id").append('<option value="'+ value.wing_id +'">'+ value.name +'</option>');
			    });
			});
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
                        		window.location.href = "{{ route('admin.panel.property.listing') }}";
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
        	initWings();
        }
    };
}();

jQuery(document).ready(function() {
	KTForm.init();

	// $("#society_id").bind('change', function(){
	// 	var requestData = {
	// 		'society_id': $(this).val(),
	// 		'_token': token
	// 	}
	// 	post_data('<?php echo route('admin.panel.society.wings'); ?>', requestData, function(response) {
	// 		$("#wing_id").find('option').remove().end().append('<option value="">Select your Wing</option>');

	// 		$.each(response.result, function(index, value){
	// 			$("#wing_id").append('<option value="'+ value.wing_id +'">'+ value.name +'</option>');
	// 	    });
	// 	});
	// })
});
</script>

@endsection
