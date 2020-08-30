@extends('layouts.admin.default')

<?php if($role->id) { ?>
	@section('title', 'Edit Role')
	@section('pageTitle', 'Edit Role')

	@section('navItemRole', 'kt-menu__item--open')
<?php } else { ?>
	@section('title', 'Add Role')
	@section('pageTitle', 'Add Role')

	@section('navItemRole', 'kt-menu__item--open')
	@section('navItemRoleAdd', 'kt-menu__item--active')
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
					@if($role->id)
						{{ __("Edit Role") }}
					@else
						{{ __("Add Role") }}
					@endif
				</h3>
				<span class="kt-subheader__separator kt-subheader__separator--v"></span>
				<div class="kt-subheader__group" id="kt_subheader_search">
					<span class="kt-subheader__desc" id="kt_subheader_total">
						@if($role->id){{ $role->name }}@endif </span>
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<a href="{{ route('admin.panel.roles') }}" class="btn btn-default btn-bold">
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
			<div class="kt-portlet__body">
				<form action="" method="post" id="kt_form">

					<div class="kt-form kt-form--label-right">
						<div class="kt-form__body">
							<div class="kt-section kt-section--first">
								<div class="kt-section__body">
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Role Name</label>
										<div class="col-lg-9 col-xl-6">
											<input class="form-control" type="text" id="name" name="name" value="{{ $role->name }}">
											<div class="invalid-feedback"></div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Role Guard</label>
										<div class="col-lg-2 col-xl-2">
											<select name="guard_name" class="form-control">
												@foreach (RolesPermissions::$GUARDS as $guard_name): ?>
													<?php $checked_gate = ($role->guard_name==$guard_name)?'selected="selected"':''; ?>
													<option value="{{ $guard_name }}" {{ $checked_gate }}>{{ $guard_name }}</option>
												<?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>

									<div class="form-group form-group-sm row">
										<div class="col-xl-3 col-lg-3"></div>
										<div class="col-lg-9 col-xl-6">
											<div class="kt-checkbox-list">
												<label class="kt-checkbox">
													<input type="checkbox" id="selectall">
													Select All Permissions
													<span></span>
												</label>
											</div>
										</div>
									</div>

									@foreach (RolesPermissions::$PERMISSIONS as $entity => $permissions)

										<div class="form-group form-group-sm form-group-last row">
											<label class="col-xl-3 col-lg-3 col-form-label">{{ ucfirst($entity) }}</label>
											<div class="col-lg-9 col-xl-6">
												<div class="kt-checkbox-inline">
													@foreach($permissions as $permission => $name)

													<?php $checked = in_array($permission, $role_permissions)?'checked="checked"': ''; ?>

													<label class="kt-checkbox">
														<input type="checkbox" name="permissions[]" id="chk_{{ $permission }}" value="{{ $permission }}" class="chkPermission" {{$checked}}/> {{ $name }}
														<span></span>
													</label>

													@endforeach

												</div>
											</div>
										</div>

									@endforeach


									<div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-xl-3"></div>
											<div class="col-lg-9 col-xl-6">
												<a href="#" class="btn btn-label-brand btn-bold frmSubmit">Save</a>
												<a href="{{ route('admin.panel.role.listing') }}" class="btn btn-clean btn-bold">Cancel</a>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					@csrf
					<input type="hidden" name="role_id" value="<?php echo $role->id; ?>"/>
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

	    var initValidation = function() {
	    	validator = formEl.validate({
	            // Validate only visible fields
	            ignore: ":hidden",

	            // Validation rules
	            rules: {
	               	name: {
						required: true
					},
					gate_name: {
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

	            if (validator.form()) {
	                // See: src\js\framework\base\app.js
	                KTApp.progress(btn);
	                KTApp.block(formEl);
	                $(".form-control").removeClass(['is-invalid', 'is-valid']);

	                // See: http://malsup.com/jquery/form/#ajaxSubmit
	                formEl.ajaxSubmit({
	                	type: 'POST',
	                	url: "{{ route('admin.panel.role.save') }}",
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
		                        	window.location.href = "{{ route('admin.panel.role.listing') }}";
		                        });
	                        } else {
	                        	swal.fire({
		                            "title": "Error",
		                            "text": data.message,
		                            "type": "error",
		                            "confirmButtonClass": "btn btn-danger"
		                        }).then(function(result) {
					                $.each(data.result, function(element){
					                	$('input[name="'+element+'"]').addClass('is-invalid').next(".invalid-feedback").html(message);;
					                });
					            });
	                        }
	                    }
	                });
	            }
	        });
	    }

	    var initPermissionSelection = function(){
	    	$('#selectall').on('click', function(){
				if($(this).prop("checked")) {
					$(".chkPermission").prop("checked", true);
				} else {
					$(".chkPermission").prop("checked", false);
				}
			});
	    }

	    return {
	        // public functions
	        init: function() {
	            formEl = $('#kt_form');
	            initValidation();
	            initSubmit();
	            initPermissionSelection();
	        }
	    };
	}();

	jQuery(document).ready(function() {
	    KTForm.init();
	});
</script>
@endsection