<?= $this->load->view("web/template/header.php") ?>

<?= $this->load->view("web/template/top-header"); ?>
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <?php
            if ($is_cart) {
                ?>
                <div class='col-md-12'>
                    <h3 class="name">Cart List</h3>								
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['cart']) && $_SESSION['cart']) {
                                $count = 0;
                                $total = 0;
                                $curr = "";
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    $this->db->where("id", $key);
                                    $product = $this->db->get("products")->row_array();
                                    $total += ($product['price'] * $value['quantity']);
                                    $curr = $product['currency'];
                                    ?>
                                    <tr>
                                        <td><?= ++$count ?></td>
                                        <td><?= $product['title'] ?></td>
                                        <td><img width="80" src="<?= base_url() . "uploads/product_images/" . $product['image'] ?>" alt=""></td>
                                        <td>
                                            <button class="quantity" data-id="<?= $product['id'] ?>" data-type="-">-</button>
                                            <span><?= $value['quantity'] ?></span>
                                            <button class="quantity" data-id="<?= $product['id'] ?>" data-type="+">+</button>
                                        </td>
                                        <td><?= ($product['price'] * $value['quantity']) . " " . $product['currency'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>Sub Total</td>
                                    <td><?= $total . " " . $curr ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td><a href="<?= base_url() . "web/home/check_out" ?>"><button class="btn btn-xs btn-info">Place Order</button></a></td>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center">No Item Found In Cart</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.col -->
            <?php } else { ?>
                <div class='col-md-12'>
                    <h3 class="name">Orders List</h3>								
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Order Id</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($orders as $key => $value) {
                                $this->db->where("id", $value['product_id']);
                                $product = $this->db->get("products")->row_array();
                                $total += ($product['price'] * $value['quantity']);
                                $curr = $product['currency'];
                                ?>
                                <tr>
                                    <td><?= ++$count ?></td>
                                    <td><?= "AS" . str_pad($value['order_id'], 3, "0", STR_PAD_LEFT); ?></td>
                                    <td><?= $product['title'] ?></td>
                                    <td><img width="80" src="<?= base_url() . "uploads/product_images/" . $product['image'] ?>" alt=""></td>
                                    <td>
                                        <span><?= $value['quantity'] ?></span>
                                    </td>
                                    <td><?= ($product['price'] * $value['quantity']) . " " . $product['currency'] ?></td>
                                    <td>
                                        <?php
                                        switch ($value['status']) {
                                            case 0:
                                                echo 'Pending';
                                                break;
                                            case 1:
                                                echo 'Approved';
                                                break;
                                            case 2:
                                                echo 'Rejected';
                                                break;

                                            default:
                                                break;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.col -->
            <?php } ?>
        </div><!-- /.sidebar -->
    </div>
</div>
<?= $this->load->view("web/template/footer") ?>
<script>
    $(".quantity").click(function () {
        let selector = $(this);
        let count = selector.data("type") == "-" ? selector.next("span").text() : selector.prev("span").text();
        count = parseInt(count);
        if (isNaN(count)) {
            count = 0;
        }
        count = selector.data("type") == "-" ? --count : ++count;
        $.ajax({
            url: "<?= base_url() ?>index.php/web/home/change_quantity",
            dataType: "json",
            type: "POST",
            data: {
                id: selector.data("id"),
                quantity: count
            },
            success: function (data) {
                if (data.data == 1) {
                    window.location.reload();
                }
            }
        });
    });
</script>