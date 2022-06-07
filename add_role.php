<div class="col-md-12">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?= ($_GET['id'] == 0) ? "Add" : "Edit" ?> Role
            </div>
            <div class="panel-body">
                <form id="add_role_form" role="form" method="post" action="<?= ADMIN_PANEL_URL . "admin/add_role" ?>" enctype="multipart/form-data">
                    <input type="text" hidden="" value="<?= ($_GET['id'] == 0) ? "" : $_GET['id'] ?>" name="id">
                    <div class="form-group col-md-12">
                        <label>Permission Name</label>
                        <input class="form-control input-sm" required="" name="name" value="<?= ($role_group) ? $role_group['name'] : "" ?>">
                    </div>
                    <?php
                    if (isset($result) && $result) {
                        $permissions = ($role_group) ? explode(",", $role_group['user_permission_id']) : "";
                        for ($i = 0; $i < count($result); $i) {
                            ?>
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label col-lg-4"><?= $result[$i]['permission_merge'] ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="group_permision_all"> <span style="font-weight: 700 !important;">  select all </span></label>
                                <div id="check_box_group_id_<?= $i ?>" class="col-lg-12">
                                    <?php do { ?>
                                        <label style="font-weight: 200 !important;" class="col-md-3">
                                            <input type="checkbox" value="<?= $result[$i]['id'] ?>" name="user_permission_id[]" <?= ($permissions && in_array($result[$i]['id'], $permissions)) ? "CHECKED" : "" ?>>
                                            <?= $result[$i]['permission_name'] ?>
                                        </label>
                                        <?php
                                        $i++;
                                    } while (isset($result[$i]) && $result[$i]['permission_merge'] == $result[$i - 1]['permission_merge']);
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="form-group col-md-4">
                        <br>
                        <button class="btn btn-info btn-sm" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" language="javascript" >
    jQuery(document).ready(function () {
        $('.group_permision_all').click(function (event) {
            var ids = $(this).parent().next('div').attr('id');
            if (this.checked) {
                // Iterate each checkbox
                $('#' + ids + ' :checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                // Iterate each checkbox
                $('#' + ids + ' :checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    });

    $("#add_role_form").submit(function () {
        var length = $("#add_role_form input[type='checkbox']:checked").length;
        if (length == 0) {
            show_toast('error', "Select Atleast One Role");
            return false;
        }
    });
</script>
