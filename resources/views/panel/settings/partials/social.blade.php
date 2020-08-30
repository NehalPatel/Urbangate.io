<section class="content-container">
    <div class="box">

        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group kt-form__group">
                        <label for="facebook">Facebook:</label>
                        <div class="input-group kt-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                            </div>
                            <input type="text" name="settings[facebook]" value="{{ $settings['facebook'] ?? '' }}" id="facebook" class="form-control kt-input" placeholder="Facebook" aria-describedby="settings">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group kt-form__group">
                        <label for="twitter">Twitter:</label>
                        <div class="input-group kt-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                            </div>
                            <input type="text" name="settings[twitter]" value="{{ $settings['twitter'] ?? '' }}" id="twitter" class="form-control kt-input" placeholder="Twitter" aria-describedby="settings">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group kt-form__group">
                        <label for="linkedin">LinkedIn:</label>
                        <div class="input-group kt-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                            </div>
                            <input type="text" name="settings[linkedin]" value="{{ $settings['linkedin'] ?? '' }}" id="linkedin" class="form-control kt-input" placeholder="LinkedIn" aria-describedby="settings">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group kt-form__group">
                        <label for="pinterest">Pinterest:</label>
                        <div class="input-group kt-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-pinterest"></i></span>
                            </div>
                            <input type="text" name="settings[pinterest]" value="{{ $settings['pinterest'] ?? '' }}" id="pinterest" class="form-control kt-input" placeholder="Pinterest" aria-describedby="settings">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group kt-form__group">
                        <label for="gplus">Google Plus:</label>
                        <div class="input-group kt-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-google-plus"></i></span>
                            </div>
                            <input type="text" name="settings[gplus]" value="{{ $settings['gplus'] ?? '' }}" id="gplus" class="form-control kt-input" placeholder="Google Plus" aria-describedby="settings">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group kt-form__group">
                        <label for="youtube">Youtube:</label>
                        <div class="input-group kt-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                            </div>
                            <input type="text" name="settings[youtube]" value="{{ $settings['youtube'] ?? '' }}" id="youtube" class="form-control kt-input" placeholder="Youtube Channel" aria-describedby="settings">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-flat btn-primary">Save Settings</button>
        </div>

    </div>
</section>