<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-auto">
            <h2 class="page-title">Manage User</h2>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Users</h3>
        <div class="card-options">
            <div>    
                <button class="btn btn-danger btn-sm delete-multiple">Delete Selected Users</button>
                <a href="<?= route('admin.user.edit_form') ?>" class="btn btn-primary btn-sm">Add New User</a>
            </div>
        </div>
      </div>
    <div class="table-responsive">
        <form id="delete-form" method="post" action="<?= route('admin.user.destory_multiple') ?>">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-1p">
                            <input type="checkbox" class="form-check-input select-all m-0 align-middle">
                        </th>
                        <th class="w-1p">Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="w-1p">Status</th>
                        <th class="w-1p">Updated Date</th>
                        <th class="w-1p">Created Date</th>
                        <th width="130px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $key => $user) { ?>
                        <tr>
                           <td><input type="checkbox" name="ids[]" value="<?= $user->id ?>" class='single-checkbox form-check-input m-0 align-middle'> </td>
                           <td><span class="text-muted"><?= $user->id ?></span></td>
                           <td><a href='<?= route('admin.user.edit_form',['id'=>$user->id]) ?>'><?= $user->name ?></a></td>
                           <td><?= $user->email ?></td>
                           <td><?= $user->status_text ?></td>
                           <td><?= dateFormat($user->updated_at) ?></td>
                           <td><?= dateFormat($user->created_at) ?></td>
                           <td>
                               <a href='<?= route('admin.user.edit_form',['id'=>$user->id]) ?>' class="btn btn-outline-primary btn-sm">Edit</a>
                               <a href='<?= route('admin.user.destory',['id'=>$user->id]) ?>' class="btn btn-outline-danger btn-sm">Delete</a>
                           </td>
                        </tr>
                    <?php } ?>
                    <?php if(!$users->total()){ ?>
                        <tr>
                            <td colspan="100%" class="text-center text-muted">No any users created yet.. please create a <a href="<?= route('admin.user.edit_form') ?>">New user</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
        <div class="text-right paginate"></div>
    </div>
    <div class="card-footer d-flex align-items-center border-top-0">
        <p class="m-0 text-muted"><?= $users->paginate_text ?></p>
        <?= $users->paginate ?>
    </div>
</div>


<script type="text/javascript">
    $(".single-checkbox").change(function(){
        if($(".single-checkbox:checked").length == 0){
            $(".delete-multiple").hide();
        } else {
            $(".delete-multiple").show();
        }
    })

    $(".select-all").change(function(){
        $(".single-checkbox").prop("checked", $(this).prop("checked")).trigger("change");
    })

    $(".delete-multiple").click(function(){
        $("#delete-form")[0].submit();
    })
</script>