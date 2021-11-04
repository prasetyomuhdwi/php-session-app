<?php
session_start();

if (!isset($_SESSION["user"])) {
    return http_response_code(403);;
};
?>
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
                        <div class='md:col-span-5'>
                            <h2 class='text-xl font-bold text-center'>Selamat Datang di Dashboard</h2>
                        </div>
                        <div class='md:col-span-5'>
                            <p class='text-sm text-center'>Nama :
                                <?php echo $_SESSION["user"]["full_name"];
                                ?>
                            </p>
                            <p class='text-sm text-center'>Email :
                                <?php echo $_SESSION["user"]["email"];
                                ?>
                            </p>
                            <p class='text-sm text-center'>Nomor Telepon :
                                <?php echo $_SESSION["user"]["phone"];
                                ?>
                            </p>
                        </div>
                        <a href="../controller/logout.php" tite="Logout"
                            class="w-full text-center bg-red-400 text-white hover:bg-red-500 md:col-span-5">Logout</a>
                        <a href="./profile.php" tite="Setting Profile"
                            class="w-full text-center bg-green-400 text-white hover:bg-green-500 md:col-span-5">Setting
                            Profile</a>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>