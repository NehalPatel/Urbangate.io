@extends('layouts.admin.default')

<?php if($societyCommittee->society_committee_id) { ?>
	@section('title', 'Edit Society Committee')
	@section('pageTitle', 'Edit Society Committee')

	@section('navItemSocietyCommittee', 'kt-menu__item--open')
<?php } else { ?>
	@section('title', 'Add Society Committee')
	@section('pageTitle', 'Add Society Committee')

	@section('navItemSocietyCommittee', 'kt-menu__item--open')
	@section('navItemSocietyCommitteeAdd', 'kt-menu__item--active')
<?php } ?>

@section('styles')

@endsection

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!--begin::Portlet-->
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon kt-hidden">
						<i class="la la-gear"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						Form Repeater Example
					</h3>
				</div>
			</div>

			<!--begin::Form-->
			<form class="kt-form">
				<div class="kt-portlet__body">
					<div class="kt-form__section kt-form__section--first">
						<div class="form-group row">
							<label class="col-lg-2 col-form-label">Full Name:</label>
							<div class="col-lg-4">
								<input type="email" class="form-control" placeholder="Enter full name">
								<span class="form-text text-muted">Please enter your full name</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2 col-form-label">Email address:</label>
							<div class="col-lg-4">
								<input type="email" class="form-control" placeholder="Enter email">
								<span class="form-text text-muted">We'll never share your email with anyone else</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2 col-form-label">Contact</label>
							<div class="col-lg-4">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="la la-chain"></i></span></div>
									<input type="text" class="form-control" placeholder="Phone number">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2 col-form-label">Communication:</label>
							<div class="col-xl-8 col-lg-8 col-sm-12 col-md-12">
								<div class="kt-checkbox-inline">
									<label class="kt-checkbox">
										<input type="checkbox"> Email
										<span></span>
									</label>
									<label class="kt-checkbox">
										<input type="checkbox"> SMS
										<span></span>
									</label>
									<label class="kt-checkbox">
										<input type="checkbox"> Phone
										<span></span>
									</label>
								</div>
							</div>
						</div>
						<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
						<div id="kt_repeater_1">
							<div class="form-group form-group-last row" id="kt_repeater_1">
								<label class="col-lg-2 col-form-label">Contacts:</label>
								<div data-repeater-list="" class="col-lg-10">
									<div data-repeater-item class="form-group row align-items-center">
										<div class="col-md-3">
											<div class="kt-form__group--inline">
												<div class="kt-form__label">
													<label>Name:</label>
												</div>
												<div class="kt-form__control">
													<input type="email" class="form-control" placeholder="Enter full name">
												</div>
											</div>
											<div class="d-md-none kt-margin-b-10"></div>
										</div>
										<div class="col-md-3">
											<div class="kt-form__group--inline">
												<div class="kt-form__label">
													<label class="kt-label m-label--single">Number:</label>
												</div>
												<div class="kt-form__control">
													<input type="email" class="form-control" placeholder="Enter contact number">
												</div>
											</div>
											<div class="d-md-none kt-margin-b-10"></div>
										</div>
										<div class="col-md-2">
											<div class="kt-radio-inline">
												<label class="kt-checkbox kt-checkbox--state-success">
													<input type="checkbox"> Primary
													<span></span>
												</label>
											</div>
										</div>
										<div class="col-md-4">
											<a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
												<i class="la la-trash-o"></i>
												Delete
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group form-group-last row">
								<label class="col-lg-2 col-form-label"></label>
								<div class="col-lg-4">
									<a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand">
										<i class="la la-plus"></i> Add
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-2"></div>
							<div class="col-lg-2">
								<button type="reset" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-secondary">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>

			<!--end::Form-->
		</div>

		<!--end::Portlet-->

		<!--begin::Portlet-->
		<div class="row">
			<div class="col-lg-6">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon kt-hidden">
								<i class="la la-gear"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								Form Repeater Example
							</h3>
						</div>
					</div>

					<!--begin::Form-->
					<form class="kt-form">
						<div class="kt-portlet__body">
							<div class="kt-form__section kt-form__section--first">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Full Name:</label>
									<div class="col-lg-6">
										<input type="email" class="form-control" placeholder="Enter full name">
										<span class="form-text text-muted">Please enter your full name</span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Email address:</label>
									<div class="col-lg-6">
										<input type="email" class="form-control" placeholder="Enter email">
										<span class="form-text text-muted">We'll never share your email with anyone else</span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Communication:</label>
									<div class="col-lg-12 col-xl-8">
										<div class="kt-checkbox-inline kt-padding-top-3">
											<label class="kt-checkbox">
												<input type="checkbox"> Email
												<span></span>
											</label>
											<label class="kt-checkbox">
												<input type="checkbox"> SMS
												<span></span>
											</label>
											<label class="kt-checkbox">
												<input type="checkbox"> Phone
												<span></span>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Credit Card</label>
									<div class="col-lg-6 ">
										<div class="input-group">
											<input type="text" class="form-control" name="creditcard" placeholder="Enter card number">
											<div class="input-group-append">
												<span class="input-group-text"><i class="la la-credit-card"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div id="kt_repeater_2">
									<div class="form-group  row">
										<label class="col-lg-3 col-form-label">Contact:</label>
										<div data-repeater-list="" class="col-lg-6">
											<div data-repeater-item class="kt-margin-b-10">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="la la-phone"></i>
														</span>
													</div>
													<input type="text" class="form-control form-control-danger" placeholder="Enter telephone">
													<div class="input-group-append">
														<a href="javascript:;" class="btn btn-danger btn-icon">
															<i class="la la-close"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3"></div>
										<div class="col">
											<div data-repeater-create="" class="btn btn btn-warning">
												<span>
													<i class="la la-plus"></i>
													<span>Add</span>
												</span>
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
										<button type="reset" class="btn btn-brand">Submit</button>
										<button type="reset" class="btn btn-secondary">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</form>

					<!--end::Form-->
				</div>
			</div>
			<div class="col-lg-6">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon kt-hidden">
								<i class="la la-gear"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								Form Repeater Example
							</h3>
						</div>
					</div>

					<!--begin::Form-->
					<form class="kt-form">
						<div class="kt-portlet__body">
							<div class="kt-form__section kt-form__section--first">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Full Name:</label>
									<div class="col-lg-6">
										<input type="email" class="form-control" placeholder="Enter full name">
										<span class="form-text text-muted">Please enter your full name</span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Email address:</label>
									<div class="col-lg-6">
										<input type="email" class="form-control" placeholder="Enter email">
										<span class="form-text text-muted">We'll never share your email with anyone else</span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Communication:</label>
									<div class="col-lg-12 col-xl-8">
										<div class="kt-checkbox-inline kt-padding-top-3">
											<label class="kt-checkbox">
												<input type="checkbox"> Email
												<span></span>
											</label>
											<label class="kt-checkbox">
												<input type="checkbox"> SMS
												<span></span>
											</label>
											<label class="kt-checkbox">
												<input type="checkbox"> Phone
												<span></span>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Credit Card</label>
									<div class="col-lg-6 ">
										<div class="input-group">
											<input type="text" class="form-control" name="creditcard" placeholder="Enter card number">
											<div class="input-group-append"><span class="input-group-text"><i class="la la-credit-card"></i></span></div>
										</div>
									</div>
								</div>
								<div id="kt_repeater_3">
									<div class="form-group  row">
										<label class="col-lg-3 col-form-label">Contact:</label>
										<div data-repeater-list="" class="col-lg-9">
											<div data-repeater-item class="row kt-margin-b-10">
												<div class="col-lg-5">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<i class="la la-phone"></i>
															</span>
														</div>
														<input type="text" class="form-control form-control-danger" placeholder="Phone">
													</div>
												</div>
												<div class="col-lg-5">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<i class="la la-envelope"></i>
															</span>
														</div>
														<input type="text" class="form-control form-control-danger" placeholder="Email">
													</div>
												</div>
												<div class="col-lg-2">
													<a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
														<i class="la la-remove"></i>
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3"></div>
										<div class="col">
											<div data-repeater-create="" class="btn btn btn-primary">
												<span>
													<i class="la la-plus"></i>
													<span>Add</span>
												</span>
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
										<button type="reset" class="btn btn-brand btn-pill btn-elevate">Submit</button>
										<button type="reset" class="btn btn-secondary btn-pill btn-elevate">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</form>

					<!--end::Form-->
				</div>
			</div>
		</div>

		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	// Class definition
var KTFormRepeater = function() {

    // Private functions
    var demo1 = function() {
        $('#kt_repeater_1').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    var demo2 = function() {
        $('#kt_repeater_2').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });
    }


    var demo3 = function() {
        $('#kt_repeater_3').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });
    }

    var demo4 = function() {
        $('#kt_repeater_4').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    var demo5 = function() {
        $('#kt_repeater_5').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    var demo6 = function() {
        $('#kt_repeater_6').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }
    return {
        // public functions
        init: function() {
            demo1();
            demo2();
            demo3();
            demo4();
            demo5();
            demo6();
        }
    };
}();

jQuery(document).ready(function() {
    KTFormRepeater.init();
});


</script>
@endsection
