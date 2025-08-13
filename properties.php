<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
$active = 'properties';
$pageTitle = 'List Rumah';
$category = isset($_GET['category']) ? $_GET['category'] : null;

$per_page = 9;
$page = max(1, (int)($_GET['page'] ?? 1));
$total = count_properties($mysqli, $category);
$pages = max(1, (int)ceil($total / $per_page));
$offset = ($page - 1) * $per_page;

$items = get_properties($mysqli, $per_page, $offset, $category);

include __DIR__ . '/partials/header.php';
?>
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="index.php">Home</a> / Properties</span>
          <h3>Properties</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">
    <div class="container">
      <ul class="properties-filter">
        <li><a class="<?php echo $category ? '' : 'is_active'; ?>" href="properties.php">Show All</a></li>
        <li><a href="properties.php?category=Apartment" class="<?php echo ($category==='Apartment')?'is_active':''; ?>">Apartment</a></li>
        <li><a href="properties.php?category=Luxury Villa" class="<?php echo ($category==='Luxury Villa')?'is_active':''; ?>">Luxury Villa</a></li>
        <li><a href="properties.php?category=Penthouse" class="<?php echo ($category==='Penthouse')?'is_active':''; ?>">Penthouse</a></li>
      </ul>
      <div class="row properties-box">
        <?php foreach ($items as $p): ?>
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items">
          <div class="item">
            <a href="property-details.php?id=<?php echo (int)$p['id']; ?>"><img src="<?php echo e($p['image_url']); ?>" alt=""></a>
            <span class="category"><?php echo e($p['category']); ?></span>
            <h6><?php echo e($p['price_label']); ?></h6>
            <h4><a href="property-details.php?id=<?php echo (int)$p['id']; ?>"><?php echo e($p['title']); ?></a></h4>
            <ul>
              <li>Bedrooms: <span><?php echo (int)$p['bedrooms']; ?></span></li>
              <li>Bathrooms: <span><?php echo (int)$p['bathrooms']; ?></span></li>
              <li>Area: <span><?php echo e($p['area']); ?>m2</span></li>
              <li>Floor: <span><?php echo e($p['floor']); ?></span></li>
              <li>Parking: <span><?php echo e($p['parking']); ?></span></li>
            </ul>
            <div class="main-button">
              <a href="property-details.php?id=<?php echo (int)$p['id']; ?>">Lihat detail</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <ul class="pagination">
            <?php for($i=1;$i<=$pages;$i++): ?>
              <li><a class="<?php echo $i===$page?'is_active':''; ?>" href="?<?php echo http_build_query(array_filter(['category'=>$category,'page'=>$i])); ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php include __DIR__ . '/partials/footer.php'; ?>
