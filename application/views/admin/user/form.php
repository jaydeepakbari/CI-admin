<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-auto">
            <div class="page-pretitle">Manage Users</div>
            <h2 class="page-title">Create User</h2>
        </div>
    </div>
</div>

<form method="post" action="<?= route('admin.user.submit_form',['id' => $user->id]) ?>" id='user_form'>
    <div class="card">
        <div class="card-body">
            <div class="form-group mb-3">
                <label class="form-label">Name</label>
                <input type="text" value="<?= $user->name ?>" name="name" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input type="text" value="<?= $user->email ?>" name="email" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Status</label>
                <div>
                    <label class="form-check-inline">
                      <input class="form-check-input" type="radio" <?= ((int)$user->id == 0 || $user->status == 1) ? 'checked' : '' ?> name="status" value="1">
                      <span class="form-check-label"> Enable</span>
                    </label>
                    <label class="form-check-inline">
                      <input class="form-check-input" type="radio" <?= ($user->status == 0) ? 'checked' : '' ?> name="status" value="0">
                      <span class="form-check-label"> Disable</span>
                    </label>
                </div>
            </div>

            <div class="form-fieldset">
                <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="c_password" class="form-control" autocomplete="new-password">
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <div class="d-flex">
                <a href="<?= route('admin.user.list') ?>" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-submit btn-primary ml-auto">Save User</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $("#user_form").submit(function(){
        $this = $(this);
        $.ajax({
            url:$this.attr("action"),
            type:'POST',
            dataType:'json',
            data:$this.serialize(),
            beforeSend:function(){ $this.find('.btn-submit').btn("loading"); },
            complete:function(){ $this.find('.btn-submit').btn("reset"); },
            success:function(json){
                json_callback(json,$this);
            },
        })
        return false;
    })
</script>