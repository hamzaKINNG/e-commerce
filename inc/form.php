<?php
$conn = mysqli_connect('localhost', 'root', 'hamza', 'produitss');
if (!$conn) {
  die('Error: ' . mysqli_connect_error());
}
?>
<?php
if (isset($_POST['submit'])) {
    // Sanitize the user inputs to prevent SQL injection attacks
    $Name          = mysqli_real_escape_string($conn, $_POST['Name']);
    $PhoneNumbar   = mysqli_real_escape_string($conn, $_POST['Phone Numbar']);
    $Email         = mysqli_real_escape_string($conn, $_POST['Email']);
    $Massage       = mysqli_real_escape_string($conn, $_POST['Massage']);

    // Use prepared statements to insert data into the database
    $stmt = "INSERT INTO mylist('Name', 'PhoneNumbar', 'Email', 'Massage') VALUES ('{$Name}', '{$PhoneNumbar}', '{$Email}','{$Massage}')";
    //$stmt->bind_param("ssss", $Name, $PhoneNumbar, $Email, $Message);

    if (empty($Name)) {
        echo 'Name empty';
    } else if (empty($PhoneNumbar)) {
        echo 'PhoneNumbar empty';
    } else if (empty($Email)) {
        echo 'Email empty';
    } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid Email format';
    } else {
        if (mysqli_query($conn,$stmt)) {
            $message = "Success";
            
        } else {
            $message = "Failure: ". mysqli_error($conn);
        }
    }
}
?>
