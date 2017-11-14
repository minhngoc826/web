
<div class="upload">
    <form class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-3">Chọn File</label>
            <input class="col-md-6" id="inputfile" name="inputfile" type="file" multiple>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="filename">Tên file</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="filename" name="filename" placeholder="Nhập tên file">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="context">Tóm tắt nội dung</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="context" name="context" placeholder="Nhập tóm tắt nội dung file">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="context">Danh mục file</label>
            <div class="col-sm-6">
                <select class="input-large form-control">
                    <option value="default" selected="selected">Chọn danh mục</option>
                    <option value="lvbc">Luân văn & báo cáo</option>
                    <option value="st">Sách & Truyện</option>
                    <option value="ttvh">Tiểu thuyết & văn học</option>
                    <option value="ktcn">Kĩ thuật & Công nghệ</option>
                    <option value="gddt">Giáo dục & Đào tạo</option>
                    <option value="bmvb">Biểu mẫu & Văn bản</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default" id="upload" name="upload">Upload</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).on('ready', function () {
        $("#inputfile").fileinput({
            showCaption: false,
            maxFileCount: 10,
            mainClass: "input-group-lg"
        });
    });
</script>


<!--<div class="row">
    <form action="multiupload.php" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
            <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple/>
        </div>
        <div class="col-md-6">
            <input type="submit" class="btn btn-primary" name='submit_image' value="Upload Multiple Image"/>
        </div>
    </form>
</div>
<div class="row" id="image_preview"></div>

<script>
    function preview_images()
    {
        var total_file = document.getElementById("images").files.length;
        for (var i = 0; i < total_file; i++)
        {
            $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
        }
    }
</script>
    -->