<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Crer un pokemon</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">
                <img src="./images/logo.png" alt="logo pokedex" width="60" height="60" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Accueil <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Types</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>

    <?php

    require("./PokemonsManager.php");
    require("./TypesManager.php");
    require("./ImagesManager.php");


    $pokemonManager = new PokemonsManager();

    $typeManager = new TypesManager();
    $types = $typeManager->getAll();
    $error = null;

    if ($_POST) {
        $number = $_POST["number"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $idType1 = $_POST["type1"];
        $idType2 = $_POST["type2"];


        try {
            if ($_FILES["image"]["size"] < 2000000) {
                /*$imagesManager = new ImagesManager();*/
                $fileName = $_FILES["image"]["name"];
                if (!is_dir("upload/")) {
                    mkdir("upload/");
                }
                $targetFile = "upload/{$fileName}";
                $fileExtension = pathinfo($targetFile, PATHINFO_EXTENSION);                
                define("EXTENSIONS", ["png", "jpeg", "jpg", "webp"]);
    
                if (in_array(strtolower($fileExtension), EXTENSIONS)) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                        $imagesManager = new ImagesManager();
                        $image = new Image(["name" => $fileName, "path" => $targetFile]);
                        $imagesManager->create($image);
                        //var_dump($imagesManager);
                    } else {
                        throw new Exception("Une erreur est survenue...");
                }
            } else {
                throw new Exception("L'extension du fichier n'est pas correcte.");
            }     
        } else {
            throw new Exception("Le fichier est trop important.");
        }
    } catch(Exception $e) {
         $error = $e->getMessage();
    }
    
    $idImage = $imagesManager->getLastImageId();
    //var_dump($idImage);
    $newPokemon = new Pokemon([
        "number" => $number,
        "name" => $name,
        "description" => $description,
        "type1" => $idType1,
        "type2" => $idType2,
        "image" => $idImage,
    ]);

    $pokemonManager->update($newPokemon);


}
    ?>


    <main class="container">
        <?php 
        if ($error) {
            echo "<p class='alert alert-danger'>$error</p>";
        } ?>
        <form method="post" enctype="multipart/form-data">
            <label for="number" class="form-label">Numéro</label>
            <input type="number" name="number" placeholder="Le numéro du Pokemon" id="number" class="form-control" min=1 max=950>
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" placeholder="Le nom du Pokemon" id="name" class="form-control" minlength="3" maxlength="40">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" placeholder="La Description du Pokemon" id="description" class="form-control" rows="6" minlength="10" maxlength="200"></textarea>
            <label for="type1" class="form-label">Type 1</label>

            <select name="type1" id="type1" class="form-select">
                <option value="">--</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?= $type->getId() ?>"><?= $type->getName() ?></option>
                <?php endforeach ?>
            </select>

            <label for="type2" class="form-label">Type 2</label>

            <select name="type2" id="type2" class="form-select">
            <option value="null">--</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?= $type->getId() ?>"><?= $type->getName() ?></option>
                <?php endforeach ?>
            </select>

            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <input type="submit" class="btn btn-success mt-3" value="Créer">
        </form>
    </main>
</body>

</html>