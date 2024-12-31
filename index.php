<?php
$jsn = file_get_contents("input.json");
$dec = json_decode($jsn, true);

$search = isset($_POST['search']) ? $_POST['search'] : '';
$filteredResults = [];

if ($search) {
    foreach ($dec as $result) {
        if (strpos(strtolower($result['name']), strtolower($search)) !== false) {
            $filteredResults[] = $result;
        }
    }
} else {
    $filteredResults = $dec;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <title>script</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit-icons.min.js"></script>
</head>
<body  class="uk-background-secondary uk-light uk-padding uk-panel">
	
	<div id="offcanvas-overlay" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">

        <button class="uk-offcanvas-close" type="button" uk-close></button>


        <h3>Scripts Shop</h3>
        <hr class="uk-divider-icon">
        	<span>Our pages</span><br><br>
        <a href="https://github.com/Mr-Banana-2045"><span uk-icon="icon: github" style="margin-right:10px;"></span>My Github</a><br><br>
        <a href="#"><span uk-icon="icon: telegram" style="margin-right:10px;"></span>My Telegram</a>
        
    </div>
    
</div>

<nav class="uk-navbar-secondery uk-light" style="margin-top:-30px;">
    <div class="uk-container">
        <div uk-navbar>

            <div class="uk-navbar-left">
        <a class="uk-navbar-toggle" uk-toggle href="#offcanvas-overlay">
                    <span uk-navbar-toggle-icon style="margin-top:16px;"></span>
                </a>
                <h1 class="uk-heading-bullet">scripts shop</h1>
                </div>
        </div>
    </div>
</nav>
    <form action="" method="post" style="margin-top:15px;">
    <div class="uk-margin" uk-margin>
        <div uk-form-custom="target: true">
            <span class="uk-form-icon" uk-icon="icon: search"></span>
            <input class="uk-input" type="text" name="search" aria-label="Not clickable icon" placeholder="search" value="<?php echo htmlspecialchars($search); ?>">
        </div>
    </div>
    </form>
    <h2>Sources <span class="uk-badge"><?php echo count($dec); ?></span></h2>
    <?php foreach ($filteredResults as $result): ?>
        <div class="uk-child-width-1-3@m" uk-grid uk-scrollspy="cls: uk-animation-fade; target: .uk-card; delay: 500; repeat: true">
    <div>
        <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
        
    <div class="uk-card-media-left uk-cover-container">
        <img src="<?php echo htmlspecialchars($result['pick']); ?>" uk-cover>
        <canvas width="600" height="400"></canvas>        
    </div>
    <div>
        <div class="uk-card-body">
            <h3 class="uk-card-title"><?php echo htmlspecialchars($result['name']); ?></h3>
            <p><?php echo htmlspecialchars($result['caption']); ?></p>
        </div>
        <div class="uk-card-footer">
        <a href="cart.php?id=<?php echo htmlspecialchars($result['id']); ?>" class="uk-button uk-button-text">Read more</a>
    </div>
    </div>
</div>
    </div>
    </div>
<br>
    <?php endforeach; ?>
    	<hr class="uk-divider-icon">
    <h2>Comments <span class="uk-badge">1</span></h2>
    <article class="uk-comment uk-comment-secondery" role="comment">
    <header class="uk-comment-header">
        <div class="uk-grid-medium uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
            	<img src="comm.jpg" style="float:left;" width="60" height="60">
                <h4 class="uk-comment-title uk-subnav uk-subnav-divider uk-margin-remove"><a class="uk-link-reset">Mr-Banana</a></h4>
                <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                    <li><a>1403/10/10</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div class="uk-comment-body">
        <p>Download our projects from this page, you will be notified every time a new project is added, thank you for being with us until now, the Saad development team.</p>
    </div>
</article>
</body>
</html>

