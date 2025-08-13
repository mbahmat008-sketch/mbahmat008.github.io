<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
$pageTitle = 'Detail Properti';
$active = 'jember';

$id_or_slug = $_GET['id'] ?? $_GET['slug'] ?? null;
if (!$id_or_slug) { http_response_code(404); die("Property not found"); }
$prop = get_property_by_id_or_slug($mysqli, $id_or_slug);
if (!$prop) { http_response_code(404); die("Property not found"); }
$images = get_property_images($mysqli, (int)$prop['id']);

include __DIR__ . '/partials/header.php';
?>
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="index.php">Home</a>  /  Single Property</span>
          <h3><?php echo e($prop['title']); ?></h3>
        </div>
      </div>
    </div>
  </div>

  <div class="single-property section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="main-image">
            <img src="<?php echo e($images[0]['image_url'] ?? $prop['image_url']); ?>" alt="">
          </div>
          <div class="main-content">
            <span class="category"><?php echo e($prop['category']); ?></span>
            <h4><?php echo e($prop['address']); ?></h4>
            <p><?php echo nl2br(e($prop['description'])); ?></p>
          </div> 
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Detail Properti
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li><strong>Harga:</strong> <?php echo e($prop['price_label']); ?></li>
                    <li><strong>Luas:</strong> <?php echo e($prop['area']); ?> m2</li>
                    <li><strong>Kamar:</strong> <?php echo (int)$prop['bedrooms']; ?></li>
                    <li><strong>Kamar Mandi:</strong> <?php echo (int)$prop['bathrooms']; ?></li>
                    <li><strong>Lantai:</strong> <?php echo e($prop['floor']); ?></li>
                    <li><strong>Parkir:</strong> <?php echo e($prop['parking']); ?></li>
                  </ul>
                </div>
              </div>
            </div>
            <?php if (count($images) > 1): ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Galeri Foto
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="row">
                  <?php foreach($images as $img): ?>
                    <div class="col-md-4 mb-3">
                      <img class="img-fluid rounded" src="<?php echo e($img['image_url']); ?>" alt="">
                    </div>
                  <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info-table">
            <ul>
              <li><img src="assets/images/info-icon-01.png" alt="" style="max-width: 52px;"><h4><?php echo e($prop['area']); ?> m2<br><span>Total Flat Space</span></h4></li>
              <li><img src="assets/images/info-icon-02.png" alt="" style="max-width: 52px;"><h4>Contract<br><span>Contract Ready</span></h4></li>
              <li><img src="assets/images/info-icon-03.png" alt="" style="max-width: 52px;"><h4>Payment<br><span>Payment Process</span></h4></li>
              <li><img src="assets/images/info-icon-04.png" alt="" style="max-width: 52px;"><h4>Safety<br><span>24/7 Under Control</span></h4></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include __DIR__ . '/partials/footer.php'; ?>
