<?= $this->extend('layouts/app.php'); ?>
<?= $this->section('content');?>

<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?= base_url('public/assets/images/hero_bg_2.jpg');?>)" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <h1 class="mb-2">Properties that you saved</h1>
      </div>
    </div>
  </div>
</div>

<div class="site-section site-section-sm bg-light">
<div class="container">

  <div class="row mb-5">
  <?php if(count($propsSaved) > 0) :?>
  <?php foreach($propsSaved as $prop) : ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="<?= url_to('prop.single', $prop->prop_id)?>" class="property-thumbnail">
                
                <img src="<?= base_url('public/assets/images/'.$prop->prop_image)?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <h2 class="property-title"><a href="<?= url_to('prop.single', $prop->prop_id)?>"><?=$prop->prop_name ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?=$prop->prop_location ?></span>
                <strong class="property-price text-primary mb-3 d-block text-success">$<?=number_format($prop->prop_price)?></strong>
              </div>
            </div>
          </div>
    <?php endforeach; ?>
    <?php else: ?>
        <p class="alert alert-success">
            You saved no properties yet.
        </p>
    <?php endif; ?>
  </div>  
</div>
</div>
<?= $this->endsection();?>