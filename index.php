<?php 
  //  スーパーグローバル変数にデータは格納される
  if (!empty($_GET) && isset($_GET['text'])){
    $text = $_GET['text'];
  }

   // データベースと接続
   $dsn = 'mysql:dbname=chatform;host=localhost';
   $user = 'root';
   $password='';
   $dbh = new PDO($dsn, $user, $password);
   $dbh->query('SET NAMES utf8');

   // SQL文の実行
   $sql = 'INSERT INTO `chats` SET `content` = ?';
   // ?→プリテイトステートメント SQLインジェクションから身をまもるために使用
   // サイバー攻撃
   $content[] =  $text;
   // $contentの配列をつくりだしている
   $stmt = $dbh->prepare($sql);
   $stmt->execute($content);
   // → executeの特徴（引数には配列をいれる）

   $stmt2 = $dbh->prepare('SELECT * FROM chats');
   $stmt2->execute();
   $records = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  //  var_dump($records);
  // $_GET送信が存在し、textの中身が殻ではない時

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./style.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <section>
    <header>
      <button type=button class="search-form">Search 夜間じっくり</button>
    </header>
    <main>
      <div class="chat-side">
        <div class="side-header">
          <p>NexSeed</p>
          <p>〇〇〇〇</p>
        </div>
        <div class="side-content">
          <ul>
            <li>Threads</li>
            <li>Mention&reaction</li>
            <li>Draft</li>
            <li>Saved items</li>
            <li>Channnel browser</li>
            <li>People & user groups</li>
            <li>Apps</li>
            <li>File browser</li>
            <li>Show less</li>
          </ul>
        </div>
        <div class="side-channel">
          <p>Channel</p>
          <ul>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
            <li>#〇〇</li>
          </ul>
        </div>
        <div class="side-dm">
          <p>Direct message</p>
          <ul>
            <li>⦿〇〇</li>
            <li>⦿〇〇</li>
            <li>⦿〇〇</li>
            <li>⦿〇〇</li>
            <li>⦿〇〇</li>
            <li>⦿〇〇</li>
          </ul>
        </div>
      </div>
      <div class="chat-main">
        <div class="chat-header">
          <div class="header-content">
            <p>#夜間じっくり<i class="far fa-star"></i></p>
            <div class="header-icon">
              <i class="far fa-user">16 |</i>
              <i class="fas fa-thumbtack">1 |</i>
              <span> Add a topic</span>
            </div>
          </div>
        </div>
        <div class="chat-content">
          <?php foreach($records as $record):?>
          <div class="message-content">
            <div class="left-image">
              <img src="./monster.jpg" alt="">
            </div>
            <div class="right-content">
              <p>Slackbot</p>
              <p><?php echo $record['content'];?></p>
            </div>
          </div>
          <?php endforeach;?>
          <!-- <div class="message-content">
            <div class="left-image">
              <img src="./monster.jpg" alt="">
            </div>
            <div class="right-content">
              <p>Slackbot</p>
              <p>プログラミングは最初は難しいが楽しい</p>
            </div>
          </div>
          <div class="message-content">
            <div class="left-image">
              <img src="./monster.jpg" alt="">
            </div>
            <div class="right-content">
              <p>Slackbot</p>
              <p>プログラミングは最初は難しいが楽しい</p>
            </div>
          </div>
          <div class="message-content">
            <div class="left-image">
              <img src="./monster.jpg" alt="">
            </div>
            <div class="right-content">
              <p>Slackbot</p>
              <p>プログラミングは最初は難しいが楽しい</p>
            </div>
          </div> -->
        </div>
        <div class="chat-message">
          <form action="#" method="GET" class="chat-form"> 
            <input type="text" class="form-text" placeholder="  Message" name="text">
            <div class="form-option">
              <input type="submit" value="送信" class="send-btn">
            </div>
          </form>
        </div>
      </div>
    </main>
  </section>
  
</body>
</html>