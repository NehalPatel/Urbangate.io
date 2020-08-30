@extends('layouts.admin.default')

<?php if($admin->admin_id) { ?>
	@section('title', 'Edit Admin')
	@section('pageTitle', 'Edit Admin')

	@section('navItemAdmin', 'kt-menu__item--open')
<?php } else { ?>
	@section('title', 'Add Admin')
	@section('pageTitle', 'Add Admin')

	@section('navItemAdmin', 'kt-menu__item--open')
	@section('navItemAdminAdd', 'kt-menu__item--active')
<?php } ?>


@section('styles')

@endsection

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Content Head -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					@if($admin->admin_id)
						{{ __("Edit Admin") }}
					@else
						{{ __("Add Admin") }}
					@endif
				</h3>
				<span class="kt-subheader__separator kt-subheader__separator--v"></span>
				<div class="kt-subheader__group" id="kt_subheader_search">
					<span class="kt-subheader__desc" id="kt_subheader_total">
						@if($admin->admin_id){{ $admin->full_name }}@endif </span>
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<a href="{{ route('admin.panel.admins') }}" class="btn btn-default btn-bold">
					Back </a>
				<div class="btn-group">
					<button type="button" class="btn btn-brand btn-bold frmSubmit">Save Changes </button>
				</div>
			</div>
		</div>
	</div>

	<!-- end:: Content Head -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--tabs">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-toolbar">
					<ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1" role="tab">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
										<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
									</g>
								</svg> Profile
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_4" role="tab">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
										<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
									</g>
								</svg> Settings
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="kt-portlet__body">
				<form action="" method="post" id="kt_form">
					<div class="tab-content">
						<div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
							<div class="kt-form kt-form--label-right">
								<div class="kt-form__body">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											<div class="row">
												<label class="col-xl-3"></label>
												<div class="col-lg-9 col-xl-6">
													<h3 class="kt-section__title kt-section__title-sm">Admin Account Info:</h3>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
												<div class="col-lg-9 col-xl-6">
													<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
														<div class="kt-avatar__holder" style="background-image: url('{{ config('panel.paths.assets') }}/media/users/default.jpg');"></div>
														<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
															<i class="fa fa-pen"></i>
															<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
														</label>
														<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
															<i class="fa fa-times"></i>
														</span>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
												<div class="col-lg-9 col-xl-6">
													<input class="form-control" type="text" id="first_name" name="first_name" value="{{ $admin->first_name }}">
													<div class="invalid-feedback"></div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
												<div class="col-lg-9 col-xl-6">
													<input class="form-control" type="text" id="last_name" name="last_name" value="{{ $admin->last_name }}">
													<div class="invalid-feedback"></div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
												<div class="col-lg-9 col-xl-6">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
														<input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" autocomplete="off" placeholder="Email" aria-describedby="basic-addon1">
														<div class="invalid-feedback"></div>
													</div>
												</div>
											</div>

											<div class="form-group form-group-last row">
												<label class="col-xl-3 col-lg-3 col-form-label">Password</label>
												<div class="col-lg-9 col-xl-6">
													<input type="password" class="form-control" id="password" name="password" placeholder="Password">
													<div class="invalid-feedback"></div>
													@if($admin->admin_id)
													<span class="form-text text-muted">Keep blank if you dont want to change existing password.</span>
													@endif
												</div>
											</div>

											<div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
											<div class="kt-form__actions">
												<div class="row">
													<div class="col-xl-3"></div>
													<div class="col-lg-9 col-xl-6">
														<a href="#" class="btn btn-label-brand btn-bold frmSubmit">Save</a>
														<a href="{{ route('admin.panel.admin.listing') }}" class="btn btn-clean btn-bold">Cancel</a>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="kt_user_edit_tab_4" role="tabpanel">
							<div class="kt-form kt-form--label-right">
								<div class="kt-form__body">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											<div class="row">
												<label class="col-xl-3"></label>
												<div class="col-lg-9 col-xl-6">
													<h3 class="kt-section__title kt-section__title-sm">Admin Account Settings:</h3>
												</div>
											</div>
											<div class="form-group form-group-sm form-group-last row">
												<label class="col-xl-3 col-lg-3 col-form-label">Status</label>
												<div class="col-lg-9 col-xl-6">
													<div class="kt-radio-inline">
														<label class="kt-radio">
															<input type="radio" name="status" value="<?php echo Status::$ACTIVE; ?>" <?php echo $admin->status == Status::$ACTIVE ? 'checked' : ''; ?>/> Active
															<span></span>
														</label>
														<label class="kt-radio">
															<input type="radio" name="status" value="<?php echo Status::$INACTIVE; ?>" <?php echo $admin->status == Status::$INACTIVE ? 'checked' : ''; ?>/> Inactive
															<span></span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					@csrf
					<input type="hidden" name="admin_id" value="<?php echo $admin->admin_id; ?>"/>
				</form>
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
	    var avatar;

		var initUserForm = function() {
			avatar = new KTAvatar('kt_user_edit_avatar');
			$("#kt_user_edit_avatar").on('change', function(e){
				console.log('photo change thayo alya');
			});
		}

	    var initValidation = function() {
	    	validator = formEl.validate({
	            // Validate only visible fields
	            ignore: ":hidden",

	            // Validation rules
	            rules: {
	               	first_name: {
						required: true
					},
					last_name: {
						required: true
					},
					email: {
						required: true
					},
					@if(!$admin->admin_id)
					password: {
						required: true
					},
					@endif
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

	            if (validator.form()) {
	                // See: src\js\framework\base\app.js
	                KTApp.progress(btn);
	                KTApp.block(formEl);
	                $(".form-control").removeClass(['is-invalid', 'is-valid']);

	                // See: http://malsup.com/jquery/form/#ajaxSubmit
	                formEl.ajaxSubmit({
	                	type: 'POST',
	                	url: "{{ route('admin.panel.admin.save') }}",
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
		                        	window.location.href = "{{ route('admin.panel.admin.listing') }}";
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
	            initUserForm();
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