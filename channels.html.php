<!DOCTYPE html>
<html class="mdc-typography">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>E-Docs+</title>
	<link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
	<link rel="stylesheet" href="css/general.css">
	<link rel="stylesheet" href="css/site_themes/light_blue/index.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="application/javascript" src="js/page.js"></script>
	<script type="application/javascript">

	</script>
</head>
<body>
<div id="page" class="" style="margin: auto">
	<?php include "header.php" ?>
	<?php include "nav.php" ?>
	<section id="main">
		<div id="menu" style="order: 1; background-color: #f3f5fa">
			<div style="width: 95%; margin: auto; background-color: white; border-radius: 3px; margin-top: 15px">
				<div class="front_item">
					<i class="material-icons" style="margin-right: 10px">watch_later</i>
                    <a href="index.php">Ultimi inserimenti</a>
				</div>
				<div class="front_item">
					<i class="material-icons" style="margin-right: 10px">highlight</i>In evidenza
				</div>
				<div class="front_item" style="display: flex">
					<i class="material-icons" style="margin-right: 10px; flex: 0 1 10%;">cast</i>
					<span style="flex: 0 1 70%">Canali</span>
					<i class="material-icons collapsable" style="flex: 0 1 20%; text-align: center" data-collapse="channels">arrow_drop_down</i>
				</div>
				<div id="channels" style="display: none">
					<?php
					while ($sub = $res_subjects->fetch_assoc()) {
						?>
						<div class="front_item sub_item">
							<a href="channel.php?cid=<?php echo $sub['sid'] ?>"><?php echo $sub['name'] ?></a>
						</div>
						<?php
					}
					?>
				</div>
				<div id="user_space" style="<?php if(!isset($_SESSION['__user__'])) echo 'display: none' ?>">
					<div class="front_item label_item" style="display: flex">
						<i class="material-icons" style="margin-right: 10px; flex: 0 1 10%;">cast_connected</i>
						<span style="flex: 0 1 70%">I tuoi canali</span>
						<i class="material-icons collapsable" style="flex: 0 1 20%; text-align: center"
						   data-collapse="mychannels">arrow_drop_down</i>
					</div>
					<div id="mychannels" style="display: none">
						<div class="front_item sub_item">Storia</div>
						<div class="front_item sub_item">Geografia</div>
					</div>
					<div class="front_item label_item" style="display: flex">
						<i class="material-icons" style="margin-right: 10px; flex: 0 1 10%;">local_library</i>
						<span style="flex: 0 1 70%">La tua libreria</span>
						<i class="material-icons collapsable" style="flex: 0 1 20%; text-align: center"
						   data-collapse="mylibrary">arrow_drop_down</i>
					</div>
					<div id="mylibrary" style="display: none">
						<div class="front_item sub_item">Storia</div>
						<div class="front_item sub_item">Geografia</div>
						<div class="front_item sub_item" style="">Italiano</div>
					</div>
				</div>
			</div>

			<p class="spacer"></p>
		</div>
		<div id="content" style="order: 2">
			<div class="main_front_label">
				<p>
					<i class="material-icons">cast</i>
					<span>Canali</span>
				</p>
			</div>
			<?php
			$res_subjects->data_seek(0);
			while ($sub = $res_subjects->fetch_assoc()) {
				$sql = "SELECT rb_documents.*, rb_categories.name AS cat, rb_categories.color AS color, rb_categories.icon AS icon, rb_subjects.name as sub 
		FROM rb_documents, rb_subjects, rb_categories 
		WHERE subject = sid AND sid = ".$sub['sid']."
		AND category = cid
		ORDER BY upload_date DESC LIMIT 6";
				$docs_sub = $db->executeQuery($sql);
				?>
				<div class="front_label">
					<p><?php echo $sub['name'] ?></p>
				</div>
				<div style="display: flex; padding-left: 40px">
					<?php
					while ($r = $docs_sub->fetch_assoc()) {
						?>
						<div class="file-card mdc-elevation--z2" id="sbitem<?php echo $r['doc_id'] ?>" data-id="<?php echo $r['doc_id'] ?>" data-list="subjects">
							<section class="file-subject normal">
								<p style="margin: auto"><?php echo $r['cat'] ?></p>
							</section>
							<section class="file-ext">
								<div>
									<i class="material-icons" style="font-size: 7rem; color: #4FC3F7"><?php echo $r['icon'] ?></i>
								</div>
							</section>
							<section class="file-title normal">
								<h1 class=""><?php echo truncateString($r['title'], 25) ?></h1>
								<!--<h2 class="mdc-card__subtitle"><?php echo $r['sub'] ?></h2>-->
							</section>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>

			<p class="spacer"></p>
			<p class="spacer"></p>
		</div>
	</section>
</div>
<?php include "footer.php" ?>
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<script src="front.js" type="application/javascript"></script>
</body>
</html>