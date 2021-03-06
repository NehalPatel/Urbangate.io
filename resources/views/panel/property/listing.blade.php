@extends('layouts.admin.default')

@section('title', 'Property Listing')
@section('pageTitle', 'Property Listing')

@section('navItemProperty', 'kt-menu__item--open')
@section('navItemPropertyListing', 'kt-menu__item--active')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Content Head -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					{{ __('Flats') }}
				</h3>
				<span class="kt-subheader__separator kt-subheader__separator--v"></span>
				<div class="kt-subheader__group" id="kt_subheader_search">
					<span class="kt-subheader__desc" id="kt_subheader_total">
						0 Total </span>
					<form class="kt-margin-l-20" id="kt_subheader_search_form">
						<div class="kt-input-icon kt-input-icon--right kt-subheader__search">
							<input type="text" class="form-control" placeholder="Search..." id="generalSearch">
							<span class="kt-input-icon__icon kt-input-icon__icon--right">
								<span>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
											<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
										</g>
									</svg>

									<!--<i class="flaticon2-search-1"></i>-->
								</span>
							</span>
						</div>
					</form>

					<div class="kt-input kt-subheader__search kt-margin-l-20">
						<select class="form-control" id="search_society_id" name="search_society_id">
							<option value="">Select your Society</option>
							@isset($societies)
								@foreach($societies as $society_id => $name)
								<option value="{{ $society_id }}">{{ $name }}</option>
								@endforeach
							@endisset
						</select>
					</div>
				</div>
				<div class="kt-subheader__group kt-hidden" id="kt_subheader_group_actions">
					<div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> Selected:</div>
					<div class="btn-toolbar kt-margin-l-20">
						<div class="dropdown" id="kt_subheader_group_actions_status_change">
							<button type="button" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
								Update Status
							</button>
							<div class="dropdown-menu">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">Change status to:</span>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="1">
											<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--bold">Approved</span></span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="2">
											<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--bold">Rejected</span></span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="3">
											<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-warning kt-badge--inline kt-badge--bold">Pending</span></span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="4">
											<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-info kt-badge--inline kt-badge--bold">On Hold</span></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<button class="btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_fetch" data-toggle="modal" data-target="#kt_datatable_records_fetch_modal">
							Fetch Selected
						</button>
						<button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_delete_all">
							Delete All
						</button>
					</div>
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<a href="#" class="">
				</a>
				<a href="{{ route('admin.panel.property.add') }}" class="btn btn-label-brand btn-bold"> {{ __('Add New Property') }} </a>
			</div>
		</div>
	</div>

	<!-- end:: Content Head -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__body kt-portlet__body--fit">

				<!--begin: Datatable -->
				<div class="kt-datatable" id="kt_properties_list"></div>

				<!--end: Datatable -->
			</div>
		</div>

		<!--end::Portlet-->

		<!--begin::Modal-->
		<div class="modal fade" id="kt_datatable_records_fetch_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Selected Records</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"></span>
						</button>
					</div>
					<div class="modal-body">
						<div class="kt-scroll" data-scroll="true" data-height="200">
							<ul id="kt_apps_user_fetch_records_selected"></ul>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-brand" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!--end::Modal-->
	</div>

	<!-- end:: Content -->
</div>
@endsection

@section('scripts')
<script type="text/javascript">

