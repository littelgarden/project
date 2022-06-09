<div class="col-md-12">
    <section class="content add_users" style="display:none;">
        <div class="box box-primary">
            <div class="box-header with-border">
                Add <?= $user_title ?? "" ?>
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="<?= ADMIN_PANEL_URL . "users/update_user" ?>" enctype="multipart/form-data">
                    <input type="text" hidden="" value="" name="id">
                    <input type="text" hidden="" value="<?= $user_type ?>" name="user_type">
                    <div class="form-group col-md-4">
                        <label>Enter Email <small class="error"><?= $user_type == 1 ? "" : "*Optional" ?></small></label>
                        <input type="text" <?= $user_type == 1 ? "required" : "" ?> placeholder="Enter Email" value="" name="email" class="form-control input-sm">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Profile Image</label>
                        <input type="file" class="form-control input-sm" name="profile_image">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Password</label>
                        <input type="text" class="form-control input-sm" name="password" placeholder="Enter Passoword">
                    </div>
                    <div class="form-group col-md-4">
                        <br>
                        <button class="btn btn-info btn-sm" type="submit">Submit</button>
                        <button class="btn btn-danger btn-sm" onclick="$('.add_users').hide('slow');" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                Our <?= $user_title ?? "" ?> List
                <span class="tools pull-right">
                    <a class='badge badge-info' onclick="add_users()">Add New <?= $user_title ?? "" ?></a>
                </span>
            </div>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="backend-user-grid">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile Image</th>
                                <th>Email</th> 
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><input type="text" data-column="1"  class="form-control search-input-text"></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
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
                                        'aTargets': [0, 1, -1] /* 1st one, start by the right */
                                    }],
                                "order": [[0, "desc"]],
                                "ajax": {
                                    url: "<?= ADMIN_PANEL_URL . "users/ajax_users_list/" . $user_type ?>", // json datasource
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
    function add_users() {
        if ($('.add_users').is(':visible')) {
            $('.add_users input[type="text"]').val("");
        }

        $("input[name=password]").val(generate_password(8));
        $('.add_users').show('slow');
    }

    function edit_user(id) {
        add_users();
        var selector = $("#" + id).parent().parent();

        $("input[name=id]").val(id.substring(1));

        var name = selector.children("td:nth-child(3)").text();
        $("input[name=name]").val(name);

        var email = selector.children("td:nth-child(4)").text();
        $("input[name=email]").val(email);

        var mobile = selector.children("td:nth-child(5)").text();
        $("input[name=mobile]").val(mobile);

        var address = selector.children("td:nth-child(6)").text();
        $("input[name=address]").val(address);

        $("input[name=password]").val("");
    }

    function operation(id, process, element, classs, type) {
        jQuery.ajax({
            url: "<?= ADMIN_PANEL_URL ?>Users/ajax_operation_user",
            type: "post", // method , by default get
            dataType: "json",
            data: {
                _tk: id,
                status: process
            },
            success: function (data) {
                if (data.data == 1) {
                    var remove = $("#" + element).attr("class").split(" ");
                    $("#" + element).removeClass(remove[3]);
                    $("#" + element).addClass(classs);
                    $("#" + element).html(type);
                    if (process == 3) {
                        $("#" + element).closest("tr").remove();
                    }
                }
                show_toast(data.type, data.message);
            }
        });
    }

    function active_inactive(id) {
        var type = $("#" + id).text();
        var process = 1;
        var data = "Inactive";
        var classs = "btn-warning";
        if (type == "Inactive") {
            process = 2;
            data = "Active"
            classs = "btn-info";
        }
        operation(id, process, id, classs, data);
    }

    function delete_user(id) {
        if (!confirm("Are You Sure Want To Delete This User Permanently From Platform.")) {
            return false;
        }
        var process = 3;
        var data = "Delete";
        var classs = "btn-danger";
        operation(id.slice(1), process, id, classs, data);
    }

    function generate_password(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    $("form").submit(function (e) {
        e.preventDefault();
        let submit = $(this).find('button[type="submit"]');
        submit.attr("disabled", true);
        submit.text("Please Wait");
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                show_toast(data.type, data.message);
                submit.attr("disabled", false);
                submit.text("Submit");
                if (data.data == 2) {
                    $("input[name=" + data.focus + "]").focus();
                } else if (data.data == 1)
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
            }, error: function (jqXHR, textStatus, errorThrown) {
                show_toast("error", "Internal Error", "Invalid Server Response");
                submit.attr("disabled", false);
                submit.text("Submit");
            }
        });
    });
</script>

