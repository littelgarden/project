<div class="col-md-12">
    <section class="content add_banner" style="display:none;">
        <div class="box box-primary">
            <div class="box-header with-border">
                Add Product
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="<?= ADMIN_PANEL_URL . "banner/index" ?>" enctype="multipart/form-data">
                    <div class="form-group col-md-4">
                        <label>Enter Title</label>
                        <input type="text" required="" placeholder="Enter Title" value="" name="title" class="form-control input-sm">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Select Image</label>
                        <input type="file" value="" name="image" class="form-control input-sm number">
                    </div>
                    <div class="form-group col-md-4">
                        <br>
                        <button class="btn btn-info btn-sm" type="submit">Submit</button>
                        <button class="btn btn-danger btn-sm" onclick="$('.add_banner').hide('slow');" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                Banner List
                <span class="tools pull-right">
                    <a class='badge badge-info' onclick="$('.add_banner').show('slow');">Add Banner</a>
                </span>
            </div>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="banner-grid">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><input type="text" data-column="2"  class="form-control search-input-text"></th>                            </th>
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
                            var table = 'banner-grid';
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
                                    url: "<?= ADMIN_PANEL_URL . "banner/ajax_banner_list/" ?>", // json datasource
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