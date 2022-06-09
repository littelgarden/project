<div class="col-md-12">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                Feedback List
            </div>
            <div class="panel-body">
                <div class="col-md-12">

                    <div class="card card-success card-outline direct-chat direct-chat-success shadow-sm">
                        <div class="card-body">
                            <div class="direct-chat-messages">
                                <?php
                                $USER_ID = 0;
                                foreach ($feedbacks as $key => $value) {
                                    IF (!$USER_ID) {
                                        $USER_ID = $value['user_id'];
                                    }
                                    if ($value['type'] == 1) {
                                        ?>
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-left">User</span>
                                                <span class="direct-chat-timestamp float-right"><?= date("d M Y, h:i A", $value['created']) ?></span>
                                            </div>
                                            <img class="direct-chat-img" src="<?= base_url() ?>uploads/profile_image/xdefault.png.pagespeed.ic.BaBXiYMJ4O.webp" alt="Message User Image">
                                            <div class="direct-chat-text"><?= $value['message'] ?></div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-right">Admin</span>
                                                <span class="direct-chat-timestamp float-left"><?= date("d M Y, h:i A", $value['created']) ?></span>
                                            </div>
                                            <img class="direct-chat-img" src="<?= base_url() ?>uploads/profile_image/xdefault.png.pagespeed.ic.BaBXiYMJ4O.webp" alt="Message User Image">
                                            <div class="direct-chat-text"><?= $value['message'] ?></div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                            <div class="direct-chat-contacts">
                                <ul class="contacts-list">
                                    <li>
                                        <a href="#">
                                            <img class="contacts-list-img" src="<?= base_url() ?>uploads/profile_image/xdefault.png.pagespeed.ic.BaBXiYMJ4O.webp" alt="User Avatar">
                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                    Count Dracula
                                                    <small class="contacts-list-date float-right">2/28/2015</small>
                                                </span>
                                                <span class="contacts-list-msg">How have you been? I was...</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>

                            </div>

                        </div>

                        <div class="card-footer">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input name="user_id" value="<?= $USER_ID ?>" hidden="">
                                    <input required="" type="text" name="message" placeholder="Type Message ..." class="form-control">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-success">Send</button>
                                    </span>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" >

    jQuery(document).ready(function () {
        var table = 'feedback-grid';
        var dataTable = jQuery("#" + table).DataTable({
            "processing": true,
            "pageLength": 50,
            "serverSide": true,
            'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [0, 1, -1] /* 1st one, start by the right */
                }],
            "order": [[0, "desc"]],
            "ajax": {
                url: "<?= ADMIN_PANEL_URL . "feedback/ajax_feedback_list/" ?>", // json datasource
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