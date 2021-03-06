<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>I miei documenti</title>
	<link rel="stylesheet" href="../css/general.css" type="text/css" media="screen,projection" />
	<link rel="stylesheet" media="screen and (min-width: 2000px)" href="../css/layouts/larger.css">
	<link rel="stylesheet" media="screen and (max-width: 1999px) and (min-width: 1300px)" href="../css/layouts/wide.css">
	<link rel="stylesheet" media="screen and (max-width: 1299px) and (min-width: 1025px)" href="../css/layouts/normal.css">
	<link rel="stylesheet" media="screen and (max-width: 1024px)" href="../css/layouts/small.css">
	<link rel="stylesheet" href="../css/site_themes/<?php echo getTheme() ?>/reg.css" type="text/css" media="screen,projection" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
	<script type="application/javascript" src="../js/page.js"></script>
    <style>
        .mdc-card {
            width: 320px;
            background-color: white;
        }

        .app-fab--absolute.app-fab--absolute {
            position: fixed;
            /*right: 39rem;*/
        }
    </style>
</head>
<body>
<?php include_once "../share/header.php" ?>
<?php include_once "../share/nav.php" ?>
<div id="main">
	<div id="right_col">
		<?php include_once "menu.php" ?>
	</div>
	<div id="left_col">
        <div style="width: 90%; margin-right: auto; margin-left: auto; margin-top: -10px; text-align: right; display: flex; justify-content: flex-end">
            <?php if(!isset($_GET['view']) || $_GET['view'] != 'list'): ?>
            <div id="choose_order" style="width: 130px; color: rgba(0, 0, 0, .57); font-size: 1.2rem; display: flex; align-items: center" class="_bold">
                <?php echo $label ?>
            </div>
            <a href="<?php echo $name_link ?>" style="margin-right: 75%">
                <div class="file-action">
                    <i class="material-icons"><?php echo $arrow ?></i>
                </div>
            </a>
            <?php endif; ?>
            <a href="<?php echo $link ?>">
                <div class="file-action">
                    <i class="material-icons"><?php echo $mat_icon ?></i>
                </div>
            </a>
        </div>
        <div id="container" style="width: 90%; margin: auto; padding: 2%; display: flex; align-items: center; flex-wrap: wrap">
        <?php
		$index = 0;
        while ($row = $res_docs->fetch_assoc()) {
			$ext = pathinfo($_SESSION['__config__']['document_root']."/".$row['file'], PATHINFO_EXTENSION);
			$fs = filesize($_SESSION['__config__']['document_root']."/".$row['file']);
			$mime = MimeType::getMimeContentType($_SESSION['__config__']['document_root']."/".$row['file']);
			if (!isset($_GET['view']) || $_GET['view'] == 'cards') {
				?>
                <div class="file-card mdc-elevation--z2" id="item<?php echo $row['doc_id'] ?>" data-id="<?php echo $row['doc_id'] ?>" data-type="<?php echo $row['document_type'] ?>">
                    <section class="file-subject normal">
						<p style="margin: auto"><?php echo $row['sub'] ?></p>
                    </section>
                    <section class="file-ext">
                        <div>
                            <i class="material-icons" style="font-size: 7rem; opacity: 25%"><?php if($row['document_type'] == 1) echo $row['icon']; else echo 'public' ?></i>
                        </div>
                    </section>
                    <section class="file-title normal">
                        <h1 class=""><?php echo truncateString($row['title'], 25) ?></h1>
                        <!--<h2 class="mdc-card__subtitle"><?php echo $row['sub'] ?></h2>-->
                    </section>
                </div>
				<?php
			}
			else {
			    if ($index == 0) {
					?>
                    <div style="width: 100%; display: flex; flex-wrap: wrap; align-items: center; height: 45px" class="bottom_decoration _bold">
                        <div style="order: 1; flex: 3; display: flex; align-items: center; color: rgba(0, 0, 0, .55)">
                            <a href="documents.php?view=list&o=title&d=desc" style="color: rgba(0, 0, 0, .55)">Titolo</a>
                            <?php if (isset($_GET['view']) && $_GET['view'] == 'list' && $_GET['o'] == 'title'): ?>
                            <a href="documents.php?view=list&o=title&d=<?php echo ($_GET['d'] == 'desc') ? 'asc': 'desc'  ?>" style="margin-right: 80%">
                                <div style="width: 30px; height: 30px;" class="file-action">
                                    <i class="material-icons" style="font-size: 1.2rem"><?php echo $arrow ?></i>
                                </div>
                            </a>
                            <?php endif; ?>
                        </div>
                        <div style="order: 2; flex: 2; display: flex; align-items: center; color: rgba(0, 0, 0, .55)">
                            <a href="documents.php?view=list&o=sub&d=desc" style="color: rgba(0, 0, 0, .55)">Disciplina</a>
							<?php if (isset($_GET['view']) && $_GET['view'] == 'list' && $_GET['o'] == 'sub'): ?>
                                <a href="documents.php?view=list&o=sub&d=<?php echo ($_GET['d'] == 'desc') ? 'asc': 'desc'  ?>" style="margin-right: 20%">
                                    <div style="width: 30px; height: 30px;" class="file-action">
                                        <i class="material-icons" style="font-size: 1.2rem"><?php echo $arrow ?></i>
                                    </div>
                                </a>
							<?php endif; ?>
                        </div>
                        <div style="order: 4; flex: 2; display: flex; align-items: center; color: rgba(0, 0, 0, .55)">
                            <a href="documents.php?view=list&o=last_modified_time&d=desc" style="color: rgba(0, 0, 0, .55)">Ultima modifica</a>
							<?php if (isset($_GET['view']) && $_GET['view'] == 'list' && $_GET['o'] == 'last_modified_time'): ?>
                                <a href="documents.php?view=list&o=last_modified_time&d=<?php echo ($_GET['d'] == 'desc') ? 'asc': 'desc'  ?>" style="margin-right: 20%">
                                    <div style="width: 30px; height: 30px;" class="file-action">
                                        <i class="material-icons" style="font-size: 1.2rem"><?php echo $arrow ?></i>
                                    </div>
                                </a>
							<?php endif; ?>
                        </div>
                        <div style="order: 5; flex: 1; color: rgba(0, 0, 0, .55)">Dimensioni file</div>
                    </div>
					<?php
				}
                    ?>
            <div style="width: 100%; display: flex; flex-wrap: wrap; align-items: center; height: 30px" class="bottom_decoration">
                <div style="order: 1; flex: 3; display: flex; align-items: center">
                    <i class="material-icons accent_color" style="margin-right: 10px; font-size: 1.3rem"><?php echo $mime['icon'] ?></i>
                    <?php echo $row['title'] ?>
                </div>
                <div style="order: 2; flex: 2; color: rgba(0, 0, 0, .55)"><?php echo $row['sub'] ?></div>
                <div style="order: 4; flex: 2; color: rgba(0, 0, 0, .55)"><?php echo format_date(substr($row['last_modified_time'], 0, 10), SQL_DATE_STYLE, IT_DATE_STYLE, "/")." ".substr($row['last_modified_time'], 10, 6) ?></div>
                <div style="order: 5; flex: 1; color: rgba(0, 0, 0, .55)"><?php echo human_filesize($fs, 0) ?></div>
            </div>
            <?php
                $index++;
            }
        }
        ?>
	</div>
    </div>
    <button id="newdoc" class="mdc-fab material-icons app-fab--absolute" aria-label="Nuovo documento">
        <span class="mdc-fab__icon">
            cloud_upload
        </span>
    </button>
	<p class="spacer"></p>
