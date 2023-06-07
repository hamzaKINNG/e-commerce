<?php
   // Establish a connection to the database
   $conn = mysqli_connect("localhost", "root", "", "produitss");
   
   // Check if the connection was successful
   if (!$conn) { 
       die('Error: ' . mysqli_connect_error());
   }
   //
   //$query="SELECT * FROM produits"; 
   //$result=mysqli_query($conn,$query);
   ?>
<?php
   $results_per_page = 6; // Change 5 to the number of results you want to display per page
   $querys = "SELECT COUNT(*) as total FROM produits"; // Get the total number of results
   $resultss = mysqli_query($conn, $querys);
   $row = mysqli_fetch_assoc($resultss);
   $total_results = $row['total'];
   $total_pages = ceil($total_results / $results_per_page); // Calculate the total number of pages
   if (isset($_GET['page']) && is_numeric($_GET['page'])) {
       $current_page = $_GET['page'];
   } else {
       $current_page = 1; // Set the default page number to 1
   }
   
   if ($current_page > $total_pages) {
       $current_page = $total_pages; // Set the current page to the last page if it's greater than the total number of pages
   }
   
   if ($current_page < 1) {
       $current_page = 1; // Set the current page to the first page if it's less than 1
   }
   $offset = ($current_page - 1) * $results_per_page; // Calculate the offset for the SQL query
   $query = "SELECT * FROM produits LIMIT $offset, $results_per_page";
   $result = mysqli_query($conn, $query);
   // Display the results as before  
   if(isset($_POST["add_to_cart"]))
   {
      if(isset($_SESSION["shopping_cart"]))
      {
         $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
         if(!in_array($_GET["id"], $item_array_id))
         {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
               'item_id' => $_GET["id"],
               'item_name' => $_POST["hidden_name"],
               'item_prix' => $_POST["hidden_prix"],
               'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
         }
         else
         {
            echo '<script>alert("item Already Added");</script>';
            echo '<script>window.location="index.php";</script>';
         } 
      }
      else
      {
         $item_array = array(
            'item_id' => $_GET["id"],
            'item_prix' => $_POST["add_to_cart"],
            'item_quantity' => $_POST["quantity"],
         );
         $_SESSION["shopping_cart"][0] = $item_array;
      }
   }
