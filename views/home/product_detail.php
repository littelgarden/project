<?= $this->load->view("web/template/header.php") ?>

<?= $this->load->view("web/template/top-header"); ?>
<style>

    .lnk{
        margin-right: 5px;
    }
    .item-carousel {
        padding: 0 15px;
    }

    .chat .container {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
        width: auto;
    }

    .darker {
        border-color: #ccc !important;
        background-color: #ddd  !important;
    }

    .chat .container::after {
        content: "";
        clear: both;
        display: table;
    }

    .chat .container img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    .chat .container img.right {
        float: right;
        margin-left: 20px;
        margin-right:0;
    }

    .time-right {
        float: right;
        color: #aaa;
    }

    .time-left {
        float: left;
        color: #999;
    }
</style>
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-4'>
                <div id="category" class="category-carousel hidden-xs">
                    <div class="item">	
                        <img src="<?= base_url() . "uploads/product_images/" . $product['image'] ?>" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class='col-md-8'>
                <div class="row">	
                    <h3 class="name"><?= $product['title'] ?></h3>								
                    <div class="products">	
                        <div class="product-info">
                            <div class="product-price">	
                                <span class="price"><a href="javascript:void(0)"><h5>Price: <?= $product['currency'] . " " . $product['price'] ?> /Unit</h5></a></span>
                            </div>
                            <div class="product-price">	
                                <span class="price"><a href="javascript:void(0)">In Stock: <?= $product['in_stock'] ?></a></span>
                            </div>
                            <div class="description">
                                <b>Product Description</b>:<br>
                                <?= $product['short_description'] ?>
                            </div>
                        </div>
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                        <a  href="#modal" class="lnk btn btn-info popup-btn">Report Product</a>
                                        <a data-id="<?= $product['id']; ?>" class="lnk add_to_cart btn btn-primary">Add to Cart: <span><?= $_SESSION['cart'][$product['id']]['quantity'] ?? 0 ?></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="furniture-container homepage-container">
            <div class="homebanner-holder">
                <span><h4>Similar Products</h4></span>
                <div class="brd_btm"></div>
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">			
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                        <?php
                                        foreach ($products as $key => $value) {
                                            ?>
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">		
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="#">
                                                                    <img  src="<?= base_url() . "uploads/product_images/" . $value['image'] ?>" style="width: 100%" alt="">
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a href="<?= base_url() ?>index.php/web/home/product_detail/<?= $value['id'] ?>"><?= $value['title'] ?></a></h3>
                                                            <div class="product-price">	
                                                                <span class="price">
                                                                    Price : 	<?= $value['currency'] . " " . $value['price'] ?></span>
                                                            </div>
                                                            <div class="description">
                                                                <?= substr($value['short_description'], 0, 150) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <div class="">
                <div class="row feedback">		
                    <h4>Product Reports</h4>
                    <div class="chat">
                        <?php
                        foreach ($product_reports as $key => $value) {
                            ?>
                            <div class="container darker">
                                <p><?= $value['description'] ?></p>
                                <span class="time-left"><?= date("d M Y, h:i A", $value['created']) ?></span>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>			
            </div>
        </div>
        <hr class="mt-5 col-md-12">
        <div class="col-md-12">
            <div class="">
                <div class="row feedback">		
                    <h4>Feedback</h4>
                    <div class="col-md-12 col-sm-12 already-registered-login">
                        <form class="feedback-form" action="<?= base_url() ?>index.php/web/home/feedback" role="form" method="post">
                            <div class="form-group">
                                <label class="info-title" for="name">Title<span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" name="title" required="required">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Message<span>*</span></label>
                                <textarea name="message" class="form-control unicase-form-control text-input"></textarea>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit</button>
                        </form>
                    </div>	

                    <hr class="col-md-12">
                    <h4>Old Messages</h4>
                    <div class="chat">
                        <?php
                        foreach ($feedbacks as $key => $value) {
                            if ($value['type'] == 1) {
                                ?>
                                <div class="container darker">
                                    <img src="<?= base_url() ?>uploads/profile_image/xdefault.png.pagespeed.ic.BaBXiYMJ4O.webp" alt="Avatar" class="right" style="width:100%;">
                                    <p><?= $value['message'] ?></p>
                                    <span class="time-left"><?= date("d M Y, h:i A", $value['created']) ?></span>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="container">
                                    <img src="<?= base_url() ?>uploads/profile_image/xdefault.png.pagespeed.ic.BaBXiYMJ4O.webp" alt="Avatar" style="width:100%;">
                                    <p><?= $value['message'] ?></p>
                                    <span class="time-right"><?= date("d M Y, h:i A", $value['created']) ?></span>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>			
            </div>
        </div>
    </div>

</div>
<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                <h4 class="modal-title">Report Product</h4>
            </div>
            <form class="feedback-form" action="<?= base_url() ?>index.php/web/home/product_report" role="form" method="post">
                <div class="modal-body">
                    <input name="product_id" hidden="" value="<?= $product['id'] ?>">
                    <textarea class="form-control input-sm" name="message"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn">Close</button>
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->load->view("web/template/footer") ?>
<script>
    $(".feedback-form").submit(function () {
<?php if (!$this->session->userdata('active_user_id')) {
    ?>
            alert("Please Login First");
            return false;
<?php } ?>
    });

    $(".add_to_cart").click(function () {
<?php if (!$this->session->userdata('active_user_id')) {
    ?>
            alert("Please Login First");
            return false;
<?php } ?>
        let selector = $(this);
        if (selector.hasClass("btn-info")) {
            alert("Item is not in stock");
        } else {
            $.ajax({
                url: "<?= base_url() ?>index.php/web/home/add_to_cart",
                dataType: "json",
                type: "POST",
                data: {
                    id: selector.data("id")
                },
                success: function (data) {
                    if (data.data == 1) {
                        window.location.reload();
                    }
                }
            });
        }
    });

    $(".popup-btn").click(function (e) {
        e.preventDefault();
        var linkID = this.hash.replace("#", "");
        $(".modal").each(function () {
            var modalID = $(this).attr("id");
            if (linkID === modalID) {
                $(this).fadeIn(200);
                $("body, html").addClass("modal-open");
                $(".modal-backdrop").addClass("in");
                $(this).addClass("in");
            } else {
                $(this).fadeOut();
                $(this).removeClass("in");
            }
        });
    });

    $("body, button.close, .modal-footer button.btn").click(function () {
        $("body, html").removeClass("modal-open");
        $(".modal-backdrop").removeClass("in");
        $(".modal").fadeOut();
        $(".modal").removeClass("in");
    });

    $(".modal-content, .popup-btn, .modal-header .close, .modal-footer .btn").click(function (e) {
        e.stopPropagation();
    });

<?php
if ($message = $this->session->flashdata('flash_alert')) {
    ?>
        alert('<?= $message ?>');
    <?php
}
?>
</script>
