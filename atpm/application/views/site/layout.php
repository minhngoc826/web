<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('site/head'); ?>
    </head>
    
    <body>
        <?php $this->load->view('site/header'); ?>
        <div class="container">
            <div class="content">
                <?php $this->load->view($content); ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php $this->load->view('site/footer'); ?>
    </body>
</html>
