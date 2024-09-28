<?php
session_start(); 


$name = $number = $email = $pwd = $pwd2 = $gender = $country = $biography = "";
$skills = [];


$nameErr = $numberErr = $emailErr = $pwdErr = $pwd2Err = $genderErr = $countryErr = $skillsErr = $bioErr = "";


function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["name"])) {
        $nameErr = "Only letters and spaces are allowed in the name";
    } else {
        $name = test_input($_POST["name"]);
    }

 
    if (empty($_POST["number"])) {
        $numberErr = "Number is required";
    } elseif (!is_numeric($_POST["number"])) {
        $numberErr = "Please enter a valid number";
    } else {
        $number = test_input($_POST["number"]);
    }

  
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = test_input($_POST["email"]);
    }

  
    if (empty($_POST["pwd"])) {
        $pwdErr = "Password is required";
    } elseif (strlen($_POST["pwd"]) < 8) {
        $pwdErr = "Password must be at least 8 characters long";
    } elseif (!preg_match("/[A-Z]/", $_POST["pwd"])) {
        $pwdErr = "Password must contain at least one uppercase letter";
    } elseif (!preg_match("/[a-z]/", $_POST["pwd"])) {
        $pwdErr = "Password must contain at least one lowercase letter";
    } elseif (!preg_match("/\d/", $_POST["pwd"])) {
        $pwdErr = "Password must contain at least one digit";
    } else {
        $pwd = test_input($_POST["pwd"]);
    }

 
    if (empty($_POST["pwd2"])) {
        $pwd2Err = "Please confirm your password";
    } elseif ($_POST["pwd"] !== $_POST["pwd2"]) {
        $pwd2Err = "Passwords do not match";
    } else {
        $pwd2 = test_input($_POST["pwd2"]);
    }

  
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

 
    if (empty($_POST["country"])) {
        $countryErr = "Country is required";
    } else {
        $country = test_input($_POST["country"]);
    }

    if (empty($_POST["skills"])) {
        $skillsErr = "At least one skill is required";
    } else {
        $skills = $_POST["skills"];
    }

   
    if (empty($_POST["biography"])) {
        $bioErr = "Biography is required";
    } else {
        $biography = test_input($_POST["biography"]);
    }

   
    if (empty($nameErr) && empty($numberErr) && empty($emailErr) && empty($pwdErr) && empty($pwd2Err) && empty($genderErr) && empty($countryErr) && empty($skillsErr) && empty($bioErr)) {
        $_SESSION['name'] = $name;
        $_SESSION['number'] = $number;
        $_SESSION['email'] = $email;
        $_SESSION['gender'] = $gender;
        $_SESSION['country'] = $country;
        $_SESSION['skills'] = $skills;
        $_SESSION['biography'] = $biography;
        header("Location: about.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Websys - Home</title>
</head>
<body>
<h1>User Information Form</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label for="name">Enter your name:</label><br>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <span style="color:red;"><?php echo $nameErr; ?></span><br>

    <label for="number">Enter your number:</label><br>
    <input type="text" id="number" name="number" value="<?php echo $number; ?>">
    <span style="color:red;"><?php echo $numberErr; ?></span><br>

    <label for="email">Enter your Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
    <span style="color:red;"><?php echo $emailErr; ?></span><br>

    <label for="pwd">Enter your password:</label><br>
    <input type="password" id="pwd" name="pwd">
    <span style="color:red;"><?php echo $pwdErr; ?></span><br>

    <label for="pwd2">Confirm password:</label><br>
    <input type="password" id="pwd2" name="pwd2">
    <span style="color:red;"><?php echo $pwd2Err; ?></span><br>

    <label for="gender">Gender:</label><br>
    <input type="radio" id="male" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
    <label for="female">Female</label>
    <span style="color:red;"><?php echo $genderErr; ?></span><br>

    <label for="country">Country:</label><br>
    <select name="country" id="country">
        <option value="">Select a country</option>
        <option value="ph" <?php echo ($country == 'ph') ? 'selected' : ''; ?>>Philippines</option>
        <option value="kr" <?php echo ($country == 'kr') ? 'selected' : ''; ?>>Korea</option>
        <option value="us" <?php echo ($country == 'us') ? 'selected' : ''; ?>>America</option>
        <option value="eur" <?php echo ($country == 'eur') ? 'selected' : ''; ?>>Europe</option>
    </select>
    <span style="color:red;"><?php echo $countryErr; ?></span><br>

    <label for="skills">Skills:</label><br>
    <label for="skill1">Coding</label>
    <input type="checkbox" id="skill1" name="skills[]" value="Coding" <?php echo in_array('Coding', $skills) ? 'checked' : ''; ?>>
    <label for="skill2">Design</label>
    <input type="checkbox" id="skill2" name="skills[]" value="Design" <?php echo in_array('Design', $skills) ? 'checked' : ''; ?>>
    <label for="skill3">Analysis</label>
    <input type="checkbox" id="skill3" name="skills[]" value="Analysis" <?php echo in_array('Analysis', $skills) ? 'checked' : ''; ?>>
    <span style="color:red;"><?php echo $skillsErr; ?></span><br>

    <label for="biography">Biography:</label><br>
    <textarea name="biography" id="biography" rows="4" cols="50"><?php echo $biography; ?></textarea>
    <span style="color:red;"><?php echo $bioErr; ?></span><br>

    <button type="submit">Submit</button>
</form>
</body>
</html>
