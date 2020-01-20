<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-auto">
            <div class="page-pretitle">Overview</div>
            <h2 class="page-title">Settings</h2>
        </div>

        <div class="col-auto ml-auto d-print-none">
            <button class="btn btn-primary save-settings ml-3">Save Settings</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card" id="setting-form">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-site-tab" data-toggle="pill" href="#v-pills-site" role="tab" aria-controls="v-pills-site" aria-selected="true">Site</a>
                            <a class="nav-link" id="v-pills-other-tab" data-toggle="pill" href="#v-pills-other" role="tab" aria-controls="v-pills-other" aria-selected="false">Other</a>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-site" role="tabpanel" aria-labelledby="v-pills-site-tab">
                                <?php include VIEWPATH ."admin/settings/site.php"; ?>
                            </div>
                            <div class="tab-pane fade" id="v-pills-other" role="tabpanel" aria-labelledby="v-pills-other-tab">
                                <?php include VIEWPATH ."admin/settings/other.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(".save-settings").click(function(){
        $this = $(this);
        $container = $("#setting-form");

        $.ajax({
            url:'<?= route("admin.save_settings") ?>',
            type:'POST',
            dataType:'json',
            data:$container.find(":input"),
            beforeSend:function(){$this.btn("loading");},
            complete:function(){$this.btn("reset");},
            success:function(json){
                json_callback(json,$container);
            },
        })
    })
</script>