</div>
<?php include_once "../share/footer.php" ?>
<script>
    var selected_doc = 0;
    var doc_type = 0;

    (function() {
        var heightMain = document.getElementById('main').clientHeight;
        var heightScreen = document.body.clientHeight;
        var usedHeight = heightMain > heightScreen ? heightScreen : heightMain;
        var btn = document.getElementById('newdoc');
        btn.style.top = (usedHeight)+"px";
        //btn.style.top = '700px';

        var screenW = screen.width;
        var bodyW = document.body.clientWidth;
        var right_offset = (bodyW - document.getElementById('main').clientWidth) / 2;
        right_offset += document.getElementById('right_col').clientWidth;
        btn.style.right = (right_offset - 18)+"px";

        btn.addEventListener('click', function () {
            window.location = 'doc.php?did=0&back=documents.php';
        });

        document.getElementById('choose_order').addEventListener('click', function (event) {
            clear_context_menu(event, 'doc_context_menu');
            clear_context_menu(event, 'cat_menu');
            show_context_menu(event, null, 300, 'field_order');
        });

        document.getElementById('left_col').addEventListener('contextmenu', function (ev) {
            ev.preventDefault();
            clear_context_menu(ev, 'doc_context_menu');
            clear_context_menu(ev, 'cat_menu');
            clear_context_menu(ev, 'field_order');
            if (selected_doc !== 0) {
                document.getElementById('item'+selected_doc).classList.remove('selected_doc');
            }
            return false;
        });
        document.getElementById('container').addEventListener('click', function (ev) {
            ev.preventDefault();
            clear_context_menu(ev, 'doc_context_menu');
            clear_context_menu(ev, 'cat_menu');
            clear_context_menu(ev, 'field_order');
            if (selected_doc !== 0) {
                document.getElementById('item'+selected_doc).classList.remove('selected_doc');
            }
            return false;
        });

        document.getElementById('open_doc').addEventListener('click', function (ev) {
            open_in_browser();
        });
        document.getElementById('show_doc').addEventListener('click', function (ev) {
            clear_context_menu(ev, 'doc_context_menu');
            getFileName(selected_doc, 'open_in_browser', '../');
        });
        document.getElementById('det_doc').addEventListener('click', function (ev) {
            clear_context_menu(ev, 'doc_context_menu');
            document.location.href = 'doc_info.php?did='+selected_doc+'&back=documents.php';
        });
        document.getElementById('stat_doc').addEventListener('click', function (ev) {
            clear_context_menu(ev, 'doc_context_menu');
            document.location.href = 'doc_stats.php?did='+selected_doc+'&back=documents.php';
        });
        document.getElementById('down_doc').addEventListener('click', download_item);
        document.getElementById('remove_doc').addEventListener('click', function (ev) {
            j_alert("confirm", "Eliminare il documento?");
            document.getElementById('okbutton').addEventListener('click', function (event) {
                event.preventDefault();
                remove_item(ev);
            });
            document.getElementById('nobutton').addEventListener('click', function (event) {
                event.preventDefault();
                fade('overlay', 'out', .1, 0);
                fade('confirm', 'out', .3, 0);
                return false;
            })

        });

        var ends = document.querySelectorAll('.file-card');
        for (i = 0; i < ends.length; i++) {
            ends[i].addEventListener('click', function (event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                clear_context_menu(ev, 'field_order');
                if (selected_doc !== 0) {
                    document.getElementById('item'+selected_doc).classList.remove('selected_doc');
                }
                event.currentTarget.classList.add('selected_doc');
                selected_doc = event.currentTarget.getAttribute("data-id");
                doc_type = event.currentTarget.getAttribute("data-type");
            });
            ends[i].addEventListener('contextmenu', function (event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                if (selected_doc !== 0) {
                    document.getElementById('item'+selected_doc).classList.remove('selected_doc');
                }
                event.currentTarget.classList.add('selected_doc');
                current_target_id = event.currentTarget.getAttribute("data-id");
                selected_doc = event.currentTarget.getAttribute("data-id");
                doc_type = event.currentTarget.getAttribute("data-type");
                if (doc_type === '2') {
                    document.getElementById('down_doc').classList.add('disabled_menu_item');
                    document.getElementById('down_doc').removeEventListener('click', download_item);
                    document.getElementById('down_doc').addEventListener('click', do_nothing);
                }
                else {
                    document.getElementById('down_doc').classList.remove('disabled_menu_item');
                    document.getElementById('down_doc').removeEventListener('click', do_nothing);
                    document.getElementById('down_doc').addEventListener('click', download_item);
                }
                show_context_menu(event, null, 200, 'doc_context_menu');
                clear_context_menu(event, 'field_order');
            });
            ends[i].addEventListener('dblclick', function (event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                selected_doc = event.currentTarget.getAttribute("data-id");
                doc_type = event.currentTarget.getAttribute("data-type");
                open_in_browser();
            });
        }

        var open_in_browser = function () {
            if (doc_type === '1') {
                document.location.href = 'doc.php?did='+selected_doc+'&back=documents.php';
            }
            else {
                document.location.href = 'doc.php?did='+selected_doc+'&back=documents.php';
            }
        };

    })();

    var download_item = function (ev) {
        clear_context_menu(ev, 'doc_context_menu');
        document.location.href = '../share/download_manager.php?did='+selected_doc;
    };

    var remove_item = function (ev) {
        fade('confirm', 'out', .1, 0);
        var xhr = new XMLHttpRequest();
        var formData = new FormData();

        xhr.open('post', 'document_manager.php');
        var action = <?php echo \edocs\Document::$DELETE_DOCUMENT ?>;

        formData.append('did', selected_doc);
        formData.append('action', action);
        xhr.responseType = 'json';
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            var DONE = 4; // readyState 4 means the request is done.
            var OK = 200; // status 200 is a successful return.
            if (xhr.readyState === DONE) {
                if (xhr.status === OK) {
                    j_alert("alert", xhr.response.message);
                    var item_to_del = document.getElementById('item'+selected_doc);
                    item_to_del.style.display = 'none';
                    clear_context_menu(ev, 'doc_context_menu');
                }
            } else {
                console.log('Error: ' + xhr.status);
            }
        }
    };
