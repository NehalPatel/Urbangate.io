<section class="content-container">
	<div class="box">

		<div class="box-body">

			<?php //dd($settings['address']['value']); ?>

            <div class="form-group kt-form__group">
                <label for="settings[site_name]">Website Name:</label>
                <div class="input-group kt-input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-desktop"></i></span>
                    </div>
                    <input type="text" name="settings[site_name]" value="{{ $settings['site_name'] ?? '' }}" id="site_name" class="form-control kt-input" placeholder="Website Name" aria-describedby="settings">
                </div>
                <span class="kt-form__help">
                    Your website Title
                </span>
            </div>

			<div class="form-group kt-form__group">
				<label>Address: </label>
				<textarea class="form-control" id="address" name="settings[address]" autocomplete="off" data-provide="markdown" rows="10" >{{ $settings['address'] ?? '' }}</textarea>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group kt-form__group">
						<label for="settings[phone1]">
							Phone 1:
						</label>
						<div class="input-group kt-input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-phone"></i></span>
							</div>
							<input type="text" name="settings[phone1]" value="{{ $settings['phone1'] ?? '' }}" id="phone1" class="form-control kt-input" placeholder="Phone number" aria-describedby="settings">
						</div>
						<span class="kt-form__help">
							Provide the institute phone number with area code.
						</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group kt-form__group">
						<label for="settings[phone2]">
							Phone 2:
						</label>
						<div class="input-group kt-input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-phone"></i></span>
							</div>
							<input type="text" name="settings[phone2]" value="{{ $settings['phone2'] ?? '' }}" id="phone2" class="form-control kt-input" placeholder="Phone number" aria-describedby="settings">
						</div>
						<span class="kt-form__help">
							Provide the institute phone number with area code.
						</span>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group kt-form__group">
						<label for="admin_email">
							Administrator Email Address:
						</label>
						<div class="input-group kt-input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-envelope"></i></span>
							</div>
							<input type="email" name="settings[admin_email]" value="{{ $settings['admin_email'] ?? '' }}" id="admin_email" class="form-control kt-input" placeholder="Website Administrator Email" aria-describedby="settings">
						</div>
						<span class="kt-form__help">
							Website Administrator Email address.
						</span>
					</div>
				</div>

                <div class="col-md-6">
					<div class="form-group kt-form__group">
						<label for="support_email">
							Support Email Address:
						</label>
						<div class="input-group kt-input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-envelope"></i></span>
							</div>
							<input type="email" name="settings[support_email]" value="{{ $settings['support_email'] ?? '' }}" id="support_email" class="form-control kt-input" placeholder="Website Support Email" aria-describedby="settings">
						</div>
						<span class="kt-form__help">
							Website Support Email address. Communication email will be sent to this address.
						</span>
					</div>
				</div>

			</div>

		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-flat btn-primary">Save Settings</button>
		</div>

	</div>
</section>