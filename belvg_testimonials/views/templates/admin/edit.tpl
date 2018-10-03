<fieldset>
    <div class="panel">
        <div class="panel-heading">
            <legend><i class="icon-info"></i> Guardamos informacion</legend>
        </div>
        <div class="form-group clearfix">
            <label class="col-lg-3">ID:</label>
            <div class="col-lg-9">
                {$objeto->id_belvg_testimonials}
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="col-lg-3">Name:</label>
            <div class="col-lg-9"><input type="text" id="name" name="name" value="{$objeto->name}"></div>
        </div>
        <div class="form-group clearfix">
            <label class="col-lg-3">Email</label>
            <div class="col-lg-9"><input type="text" id="name" name="name" value="{$objeto->email}"></div>
        </div>
        <div class="form-group clearfix">
            <label class="col-lg-3">Site</label>
            <div class="col-lg-9"><input type="text" id="name" name="name" value="{$objeto->site}"></div>
        </div>
        <div class="form-group clearfix">
            <label class="col-lg-3">Status</label>
            <div class="col-lg-9"><input type="text" id="name" name="name" value="{$objeto->status}"></div>
        </div>
    </div>
</fieldset>