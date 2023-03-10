<?php get_header(); ?>

<main>
  <h2 class="page-title">訪問結果一覧<span>アプローチャー飛び込み</span></h2>

  <?php
  // データベースに接続
  include('access.php');
  ?>

  <?php
  date_default_timezone_set('Asia/Tokyo');
  //日付情報を取得
  if (isset($_POST['postmonth'])) {
    //クリック値がある場合
    $n_month = $_POST['postmonth'];
    $toyear = date('Y', strtotime($n_month));
    $tomonth = date('m', strtotime($n_month));
  } else {
    // クリック値がない場合
    $n_month = date('Y-m');
    // 今年を取得
    $toyear = date('Y');
    // 今月を取得
    $tomonth = date('m');
  }
  ?>

<div class="date-container">
    <form class="date-pull" action="index.php" method="post">
      <?php
      // セレクトフォームの用意

      // SELECT文を変数に格納
      $sql_date = "SELECT * FROM approacher_report
              ORDER BY a_visit_date";

      // SQLステートメントを実行し、結果を変数に格納
      $stmt_date = $pdo->query($sql_date);

      // SQL文の結果の取り出し
      $result_date = $stmt_date->fetchAll(PDO::FETCH_ASSOC);
      $i = 0;

      echo '<label class="selectbox-005">
            <select name="selectdate">
            <option value="" selected hidden>年月を指定する</option>';

      // foreach文で配列の中身を一行ずつ出力
      foreach ($result_date as $row) {
        $option_date[$i] = date('Y年n月', strtotime(htmlspecialchars($row['a_visit_date'], ENT_QUOTES, 'UTF-8')));
        $i++;
      }

      $option_date_disp = array_unique($option_date);

      for ($i = count($option_date_disp) - 1; $i >= 0; $i--) {
        echo '<option value="' . $option_date_disp[$i] . '">' . $option_date_disp[$i] . '</option>';
      }

      echo '</select>
            </label>';

      ?>
      <input class="button-002" type="submit" name="datesearch" value="表示" />
      <?php

        if (isset($_POST["datesearch"])) { // 検索ボタン押下時の処理
          // 検索フォームに入力された値を取得
          $pattern = ['年' , '月'];
          $replace = ['-' , ''];
          $n_month = str_replace($pattern,$replace,$_POST["selectdate"]);
          $toyear = date('Y' , strtotime($n_month));
          $tomonth = date('m' , strtotime($n_month));
        }

      ?>
      <input type="hidden" name="postmonth" value="<?php echo $n_month; ?>" />
    </form>

    <form class="date-recent" action="index.php" method="post">
      <input class="lastmonth_btn" type="submit" name="lastmonth" value="" />
      <?php

      // 次月先月ボタン押下時の処理
      if (isset($_POST['nextmonth'])) { // 次月ボタン
        $n_month = date('Y-m', strtotime($toyear . '-' . $tomonth . ' +1 month'));
        $toyear = date('Y', strtotime($n_month));
        $tomonth = date('m', strtotime($n_month));
      } else if (isset($_POST['lastmonth'])) { // 先月ボタン
        $n_month = date('Y-m', strtotime($toyear . '-' . $tomonth . ' -1 month'));
        $toyear = date('Y', strtotime($n_month));
        $tomonth = date('m', strtotime($n_month));
      }

      // 年月を表示
      echo "<div class=\"current-month\">$toyear 年 ". date('n', strtotime($toyear . '-' . $tomonth)) ." 月</div>";
      ?>
      <input class="nextmonth_btn" type="submit" name="nextmonth" value="" />
      <input type="hidden" name="postmonth" value="<?php echo $n_month; ?>" />
    </form>
  </div>

  <!-- キーワード検索 -->
  <input type="search" class="light-table-filter" data-table="order-table" placeholder="検索キーワードを入れてください" />
  
  <?php
  // 月初を取得
  $firstdate = date('Y-m-d', strtotime('first day of ' . $toyear . '-' . $tomonth));
  // 月末を取得
  $lastdate = date('Y-m-d', strtotime('last day of ' . $toyear . '-' . $tomonth));

  // SELECT文を変数に格納
  $sql = "SELECT * FROM approacher_report
          JOIN user_list ON approacher_report.ul_user_ID = user_list.ul_user_ID
          JOIN apo_type ON approacher_report.ap_apo_ID = apo_type.ap_apo_ID
          JOIN product_type ON approacher_report.pt_product_ID = product_type.pt_product_ID
          JOIN result_type ON approacher_report.rt_result_ID = result_type.rt_result_ID
          JOIN apart_list ON user_list.al_apart_ID = apart_list.al_apart_ID
          WHERE a_visit_date BETWEEN '$firstdate' AND '$lastdate'";

  // SQLステートメントを実行し、結果を変数に格納
  $stmt = $pdo->query($sql);

  // SQL文の結果の取り出し
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // テーブルの用意
echo "<div class=\"table-scroll\">\n";
  echo "<table class=\"order-table result_table\">\n";
  echo "<thead>\n";
  echo "<tr>\n";
  echo "<th class=\"sort-th th-id-width\">ID</th>
                  <th class=\"sort-th th-medium-width\">訪問日</th>
                  <th class=\"th-medium-width\">顧客氏名</th>
                  <th class=\"th-medium-width\">郵便番号</th>
                  <th class=\"th-large-width\">訪問場所</th>
                  <th class=\"th-medium-width\">所属</th>
                  <th class=\"th-medium-width\">営業担当</th>
                  <th class=\"th-medium-width\">アポの種類</th>
                  <th class=\"th-medium-width\">商材の種類</th>
                  <th class=\"th-medium-width\">訪問手法</th>
                  <th class=\"th-medium-width\">催事開催場所</th>
                  <th class=\"th-medium-width\">営業結果</th>
                  <th class=\"th-large-width\">NG/FOの理由</th>
                  <th class=\"th-small-width\">アポカード</th>
                  <th class=\"th-large-width\">録音ファイル</th>
                  <th class=\"th-small-width\">詳細</th>
                  <th class=\"th-small-width\">編集</th>";
  echo "</thead>\n";
  echo "</tr>";

  echo "<tbody>\n";
  // foreach文で配列の中身を一行ずつ出力
  foreach ($result as $row) {
    // データベースのフィールド名で出力
    $ID = htmlspecialchars($row['a_visit_ID'], ENT_QUOTES, 'UTF-8');
    $edit_id = $ID;
    echo "<tr id=\"data_edit_".$ID."\">\n";
    echo "<td>" . htmlspecialchars($row['a_visit_ID'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td><form><input type=\"date\" value=\"" . htmlspecialchars($row['a_visit_date'], ENT_QUOTES, 'UTF-8') . "\" id=\"td_a_visit_date\" class=\"edit_input_".$ID."\" disabled/></form></td>\n";
    echo "<td><form><input type=\"text\" value=\"" . htmlspecialchars($row['a_customer_name'], ENT_QUOTES, 'UTF-8') . "\" class=\"edit_input_".$ID."\" disabled/></form></td>\n";
  //  echo "<td id=\"td_a_customer_name" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['a_customer_name'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_a_post_code" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['a_post_code'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_a_spot" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['a_spot'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_al_apart" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['al_apart'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_ul_name" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['ul_name'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_ap_type" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['ap_type'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_pt_type" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['pt_type'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_a_visit_type" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['a_visit_type'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_a_event_spot" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['a_event_spot'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_rt_type" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['rt_type'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td id=\"td_a_reason" . $ID . "\" myTDcontentEditable>" . htmlspecialchars($row['a_reason'], ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "<td><a class=\"apocard_icon\" data-lightbox=\"apo_card\" href=" . htmlspecialchars($row['a_apo_card'], ENT_QUOTES, 'UTF-8') . "><img src=" . get_template_directory_uri() . "./img/apocard_icon.png\"></a></td>\n";
    echo "<td><div class=\"rec_td\"><audio controls src=" . htmlspecialchars($row['a_rec'], ENT_QUOTES, 'UTF-8') . "><a href=" . htmlspecialchars($row['a_rec'], ENT_QUOTES, 'UTF-8') . ">Download</a></audio></div></td>\n";
    echo "<td><form action=\"approachdetail.php\"><input type=\"submit\" value=" . htmlspecialchars($row['a_visit_ID'], ENT_QUOTES, 'UTF-8') . " name=\"visitID\"/></form></td>\n";
    echo "<td><form action=\"index.php\" method=\"post\"><input type=\"button\" value=\"編集\" name=\"tableedit\" onclick=\"click_disabled()\"/></form><form action=\"index.php\" method=\"post\"><input type=\"button\" value=\"キャンセル\" onclick=\"click_disabled_cancel()\"/></form><input type=\"submit\" value=\"更新\"></td>\n";
    echo "</tr>\n";

    echo <<<EOM
    <script>
    function click_disabled(){
      // if(document.getElementById("td_a_visit_date1").disabled === false){
      //   document.getElementById("td_a_visit_date1").disabled = true;
      // } else {
      //   document.getElementById("td_a_visit_date1").disabled = false;
      // }

    let inputItem = document.querySelectorAll(".edit_input_{$edit_id}");
     console.log(inputItem)
    for(var i=0; i<inputItem.length; i++){
      if(inputItem[i].disabled === false){
        inputItem[i].disabled = true;
      } else {
        inputItem[i].disabled = false;
      }
    }
    }
    function click_disabled_cancel(){
      var inputItem = document.getElementById("data_edit_{$ID}").getElementsByTagName("input");
    for(var i=0; i<inputItem.length; i++){
        inputItem[i].disabled = false;
    }
    }
    </script>
    EOM;
  }
  echo "</tbody>";
  echo "</table>\n";
  echo "</div>\n";
  ?>

 <?php
  // 編集ボタン押下時の処理
  if (isset($_POST['tableedit'])) { 
    // SELECT文を変数に格納
  $sql = "UPDATE approacher_report
  SET approacher_report.a_visit_date
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
  }
  ?>

</main>
<?php get_footer(); ?>