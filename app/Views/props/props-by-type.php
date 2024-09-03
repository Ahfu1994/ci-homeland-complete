<?= $this->extend('layouts/app.php'); ?>
<?= $this->section('content');?>

<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?= base_url('public/assets/images/hero_bg_2.jpg');?>)" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">Properties for type: <?= $type; ?></h1>
          </div>
        </div>
      </div>
    </div>

<div class="site-section site-section-sm bg-light">
<div class="container">

  <div class="row mb-5">

  <?php foreach($propties as $prop) : ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="<?= url_to('prop.single', $prop->id)?>" class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type bg-success"><?=$prop->type ?></span>
                </div>
                <img src="<?= base_url('public/assets/images/'.$prop->image)?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <a href="<?= url_to('prop.single', $prop->id)?>" class="property-favorite"><span class="icon-heart-o"></span></a>
                <h2 class="property-title"><a href="<?= url_to('prop.single', $prop->id)?>"><?=$prop->name ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?=$prop->location ?></span>
                <strong class="property-price text-primary mb-3 d-block text-success">$<?=number_format($prop->price)?></strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number"><?= $prop->num_beds?> <sup>+</sup></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number"><?= $prop->num_baths?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number"><?= $prop->sq_ft?></span>
                    
                  </li>
                </ul>

              </div>
            </div>
          </div>
    <?php endforeach; ?>

  </div>  
</div>
</div>
<?= $this->endsection();?>