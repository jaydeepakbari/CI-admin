<div class="d-flex h-auto min-h-full justify-content-center">
    <div class="d-flex align-items-center justify-content-center flex-fill">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-4 mt-4">
                        <img src="<?= base_url('assets/admin/img/logo-black.png') ?>" class="w-50" alt="">
                    </div>
                    <?php if($message = $this->session->flashdata('success')){ ?>
                        <div class="alert alert-success alert-dismissible" role='alert'>
                            <h3>Email Sent!</h3>
                            <p><?= $message ?></p>
                        </div>
                    <?php } ?>
                    <form class="card" action="<?= route('admin.forget_form_check') ?>" id="forgot_form" method="post">
                        
                        <div class="card-body p-5">
                            <div class="card-title">Forgot password</div>
                            <p class="text-muted">Enter your email address and your password will be reset and emailed to you.</p>
                            <div class="mb-2">
                                <label class="form-label" for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-submit btn-primary btn-block">Send confirmation link</button>
                            </div>
                        </div>
                        
                    </form>
                    <div class="text-center text-muted">
                        Have account yet? <a href="<?= route('admin.login') ?>">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#forgot_form").submit(function(){
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