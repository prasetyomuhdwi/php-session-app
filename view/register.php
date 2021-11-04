<!-- PHP -->
<?php
$cookie_name = array("full_name", "email", "phone", "password");
$errMsg = array();
$dataPre = array();
foreach ($cookie_name as $value) {
  if (isset($_COOKIE["err" . $value])) {
    $errMsg[$value] = str_replace("+", " ", $_COOKIE["err" . $value]);
  }
}
foreach ($cookie_name as $value) {
  if (isset($_COOKIE[$value])) {
    $dataPre[$value] = str_replace("+", " ", $_COOKIE[$value]);
  }
}
?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registasi</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet" />
    <style>
    html {
        font-family: "Noto Sans", Tahoma, Geneva, Verdana, sans-serif;
    }
    </style>
</head>

<body>
    <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <div>
                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-10 md:py-20 mb-6">
                    <div class="grid gap-6 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 justify-centeritems-center">
                        <div class="text-gray-600 bg-blue-50 p-4 rounded-lg shadow-md">
                            <img src="../asset/undraw_hero.svg" class="h-96" alt="undraw_hero" />
                        </div>
                        <div class="lg:col-span-2">
                            <form class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5"
                                action="../controller/validasi.php" method="post">
                                <h2 class="text-2xl font-bold mb-4">Registasi</h2>
                                <div class="md:col-span-5">
                                    <label for="full_name">Nama Lengkap</label>
                                    <?php
                  if (isset($dataPre["full_name"])) {
                    echo "<input required type='text' name='full_name' id='full_name' 
                    class='h-10 border mt-1 rounded px-4 w-full bg-gray-50' value='" .  $dataPre["full_name"] . "' />";
                  } else {
                    echo "<input required type='text' name='full_name' id='full_name' 
                    class='h-10 border mt-1 rounded px-4 w-full bg-gray-50' value='' />";
                  }
                  if (isset($errMsg["full_name"])) {
                    echo "<span class='text-xs tracking-wide text-red-600'>" . $errMsg["full_name"] . "</span>";
                  }
                  ?>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="email">Alamat E-mail</label>

                                    <?php
                  if (isset($dataPre["email"])) {
                    echo "<input required type='email' name='email' id='email'
                    class='h-10 border mt-1 rounded px-4 w-full bg-gray-50' value='" . $dataPre["email"] . "'
                    placeholder='email@domain.com' />";
                  } else {
                    echo "<input required type='email' name='email' id='email'
                    class='h-10 border mt-1 rounded px-4 w-full bg-gray-50' value=''
                    placeholder='email@domain.com' />";
                  }
                  if (isset($errMsg["email"])) {
                    echo "<span class='text-xs tracking-wide text-red-600'>" . $errMsg["email"] . "</span>";
                  }
                  ?>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="phone">Nomor Telepon</label>
                                    <?php
                  if (isset($dataPre["phone"])) {
                    echo "<input required type='number' name='phone' id='phone'
                    class='h-10 border mt-1 rounded px-4 w-full bg-gray-50' value='" . $dataPre["phone"] . "'
                    placeholder='081234567890' />";
                  } else {
                    echo "<input required type='number' name='phone' id='phone'
                    class='h-10 border mt-1 rounded px-4 w-full bg-gray-50' value=''
                    placeholder='081234567890' />";
                  }
                  if (isset($errMsg["phone"])) {
                    echo "<span class='text-xs tracking-wide text-red-600'>" . $errMsg["phone"] . "</span>";
                  }
                  ?>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="password">Kata Sandi</label>

                                    <?php
                  if (isset($dataPre["password"])) {
                    echo "<input required type='password' name='password' id='password'
                    class='h-10 border mt-1 rounded px-4 w-full bg-gray-50' value='" . $dataPre["password"] . "'
                    placeholder='********' />";
                  } else {
                    echo "<input required type='password' name='password' id='password'
                    class='h-10 border mt-1 rounded px-4 w-full bg-gray-50' value=''
                    placeholder='********' />";
                  }
                  if (isset($errMsg["password"])) {
                    echo "<span class='text-xs tracking-wide text-red-600'>" . $errMsg["password"] . "</span>";
                  }
                  ?>
                                </div>
                                <div class="flex justify-between items-center md:col-span-5">
                                    <div class="hover:text-blue-400">
                                        <a href="http://" class="flex ">
                                            <p>Sudah punya akun ?</p>
                                            <b class="ml-2"> Login disini</b>
                                        </a>
                                    </div>
                                    <div class="text-right">
                                        <div class="inline-flex items-end">
                                            <button class="
                            bg-blue-500
                            hover:bg-blue-700
                            text-white
                            font-bold
                            py-2
                            px-4
                            rounded
                          " name="submit">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>