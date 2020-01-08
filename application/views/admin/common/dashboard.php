<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-auto">
      <!-- Page pre-title -->
      <div class="page-pretitle">
        Overview
      </div>
      <h2 class="page-title">
        Dashboard
      </h2>
    </div>
    <!-- Page title actions -->
    <div class="col-auto ml-auto d-print-none">
      <span class="d-none d-sm-inline">
        <a href="#" class="btn btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
          New view
        </a>
      </span>
      <a href="#" class="btn btn-primary ml-3">
        Create new report
      </a>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-sm-6 col-xl-3">
                <div class="card">
                  <div class="card-body p-3 d-flex align-items-center">
                    
                      <span class="bg-blue text-white stamp mr-3"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="m-0"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </span>
                    <div class="mr-3 lh-sm">
                      <div class="strong">
                        <?= Model\User::count() ?> Members
                      </div>
                      <div class="text-muted"><?= Model\User::where('status',1)->count() ?> active users</div>
                    </div>
                  </div>
                </div>
              </div>
</div>