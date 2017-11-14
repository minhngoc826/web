<div class="setrole">
    <h3>Thay đổi role user</h3>
    <form class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3" for="user">ID/Tên đăng nhập</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="user" name="user" placeholder="Nhập ID/tên đăng nhập">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="context">Role</label>
            <div class="col-sm-6">
                <select class="input-large form-control">
                    <option value="default" selected="selected">Chọn Role</option>
                    <option value="1">Admin</option>
                    <option value="2">Manager</option>
                </select>
            </div>
        </div>
        
        <div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary" id="setrole" name="setrole">Set Role</button>
            </div>
        </div>
    </form>
</div>


<div class="permission">
    <h3>Thay đổi permission</h3>
    <form class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3" for="context">Role</label>
            <div class="col-sm-6">
                <select class="input-large form-control">
                    <option value="default" selected="selected">Chọn Role</option>
                    <option value="1">Admin</option>
                    <option value="2">Manager</option>
                    <option value="3">Member</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="user">Controller</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="controller" name="controller" placeholder="Nhập controller">
            </div>
        </div>
        
         <div class="form-group">
            <label class="control-label col-sm-3" for="user">Action</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="action" name="action" placeholder="Nhập action">
            </div>
        </div>
        
        <div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-6">
                <div class="checkbox">
                    <button type="submit" class="btn btn-primary" id="setrole" name="setrole">Add permission</button>
                </div>
            </div>
        </div>
    </form>
</div>
