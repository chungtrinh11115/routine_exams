<?php
    $dsn = "mysql:host=localhost;dbname=restaurantdb;charset=utf8";
    $user = "restaurantdb_admin";
    $password = "admin123";
    
     isset($_GET["id"]) ? $id = $_GET["id"] : $id = "";
    
    try {
    	$pdo = new PDO($dsn, $user, $password);
    	$sql = "select * from restaurants where id=?";
    	$pstmt = $pdo->prepare($sql);
    	$pstmt->bindValue(1, $id);
    	$pstmt->execute();
    	$records = [];
    	$records = $pstmt->fetchAll(PDO::FETCH_ASSOC);
    	unset($pstmt);
    	unset($pdo);
    } catch (PDOException $e) { 
    	echo $e->getMessage();
    } 

    
    var_dump($records);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>レストランレビュサイト - 小テスト</title>
	<link rel="stylesheet" href="../assets/css/style.css" />
	<link rel="stylesheet" href="../assets/css/detail.css" />
</head>
<body id="detail">
	<div class="p-wrapper">
	<header>
		<h1><a href="list.html">レストラン レビュ サイト</a></h1>
	</header>
	<main>
		<article class="detail">
			<h2>レストラン詳細</h2>
			<section>
				<table class="list">
					<tr>
					    <?php if(count($records) > 0): ?>
					        <?php foreach ($records as $record): ?>
        						<td class="photo"><img name="image" src="../pages/img/<?= $record[image] ?> "/></td>
        						<td class="info">
        							<dl>
        								<dt name="name"><?= $record[name] ?></dt>
        								<dd name="description">
        									<?= $record[description] ?>
        								</dd>
        							</dl>
        						</td>
    						<?php endforeach;?>
						<?php endif;?>
					</tr>
				</table>
			</section>
		</article>
		<article class="reviews">
			<h2>レビュ一覧</h2>
			<section>
				<dl class="review">
					<dt name="point">★★★★☆</dt>
					<dd name="description">
							常連の者で、いつも夫婦で伺っています。
							席数が少ないので予約した方が安心ですが、その分落ち着いて食事できますよ。
							コースのメインは基本的にシェフにお任せ。
							来るたびに、新しい味との出会いを楽しめるお店です。
							<div name="posted">
								（<span name="posted_at">2020-09-14 05:29:01</span><span name="reviewer">totsuka</span>さん）
							</div>
					</dd>
				</dl>
				<dl class="review">
					<dt name="point">★★★★★</dt>
					<dd name="description">
							説明の通り、喧騒を外れた場所にひっそりとあるレストランでした。
							伊豆市には初めて来ましたが、本当に桜がきれいですね。
							何よりも空気がきれいで、いいリフレッシュになりました。
							<div name="posted">
								（<span name="posted_at">2020-09-12 15:43:45</span><span name="reviewer">oie</span>さん）
							</div>
					</dd>
				</dl>
			</section>
		</article>
		<article class="entry">
			<h2>レビュを書き込む</h2>
			<section>
				<form action="detail.html" method="post">
					<table class="entry">
						<tr>
							<th>お名前</th>
							<td>
								<input type="text" name="name" />
							</td>
						</tr>
						<tr>
							<th>ポイント</th>
							<td>
								<input type="radio" name="point" value="1">1
								<input type="radio" name="point" value="2">2
								<input type="radio" name="point" value="3" checked>3
								<input type="radio" name="point" value="4">4
								<input type="radio" name="point" value="5">5
							</td>
						</tr>
						<tr>
							<th>レビュ</th>
							<td>
								<textarea name="comment"></textarea>
							</td>
						</tr>
					</table>
					<div class="buttons">
						<input type="submit" value="投稿" />
						<input type="reset" value="クリア" />
					</div>
				</form>
			</section>
		</article>
	</main>
	<footer>
		<div class="copyright">&copy; 2020 the applied course of web system development</div>
	</footer>
	</div>
</body>
</html>