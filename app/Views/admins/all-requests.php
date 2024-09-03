<?= $this->extend('layouts/admin.php'); ?>
<?= $this->section('content');?>

<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Requests</h5>
            
              <table class="table mt-3">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">go to this property</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($allRequests as $index => $req): ?>
                    <tr>
                        <th scope="row"><?= $index+1?></th>
                        <td><?= $req['name']?></td>
                        <td><?= $req['email']?></td>
                        <td><?= $req['phone']?></td>
                        <td><a href="<?= url_to('prop.single', $req['prop_id'])?>" class="btn btn-success  text-center ">go</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?= $this->endsection();?>