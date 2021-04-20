<!DOCTYPE html>
<html>

<head>
    <title>Home - Ristoranti Gluten Free</title>
    <link rel="stylesheet" href="css/search-page.css">
    <link rel="stylesheet" href="css/searchbars.css">
    <link rel="stylesheet" href="css/sidebar.css">

    <!--Responsiveness-->
    <meta name="viewport" content="width=device-width initial-scale=1.0" />
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cardo:400,700|Oswald" rel="stylesheet">
</head>

<body class="background">

    <?php include "assets/search-page/header.html"; ?>

    <div class="body-container">

        <?php include "assets/search-page/sidebar.html"; ?>

        <div class="cards-container">
            <div class="card mb-3" style="max-width: 50rem;">
                <div class="row g-0">
                    <div class="col-md-4 card-img-container">
                        <img class="card-img" src="img/home-restaurants/lievito-72-home.jpg">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis rem
                                quos
                                cumque soluta modi rerum nobis minus asperiores quia fuga consequuntur nam quas dolor
                                dolore
                                quo qui saepe ullam, unde amet ipsa est ut quae. Laborum molestiae quia dolor nihil
                                ratione
                                consequatur optio aliquid dicta odio obcaecati, asperiores nemo eligendi maxime non
                                atque
                                quidem.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3" style="max-width: 50rem;">
                <div class="row g-0">
                    <div class="col-md-4 card-img-container">
                        <img class="card-img" src="img/home-restaurants/mama-eat-roma-home.jpg">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis rem
                                quos
                                cumque soluta modi rerum nobis minus asperiores quia fuga consequuntur nam quas dolor
                                dolore
                                quo qui saepe ullam, unde amet ipsa est ut quae. Laborum molestiae quia dolor nihil
                                ratione
                                consequatur optio aliquid dicta odio obcaecati, asperiores nemo eligendi maxime non
                                atque
                                quidem.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>