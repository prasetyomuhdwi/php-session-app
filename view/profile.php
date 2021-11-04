<?php
session_start();

if (!isset($_SESSION["user"])) {
    return http_response_code(403);;
};

if (file_exists("../asset/usr/{$_SESSION["user"]["full_name"]}.png")) {
    $profilePic = "../asset/usr/{$_SESSION["user"]["full_name"]}.png";
} else {
    $profilePic = "../asset/default.png";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Setting Profile</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body>
    <div class="w-full md:h-screen flex justify-center items-center bg-blue-200">
        <div class="w-4/5">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-4">
                    <h3 class="text-lg leading-6 font-bold text-gray-900">
                        Setting Profile
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Informasi pengguna anda hanya digunakan untuk meningkatkan
                        kenyamanan pengguna.
                    </p>
                </div>
                <div class="grid gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="md:col-span-2">
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="
                    bg-gray-50
                    px-2
                    py-5
                    sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4
                  ">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Nama Lengkap
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <?php echo $_SESSION["user"]["full_name"];
                                        ?>
                                    </dd>
                                </div>
                                <div class="
                    bg-white
                    px-2
                    py-5
                    sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4
                  ">
                                    <dt class="text-sm font-bold text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <?php echo $_SESSION["user"]["email"];
                                        ?>
                                    </dd>
                                </div>
                                <div class="
                                bg-gray-50
                    px-2
                    py-5
                    sm:grid sm:grid-cols-2 sm:gap-2 sm:px-4
                  ">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Nomor Telepon
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <?php echo $_SESSION["user"]["phone"];
                                        ?>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    <div class="md:col-span-1 p-3 border-t border-l border-gray-200">
                        <dl class="flex flex-col items-center">
                            <div class="px-4 py-5">
                                <dt class="text-center font-bold text-gray-500">
                                    Foto Profil
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <?php echo "<img class='w-64 h-64 overflow-hidden' src='{$profilePic}' alt='avatar' />"; ?>
                                </dd>
                            </div>
                            <div class="bg-white px-2 py-1">
                                <button onclick="popupModal()" class="
                      bg-blue-400
                      text-sm
                      font-bold
                      text-white
                      p-2
                      rounded-lg
                      transform
                      hover:scale-125 hover:bg-blue-600
                      transition
                      ease-in-out
                      duration-300
                    ">
                                    Ganti foto
                                </button>
                            </div>
                        </dl>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="modal" class="
          fixed
          z-10
          top-0
          w-full
          h-full
          flex
          bg-black bg-opacity-60
          hidden
        ">
            <div class="extraOutline p-4 bg-white w-max bg-whtie m-auto rounded-lg">
                <div class="
              file_upload
              p-5
              relative
              border-4 border-dotted border-gray-300
              rounded-lg
            " style="width: 450px">
                    <svg class="chooseImg text-indigo-500 w-24 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <form class="input_field flex flex-col w-max mx-auto text-center" onsubmit="return onSubmit(event);"
                        method="POST" enctype="multipart/form-data">
                        <div class="chooseImg">
                            <label>
                                <input class="text-sm cursor-pointer w-36 hidden" type="file" name="profileImg"
                                    onChange="displayImage(this);" id="profileImg" multiple />
                                <div class="
                      text
                      bg-indigo-400
                      text-white
                      border border-gray-300
                      rounded
                      font-semibold
                      cursor-pointer
                      p-1
                      px-3
                      hover:bg-indigo-600
                      transform
                      hover:scale-125
                      transition
                      ease-in-out
                      duration-500
                    ">
                                    Pilih foto
                                </div>
                            </label>

                        </div>
                        <div id="previewImg" class="hidden">
                            <?php
                            echo "<img src='{$profilePic}' id='profileDisplay' class='w-64 h-64 overflow-hidden' />"; ?>
                            <div class="mt-2 h-3 relative max-w-xl rounded-full overflow-hidden">
                                <div class="w-full h-full bg-gray-200 absolute"></div>
                                <div id="bar" class="h-full bg-green-500 relative w-0"></div>
                            </div>

                            <input type="submit" id="btnSubmit" class="
                    bg-blue-400
                    text-sm
                    font-bold
                    text-white
                    mt-2
                    p-2
                    rounded-lg
                    transform
                    hover:scale-125 hover:bg-blue-600
                    transition
                    ease-in-out
                    duration-300
                  " value="Unggah foto">
                            </input>
                        </div>
                    </form>
                    <button onclick="popupModal()" class="
                close_btn
                absolute
                -top-10
                -right-10
                bg-white
                p-1
                cursor-pointer
                text-gray-600
                shadow-lg
                transform
                hover:scale-125
                transition
                ease-in-out
                duration-500
                rounded-full
              ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="
                  h-9
                  w-9
                  fill-current
                  transform
                  hover:text-red-400 hover:scale-125
                  transition
                  ease-in-out
                  duration-700
                " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="../asset/profile.js"></script>

</body>

</html>