?>   
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>MY PROJECT</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- header section start -->
      <div class="header_section">
         <div class="container">
            <div class="row">
               <div class="col-sm-3">
                  <div class="logo"><a href="#"><img src="images/logo.png"></a></div>
               </div>
               <div class="col-sm-9">
                  <nav class="navbar navbar-expand-lg navbar-light bg-light">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                           <a class="nav-item nav-link" href="index.php">Home</a>
                           <a class="nav-item nav-link" href="collection.html">Collection</a>
                           <a class="nav-item nav-link" href="shoes.html">Shoes</a>
                           <a class="nav-item nav-link" href="racing boots.html">Racing Boots</a>
                           <a class="nav-item nav-link" href="contact.php">Contact</a>
                           <a class="nav-item nav-link last" href="#"><img src="images/search_icon.png"></a>
                           <a class="nav-item nav-link last" href="login.php"><img src="images/shop_icon.png"></a>
                        </div>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
         <div class="banner_section">
            <div class="container-fluid">
               <section class="slide-wrapper">
                  <div class="container-fluid">
                     <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                           <li data-target="#myCarousel" data-slide-to="1"></li>
                           <li data-target="#myCarousel" data-slide-to="2"></li>
                           <li data-target="#myCarousel" data-slide-to="3"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                           <div class="carousel-item active">
                              <div class="row">
                                 <div class="col-sm-2 padding_0">
                                    <p class="mens_taital">Men Shoes</p>
                                    <div class="page_no">0/2</div>
                                    <p class="mens_taital_2">Men Shoes</p>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="banner_taital">
                                       <h1 class="banner_text">New Running Shoes </h1>
                                       <h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
                                       <p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                       <button class="buy_bt">Buy Now</button>
                                       <button class="more_bt">See More</button>
                                    </div>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="shoes_img"><img src="images/running-shoes.png"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="carousel-item">
                              <div class="row">
                                 <div class="col-sm-2 padding_0">
                                    <p class="mens_taital">Men Shoes</p>
                                    <div class="page_no">0/2</div>
                                    <p class="mens_taital_2">Men Shoes</p>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="banner_taital">
                                       <h1 class="banner_text">New Running Shoes </h1>
                                       <h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
                                       <p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                       <button class="buy_bt">Buy Now</button>
                                       <button class="more_bt">See More</button>
                                    </div>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="shoes_img"><img src="images/running-shoes.png"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="carousel-item">
                              <div class="row">
                                 <div class="col-sm-2 padding_0">
                                    <p class="mens_taital">Men Shoes</p>
                                    <div class="page_no">0/2</div>
                                    <p class="mens_taital_2">Men Shoes</p>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="banner_taital">
                                       <h1 class="banner_text">New Running Shoes </h1>
                                       <h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
                                       <p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                       <button class="buy_bt">Buy Now</button>
                                       <button class="more_bt">See More</button>
                                    </div>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="shoes_img"><img src="images/running-shoes.png"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="carousel-item">
                              <div class="row">
                                 <div class="col-sm-2 padding_0">
                                    <p class="mens_taital">Men Shoes</p>
                                    <div class="page_no">0/2</div>
                                    <p class="mens_taital_2">Men Shoes</p>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="banner_taital">
                                       <h1 class="banner_text">New Running Shoes </h1>
                                       <h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
                                       <p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                       <button class="buy_bt">Buy Now</button>
                                       <button class="more_bt">See More</button>
                                    </div>
                                 </div>
                                 <div class="col-sm-5">
                                    <div class="shoes_img"><img src="images/running-shoes.png"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
         </div>
      </div>
      <!-- header section end -->
      <!-- new collection section start -->
      <div class="layout_padding collection_section">
         <div class="container">
            <h1 class="new_text"><strong>New  Collection</strong></h1>
            <p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
            <div class="collection_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="about-img">
                        <button class="new_bt">New</button>
                        <div class="shoes-img"><img src="images/shoes-img1.png"></div>
                        <p class="sport_text">Men Sports</p>
                        <div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
                        <div class="star_icon">
                           <ul>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                           </ul>
                        </div>
                     </div>
                     <button class="seemore_bt">See More</button>
                  </div>
                  <div class="col-md-6">
                     <div class="about-img2">
                        <div class="shoes-img2"><img src="images/shoes-img2.png"></div>
                        <p class="sport_text">Men Sports</p>
                        <div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
                        <div class="star_icon">
                           <ul>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                              <li><a href="#"><img src="images/star-icon.png"></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="collection_section">
         <div class="container">
            <h1 class="new_text"><strong>Racing Boots</strong></h1>
            <p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
         </div>
      </div>
      <div class="collectipn_section_3 layuot_padding">
         <div class="container">
            <div class="racing_shoes">
               <div class="row">
                  <div class="col-md-8">
                     <div class="shoes-img3"><img src="images/shoes-img3.png"></div>
                  </div>
                  <div class="col-md-4">
                     <div class="sale_text"><strong>Sale <br><span style="color: #0a0506;">JOGING</span> <br>SHOES</strong></div>
                     <div class="number_text"><strong>$ <span style="color: #0a0506">100</span></strong></div>
                     <button class="seemore">See More</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="collection_section layout_padding">
         <div class="container">
            <h1 class="new_text"><strong>New Arrivals Products</strong></h1>
            <p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
         </div>
      </div>
      <!-- new collection section end -->
      <!-- New Arrivals section start -->
      <div class="layout_padding gallery_section">
   <div class="container">
      <div class="row">
         <?php  
            while ($row = mysqli_fetch_assoc($result)) {
         ?>
         <div class="col-sm-4" >
            <div class="best_shoes">
               <p class="best_text"><?php echo $row['nom']; ?> </p>
               <div class="shoes_icon"  ><img src="<?php echo $row['IMG'];  ?>"></div>
               <div class="star_text">
                  <div class="left_part">
                     <ul>
                        <li><a href="#"><img src="images/star-icon.png" ></a></li>
                        <li><a href="#"><img src="images/star-icon.png"></a></li>
                        <li><a href="#"><img src="images/star-icon.png"></a></li>
                        <li><a href="#"><img src="images/star-icon.png"></a></li>
                        <li><a href="#"><img src="images/star-icon.png"></a></li>
                     </ul>
                  </div>
                  <div class="right_part">
                  <h4 class="product-prix">$ <?php echo htmlspecialchars($row["prix"], ENT_QUOTES);?></h4>
                  <input type="submit" name="add_to_cart" class="btn btn-success" value="Add to Cart" href="../java/prodact.html">
               </div>
               </div>
            </div>
         </div>
         <?php } ?>   


         
         <div style="margin-left:500px;">
                  <?php
                     // Display the pagination links
                     echo '<ul class="pagination  " >';
                     for ($i = 1; $i <= $total_pages; $i++) {
                         if ($i == $current_page) {
                             echo '<li class="active"><a href="#">' . $i . '</a></li>'; // Highlight the current page
                         } else {
                             echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>'; // Link to the other pages
                         }
                     }
                     echo '</ul>';
                     ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
               
               </div>
            </div>
         </div>
         <div class="buy_now_bt">
            <button class="buy_text">Buy Now</button>
         </div>
      </div>
      </div>
      <!-- New Arrivals section end -->
      <!-- contact section start -->
      <div class="layout_padding contact_section">
         <div class="container">
            <h1 class="new_text"><strong>Contact Now</strong></h1>
         </div>
         <div class="container-fluid ram">
            <div class="row">
               <div class="col-md-6">
                  <div class="email_box">
                     <div class="input_main">
                        <div class="container">
                           <form action="/action_page.php">
                              <div class="form-group">
                                 <input type="text" class="email-bt" placeholder="Name" name="Name">
                              </div>
                              <div class="form-group">
                                 <input type="text" class="email-bt" placeholder="Phone Numbar" name="Phone Numbar">
                              </div>
                              <div class="form-group">
                                 <input type="text" class="email-bt" placeholder="Email" name="Email">
                              </div>
                              <div class="form-group">
                                 <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                              </div>
                        </div>
                        <div class="send_btn">
                        <button class="main_bt" type="submit">Send</button>
                        </div>                   
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
               <div class="shop_banner">
               <div class="our_shop">
               <button class="out_shop_bt">Our Shop</button>
               </div>
               </div>
               </div>
            </div>
         </div>
      </div>
      </form>
      <!-- contact section end -->
      <!-- section footer start -->
      <div class="section_footer">
         <div class="container">
            <div class="mail_section">
               <div class="row">
                  <div class="col-sm-6 col-lg-2">
                     <div><a href="#"><img src="images/footer-logo.png"></a></div>
                  </div>
                  <div class="col-sm-6 col-lg-2">
                     <div class="footer-logo"><img src="images/phone-icon.png"><span class="map_text">(212)0607662125 </span></div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                     <div class="footer-logo"><img src="images/email-icon.png"><span class="map_text">bakrimhamza664@gmail.com</span></div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                     <div class="social_icon">
                        <ul>
                           <li><a href="#"><img src="images/fb-icon.png"></a></li>
                           <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                           <li><a href="#"><img src="images/in-icon.png"></a></li>
                           <li><a href="#"><img src="images/google-icon.png"></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-sm-2"></div>
               </div>
            </div>
            <div class="footer_section_2">
               <div class="row">
                  <div class="col-sm-4 col-lg-2">
                     <p class="dummy_text"> ipsum dolor sit amet, consectetur ipsum dolor sit amet, consectetur  ipsum dolor sit amet,</p>
                  </div>
                  <div class="col-sm-4 col-lg-2">
                     <h2 class="shop_text">Address </h2>
                     <div class="image-icon"><img src="images/map-icon.png"><span class="pet_text">No 40 Baria Sreet 15/2 NewYork City, NY, United States.</span></div>
                  </div>
                  <div class="col-sm-4 col-md-6 col-lg-3">
                     <h2 class="shop_text">Our Company </h2>
                     <div class="delivery_text">
                        <ul>
                           <li>Delivery</li>
                           <li>Legal Notice</li>
                           <li>About us</li>
                           <li>Secure payment</li>
                           <li>Contact us</li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                     <h2 class="adderess_text">Products</h2>
                     <div class="delivery_text">
                        <ul>
                           <li>Prices drop</li>
                           <li>New products</li>
                           <li>Best sales</li>
                           <li>Contact us</li>
                           <li>Sitemap</li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-sm-6 col-lg-2">
                     <h2 class="adderess_text">Newsletter</h2>
                     <div class="form-group">
                        <input type="text" class="enter_email" placeholder="Enter Your email" name="Name">
                     </div>
                     <button class="subscribr_bt">Subscribe</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <!-- section footer end -->
      <div class="copyright">2023 All Rights Reserved. <a href="https://html.design">Free html  Templates</a></div>
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script>
       // Select all "Add to Cart" buttons
