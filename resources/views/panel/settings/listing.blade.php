@extends('layouts.admin.default')

@section('pageTitle', 'Settings')
@section('title', 'Settings')

@section('navItemSetting', 'kt-menu__item--open')
@section('navItemSystemSetting', 'kt-menu__item--active')


@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">


		@if(Session::has('success'))
	        <div class="alert alert-success fade show" role="alert">
				<div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
				<div class="alert-text">{!!Session::get('success')!!}</div>
				<div class="alert-close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="la la-close"></i></span>
					</button>
				</div>
			</div>
	    @endif

	    @if(Session::has('error'))
	        <div class="alert alert-error fade show" role="alert">
				<div class="alert-icon"><i class="flaticon2-exclamation"></i></div>
				<div class="alert-text">{!!Session::get('error')!!}</div>
				<div class="alert-close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="la la-close"></i></span>
					</button>
				</div>
			</div>
	    @endif

		<form role="form" id="product_form" action="<?php echo route('admin.panel.settings.save'); ?>" method="POST" novalidate>
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

		<div class="kt-portlet kt-portlet--tabs">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						System Settings
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-right" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_tab_content" role="tab">
								<i class="flaticon-cogwheel-2"></i> General
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_tab_content" role="tab">
								<i class="flaticon-chat"></i> Social
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_3_tab_content" role="tab">
								<i class="flaticon-letter-g"></i> Google
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="kt-portlet__body">
				<div class="tab-content">
					<div class="tab-pane active" id="kt_portlet_base_demo_1_tab_content" role="tabpanel">
						@include('panel.settings.partials.general')
					</div>
					<div class="tab-pane" id="kt_portlet_base_demo_2_tab_content" role="tabpanel">
						@include('panel.settings.partials.social')
					</div>
					<div class="tab-pane" id="kt_portlet_base_demo_3_tab_content" role="tabpanel">
						@include('panel.settings.partials.google')
					</div>
				</div>
			</div>
		</div>

		</form>

	</div>
</div>

@endsection

@section('scoped_scripts')

	<script type="text/javascript">
		$(function()
		{
			$(document).ready(function()
			{
				$('#address').wysihtml5();
			});

		}(jQuery));
	</script>

@endsection
