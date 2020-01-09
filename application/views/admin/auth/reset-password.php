<div class="d-flex h-auto min-h-full justify-content-center">
    <div class="d-flex align-items-center justify-content-center flex-fill">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-4 mt-4">
                        <img src="<?= base_url('assets/admin/img/logo-black.png') ?>" class="w-50" alt="">
                    </div>
                    
                    <form class="card" action="<?= route('admin.reset_password_check') ?>" id="reset_form" method="post">
                        <div class="card-body p-5">
                            <div class="card-title">Reset password</div>
                            <input type="hidden" name="token" class="form-control" value="<?= $token ?>">

                            <div class="mb-2 form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password">
                            </div>

                            <div class="mb-2 form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="c_password" class="form-control" placeholder="Enter confirm password">
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-submit btn-primary btn-block">Reset Password</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center text-muted">
                        Back to <a href="<?= route('admin.login') ?>">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#reset_form").submit(function(){
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