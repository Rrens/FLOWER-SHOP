<?php 
    include "config.php";
    session_start();

if(!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

$login = $_SESSION['login'];

$query_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM db_user WHERE EMAIL = '$login'"));

    $id = $_GET['id'];
    $query = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM product WHERE ID_PRODUCT = '$id'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/text.css">

    <title>Detail Produk</title>
</head>

<body style="overflow-x: hidden;">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid bg1">
            <img src="logo.png" alt="" class="align-self-center rounded-circle" width="100px"
                height="100px" style="margin: 0,1% 0; position:relative; left:200px;">
            <form class="d-flex" style="position:relative; right:80px">
                <input class="form-control me-2" type="Cari Disini" placeholder="Cari Disini" aria-label="Cari">
                <button class="btn btn-outline-success" type="submit" style="width: 200px;">Cari</button>
                <img src="./asset/icon/keranjang.jpeg" alt="" class="image"
                    style="margin-left: 20px; width:25px; height:25px;">
                <i class="bx bx-chevron-right"></i> <a href="keranjang.php" style="margin-left: 10px;"> Keranjang</a>
                <p style="margin-left: 30px;"> |</p>
                <img src="<?= "foto/profil/" .$query_user['PHOTO'] ?>" alt="" class="image"
                    style="margin-left: 20px; width:25px; height:25px;">
                <i class="bx bx-chevron-right"></i> <a href="#" style="margin-left: 10px;"><?= $query_user['FIRST_NAME'] ?></a>
                <p style="margin-left: 30px;"> |</p>
                <i class="bx bx-chevron-right"></i> <a class="fw-bold" href="#" style="margin-left: 20px;"> Bahasa</a>
            </form>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto custom2">
                    <a class="nav-link active" aria-current="page" href="homepage.php">HOME</a>
                    <a class="nav-link active" aria-current="page" href="product.php?id=3001">BUNGA POT BESAR</a>
                    <a class="nav-link active" aria-current="page" href="product.php?id=3002">BUNGA POT KECIL</a>
                    <a class="nav-link active" aria-current="page" href="product.php?id=3003">POHON HIAS</a>
                </div>
            </div>
        </div>
    </nav>


    <div class="container-fluid" style="position:relative; right: 0px; background-color: #F0F0F0;">
        <br>
        <div style="position:relative; left:300px; top:2px;">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php 
                        $query_balik = mysqli_query($db, "SELECT * FROM category_product a JOIN product b ON a.ID_PRODUCT = b.ID_PRODUCT JOIN category c ON a.ID_CATEGORY = c.ID_CATEGORY WHERE b.ID_PRODUCT = $id;");
                        while ($row = mysqli_fetch_assoc($query_balik)) :
                    ?>
                    <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product.php?id=<?= $row['ID_CATEGORY'] ?>"><?= $row['NAME'] ?></a></li>
                    <?php endwhile; ?>
                </ol>
            </nav>
        </div>

        <div class="container" style="padding-bottom: 190px; max-width: 1250px; max-height: 1250px; background-color: white;">
            <?php  

                $id_product = $query['ID_PRODUCT'];        
                $diskon = $query['PRICE'] - $query['DISCOUNT'];
                // $persen = $row_query_top_Seller['DISCOUNT'] / $row_query_top_Seller['PRICE'] * 100;
                $query_diskon =  mysqli_query($db, "SELECT * FROM product WHERE ID_PRODUCT = '$id_product'");
                while($row_diskon = mysqli_fetch_assoc($query_diskon)) :
                $persen_total = $row_diskon['tmp_discount'];
            ?>
          
            <div class="contariner" style="width: 10px; margin-top: 50px; margin-bottom: 150px;">
                <img src="<?= "foto/" . $query['gambar'] ?>" alt="#" style="width: 400px; margin-left: 60px; margin-top: 40px; margin-bottom: 70px;">

            </div>
            <p style="margin-left: 520px; margin-top: -550px;"><?= $query['BRAND'] ?></p>
            <h5 style="margin-left: 520px; margin-top: -10px;"><?= $query['NAME'] ?></h5>
            <p style="margin-left: 520px; margin-top: -5px; width: 650px;"><?= $query['product_detail'] ?></p>
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        <h6 style="font-size: 15px; text-decoration:line-through; margin-left: 520px;">Rp. <?= $query['PRICE'] ?></h6>
                    </div>
                    <div class="p-2 bd-highlight" style="margin-top: -4px; margin-left: 5px;"><span
                            style="font-size: 15px; text-decoration: none !important;"> Rp. <?= $diskon ?></span>
                    </div>


                    <div class="badge bg-primary text-wrap ml-auto" style="height: 30px; color: white;">
                        <p style="margin-top: 5px;"><?= $persen_total ?>% Off</p>
                    </div>
                </div>
                <form action="../tambah-cart.php?id=<?= $query['ID_PRODUCT'] ?>" method="post">
                    <a href="../tambah-cart.php?id=<?= $query['ID_PRODUCT'] ?>">
                        <button class="bg-dark" style="height: 40px; width: 150px; margin-left: 520px; color: white;" name="tmbh_keranjang">ADD TO
                            CART</button>
                    </a>
                </form>
            <br><br>
            <?php endwhile; ?>
        </div>

        <br>

        <div class="container"
            style="max-width:780px; max-height: 1250px; margin-left: 315px; background-color: white;">
            <br>
            <h4 style="margin-left: 20px;">Reviews <a style="font-size: 20px;">( 1480 )</a></h4>
            <button
                style="width: 150px; height: 50px; margin-left: 580px; margin-top: -10px; background-color: black; color: white;">WRITE
                REVIEW</button>
            <img src="./asset/icon/bintang.jpeg" style="margin-left: -715px;">
            <h3 style="margin-left: 50px; margin-top: -40px;">4</h3>
            <p style="margin-left: 78px; margin-top: -30px;">/ 5</p>
            <p style="margin-left: 110px; margin-top: -40px;">Average Rating</p>

            <div>
                <img src="./asset/icon/user.jpeg" style="width: 40px; margin-left: 20px;">
                <p style="margin-left: 70px; margin-top: -40px;">Name Surname</p>
                <img src="./asset/icon/bbintang.jpeg" style="width: 110px; margin-left: 70px; margin-top: -35px;">
                <p style="margin-left: 70px; margin-top: -15px; font-size: 13px;">5 September 2018</p>
                <p style="width: 700px; margin-left: 70px; margin-top: -5px; font-size: 15px;">Porta corporis nibh.
                    Adipisci maiores
                    dui torquent porttitor wisi necessitatibus lorem perspiciatis repudiandae ad nesciunt deleniti
                    facilisi, est orci libero, aspernatur asperiores ornare aliquip vehicula? Proident? Nobis? Deserunt,
                    conubia facilis, amet torquent, voluptate dictum, sapien, lorem? Veniam! Vestibulum tenetur atque
                    ultricies justo pariatur dis eget condimentum libero, occaecat! Vulputate molestias quaerat,
                    maxime!.</p>
            </div>

            <br><br>

            <div>
                <img src="./asset/icon/user.jpeg" style="width: 40px; margin-left: 20px;">
                <p style="margin-left: 70px; margin-top: -40px;">Name Surname</p>
                <img src="./asset/icon/bbintang.jpeg" style="width: 110px; margin-left: 70px; margin-top: -35px;">
                <p style="margin-left: 70px; margin-top: -15px; font-size: 13px;">5 September 2018</p>
                <p style="width: 700px; margin-left: 70px; margin-top: -5px; font-size: 15px;">Porta corporis nibh.
                    Adipisci maiores
                    dui torquent porttitor wisi necessitatibus lorem perspiciatis repudiandae ad nesciunt deleniti
                    facilisi, est orci libero, aspernatur asperiores ornare aliquip vehicula? Proident? Nobis? Deserunt,
                    conubia facilis, amet torquent, voluptate dictum, sapien, lorem? Veniam! Vestibulum tenetur atque
                    ultricies justo pariatur dis eget condimentum libero, occaecat! Vulputate molestias quaerat,
                    maxime!.</p>
            </div>

            <br><br>

            <div>
                <img src="./asset/icon/user.jpeg" style="width: 40px; margin-left: 20px;">
                <p style="margin-left: 70px; margin-top: -40px;">Name Surname</p>
                <img src="./asset/icon/bbintang.jpeg" style="width: 110px; margin-left: 70px; margin-top: -35px;">
                <p style="margin-left: 70px; margin-top: -15px; font-size: 13px;">5 September 2018</p>
                <p style="width: 700px; margin-left: 70px; margin-top: -5px; font-size: 15px;">Porta corporis nibh.
                    Adipisci maiores
                    dui torquent porttitor wisi necessitatibus lorem perspiciatis repudiandae ad nesciunt deleniti
                    facilisi, est orci libero, aspernatur asperiores ornare aliquip vehicula? Proident? Nobis? Deserunt,
                    conubia facilis, amet torquent, voluptate dictum, sapien, lorem? Veniam! Vestibulum tenetur atque
                    ultricies justo pariatur dis eget condimentum libero, occaecat! Vulputate molestias quaerat,
                    maxime!.</p>
            </div>

            <br>

            <a class="nav-link active" href="#"
                style="margin-left: 330px; color: black; text-decoration: underline;">View All</a>

            <br>
        </div>

        <br>

        <div class="container"
            style="max-width:430px; max-height: 1250px; margin-left: 1130px; margin-top: -935px; background-color: white;">
            <br>
            <div>
                <img src="./asset/icon/user.jpeg" style="width: 30px; margin-left: 10px;">
                <p style="margin-left: 50px; margin-top: -25px; font-size: 14px;">Name Surname</p>
                <img src="./asset/icon/bbintangf.jpeg" style="width: 85px; margin-left: 20px; margin-top: -15px;">
                <p style="margin-left: 20px; margin-top: -5px; font-size: 12px;">5 September 2018</p>
                <p style="width: 380px; margin-left: 20px; margin-top: -5px; font-size: 12px;">Porta corporis nibh.
                    Adipisci maiores
                    dui torquent porttitor wisi necessitatibus lorem perspiciatis repudiandae ad nesciunt deleniti
                    facilisi, est orci libero, aspernatur asperiores ornare aliquip vehicula? Proident? Nobis? Deserunt,
                    conubia facilis, amet torquent, voluptate dictum, sapien, lorem? Veniam! Vestibulum tenetur atque
                    ultricies justo pariatur dis eget condimentum libero, occaecat! Vulputate molestias quaerat,
                    maxime!.</p>
            </div>
            <br>
            <div>
                <img src="./asset/icon/user.jpeg" style="width: 30px; margin-left: 10px;">
                <p style="margin-left: 50px; margin-top: -25px; font-size: 14px;">Name Surname</p>
                <img src="./asset/icon/bbintangf.jpeg" style="width: 85px; margin-left: 20px; margin-top: -15px;">
                <p style="margin-left: 20px; margin-top: -5px; font-size: 12px;">5 September 2018</p>
                <p style="width: 380px; margin-left: 20px; margin-top: -5px; font-size: 12px;">Porta corporis nibh.
                    Adipisci maiores
                    dui torquent porttitor wisi necessitatibus lorem perspiciatis repudiandae ad nesciunt deleniti
                    facilisi, est orci libero, aspernatur asperiores ornare aliquip vehicula? Proident? Nobis? Deserunt,
                    conubia facilis, amet torquent, voluptate dictum, sapien, lorem? Veniam! Vestibulum tenetur atque
                    ultricies justo pariatur dis eget condimentum libero, occaecat! Vulputate molestias quaerat,
                    maxime!.</p>
            </div>
            <br>
            <div>
                <img src="./asset/icon/user.jpeg" style="width: 30px; margin-left: 10px;">
                <p style="margin-left: 50px; margin-top: -25px; font-size: 14px;">Name Surname</p>
                <img src="./asset/icon/bbintangf.jpeg" style="width: 85px; margin-left: 20px; margin-top: -15px;">
                <p style="margin-left: 20px; margin-top: -5px; font-size: 12px;">5 September 2018</p>
                <p style="width: 380px; margin-left: 20px; margin-top: -5px; font-size: 12px;">Porta corporis nibh.
                    Adipisci maiores
                    dui torquent porttitor wisi necessitatibus lorem perspiciatis repudiandae ad nesciunt deleniti
                    facilisi, est orci libero, aspernatur asperiores ornare aliquip vehicula? Proident? Nobis? Deserunt,
                    conubia facilis, amet torquent, voluptate dictum, sapien, lorem? Veniam! Vestibulum tenetur atque
                    ultricies justo pariatur dis eget condimentum libero, occaecat! Vulputate molestias quaerat,
                    maxime!.</p>
            </div>
            <br>
        </div>

        <br><br><br><br><br><br>

    </div>

    <br>

    <h4 style="margin-left: 300px;">Rekomendasi</h4>

    <br>

    <div>
        <div class="container mt-3">
            <div class="row">
            <?php 
                $query = mysqli_query($db, "SELECT * FROM category_product b JOIN category a ON a.ID_CATEGORY = b.ID_CATEGORY JOIN product c ON b.ID_PRODUCT = c.ID_PRODUCT WHERE a.ID_CATEGORY = 3001 OR a.ID_CATEGORY = 3002 LIMIT 4");
                while($row = mysqli_fetch_assoc($query)) :
                    $id_product = $row['ID_PRODUCT'];        
                    $diskon = $row['PRICE'] - $row['DISCOUNT'];
                    $persen = $row['DISCOUNT'] / $row['PRICE'] * 100;
                    mysqli_query($db, "UPDATE product SET tmp_discount = '$persen' WHERE ID_PRODUCT = '$id_product'");
                    $query_diskon =  mysqli_query($db, "SELECT * FROM product WHERE ID_PRODUCT = '$id_product'");
                    $row_diskon = mysqli_fetch_assoc($query_diskon);
                    $persen_total = $row_diskon['tmp_discount'];
            ?>
                <div class="col-md-3">
                    <a href="detail-page.php?id=<?= $row['ID_PRODUCT'] ?>">
                        <div class="card">
                            <img src=" <?= "foto/" . $row['gambar'] ?>" class="card-img-top" alt="" width="50" height="300">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['NAME'] ?></h5>
                                <div class="d-flex flex-row bd-highlight mb-3">
                                    <div class="p-2 bd-highlight">
                                        <h6 style="font-size: 14px; text-decoration:line-through">Rp.<?= $row['PRICE'] ?></h6>
                                    </div>
                                    <div class="p-2 bd-highlight" style="margin-top: -6px;"><span
                                            style="font-size: 14px; text-decoration: none !important;"> Rp. <?= $diskon ?></span>
                                    </div>
                                </div>
                                <div class="badge bg-primary text-wrap ml-auto">
                                    <?= $persen_total ?>% Off
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>    
        </div>
    </div>

    <div class="footer mt-5 pb-5 bg2">
        <div class="container-fluid">
            <div class="row ms-5 me-5">
                <div class="col-lg-2 col-md-6 footer-contact" style="margin-top: 50px; margin-left: 25px;">
                    <img src="logo.png" class="align-self-center rounded-circle" alt="..."
                        style="height: 100px; width: 100px; margin-left: 85px;">
                    <div class="icon-sosmed d-flex flex-row justify-content-center">
                        <a href="#" style="margin: 0 1%">
                            <img src="./asset/icon/facebook.png" alt="" width="40px" height="40px"
                                style="margin-top: 10px;">
                        </a>
                        <a href="#" style="margin: 0 1%">
                            <img src="./asset/icon/twitter.png" alt="" width="35px" height="35px"
                                style="margin-top: 13px;">
                        </a>
                        <a href="#" style="margin: 0 1%">
                            <img src="./asset/icon/google+.jpeg" alt="" width="40px" height="40px"
                                style="margin-top: 10px;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 footer-links" style="margin-top: 50px; margin-left: 25px;">
                    <h4>MAIN PAGE</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Sell with Us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About Us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Contact Us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Promos</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Become an Ambassador</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 footer-links" style="margin-top: 50px; margin-left: 25px;">
                    <h4>POLICY</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of Usage</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy Policy</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Return Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 footer-contact" style="margin-top: 50px; margin-left: 25px;">
                    <h4>CATEGORIES</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="product.php?id=3001">Bunga Pot Besar</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="product.php?id=3002">Bunga Pot Kecil</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="product.php?id=3003">Pohon Hias</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 footer-contact" style="margin-top: 50px; margin-left: 25px;">
                    <h4>SUBSCRIBE</h4>
                    <p>Subscribe to our newsletter, so that you can be the first to know about new offers and
                        promotions.</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input style="background-color: black; color: white;"
                            type="submit" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="bank" style="position: relative; left: 1550px;">
        <h6 style="position: relative; right: 1430px; top: 35px;">
            &copy; 2021 Rens Corporation
        </h6>
        <img src="./asset/icon/ceklis.jpeg" class="img-fluid col-lg-2 col-md-3" alt="..."
            style="height: 28px; width: 22px; margin-left: 20px;">
        <img src="./asset/icon/card.png" class="img-fluid col-lg-2 col-md-3" alt="..."
            style="height: 35px; width: 55px; margin-left: 15px;">
        <img src="./asset/icon/visa.jpeg" class="img-fluid col-lg-2 col-md-3" alt="..."
            style="height: 25px; width: 75px; margin-left: 15px;">
    </div>

    <br>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
</body>

</html>