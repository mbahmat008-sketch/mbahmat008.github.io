<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
$pageTitle = 'Igoy Properti - Agen Perumahan Jember';
$active = 'home';
include __DIR__ . '/partials/header.php';
?>
  <div class="main-banner">
    <div class="owl-carousel owl-banner">
      <div class="item item-1">
        <div class="header-text">
          <span class="category">Patrang, <em>Jember</em></span>
          <h2>Temukan<br>Rumah Impianmu Disini</h2>
        </div>
      </div>
      <div class="item item-2">
        <div class="header-text">
          <span class="category">Baratan, <em>Patrang</em></span>
          <h2>Rumah<br>Subsidi Terluas Se Jember</h2>
        </div>
      </div>
      <div class="item item-3">
        <div class="header-text">
          <span class="category">Sumbersari, <em>Jember</em></span>
          <h2>Rumah<br>Subsidi Terlaris Se Jember</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="properties section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| Properties</h6>
            <h2>Listing Terbaru</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <?php foreach (get_properties($mysqli, 6, 0, null) as $p): ?>
        <div class="col-lg-4 col-md-6">
          <div class="item">
            <a href="property-details.php?id=<?php echo (int)$p['id']; ?>"><img src="<?php echo e($p['image_url']); ?>" alt=""></a>
            <span class="category"><?php echo e($p['category']); ?></span>
            <h6><?php echo e($p['price_label']); ?></h6>
            <h4><a href="property-details.php?id=<?php echo (int)$p['id']; ?>"><?php echo e($p['title']); ?></a></h4>
            <ul>
              <li>Kamar: <span><?php echo (int)$p['bedrooms']; ?></span></li>
              <li>Kamar Mandi: <span><?php echo (int)$p['bathrooms']; ?></span></li>
              <li>Luas: <span><?php echo e($p['area']); ?> m2</span></li>
              <li>Lantai: <span><?php echo e($p['floor']); ?></span></li>
              <li>Parkir: <span><?php echo e($p['parking']); ?></span></li>
            </ul>
            <div class="main-button">
              <a href="property-details.php?id=<?php echo (int)$p['id']; ?>">Lihat detail</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="row">
        <div class="col-lg-12 text-center">
          <a class="btn btn-outline-primary" href="properties.php">Lihat semua</a>
        </div>
      </div>
    </div>
  </div>
<?php include __DIR__ . '/partials/footer.php'; ?>
