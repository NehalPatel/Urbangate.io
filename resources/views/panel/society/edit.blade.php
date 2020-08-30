@extends('layouts.admin.default')

@section('title', 'Society Listing')
@section('pageTitle', 'Society Listing')

@section('navItemSociety', 'kt-menu__item--open')
@section('navItemSocietyListing', 'kt-menu__item--active')

@section('styles')
@endsection

@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

	<!-- begin:: Content Head -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Update Society Details
				</h3>
				<span class="kt-subheader__separator kt-subheader__separator--v"></span>
				<div class="kt-subheader__group">
					<span class="kt-subheader__desc">
						{{ $society->name??'' }} </span>
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<a href="{{ route('admin.panel.society.listing') }}" class="btn btn-default btn-bold">
					{{ __('Back') }} </a>
			</div>
		</div>
	</div>
	<!-- end:: Content Head -->

	<!--Begin::App-->
	<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

		<!--Begin:: App Aside Mobile Toggle-->
		<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
			<i class="la la-close"></i>
		</button>

		<!--End:: App Aside Mobile Toggle-->

		<!--Begin:: App Aside-->
		@include('panel.society.details.menu')
		<!--End:: App Aside-->
		<!--Begin:: App Content-->

		@switch($page)
			@case('basic')
				@include('panel.society.details.basic')
				@break

			@case('location')
				@include('panel.society.details.location')
				@break

			@case('bank')
				@include('panel.society.details.bank')
				@break

			@case('wings')
				@include('panel.society.details.wings.listing')
				@break
			@case('wings.add')
				@include('panel.society.details.wings.add')
				@break

			@case('properties')
				@include('panel.society.details.properties.listing')
				@break
			@case('properties.add')
				@include('panel.society.details.properties.add')
				@break

			@case('properties')
				@include('panel.society.details.properties')
				@break

			@default
				@include('panel.society.details.basic')
		@endswitch
		<!--End:: App Content-->

	</div>

	<!--End::App-->
</div>

@endsection

@section('scripts')

@endsection
