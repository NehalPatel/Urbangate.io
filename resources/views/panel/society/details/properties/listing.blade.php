<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
	<div class="row">
		<div class="col-xl-12">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">Society Properties <small> view society all properties</small></h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<a href="{{ route('admin.panel.society.listing') }}" class="btn btn-clean btn-icon-sm">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
							&nbsp;
							<a href="{{ route('admin.panel.property.add', ['society_id' => $society->society_id]) }}" class="btn btn-brand btn-icon-sm">
								<i class="flaticon2-plus"></i>
								{{ __('Add New Property') }}
							</a>
						</div>
					</div>
				</div>


				<form class="kt-form kt-form--label-right" id="kt_form" method="post" action="{{ route('admin.panel.society.saveBasic') }}">
					@csrf
					<input type="hidden" name="society_id" value="{{ $society->society_id}}" />
					<div class="kt-portlet__body">

						<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
							<div class="row align-items-center">
								<div class="col-xl-8 order-2 order-xl-1">
									<div class="row align-items-center">
										<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-input-icon kt-input-icon--left">
												<input type="text" class="form-control" placeholder="Search..." id="generalSearch">
												<span class="kt-input-icon__icon kt-input-icon__icon--left">
													<span><i class="la la-search"></i></span>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-4 order-1 order-xl-2 kt-align-right">
									<a href="#" class="btn btn-default kt-hidden">
										<i class="la la-cart-plus"></i> New Order
									</a>
									<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
								</div>
							</div>
						</div>
						<!--begin: Datatable -->
						<div class="kt-datatable" id="kt_properties_list"></div>

						<!--end: Datatable -->
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

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
							query: {'society_id':'{{ $society->society_id }}'}
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