var addToCartButtons = document.querySelectorAll('input[name="add_to_cart"]');

// Loop through each button and add event listeners
addToCartButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    // Get the corresponding product information
    var productContainer = button.closest('.best_shoes');
    var productName = productContainer.querySelector('.best_text').textContent;
    var productImage = productContainer.querySelector('.shoes_icon img').getAttribute('src');
    var productPrice = productContainer.querySelector('.product-prix').textContent;

    // Create an object to represent the product
    var product = {
      name: productName,
      image: productImage,
      price: productPrice,
      quantity: 1 // Initialize quantity to 1
    };

    // Get the existing products from local storage
    var existingProducts = JSON.parse(localStorage.getItem('products')) || [];

    // Check if the product already exists in the cart
    var existingProductIndex = existingProducts.findIndex(function(p) {
      return p.name === product.name;
    });

    if (existingProductIndex !== -1) {
      // If the product already exists, increment the quantity
      existingProducts[existingProductIndex].quantity++;
    } else {
      // If the product is new, add it to the existing products array
      existingProducts.push(product);
    }

    // Save the updated products array back to local storage
    localStorage.setItem('products', JSON.stringify(existingProducts));

    // Redirect to a new page
    window.location.href = "./java/prodact.html";
  });
});


         </script>
         <script>
         $(document).ready(function()){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         
         }
         $('#myCarousel').carousel({
            interval: false
         });
         
         //scroll slides on swipe for touch enabled devices
         
         $("#myCarousel").on("touchstart", function(event){
         
            var yClick = event.originalEvent.touches[0].pageY;
            $(this).one("touchmove", function(event){
         
                var yMove = event.originalEvent.touches[0].pageY;
                if( Math.floor(yClick - yMove) > 1 ){
                    $(".carousel").carousel('next');
                }
                else if( Math.floor(yClick - yMove) < -1 ){
                    $(".carousel").carousel('prev');
                }
            });
            $(".carousel").on("touchend", function(){
                $(this).off("touchmove");
            });
         });   // Sélectionner tous les boutons "Ajouter au panier"
        var boutonsAjout = document.querySelectorAll('.ajouter');

        // Parcourir les boutons et ajouter un événement de clic à chacun
        boutonsAjout.forEach(function(bouton) {
            bouton.addEventListener('click', function() {
                // Récupérer les informations de l'article associé
                var nomProduit = this.previousElementSibling.textContent;

                // Créer un nouvel élément HTML pour l'article ajouté
                var nouvelElement = document.createElement('div');
                nouvelElement.textContent = nomProduit;

                // Ajouter l'élément au panier
                var panier = document.getElementById('panier');
                panier.appendChild(nouvelElement);
            });
        });
      </script> 

   </body>
</html>