var KTUserListDatatable = function() {

	// variables
	var datatable;
	var token = '<?php echo csrf_token(); ?>';

	// init
	var init = function() {
		// init the datatables. Learn more: https://keenthemes.com/metronic/?page=docs&section=datatable
		datatable = $('#kt_properties_list').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						method: 'POST',
						url: '{{ route("admin.panel.property.search") }}',
						params: {
							_token: token,
						},
						map: function(response) {
							if(response.status) {
								var result = response.result;
								return result;
							}
						}
					},
				},
				pageSize: 10, // display 20 records per page
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch'),
				delay: 400,
			},

			rows: {
				afterTemplate: function(row, data, index) {
					$(row).off('click.delete').on('click.delete', '.atnDelete', function(e) {
						e.preventDefault();

						mAlert.confirm('Are you sure?', 'You won\'t be able to revert this!', function() {
							var requestData = {
								'property_id': data.property_id,
								'_token': token
							}
							post_data('<?php echo route('admin.panel.property.delete'); ?>', requestData, function(response) {
								if(response.status) {
									mAlert.success('Done!', response.message, 2000);
									datatable.reload();
								} else {
									mAlert.error('Oops!', response.message, true);
								}
							});
						});
					});
				}
			},
			// columns definition
			columns: [
			{
				field: 'property_id',
				title: '#',
				sortable: false,
				width: 20,
				selector: {
					class: 'kt-checkbox--solid'
				},
				textAlign: 'center',
			},
			{
				field: 'property_no',
				title: 'Property No',
				width: 150,
			},
			{
				field: 'society.name',
				title: 'Society Name',
				width: 200,
				sortable: false,
			},
			{
				field: 'wing.name',
				title: 'Wing Name',
				width: 200,
				sortable: false,
			},
			{
				field: 'property_number',
				width: 100,
				title: 'Flat Number'
			},
			{
				field: 'status',
				title: 'Status',
				width: 100,
				textAlign: 'center',
				template: function(row) {
					var e = {
						<?php echo Status::$DRAFT ?>: {
							title: 'Draft',
							class: 'btn-label-warning'
						},
						<?php echo Status::$ACTIVE ?>: {
							title: 'Active',
							class: ' btn-label-success'
						},
						<?php echo Status::$INACTIVE ?>: {
							title: 'Inactive',
							class: 'btn-label-danger'
						},
					};
					return `<span class="btn btn-bold btn-sm btn-font-sm ` + e[row.status].class + `">` + e[row.status].title + `</span>`;
				}
			},
			{
				field: "actions",
				title: "Actions",
				sortable: false,
				width: 200,
				textAlign: 'center',
				template: function(row) {
					var actions = '';

					var editUrl = '<?php echo route('admin.panel.property.edit', ['property_id' => ':property_id']); ?>';
					editUrl = editUrl.replace(':property_id', row.property_id);
					var atnEdit = `<a href="` + editUrl + `" class="btn btn-bold btn-sm btn-font-sm kt-font-success"><i class="la la-edit"></i></a>`;
					actions += atnEdit;

					var atnDelete = `<a href="<?php echo route('admin.panel.property.delete'); ?>" class="btn btn-bold btn-sm btn-font-sm kt-font-danger atnDelete"><i class="la la-trash"></i></a>`;
					actions += atnDelete;

					return actions;
				}
			},
		]
		});
	}

	// search
	var search = function() {
		$('#kt_form_status').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Status');
		});
	}

	var searchSociety = function() {
		$('#search_society_id').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'society_id');
		});
	}

	// selection
	var selection = function() {
		// init form controls
		//$('#kt_form_status, #kt_form_type').selectpicker();

		// event handler on check and uncheck on records
		datatable.on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',	function(e) {
			var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes(); // get selected records
			var count = checkedNodes.length; // selected records count

			$('#kt_subheader_group_selected_rows').html(count);

			if (count > 0) {
				$('#kt_subheader_search').addClass('kt-hidden');
				$('#kt_subheader_group_actions').removeClass('kt-hidden');
			} else {
				$('#kt_subheader_search').removeClass('kt-hidden');
				$('#kt_subheader_group_actions').addClass('kt-hidden');
			}
		});
	}

	// fetch selected records
	var selectedFetch = function() {
		// event handler on selected records fetch modal launch
		$('#kt_datatable_records_fetch_modal').on('show.bs.modal', function(e) {
			// show loading dialog
            var loading = new KTDialog({'type': 'loader', 'placement': 'top center', 'message': 'Loading ...'});
            loading.show();

            setTimeout(function() {
                loading.hide();
			}, 1000);

			// fetch selected IDs
			var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
				return $(chk).val();
			});

			// populate selected IDs
			var c = document.createDocumentFragment();

			for (var i = 0; i < ids.length; i++) {
				var li = document.createElement('li');
				li.setAttribute('data-id', ids[i]);
				li.innerHTML = 'Selected record ID: ' + ids[i];
				c.appendChild(li);
			}

			$(e.target).find('#kt_apps_user_fetch_records_selected').append(c);
		}).on('hide.bs.modal', function(e) {
			$(e.target).find('#kt_apps_user_fetch_records_selected').empty();
		});
	};

	// selected records status update
	var selectedStatusUpdate = function() {
		$('#kt_subheader_group_actions_status_change').on('click', "[data-toggle='status-change']", function() {
			var status = $(this).find(".kt-nav__link-text").html();

			// fetch selected IDs
			var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
				return $(chk).val();
			});

			if (ids.length > 0) {
				// learn more: https://sweetalert2.github.io/
				swal.fire({
					buttonsStyling: false,

					html: "Are you sure to update " + ids.length + " selected records status to " + status + " ?",
					type: "info",

					confirmButtonText: "Yes, update!",
					confirmButtonClass: "btn btn-sm btn-bold btn-brand",

					showCancelButton: true,
					cancelButtonText: "No, cancel",
					cancelButtonClass: "btn btn-sm btn-bold btn-default"
				}).then(function(result) {
					if (result.value) {
						swal.fire({
							title: 'Deleted!',
							text: 'Your selected records statuses have been updated!',
							type: 'success',
							buttonsStyling: false,
							confirmButtonText: "OK",
							confirmButtonClass: "btn btn-sm btn-bold btn-brand",
						})
						// result.dismiss can be 'cancel', 'overlay',
						// 'close', and 'timer'
					} else if (result.dismiss === 'cancel') {
						swal.fire({
							title: 'Cancelled',
							text: 'You selected records statuses have not been updated!',
							type: 'error',
							buttonsStyling: false,
							confirmButtonText: "OK",
							confirmButtonClass: "btn btn-sm btn-bold btn-brand",
						});
					}
				});
			}
		});
	}

	// selected records delete
	var selectedDelete = function() {
		$('#kt_subheader_group_actions_delete_all').on('click', function() {
			// fetch selected IDs
			var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
				return $(chk).val();
			});

			if (ids.length > 0) {
				// learn more: https://sweetalert2.github.io/
				swal.fire({
					buttonsStyling: false,

					text: "Are you sure to delete " + ids.length + " selected records ?",
					type: "danger",

					confirmButtonText: "Yes, delete!",
					confirmButtonClass: "btn btn-sm btn-bold btn-danger",

					showCancelButton: true,
					cancelButtonText: "No, cancel",
					cancelButtonClass: "btn btn-sm btn-bold btn-brand"
				}).then(function(result) {
					if (result.value) {

						var requestData = {
							'property_id': ids,
							'_token': token
						}

						post_data('<?php echo route('admin.panel.property.save'); ?>', requestData, function(response) {
							if(response.status) {
								mAlert.success('Done!', response.message, 2000);
								datatable.reload();
							} else {
								mAlert.error('Oops!', response.message, true);
							}
						});

						// swal.fire({
						// 	title: 'Deleted!',
						// 	text: 'Your selected records have been deleted! :(',
						// 	type: 'success',
						// 	buttonsStyling: false,
						// 	confirmButtonText: "OK",
						// 	confirmButtonClass: "btn btn-sm btn-bold btn-brand",
						// })
						// result.dismiss can be 'cancel', 'overlay',
						// 'close', and 'timer'
					} else if (result.dismiss === 'cancel') {
						swal.fire({
							title: 'Cancelled',
							text: 'You selected records have not been deleted! :)',
							type: 'error',
							buttonsStyling: false,
							confirmButtonText: "OK",
							confirmButtonClass: "btn btn-sm btn-bold btn-brand",
						});
					}
				});
			}
		});
	}

	var updateTotal = function() {
		datatable.on('kt-datatable--on-layout-updated', function () {
			$('#kt_subheader_total').html(datatable.getTotalRows() + ' Total');
		});
	};

	return {
		// public functions
		init: function() {
			init();
			search();
			searchSociety();
			selection();
			selectedFetch();
			selectedStatusUpdate();
			selectedDelete();
			updateTotal();
		},
	};
}();

// On document ready
KTUtil.ready(function() {
	KTUserListDatatable.init();
});

</script>

@endsection