</script>
<div id="cat_menu" style="display: none" class="mdc-elevation--z4">
<?php
while($cat = $res_categorie->fetch_assoc()) {
    ?>
    <div class="item" style="border-bottom: 1px solid rgba(0, 0, 0, .10)">
        <a href="#">
            <i class="material-icons" style="color: <?php echo $cat['color'] ?>"><?php echo $cat['icon'] ?></i>
            <span><?php echo $cat['name'] ?></span>
        </a>
    </div>
    <?php
}
?>
</div>
<div id="field_order" style="display: none" class="mdc-elevation--z4">
    <div class="item">
        <a href="documents.php?o=title&d=<?php echo $d ?>">
            <i class="material-icons">sort</i>
            <span>Nome</span>
        </a>
    </div>
    <div class="item">
        <a href="documents.php?o=category&d=<?php echo $d ?>">
            <i class="material-icons">label</i>
            <span>Categoria</span>
        </a>
    </div>
    <div class="item">
        <a href="documents.php?o=subject&d=<?php echo $d ?>">
            <i class="material-icons">pie_chart</i>
            <span>Disciplina</span>
        </a>
    </div>
    <div class="item" style="border-top: 1px solid rgba(0, 0, 0, .10)">
        <a href="documents.php?o=title&d=<?php echo $d ?>">
            <i class="material-icons">exposure</i>
            <span>Dimensioni</span>
        </a>
    </div>
    <div class="item" style="border-top: 1px solid rgba(0, 0, 0, .10)">
        <a href="documents.php?o=upload_date&d=<?php echo $d ?>">
            <i class="material-icons">add_box</i>
            <span>Data caricamento</span>
        </a>
    </div>
    <div class="item">
        <a href="documents.php?o=last_modified_time&d=<?php echo $d ?>">
            <i class="material-icons">recent_actors</i>
            <span>Data di modifica</span>
        </a>
    </div>
</div>
<div id="stats" style="display: none" class="mdc-elevation--z4">
    <div class="item">

    </div>
    <div class="item">

    </div>
</div>
</body>
</html>