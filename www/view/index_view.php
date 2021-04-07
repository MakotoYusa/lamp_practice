<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>

  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>

<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>


  <div class="container">
    <h1>商品一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form action="index_sort.php" method="get">
      <select name="sort_type">
        <option value="new_arrival">新着順</option>
        <option value="low_price">価格が安い順</option>
        <option value="high_price">価格が高い順</option>
      </select>
      <input type="submit" value="並び替え" class="btn">
      <input type="hidden" name="token" value="<?php print $token ?>">
    </form>

    <div class="card-deck">
      <div class="row">
        <?php foreach ($items as $item) { ?>
          <div class="col-6 item">
            <div class="card h-100 text-center">
              <div class="card-header">
                <?php print(h($item['name'])); ?>
              </div>
              <figure class="card-body">
                <img class="card-img" src="<?php print(IMAGE_PATH . h($item['image'])); ?>">
                <figcaption>
                  <?php print(number_format(h($item['price']))); ?>円
                  <?php if (h($item['stock']) > 0) { ?>
                    <form action="index_add_cart.php" method="post">
                      <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                      <input type="hidden" name="item_id" value="<?php print(h($item['item_id'])); ?>">
                      <input type="hidden" name="token" value="<?php print $token ?>">
                    </form>
                  <?php } else { ?>
                    <p class="text-danger">現在売り切れです。</p>
                  <?php } ?>
                </figcaption>
              </figure>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

</body>

</html>