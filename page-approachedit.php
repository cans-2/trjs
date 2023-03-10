<?php get_header(); ?>

<main>
  <h2 class="page-title">訪問結果編集</h2>

  <!-- 直前のページに戻る -->
  <input type="button" onclick="history.back()" value="戻る">

  <?php
  // データベースに接続
  include('access.php');
  ?>

  <?php
  if (isset($_GET['e_visitID'])) {
    // 遷移時のみ
    // IDを前ページから取得
    $ID = $_GET['e_visitID'];
  } else if (isset($_POST['e_visitID'])) {
    $ID = $_POST['e_visitID'];
  }

  // SELECT文を変数に格納
  $sql = "SELECT * FROM approacher_report
            JOIN user_list ON approacher_report.ul_user_ID = user_list.ul_user_ID
            JOIN apo_type ON approacher_report.ap_apo_ID = apo_type.ap_apo_ID
            JOIN product_type ON approacher_report.pt_product_ID = product_type.pt_product_ID
            JOIN result_type ON approacher_report.rt_result_ID = result_type.rt_result_ID
            JOIN apart_list ON user_list.al_apart_ID = apart_list.al_apart_ID
            WHERE a_visit_ID = $ID";

  // SQLステートメントを実行し、結果を変数に格納
  $stmt = $pdo->query($sql);

  // SQL文の結果の取り出し
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // フォームの用意
  echo "<form id=\"edit_main\" action=\"/approachedit\" method=\"post\">";
  // foreach文で配列の中身を一行ずつ出力
  foreach ($result as $row) {
    // データベースのフィールド名で出力
    echo "訪問日:<input type=\"date\" name=\"visit_date\" value=\"" . htmlspecialchars($row['a_visit_date'], ENT_QUOTES, 'UTF-8') . "\">\n";
    echo "顧客氏名:<input type=\"text\" name=\"customer_name\" value=\"" . htmlspecialchars($row['a_customer_name'], ENT_QUOTES, 'UTF-8') . "\">\n";
    echo "郵便番号:<input type=\"text\" name=\"post_code\" value=\"" . htmlspecialchars($row['a_post_code'], ENT_QUOTES, 'UTF-8') . "\">\n";
    echo "訪問場所:<input type=\"text\" name=\"spot\" value=\"" . htmlspecialchars($row['a_spot'], ENT_QUOTES, 'UTF-8') . "\">\n";
    // echo "所属:<input type=\"select\" name=\"apart\" value=\"" . htmlspecialchars($row['al_apart'], ENT_QUOTES, 'UTF-8') . "\">\n";

    // echo "営業氏名:<input type=\"select\" name=\"staff_name\" value=\"" . htmlspecialchars($row['ul_name'], ENT_QUOTES, 'UTF-8') . "\">\n";

    // echo "アポの種類:<input type=\"select\" name=\"ap_type\" value=\"" . htmlspecialchars($row['ap_type'], ENT_QUOTES, 'UTF-8') . "\">\n";

    // echo "商材の種類:<input type=\"select\" name=\"pt_type\" value=\"" . htmlspecialchars($row['pt_type'], ENT_QUOTES, 'UTF-8') . "\">\n";

    // echo "営業結果:<input type=\"select\" name=\"visit_type\" value=\"" . htmlspecialchars($row['rt_type'], ENT_QUOTES, 'UTF-8') . "\">\n";

    echo "NG/FOの理由:<input type=\"text\" name=\"reason\" value=\"" . htmlspecialchars($row['a_reason'], ENT_QUOTES, 'UTF-8') . "\">\n";
  }
  ?>
  </form>
  <form id="edit_file" action="/approachedit" method="post" name="apo_card" enctype="multipart/form-data">
    <p>アポカード:</p><input type="file" value="<?php echo htmlspecialchars($row['a_apo_card'], ENT_QUOTES, 'UTF-8'); ?>" form="edit_main">

    <p>録音ファイル:</p><input type="file" value="<?php echo htmlspecialchars($row['a_rec'], ENT_QUOTES, 'UTF-8'); ?>" form="edit_main">

  </form>
  <form id="edit_submit" action="/approachedit" method="post">
    <input class="edit_btn" type="submit" name="edit_at" value="更新" form="edit_main" />

    <?php
    // 編集ボタン押下時の処理
    if (isset($_POST['edit_at'])) {

      // UPDATE文を変数に格納
      $sql = "UPDATE approacher_report
              JOIN user_list ON approacher_report.ul_user_ID = user_list.ul_user_ID
              JOIN apo_type ON approacher_report.ap_apo_ID = apo_type.ap_apo_ID
              JOIN product_type ON approacher_report.pt_product_ID = product_type.pt_product_ID
              JOIN result_type ON approacher_report.rt_result_ID = result_type.rt_result_ID
              JOIN apart_list ON user_list.al_apart_ID = apart_list.al_apart_ID
              SET approacher_report.a_visit_date = :visit_date,
              approacher_report.a_customer_name = :customer_name,
              approacher_report.a_post_code = :post_code,
              approacher_report.a_spot = :spot,
              -- approacher_report.al_apart = :apart,
              -- approacher_report.ul_name = :staff_name,
              -- approacher_report.ap_type = :ap_type,
              -- approacher_report.pt_type = :pt_type,
              -- approacher_report.rt_type = :rt_type,
              approacher_report.a_reason = :reason
              WHERE a_visit_ID = :visit_ID";

      // SQLステートメントを実行し、結果を変数に格納
      $stmt = $pdo->prepare($sql);

      $pattern = ['/'];
      $replace = ['-'];
      $visit_date = str_replace($pattern, $replace, $_POST['visit_date']);

      // 値の組み込み
      $stmt->bindValue(':visit_ID', $ID);
      $stmt->bindValue(':visit_date', $visit_date);
      $stmt->bindValue(':customer_name', $_POST['customer_name']);
      $stmt->bindValue(':post_code', $_POST['post_code']);
      $stmt->bindValue(':spot', $_POST['spot']);
      // $stmt->bindValue(':apart', $_POST['apart']);
      // $stmt->bindValue(':staff_name', $_POST['staff_name']);
      // $stmt->bindValue(':ap_type', $_POST['ap_type']);
      // $stmt->bindValue(':pt_type', $_POST['pt_type']);
      // $stmt->bindValue(':rt_type', $_POST['visit_type']);
      $stmt->bindValue(':reason', $_POST['reason']);

      // SQL文の実行
      $result = $stmt->execute();
    }
    ?>
    <input type="hidden" name="e_visitID" value="<?php echo $ID; ?>" form="edit_main" />
  </form>
</main>
<?php get_footer(); ?>