<div class="col-md-12">
    <section class="content add_product" style="display:none;">
        <div class="box box-primary">
            <div class="box-header with-border">
                Add Product
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="<?= ADMIN_PANEL_URL . "product/index" ?>" enctype="multipart/form-data">
                    <input type="text" hidden="" value="" name="id">
                    <div class="form-group col-md-4">
                        <label>Enter Title</label>
                        <input type="text" required="" placeholder="Enter Title" value="" name="title" class="form-control input-sm">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Enter Price</label>
                        <input type="text" required="" placeholder="Enter Price" value="" name="price" class="form-control input-sm number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Enter Currency</label>
                        <input type="text" required="" placeholder="Enter Currency" value="" name="currency" class="form-control input-sm">
                    </div>
                    <div class="form-group col-md-4">
                        <label>In stock quantity</label>
                        <input type="text" required="" placeholder="Enter Quantity" value="" name="in_stock" class="form-control input-sm number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tags</label>
                        <input type="text" required="" placeholder="Enter Tags" value="" name="tags" class="form-control input-sm">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Short Description</label>
                        <textarea class="form-control input-sm" name="short_description"></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Select Image</label>
                        <input type="file" value="" name="image" class="form-control input-sm number">
                    </div>
                    <div class="form-group col-md-4">
                        <br>
                        <button class="btn btn-info btn-sm" type="submit">Submit</button>
                        <button class="btn btn-danger btn-sm" onclick="$('.add_product').hide('slow');" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                Products List
                <span class="tools pull-right">
                    <a class='badge badge-info' onclick="$('.add_product').show('slow');">Add New Product</a>
                </span>
            </div>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="product-grid">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Currency</th>
                                <th>In Stock</th>
                                <th>Tags</th>
                                <th>Short Desc</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><input type="text" data-column="2"  class="form-control search-input-text"></th>                            </th>
                                <th><input type="text" data-column="3"  class="form-control search-input-text"></th>
                                <th></th>
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
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" >

                        jQuery(document).ready(function () {
                            var table = 'product-grid';
                            var dataTable = jQuery("#" + table).DataTable({
                                "processing": true,
                                "pageLength": 50,
                                "serverSide": true,
                                'aoColumnDefs': [{
                                        'bSortable': false,
                                        'aTargets': [0, 1, -1,-2] 
                                    }],
                                "order": [[0, "desc"]],
                                "ajax": {
                                    url: "<?= ADMIN_PANEL_URL . "product/ajax_products_list/" ?>", // json datasource
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
    function add_product() {
        if ($('.add_product').is(':visible')) {
            $('.add_product input[type="text"]').val("");
        }
        $('.add_product').show('slow');
    }

    function edit_product(id) {
        add_product();
        var selector = $("#" + id).parent().parent();

        $("input[name=id]").val(id.substring(1));

        var title = selector.children("td:nth-child(3)").text();
        $("input[name=title]").val(title);

        var price = selector.children("td:nth-child(4)").text();
        $("input[name=price]").val(price);
        
        var currency = selector.children("td:nth-child(5)").text();
        $("input[name=currency]").val(currency);
        
        var in_stock = selector.children("td:nth-child(6)").text();
        $("input[name=in_stock]").val(in_stock);
        
        var tags = selector.children("td:nth-child(7)").text();
        $("input[name=tags]").val(tags);

        var short_description = selector.children("td:nth-child(8)").text();
        $("textarea[name=short_description]").val(short_description);
    }

    function delete_product(id) {
        if (!confirm("Are You Sure Want To Delete Product Permanently?")) {
            return false;
        }
        jQuery.ajax({
            url: "<?= ADMIN_PANEL_URL ?>product/ajax_delete_product",
            type: "post", // method  , by default get
            dataType: "json",
            data: {
                id: id,
            },
            success: function (data) {
                if (data.data == 1) {
                    show_toast("success", "Product Deleted");
                    $("#" + id).closest("tr").remove();
                } else {
                    show_toast("error", "Error! Try again..");
                }
            }
        });
    }
</script>

