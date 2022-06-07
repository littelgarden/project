<?= $this->load->view("web/template/header.php") ?>
<body class="cnt-home">
    <?= $this->load->view("web/template/top-header"); ?>
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
                        <h3><center>Contact Us</center></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="furniture-container">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <?= $contact_us ?>
                </div>
            </div>
        </div>
    </div>
</body>

<?= $this->load->view("web/template/footer") ?>
</html>
