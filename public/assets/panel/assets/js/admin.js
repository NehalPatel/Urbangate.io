/*----------  Document Events  ----------*/

$(document).ready(function() {
	plugins.load();
});

/*----------  Window Events  ----------*/

$(window).on('load', function() {

	$('#m_datetimepicker').datetimepicker({
		format: "yyyy/mm/dd",
		todayHighlight: true,
		autoclose: true,
		startView: 2,
		minView: 2,
		forceParse: 0,
		pickerPosition: 'bottom-right'
	});
});

/*----------  Preloader  ----------*/

var preloader = {
	show: function($cnt) {
		mApp.block($cnt, {
			overlayColor: '#000000',
			type: 'loader',
			state: 'primary',
			message: 'Please Wait'
		});
	},

	hide: function($cnt) {
		mApp.unblock($cnt);
	}
}

/*----------  Alerts  ----------*/

var mAlert = {
	show: function(opts) {
		var title = opts.title ? opts.title : 'Alert';
		var message = opts.message ? opts.message : '';
		var type = opts.type ? opts.type : 'error';
		var timer = opts.timer ? opts.timer : '';
		var showCancelButton = opts.showCancelButton ? opts.showCancelButton : false;
		var showConfirmButton = opts.showConfirmButton ? opts.showConfirmButton : false;
		var callback = opts.callback ? opts.callback : false;

		swal.fire({
			type: type,
			title: title,
			text: message,
			showCancelButton: showCancelButton,
			showConfirmButton: showConfirmButton,
			timer: timer
		}).then(function(e) {
			if(e.value && callback) callback();
		});
	},

	success: function(title, message, timer, showConfirmButton) {
		var opts = new Object;
		opts.type = 'success';
		opts.title = title;
		opts.message = message;
		opts.timer = timer;
		opts.showConfirmButton = showConfirmButton;

		this.show(opts);
	},

	error: function(title, message, showConfirmButton) {
		var opts = new Object;
		opts.type = 'error';
		opts.title = title;
		opts.message = message;
		opts.showConfirmButton = showConfirmButton;

		this.show(opts);
	},

	confirm: function(title, message, callback) {
		var opts = new Object;
		opts.type = 'warning';
		opts.title = title;
		opts.message = message;
		opts.showCancelButton = true;
		opts.showConfirmButton = true;
		opts.callback = callback;

		this.show(opts);
	}
}

/*----------  Plugins  ----------*/

var plugins = {
	load: function() {
		this.select();
		this.validator();
		this.datepicker();
	},

	select: function() {
		var $select = $('[data-md-select]');

		if($select.length) {
			$select.selectpicker();
		}
	},

	datepicker: function() {
		var $input = $('[data-md-datepicker]');

		if($input.length) {
			$input.each(function() {
				var opts = $(this).data('md-datepicker');
				var todayHighlight = opts.todayHighlight != undefined ? opts.todayHighlight : true;
				var format = opts.format != undefined ? opts.format : 'yyyy-mm-dd';

				$(this).datepicker({
					todayHighlight: todayHighlight,
					format: format,
					orientation: 'bottom left',
					templates: {
						leftArrow: '<i class="la la-angle-left"></i>',
						rightArrow: '<i class="la la-angle-right"></i>'
					}
				}).prop('readonly', true);
			});
		}
	},

	validator: function() {
		$.validator.setDefaults({
			errorPlacement: function(error, element) {
				var $error = $(error);
				var $element = $(element);
				var $parent = $element.closest('.m-form__group');

				$parent.append($error);
			}
		});
	}
}