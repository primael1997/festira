<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('admin.general-setting.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Site Name</label>
                <input type="text" class="form-control" name="site_name" value="{{@$generalSettings->site_name}}">
            </div>
            <div class="form-group">
                <label>Contact Email</label>
                <input type="text" class="form-control" name="contact_email" value="{{@$generalSettings->email}}">
            </div>
            <div class="form-group">
                <label>Contact Phone</label>
                <input type="text" class="form-control" name="contact_phone" value="{{@$generalSettings->phone}}">
            </div>
            <div class="form-group">
                <label>Contact Address</label>
                <input type="text" class="form-control" name="contact_address" value="{{@$generalSettings->contact_address}}">
            </div>
            <hr>

            <div class="form-group">
                <label>Lien Facebook</label>
                <input type="text" class="form-control" name="link_fb" value="{{@$generalSettings->fb}}">
            </div>

            <div class="form-group">
                <label>Lien Instagramme</label>
                <input type="text" class="form-control" name="link_insta" value="{{@$generalSettings->insta}}">
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</div>
</div>
