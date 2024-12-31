<?php

$jsn = file_get_contents("input.json");
$dec = json_decode($jsn, true);

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
   
    $product = null;
    foreach ($dec as $item) {
        if ($item['id'] == $product_id) {
            $product = $item;
            break;
        }
    }
} else {
    header("Location: /index.php");
    exit();
}

function countFilesAndFoldersInZip($zipFilePath) {
    if (!file_exists($zipFilePath)) {
        return "not found.";
    }

    $zip = new ZipArchive;
    
    if ($zip->open($zipFilePath) === TRUE) {
        $fileCount = 0;
        $folderCount = 0;
        
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i);
            if (substr($filename, -1) === '/') {
                $folderCount++;
            } else {
                $fileCount++;
            }
        }

        $zip->close();

        return "<p>File : $fileCount</p><p>Folders : $folderCount</p>";
    } else {
        return "error";
    }
}

function sizefile($filesi){
$zipFilePath = $filesi;
if (file_exists($zipFilePath)) {
    $fileSize = filesize($zipFilePath);
    
    echo ($fileSize / 1024);
} else {
    echo "not found.";
}
}

?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width" />
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css" />
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
    <title><?php echo htmlspecialchars($product['name'] ?? 'Product Not Found', ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body  class="uk-background-secondary uk-light uk-padding uk-panel">
	<div id="modal-example" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-light">
        <h2 class="uk-modal-title" style="color:black;">Downlaod</h2>
        <p style="color:gray;">Download file <?php echo htmlspecialchars($product['name']); ?></p>
        <p class="uk-text-right">
            <button class="uk-button uk-button-primary uk-modal-close" type="button">Cancel</button>
            <a href="<?php echo $product['file']; ?>"><button class="uk-button uk-button-primary" type="button">Yes</button></a>
        </p>
    </div>
</div>
	<nav aria-label="Breadcrumb">
    <ul class="uk-breadcrumb">
        <li><a href="/index.php">Home</a></li>
        <li><a><?php echo htmlspecialchars($product['name'] ?? 'Product Not Found', ENT_QUOTES, 'UTF-8'); ?></a></li>
    </ul>
</nav>
	<div class="uk-card uk-card-secondary uk-card-body uk-card-hover uk-light">
    <?php if ($product): ?>
        <img src="<?php echo $product['pick']; ?>"><br>
        	<p>Name : <?php echo htmlspecialchars($product['name'] ?? 'Product Not Found', ENT_QUOTES, 'UTF-8'); ?></p>
        	  <p>Caption : <?php echo htmlspecialchars($product['caption'] ?? 'Product Not Found', ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Developer : Mr-Banana-2045</p>
        <p>File : <?php $inp = $product['file']; echo str_replace("files/", "", $inp); ?></p>
        <?php print_r(countFilesAndFoldersInZip($product['file'])); ?>
        	<p>Date : <?php echo $product['date']; ?></p>
        <p>Time : <?php echo $product['time']; ?></p>
        <p>Size : <?php echo sizefile($product['file']); ?></p>
        <a href="<?php echo $product['link']; ?>"><button class="uk-button uk-button-primary uk-button-large">Demo</button></a>
        <button class="uk-button uk-button-default uk-button-large" uk-toggle="target: #modal-example">Download</button><br>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
    	</div>
    <a href="/index.php">Back</a>
</body>
</html>
