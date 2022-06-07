<div class="col-md-12">
    <section class="content add_user" style="display:none;">
        <div class="box box-primary">
            <header class="panel-heading">
                Create User
            </header>
            <div class="panel-body">
                <form role="form" class="submit_user" method="post">
                    <input value="" name="user_id" hidden="">
                    <div class="form-group col-md-6">
                        <label>Enter Name</label>
                        <input type="text" required="" placeholder="Enter User Name" value="" name="name" class="form-control input-sm">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Enter Email</label>
                        <input type="text" required="" placeholder="Enter Email" value="" name="email" class="form-control input-sm">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Enter Mobile</label>
                        <input type="text" required="" placeholder="Enter Mobile" value="" name="mobile" class="form-control input-sm number">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Enter Password</label>
                        <input type="text" placeholder="Enter Password" value="" name="password" class="form-control input-sm">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Select Image</label>
                        <input type="file" name="profile_image" class="form-control input-sm">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Select Permission</label>
                        <select class="form-control input-sm" name="permission_group_id" required="">
                            <option value="">Select</option>
                            <?php
                            foreach ($perms as $p) {
                                ?>
                                <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <br>
                        <button class="btn btn-info btn-sm" type="submit">Submit</button>
                        <button class="btn btn-danger btn-sm" onclick="$('.add_user').hide('slow');" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="box box-primary">
            <header class="panel-heading">
                Users List
                <span class="tools pull-right">
                    <a class='badge badge-info' onclick="add_user()">Create User</a>
                </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="backend-user-grid">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Permission</th>
                                <th>Profile Image</th>
                                <th>Member Since</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th></th>
                                <th><input type="text" data-column="1" class="form-control input-sm search-input-text"></th>                            </th>
                                <th><input type="text" data-column="2" class="form-control input-sm search-input-text number"></th>
                                <th><input type="text" data-column="3" class="form-control input-sm search-input-text"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?=ADMIN_PANEL_URL."admin/change_requested_password"?>">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Change Password ?</h4>
                </div>
                <div class="modal-body">
                    <input name="n_user_id" class="hide" value="">
                    <span id="validate_message"></span>
                    <p>New Password.</p>
                    <input type="text" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Password" name="n_password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success submit_form">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" >

                        jQuery(document).ready(function () {
                            var table = 'backend-user-grid';
                            var dataTable = jQuery("#" + table).DataTable({
                                "processing": true,
                                "pageLength": 50,
                                "serverSide": true,
                                "serverSide": true, "serverSide": true,
                                'aoColumnDefs': [{
                                        'bSortable': false,
                                        'aTargets': [0, -1, -2] /* 1st one, start by the right */
                                    }],
                                "order": [[0, "desc"]],
                                "ajax": {
                                    url: "<?= ADMIN_PANEL_URL . "admin/ajax_users_list" ?>", // json datasource
                                    type: "post", // method  , by default get
                                    error: function () {  // error handling
                                        jQuery("." + table + "-error").html("");
                                        jQuery("#" + table + "_processing").css("display", "none");
                                    }
                                }
                            });
                            jQuery("#" + table + "_filter").css("display", "none");
                            $('.search-input-text').on('keyup click', function () {   // for text boxes
                                var i = $(this).attr('data-column');  // getting column index
                                var v = $(this).val();  // getting search input value
                                dataTable.columns(i).search(v).draw();
                            });
                            $('.search-input-select').on('change', function () {   // for select box
                                var i = $(this).attr('data-column');
                                var v = $(this).val();
                                dataTable.columns(i).search(v).draw();
                            });
                        });
</script>
<script>
    $(".submit_user").submit(function (e) {
        var name = $("#name").val();
        if (name == "") {
            show_toast("error", "User Name Required");
            $("#name").focus();
            return false;
        }
        var email = $("#email").val();
        if (email == "") {
            show_toast("error", "User Email Required");
            $("#email").focus();
            return false;
        }
        var mobile = $("#mobile").val();
        if (mobile == "") {
            show_toast("error", "User Mobile Required");
            $("#mobile").focus();
            return false;
        }
        var permission_group_id = $("#permission_group_id").val();
        if (permission_group_id == "") {
            show_toast("error", "Select Valid Permission");
            $("#permission_group_id").focus();
            return false;
        }
        var password = "";
        if ($("#user_id").val() == "") {
            password = $("#password").val();
            if (password == "") {
                show_toast("error", "Enter Valid Password");
                $("#password").focus();
                return false;
            }
        }
        if (!confirm("Are You Sure?")) {
            return false;
        }
        e.preventDefault();
        jQuery.ajax({
            url: "<?= ADMIN_PANEL_URL ?>admin/ajax_add_user",
            type: "post", // method  , by default get
            dataType: "json",
            processData: false,
            contentType: false,
            data: new FormData(this),
            success: function (data) {
                if (data.data == 1) {
                    show_toast(data.type, data.message);
                    $('.add_user input[type="text"]').val("");
                    $('.add_user').hide('slow');
                    dataTable.columns(0).search("").draw();
                } else {
                    $("#" + data.focus).focus();
                    show_toast(data.type, data.message);
                }
            }
        });
    });

    $(document).on("click", ".change_password", function () {
        let id = $(this).data("id");
        $("#myModal").modal("show");
        $("input[name=n_password]").val(generate_password(8));
        $("input[name=n_user_id]").val(id);
    });

    function generate_password(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
</script>
<script>
    function add_user() {
        if ($('.add_user').is(':visible')) {
            $('.add_user input[type="text"]').val("");
        }
        $('.add_user').show('slow');
    }

    function edit_user(id) {
        add_user();
        var selector = $("#" + id).parent().parent();

        $("input[name=user_id]").val(id.substring(1));

        var name = selector.children("td:nth-child(2)").text();
        $("input[name=name]").val(name);

        var mobile = selector.children("td:nth-child(3)").text();
        $("input[name=mobile]").val(mobile);

        var email = selector.children("td:nth-child(4)").text();
        $("input[name=email]").val(email);

        var permission = selector.children("td:nth-child(5)").text();
        $('select[name=permission_group_id] option').removeAttr('selected');
        $('select[name=permission_group_id] option:contains("' + permission + '")').attr('selected', 'selected');

    }

    function delete_user(id) {
        if (!confirm("Are You Sure?")) {
            return false;
        }
        jQuery.ajax({
            url: "<?= ADMIN_PANEL_URL ?>admin/ajax_delete_user",
            type: "post", // method  , by default get
            dataType: "json",
            data: {
                id: id,
            },
            success: function (data) {
                if (data.data == 1) {
                    show_toast("success", "User Deleted");
                    $("#" + id).closest("tr").remove();
                } else {
                    show_toast("error", "Error! Try again..");
                }
            }
        });
    }
</script>
