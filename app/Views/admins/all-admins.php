<?= $this->extend('layouts/admin.php'); ?>
<?= $this->section('content');?>


<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
            <?php if(session()->getFlashdata('create')) : ?>
                <p class="alert alert-success"><?= session()->getFlashdata('create')?> </p>
            <?php endif; ?>
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a href="<?= url_to('admins.create')?>" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($allAdmins as $index => $admin) : ?>
                  <tr>
                    <td scope="row"><?= $index+1?></td>
                    <td ><?= $admin['name']?></td>
                    <td ><?= $admin['email']?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>


<?= $this->endsection();?>