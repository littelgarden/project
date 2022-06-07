<?= $this->load->view("web/template/header.php") ?>
<body class="cnt-home">

    <?= $this->load->view("web/template/top-header"); ?>
    <?php // $this->load->view("web/template/main-header"); ?>
    <style>
        .item-carousel{
            padding: 0 15px;
        }
        .span3{
            width: 32%;
            margin-right: 1%;
            float: left;
        }
        .add_to_cart{
            width: 100%;
        }
    </style>
    <div class="body-content" id="top-banner-and-menu">
        <div class="">
            <div class="furniture-container homepage-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                foreach ($banners as $key => $value) {
                                    ?>
                                    <div class="item <?= !$key ? "active" : "" ?>">
                                        <img style="height:450px" class="d-block w-100" src="<?= base_url() . "uploads/product_images/" . $value['image'] ?>" alt="First slide">
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <a class="left carousel-control" style="margin-left: 15px" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                            <a class="right carousel-control" style="margin-right: 15px" href="#myCarousel" data-slide="next">&rsaquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="furniture-container">
                <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">
                    <span><h3 class="heading">Products List</h3></span>
                    <div class="brd_btm"></div>
                    <div class="row">
                        <div class='col-md-3 col-sm-3 col-md-3 sidebar' style="margin-top: 30px">
                            <div class="side-menu animate-dropdown outer-bottom-xs">       
                                <div class="side-menu animate-dropdown outer-bottom-xs">
                                    <nav class="yamm megamenu-horizontal" role="navigation">
                                        <ul class="nav">
                                            <li class="dropdown menu-item">
                                                <a href="<?= base_url() ?>index.php/web/home/index" class="dropdown-toggle"><i class="icon fa fa-circle"></i>All</a>
                                            </li>
                                            <?php
                                            foreach ($tags as $key => $value) {
                                                ?>
                                                <li class="dropdown menu-item">
                                                    <a href="<?= base_url() ?>index.php/web/home/index?tag=<?= urlencode($value['tags']) ?>" class="dropdown-toggle"><i class="icon fa fa-circle"></i><?= $value['tags'] ?></a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9">
                            <div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
                                <div class="tab-content outer-top-xs">
                                    <div class="tab-pane in active" id="all">			
                                        

                                        <ul class="thumbnails">
                                            <?php
                                            foreach ($products as $key => $value) {
                                                # code...
                                                ?>
                                                <li class="span3">
                                                    <div class="thumbnail">
                                                        <i class="tag"></i>
                                                        <a href="<?= base_url() ?>index.php/web/home/product_detail/<?= $value['id'] ?>">
                                                            <img src="<?= base_url() . "uploads/product_images/" . $value['image'] ?>" alt="">
                                                        </a>
                                                        <div class="caption">
                                                            <h5><?= $value['title'] ?></h5>
                                                            <h4>
                                                                <a data-id="<?= $value['id']; ?>" class="lnk add_to_cart btn btn-primary">Add to Cart: <span><?= $_SESSION['cart'][$value['id']]['quantity'] ?? 0 ?></span></a>
                                                                <a class="btn" href="<?= base_url() ?>index.php/web/home/product_detail/<?= $value['id'] ?>">VIEW</a> 
                                                                <span class="pull-right"><?= $value['currency'] . " " . $value['price'] ?></span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?= $this->load->view("web/template/footer") ?>
<script>
    $(document).ready(function () {
        $('.show-theme-options').click(function () {
            $(this).parent().toggleClass('open');
            return false;
        });
    });

    $(window).bind("load", function () {
        $('.show-theme-options').delay(2000).trigger('click');
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
</script>
</html>
