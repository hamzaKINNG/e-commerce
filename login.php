
<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "produitss");

// Vérification de la connexion
if ($conn->connect_errno) {
    echo "Echec de la connexion MySQL: " . $conn->connect_error;
    exit();
}

// Vérification si le bouton "submit" a été cliqué  
if (isset($_POST['submit'])) {
    // Récupération des variables POST du formulaire d'inscription
    $EmailAddress = $_POST['EmailAddress'];
    $Password = $_POST['Password'];
    
    // Requête SQL pour insérer un nouvel utilisateur dans la base de données
    $query = "INSERT INTO enregistrer (EmailAddress, Password) VALUES ('$EmailAddress', '$Password')";
    $result = $conn->query($query);

    // Vérification du résultat de la requête
    if ($result) {
        // L'utilisateur a été ajouté avec succès
        //echo "Inscription réussie";
    } else {
        // L'utilisateur n'a pas pu être ajouté
        echo "Une erreur s'est produite lors de l'inscription: " . $conn->error;
    }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <script src="https://cdn.tailwindcss.com"></script>
    <form action="" method="post">
        <!-- component -->
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
	<div class="relative py-3 sm:max-w-xl sm:mx-auto">
		<div
			class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
		</div>
		<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
			<div class="max-w-md mx-auto">
				<div>
					<h1 class="text-2xl font-semibold">Login Form with Floating Labels</h1>
				</div>
				<div class="divide-y divide-gray-200">
					<div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
						<div class="relative">
							<input autocomplete="off" id="EmailAddress" name="EmailAddress" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
							<label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">EmailAddress</label>
						</div>
						<div class="relative">
							<input autocomplete="off" id="Password" name="Password" type="Password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
							<label for="Password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
						</div>
						<div class="relative">
							<button name="submit" class="bg-blue-500 text-white rounded-md px-2 py-1">Submit</button>
							
							<?php
$stored_email = "hamzabakrim664@gmail.com";
$stored_password = "12345";

if(isset($_POST['submit'])){
    $entered_email = $_POST['EmailAddress'];
    $entered_password = $_POST['Password'];
    
    if($entered_email === $stored_email && $entered_password === $stored_password){
        header("Location: ./dashbord/hamza/index.html?");
        exit;
    }else{
		echo "<p style='color:red'>Invalid Email or Password </p> " ;
		

		
    }
}
?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
       
    </form>
</body>
</html>