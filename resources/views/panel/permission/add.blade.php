@extends('layouts.admin.default')

@section('title', 'Save Permission')
@section('pageTitle', 'Save Permission')

@section('navItemPermission', 'kt-menu__item--open')
@section('navItemPermissionAdd', 'kt-menu__item--active')


@section('styles')

@endsection

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Content Head -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					{{ __("Save Permission") }}
				</h3>
			</div>
			<div class="kt-subheader__toolbar">
				<a href="{{ route('admin.panel.permissions') }}" class="btn btn-default btn-bold">
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
									<div class="form-group form-group-sm row">
										<div class="col-xl-3 col-lg-3"></div>
										<div class="col-xl-6 col-lg-6">
											<p class="alert alert-warning">Update RolePermission Constant File for adding new permissions.</p>
										</div>

									</div>


									@foreach (RolesPermissions::$PERMISSIONS as $entity => $permissions_constants)

										<div class="form-group form-group-sm form-group-last row">
											<label class="col-xl-3 col-lg-3 col-form-label">{{ ucfirst($entity) }}</label>
											<div class="col-lg-9 col-xl-6">
												<div class="kt-checkbox-inline">
													@foreach($permissions_constants as $permission_obj => $name)

													<?php
														$checked = in_array($permission_obj, $permissions)?'checked="checked" disabled="disabled"': '';
														$state = ($checked != '') ? '':'kt-checkbox--state-success';
													?>

													<label class="kt-checkbox {{ $state }}">
														<input type="checkbox" name="permissions[]" id="chk_{{ $permission_obj }}" value="{{ $permission_obj }}" class="chkPermission" {{$checked}}/> {{ $name }}
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
												<a href="{{ route('admin.panel.permission.listing') }}" class="btn btn-clean btn-bold">Cancel</a>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					@csrf
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

	    var initSubmit = function() {
	        var btn = $('.frmSubmit');

	        btn.on('click', function(e) {
	            e.preventDefault();

                KTApp.progress(btn);
                KTApp.block(formEl);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                	type: 'POST',
                	url: "{{ route('admin.panel.permission.save') }}",
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
	                        	window.location.href = "{{ route('admin.panel.permission.listing') }}";
	                        });
                        } else {
                        	swal.fire({
	                            "title": "Error",
	                            "text": data.message,
	                            "type": "error",
	                            "confirmButtonClass": "btn btn-danger"
	                        }).then(function(result) {
				                $.each(data.result, function(element){
				                	$('input[name="'+element+'"]').addClass('is-invalid').next(".invalid-feedback").html(message);
				                });
				            });
                        }
                    }
                });

	        });
	    }
	    return {
	        // public functions
	        init: function() {
	            formEl = $('#kt_form');
	            initSubmit();
	        }
	    };
	}();

	jQuery(document).ready(function() {
	    KTForm.init();
	});
</script>
@endsection