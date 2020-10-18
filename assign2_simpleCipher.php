<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Simple Cipher</title>
</head>

<body>
    <header>
        <h1>Simple Cipher</h1>
    </header>

    <main>
        <form class="narrow" method="POST" autocomplete="off" action="assign2_simpleCipher.php">

            <?php
            if (isset($_POST['UserMessage'])) {

                $UserOrgMessage = $_POST['UserMessage'];
                $encryption_key = substr($_POST['EncryptionKey'], 0, 7);
                $encryption_iv = substr($_POST['EncryptionKey'], 8, 16);

                echo "<h2>Your message before encryption is: </h2>" .
                    $UserOrgMessage . "<br>";

                // Store a string into the variable which
                // need to be Encrypted
                // Display the original string

                // Store the cipher method
                $ciphering = "AES-128-CTR";

                // Use OpenSSl Encryption method
                $iv_length = openssl_cipher_iv_length($ciphering);
                $options = 0;

                // Use openssl_encrypt() function to encrypt the data
                $encrypted_message = openssl_encrypt($UserOrgMessage, $ciphering, $encryption_key, $options, $encryption_iv);

                // Display the encrypted string
                echo "<h2>Encrypted Message: </h2>" . $encrypted_message;

                echo "<br><br><h3>Please copy and paste the above Encrypted Message here for decryption process</h3><input type='text' name='DecryptMessage' value='' required/>";
                echo "<h3>Please provide the encryption key in this format</h3>(First 8 are Alphabets letters, can be either Uppercase or Lowercase follow by 16 numberic numbers):<br><input type='text' name='DecryptionKey' value=''  size='30' pattern='[a-zA-Z]{8}\d{16}' title='First 8 are Alphabets letters can be either Uppercase or Lowercase follow by 16 numberic numbers' required/> <br><br>";
                echo "<br><input type='submit' name='submit' value='Decrypt Now'>";
            } elseif (isset($_POST['DecryptMessage'])) {
                $DecryptMessage = $_POST['DecryptMessage'];
                $decryption_key = substr($_POST['DecryptionKey'], 0, 7);
                $decryption_iv = substr($_POST['DecryptionKey'], 8, 16);

                $ciphering = "AES-128-CTR";
                $options = 0;

                // Use openssl_decrypt() function to decrypt the data
                $DecryptionMessage = openssl_decrypt($DecryptMessage, $ciphering, $decryption_key, $options, $decryption_iv);

                echo "<h2>This is your original message: </h2>" . $DecryptionMessage;
                echo "<br><br><button onClick='window.location.href=window.location.href'>Please try again</button>";
            } else {
                echo "<h3>Please enter a message you want to encrypt with no more than 24 characters</h3>(Enter only with Alphabets letters, can be either Uppercase or Lowercase or numeric numbers with space):<br><input type='text' name='UserMessage' value='' minlength='1' maxlength='25' size='30' pattern='[a-zA-Z0-9 ]{1,24}' required /> <br><br>";
                echo "<h3>Please provide the encryption key in this format </h3>(First 8 are Alphabets letters, can be either Uppercase or Lowercase follow by 16 numberic numbers):<br><input type='text' name='EncryptionKey' value=''  size='30' pattern='[a-zA-Z]{8}\d{16}' title='First 8 are Alphabets letters can be either Uppercase or Lowercase follow by 16 numberic numbers' required/><b><i> Please remember your entry!!!<i><b><br><br>";
                echo "<br><input type='submit' name='submit' value='Encrypt Now' >";
            }
            ?>

        </form>

    </main>

    <footer>
        <br><br>
        <address>Simple Cipher @ Vicky Law</address>
    </footer>

</body>

<script>
</script>