<?= $this->load->view("web/template/header.php") ?>
<div class="body-content login_container">
    <div class="container">
        <div class="sign-in-page inner-bottom-sm">
            <div class="row">
                
                <div class="col-md-6 col-sm-6 col-md-offset-3 ">
                    <div class="bg-white login_card">
                        <h3 class="mt-5">Update Profile</h3>
                        <form class="register-form outer-top-xs" method="post">
                            <div class="form-group">
                                <label class="info-title">Name <span>*</span></label>
                                <input type="text" name="name" value="<?= $profile->name ? $profile->name : "" ?>" class="form-control unicase-form-control text-input" >
                            </div>
                            <div class="form-group">
                                <label class="info-title">Mobile <span>*</span></label>
                                <input type="text" name="mobile" value="<?= $profile->mobile ? $profile->mobile : "" ?>" class="form-control unicase-form-control text-input" >
                            </div>
                            <div class="form-group">
                                <label class="info-title">Email</label>
                                <input type="text"  value="<?= $profile->email ?>" class="form-control unicase-form-control text-input" readonly="">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn-upper btn theme-btn checkout-page-button">Update Profile</button>
                            </div>
                        </form>		
                    </div>			
                </div>
                
            </div>
        </div>

    </div>
</div>
<?= $this->load->view("web/template/footer") ?>
<script>
    $(document).on('submit', 'form', function (ev) {
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.data == 1)
                    window.location.href = "<?= base_url() ?>index.php/web/home";
                alert(data.message);
            }, error: function (jqXHR, textStatus, errorThrown) {
                data = jqXHR.responseText.split('   {');
                try {
                    data = JSON.parse("{" + data[1]);
                    show_toast(data.type, data.title, data.message);
                } catch (e) {
                    show_toast("error", "Internal Error", "Invalid Server Response")
                }
            }
        });
        ev.preventDefault();
    });

</script>