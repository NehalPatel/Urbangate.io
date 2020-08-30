@extends('layouts.admin.default')

<?php if($wing->wingId) { ?>
	@section('title', 'Edit Wing')
	@section('pageTitle', 'Edit Wing')

	@section('navItemWing', 'kt-menu__item--open')
<?php } else { ?>
	@section('title', 'Add Wing')
	@section('pageTitle', 'Add Wing')

	@section('navItemWing', 'kt-menu__item--open')
	@section('navItemWingAdd', 'kt-menu__item--active')
<?php } ?>

@section('styles')

@endsection

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">
			<div class="col-lg-12">

				<!--begin::Portlet-->
				<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">Add New Society Wing <small></small></h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<a href="{{ route('admin.panel.wing.listing') }}" class="btn btn-clean kt-margin-r-10">
								<i class="la la-arrow-left"></i>
								<span class="kt-hidden-mobile">Back</span>
							</a>
							<div class="btn-group">
								<button type="button" class="btn btn-brand form-submit">
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
						<form class="kt-form" id="kt_form">
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
															if($wing->society)
																$checked = ($society->society_id == $wing->society->society_id)?'selected="selected"':'';
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
												<div class="col-9">
													<input class="form-control" type="text" id="wing_name" name="wing_name" value="{{ $wing->name }}">
													<div class='invalid-feedback'></div>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-3 col-form-label">Wing Type</label>
												<div class="col-9">
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
												<label class="col-lg-3 col-form-label">Number of Floors:</label>
												<div class="col-lg-3">
													<input type="number" class="form-control" id="number_of_floors" name="number_of_floors" placeholder="Enter number of floors" value="{{ $wing->number_of_floors }}">
													<div class='invalid-feedback'></div>
													<span class="form-text text-muted">Please enter floors the wing have</span>
												</div>
												<div class="col-lg-1"></div>
												<label class="col-lg-2 col-form-label">Flats per floor:</label>
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
								<div class="col-xl-2"></div>
							</div>
							@csrf
							<input type="hidden" name="wing_id" value="{{ $wing->wing_id}}" />
						</form>
					</div>
				</div>

				<!--end::Portlet-->
			</div>
		</div>
	</div>

	<!-- end:: Content -->

</div>
@endsection

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
	        var btn = $('.form-submit');

	        btn.on('click', function(e) {
	            e.preventDefault();

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
		                            "confirmButtonClass": "btn btn-brand"
		                        }).then(function(result){
		                        	window.location.href = "{{ route('admin.panel.wing.listing') }}";
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
