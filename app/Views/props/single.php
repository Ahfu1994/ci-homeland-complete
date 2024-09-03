<?= $this->extend('layouts/app.php'); ?>
<?= $this->section('content');?>

<?php foreach($singleProps as $prop) : ?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?= base_url('public/assets/images/'.$prop->image);?>)" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <h1 class="mb-2"><?= $prop->name?></h1>
      </div>
    </div>
  </div>
</div>
  <?php if(session()->getFlashdata('sent')) : ?>
    <p class="alert alert-success"><?= session()->getFlashdata('sent')?> </p>
  <?php endif; ?>
  <?php if(session()->getFlashdata('save')) : ?>
    <p class="alert alert-success"><?= session()->getFlashdata('save')?> </p>
  <?php endif; ?>
<div class="site-section site-section-sm">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div>
              <div class="slide-one-item home-slider owl-carousel">
                <?php foreach($images as $image): ?>
                  <div><img src="<?=base_url('public/assets/gallery/'.$image->image)?>" alt="Image" class="img-fluid"></div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="bg-white property-body border-bottom border-left border-right">
              <div class="row mb-5">
                <div class="col-md-6">
                  <strong class="text-success h1 mb-3"><?= number_format($prop->price)?></strong>
                </div>
                <div class="col-md-6">
                  <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                  <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number"><?= $prop->num_beds?> </span>
                    
                  </li>
                  <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number"><?= $prop->num_baths?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number"><?= number_format($prop->sq_ft)?></span>
                    
                  </li>
                </ul>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
                  <strong class="d-block"><?= $prop->type?></strong>
                </div>
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
                  <strong class="d-block"><?= $prop->year_built?></strong>
                </div>
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
                  <strong class="d-block"><?=  number_format($prop->price_sq_ft)?></strong>
                </div>
              </div>
              <h2 class="h4 text-black">More Info</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda aperiam perferendis deleniti vitae asperiores accusamus tempora facilis sapiente, quas! Quos asperiores alias fugiat sunt tempora molestias quo deserunt similique sequi.</p>
              <p>Nisi voluptatum error ipsum repudiandae, autem deleniti, velit dolorem enim quaerat rerum incidunt sed, qui ducimus! Tempora architecto non, eligendi vitae dolorem laudantium dolore blanditiis assumenda in eos hic unde.</p>
              <p>Voluptatum debitis cupiditate vero tempora error fugit aspernatur sint veniam laboriosam eaque eum, et hic odio quibusdam molestias corporis dicta! Beatae id magni, laudantium nulla iure ea sunt aliquam. A.</p>

              <div class="row no-gutters mt-5">
                <div class="col-12">
                  <h2 class="h4 text-black mb-3">Gallery</h2>
                </div>
                <?php foreach($images as $image): ?>
                  <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="<?=base_url('public/assets/gallery/'.$image->image)?>" class="image-popup gal-item">
                      <img src="<?=base_url('public/assets/gallery/'.$image->image)?>" alt="Image" class="img-fluid"></a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="col-lg-4">

            <div class="bg-white widget border rounded">

              <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
              <?php if(isset(auth()->user()->id)) : ?>
                <?php if($checkingForSendingRequests > 0) :?>
                  <p class="alert alert-success" >Yes sent a request to this property </p>
                <?php else : ?>
                  <form action="<?= url_to('send.request', $prop->id)?>" method="POST" class="form-contact-agent">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="name" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" id="phone" class="form-control" name="phone">
                    </div>
                    <!-- type hidden -->
                    <input type="hidden"  class="form-control" name="prop_name" value="<?= $prop->name?>">
                    <input type="hidden"  class="form-control" name="prop_image" value="<?= $prop->image?>">
                    <input type="hidden"  class="form-control" name="prop_location" value="<?= $prop->location?>">
                    <input type="hidden"  class="form-control" name="prop_price" value="<?= $prop->price?>">

                    <div class="form-group">
                      <input type="submit" id="phone" class="btn btn-primary" value="Send Request">
                    </div>
                  </form>
                <?php endif; ?>
              <?php else: ?>
                  <p class="alert alert-success ">Login to send a contact the agent about this property </p>
              <?php endif; ?>
            </div>

            <div class="bg-white widget border rounded">
              <h3 class="h4 text-black widget-title mb-3">Save Property</h3>
              <?php if(isset(auth()->user()->id)) : ?>
                <?php if($checkingSavedProps > 0) :?>
                  <p class="alert alert-success" >Yes saved this property </p>
                <?php else : ?>
                  <form action="<?= url_to('save.prop', $prop->id)?>" method="POST" class="form-contact-agent">
                    <!-- type hidden -->
                    <div class="form-group">
                        <input type="hidden"  class="form-control" name="prop_name" 
                        value="<?= $prop->name?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden"  class="form-control" name="prop_image" 
                        value="<?= $prop->image?>">
                    <div class="form-group">
                        <input type="hidden"  class="form-control" name="prop_location" 
                        value="<?= $prop->location?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden"  class="form-control" name="prop_price" 
                        value="<?= $prop->price?>">
                    </div>
                    <div class="form-group">
                      <input type="submit" id="phone" class="btn btn-primary" value="Send Property">
                    </div>
                  </form>
                <?php endif; ?>
              <?php else: ?>
                <p class="alert alert-success ">Login to save this property </p>
              <?php endif;?>
            </div>

            <div class="bg-white widget border rounded">
              <h3 class="h4 text-black widget-title mb-3 ml-0">Properties Home Types</h3>
                  <div class="px-3" style="margin-left: -15px;">
                    <?php foreach($allHomeType as $homeType) : ?>
                      <a href="<?= url_to('props.home.type', $homeType['name'])?>" class="pt-3 pb-3 pr-3 pl-0 d-block"><?= $homeType['name']?></a>
                    <?php endforeach; ?>
                  </div>            
            </div>

            <div class="bg-white widget border rounded">
              <h3 class="h4 text-black widget-title mb-3 ml-0">Properties Home Types</h3>
                  <div class="px-3" style="margin-left: -15px;">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= url_to('prop.single', $prop->id)?>&quote=<?= $prop->name?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                    <a  href="https://twitter.com/intent/tweet?text=<?= $prop->name?>&url=<?= url_to('prop.single', $prop->id)?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= url_to('prop.single', $prop->id)?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>    
                  </div>            
            </div>

          </div>
          
        </div>
      </div>
    </div>
<?php endforeach;?>
    <div class="site-section site-section-sm bg-light">
      <div class="container">

        <div class="row">
          <div class="col-12">
            <div class="site-section-title mb-5">
              <h2>Related Properties</h2>
            </div>
          </div>
        </div>
      
        <div class="row mb-5">
          <?php foreach($relatedProps as $prop): ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="<?= url_to('prop.single', $prop->id)?>" class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type bg-danger"><?= $prop->type?></span>
                </div>
                <img src="<?=base_url('public/assets/images/'.$prop->image)?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                <h2 class="property-title"><a href="<?= url_to('prop.single', $prop->id)?>"><?= $prop->name?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span><?= $prop->location?></span>
                <strong class="property-price text-primary mb-3 d-block text-success">$<?= number_format($prop->price);?></strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number"><?= $prop->num_beds?></span>
                    
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

<?= $this->endsection();?>