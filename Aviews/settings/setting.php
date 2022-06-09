<div class="col-lg-12">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                About Us
            </div>
            <div class="panel-body">
                <form method="POST" action="" role="form">
                    <input name="tag" value="ABOUT_US" hidden="">
                    <div class="form-group col-md-12">
                        <textarea class="form-control input-sm" name="value"><?= $info->about ?? "" ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success" type="submit">save</button>
                    </div>
                </form>
            </div>
    </section>
</div>
<div class="col-lg-12">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                Contact Us
            </div>
            <div class="panel-body">
                <form method="POST" action="" role="form">
                    <input name="tag" value="CONTACT_US" hidden="">
                    <div class="form-group col-md-12">
                        <textarea class="form-control input-sm" name="value"><?= $info->contact ?? "" ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success" type="submit">save</button>
                    </div>
                </form>
            </div>
    </section>
</div>
<script src="<?= base_url() ?>ckeditor/ckeditor.js"></script>
<script>
    $.each($("textarea[name=value]"),function () {
        CKEDITOR.replace(this);
    });
</script>