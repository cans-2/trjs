<?php get_header(); ?>

<main>
  <h2 class="page-title">訪問結果印刷</h2>

  <!-- 直前のページに戻る -->
  <input type="button" onclick="history.back()" value="戻る">

  <?php
  // データベースに接続
  include('access.php');
  ?>

  <?php
  // IDを前ページから取得
  $ID = $_GET['p_visitID'];

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

  // テーブルの用意
  echo "<table class=\"order-table result_table\">\n";
  echo "<thead>\n";
  echo "<tr>\n";
  echo "<th class=\"sort-th\">ID</th>
                  <th class=\"sort-th\">訪問日</th>
                  <th>顧客氏名</th>
                  <th>郵便番号</th>
                  <th>訪問場所</th>
                  <th>所属</th>
                  <th>営業担当</th>
                  <th>アポの種類</th>
                  <th>商材の種類</th>
                  <th>訪問手法</th>
                  <th>催事開催場所</th>
                  <th>営業結果</th>
                  <th>NG/FOの理由</th>
                  <th>アポカード</th>
                  <th>録音ファイル</th>";
  echo "</thead>\n";
  echo "</tr>";

  echo "<tbody>\n";
  // foreach文で配列の中身を一行ずつ出力
  foreach ($result as $row) {
    // データベースのフィールド名で出力
    echo "<tr>\n";
    echo "<td>" . htmlspecialchars($row['a_visit_ID'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['a_visit_date'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['a_customer_name'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['a_post_code'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['a_spot'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['al_apart'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['ul_name'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['ap_type'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['pt_type'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['a_visit_type'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['a_event_spot'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['rt_type'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td>" . htmlspecialchars($row['a_reason'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td><a class=\"apocard_icon\" data-lightbox=\"apo_card\" href=" . htmlspecialchars($row['a_apo_card'], ENT_QUOTES, 'UTF-8') . "><img src=" . get_template_directory_uri() . "./img/apocard_icon.png\"></a></td>\n";
    echo "<td><audio controls src=" . htmlspecialchars($row['a_rec'], ENT_QUOTES, 'UTF-8') . "><a href=" . htmlspecialchars($row['a_rec'], ENT_QUOTES, 'UTF-8') . ">Download</a></audio></td>\n";
    echo "</tr>\n";
  }
  echo "</tbody>";
  echo "</table>\n"
  ?>
</main>
<?php get_footer(); ?>