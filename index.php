<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Pokédex Studi</title>
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
                        <a class="nav-link" href="./index.php">Accueil <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Types</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control mr-sm-2" type="search" placeholder="Chercher" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
        require("./PokemonsManager.php");
        require("./TypesManager.php");
        require("./ImagesManager.php");    
        $pokemonManager = new PokemonsManager();
        $pokemons = $pokemonManager->getAll();
    
        /*$typeManager = new TypesManager();
        $types = $typeManager->getAll();*/

        
    ?>
    <main class="container">
        <section class="d-flex flex-wrap justify-content-center">
            <?php foreach ($pokemons as $pokemon) : ?>
                <div class="card m-5" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $pokemon->getNumber() ?> # <?php echo $pokemon->getName() ?></h5>
                        <p class="card-text"><?= $pokemon->getDescription() ?></p>
                        <a href="#" class="btn btn-warning">Modifier</a>
                    </div>
                </div>
            <?php endforeach ?>
        </section>
        <a href="./create.php" class="btn btn-success">Créer un Pokémon</a>
    </main>
</body>

</html>