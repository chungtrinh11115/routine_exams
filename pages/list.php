<?php
    $dsn = "mysql:host=localhost;dbname=restaurantdb;charset=utf8";
    $user = "restaurantdb_admin";
    $password = "admin123";
    
     isset($_GET["area"]) ? $area = $_GET["area"] : $area = "";
    
    try {
    	$pdo = new PDO($dsn, $user, $password);
    	$sql = "select * from restaurants where area=?";
    	$pstmt = $pdo->prepare($sql);
    	$pstmt->bindValue(1, $area);
    	$pstmt->execute();
    	$records = [];
    	$records = $pstmt->fetchAll(PDO::FETCH_ASSOC);
    	$stmt = $pdo->prepare("select * from restaurants");
    	$stmt->execute();
    	$allData = [];
    	$allData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    	unset($pstmt);
    	unset($stmt);
    	unset($pdo);
    } catch (PDOException $e) { 
    	echo $e->getMessage();
    } 


   
    //$data = var_dump($area);
    //$data2 = var_dump($records);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>レストランレビュサイト - 小テスト</title>
	<link rel="stylesheet" href="../assets/css/style.css" />
	<link rel="stylesheet" href="../assets/css/list.css" />
</head>
<body id="list">
	<header>
		<h1>レストラン レビュ サイト</h1>
	</header>
	<main>
		<article>
			<div class="clearfix">
			<h2>レストラン一覧</h2>
			<section class="entry">
				<form action="list.php" method="get">
					<select name="area">
						<option value="">-- 地域を選んでください --</option>
						<option value="福岡">福岡</option>
						<option value="神戸">神戸</option>
						<option value="伊豆">伊豆</option>
					</select>
					<input type="submit" value="検索" />
				</form>
			</section>
			</div>
			<section class="result">
			    <?php if(count($records) == 0): ?>
			        <p><?= count($allData) ?>件のレストランが見つかりました。</p>
    				<table class="list">
    				    <?php foreach ($allData as $data): ?>
        					<tr>
        						<td class="photo"><img name="image" alt="「Wine Bar ENOTECA」の写真" src="../pages/img/<?= $data[image]?>" /></td>
        						<td class="info">
        							<dl>
        								<dt name="name"><?= $data[name]?></dt>
        								<dd name="description"><?= $data[description]?></dd>
        							</dl>
        						</td>
        						<td class="link"><a href="detail.php?id=<?= $data[id]?>">詳細</a></td>
        					</tr>
    					<?php endforeach;?>
    				</table>
			    <?php endif;?>
			    <?php if(count($records) > 0): ?>
    				<p><?= count($records) ?>件のレストランが見つかりました。</p>
    				<table class="list">
    				    <?php foreach ($records as $record): ?>
        					<tr>
        						<td class="photo"><img name="image" alt="「Wine Bar ENOTECA」の写真" src="../pages/img/<?= $record[image]?>" /></td>
        						<td class="info">
        							<dl>
        								<dt name="name"><?= $record[name]?></dt>
        								<dd name="description"><?= $record[description]?></dd>
        							</dl>
        						</td>
        						<td class="link"><a href="detail.php?id=<?= $record[id]?>">詳細</a></td>
        					</tr>
    					<?php endforeach;?>
    				</table>
    			<?php endif;?>
			</section>
		</article>
	</main>
	<footer>
		<div class="copyright">&copy; 2020 the applied course of web system development</div>
	</footer>
	
</body>
</html>