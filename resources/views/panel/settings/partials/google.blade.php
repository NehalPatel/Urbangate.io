<section class="content-container">
    <div class="box">

        <div class="box-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group kt-form__group">
                        <label for="gmap_api">Google Map API Key:</label>
                        <div class="input-group kt-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-map"></i></span>
                            </div>
                            <input type="text" name="settings[gmap_api]" value="{{ $settings['gmap_api'] ?? '' }}" id="gmap_api" class="form-control kt-input" placeholder="Google Map API KEY" aria-describedby="settings">
                        </div>
                        <span class="kt-form__help">Please get google map API from <a href="https://console.cloud.google.com/google/maps-apis/new" target="_blank"> Google Cloude Platform</a> console.</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group kt-form__group">
                        <label for="latitude">Latitude:</label>
                        <div class="input-group kt-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                            </div>
                            <input type="text" name="settings[latitude]" value="{{ $settings['latitude'] ?? '' }}" id="latitude" class="form-control kt-input" placeholder="Latitude" aria-describedby="settings">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group kt-form__group">
                        <label for="longitude">Longitude:</label>
                        <div class="input-group kt-input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                            </div>
                            <input type="text" name="settings[longitude]" value="{{ $settings['longitude'] ?? '' }}" id="longitude" class="form-control kt-input" placeholder="Longitude" aria-describedby="settings">
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