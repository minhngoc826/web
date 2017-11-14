<div class="row showfile">
    <div class="col-md-8">
        <b>Tên file</b>
        <p>Bài toán người du lịch</p>
    </div>
    <div class="col-md-2">
        <b>Uploader</b>
        <p>user1</p>
    </div>
    <div class="col-md-2">
        <b>Kiểu file</b>
        <p>PDF</p>
    </div>
</div>

<div id="showfile"></div>

<script>PDFObject.embed("<?php echo base_url(); ?>upload/BT STP.pdf", "#showfile");</script>


<style>
.pdfobject-container { height: 600px;}
.pdfobject { border: 1px solid #666; }
</style>

<!--<object data="<?php echo base_url(); ?>upload/BT STP.pdf"></object>-->