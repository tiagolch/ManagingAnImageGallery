<?php

require_once 'db.php';
require_once 'api.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])){
    $tags = $_GET['search'];
} else {
    $tags = 'kitten';
}

$apiKey = 'f9cc014fa76b098f9e82f1c288379ea1'; // TODO: change key to file .env
$perPage = 10;
$page = 1;
$flickrAPI = new FlickrAPI($apiKey, $tags, $perPage, $page);
$photos = $flickrAPI->getPhotos();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Galeria de Imagens</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/index.php">Galeria de Imagens</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form class="form-inline ml-2 my-lg-0" action="index.php" method="GET"> 
                        <input class="form-control mr-sm-2" type="search" placeholder="Buscar imagens" aria-label="Buscar imagens" name="search" required> 
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($photos as $photo) { ?>
                <div class="col-md-4">
                    <img 
                        class="img-fluid" 
                        src="https://farm<?php echo $photo['farm']; ?>.staticflickr.com/<?php echo $photo['server']; ?>/<?php echo $photo['id']; ?>_<?php echo $photo['secret']; ?>.jpg" 
                        alt="<?php echo $photo['title']; ?>">
                </div>
            <?php } ?>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php

$dbFile = 'images.db';
$db = SingletonDBConnection::getInstance($dbFile);

$db->insertImages($photos);

$db->close();

?>