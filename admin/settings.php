<?php
require_once '../includes/components/header.php';


// Fetch and display current officers' information
$sql = "SELECT * FROM officers";
$result = mysqli_query($conn, $sql);
?>

<body class="bg-gray-50 dark:bg-gray-800">

    <?php require_once "../includes/components/nav.php";?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>

        <div id="main-content" class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

            <main>
                <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
                    <div class="mb-4 col-span-full xl:mb-2">
                        <nav class="flex mb-5" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                                <li class="inline-flex items-center">
                                    <a href="#"
                                        class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                        <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                            </path>
                                        </svg>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <a href="#"
                                            class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Users</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                            aria-current="page">Settings</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">User settings</h1>
                        <?php 
                        if(isset($_SESSION['success_message'])){
                            echo $Components->AlertDiv($_SESSION['success_message'], "success");
                            unset($_SESSION['success_message']);
                        }
                        ?>
                    </div>
                    <!-- Right Content -->
                    <div class="col-span-full xl:col-auto">
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                                <img id="image_preview" class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0"
                                    src="../includes/images/<?php echo $_SESSION['image_url'];?>"
                                    alt="Profile Picture Preview">
                                <div>
                                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Profile picture
                                    </h3>
                                    <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                                        JPG, GIF or PNG. Max size of 800K
                                    </div>
                                    <form action="../api/upload.php" method="post" enctype="multipart/form-data">
                                        <div class="flex items-center space-x-4">
                                            <input type="file"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                name="profile_image" id="profile_image" onchange="previewImage();">
                                            <button type="submit" name="submit_image"
                                                class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                Save
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="flow-root">
                                <h3 class="text-xl font-semibold dark:text-white">Social accounts</h3>
                                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5 dark:text-white" aria-hidden="true"
                                                    focusable="false" data-prefix="fab" data-icon="facebook-f"
                                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                    <path fill="currentColor"
                                                        d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <span
                                                    class="block text-base font-semibold text-gray-900 truncate dark:text-white">
                                                    Facebook account
                                                </span>
                                                <a href="#"
                                                    class="block text-sm font-normal truncate text-primary-700 hover:underline dark:text-primary-500">
                                                    www.facebook.com/themesberg
                                                </a>
                                            </div>
                                            <div class="inline-flex items-center">
                                                <a href="#"
                                                    class="px-3 py-2 mb-3 mr-3 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Disconnect</a>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="pt-4 pb-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5 dark:text-white" aria-hidden="true"
                                                    focusable="false" data-prefix="fab" data-icon="dribbble" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor"
                                                        d="M256 8C119.252 8 8 119.252 8 256s111.252 248 248 248 248-111.252 248-248S392.748 8 256 8zm163.97 114.366c29.503 36.046 47.369 81.957 47.835 131.955-6.984-1.477-77.018-15.682-147.502-6.818-5.752-14.041-11.181-26.393-18.617-41.614 78.321-31.977 113.818-77.482 118.284-83.523zM396.421 97.87c-3.81 5.427-35.697 48.286-111.021 76.519-34.712-63.776-73.185-116.168-79.04-124.008 67.176-16.193 137.966 1.27 190.061 47.489zm-230.48-33.25c5.585 7.659 43.438 60.116 78.537 122.509-99.087 26.313-186.36 25.934-195.834 25.809C62.38 147.205 106.678 92.573 165.941 64.62zM44.17 256.323c0-2.166.043-4.322.108-6.473 9.268.19 111.92 1.513 217.706-30.146 6.064 11.868 11.857 23.915 17.174 35.949-76.599 21.575-146.194 83.527-180.531 142.306C64.794 360.405 44.17 310.73 44.17 256.323zm81.807 167.113c22.127-45.233 82.178-103.622 167.579-132.756 29.74 77.283 42.039 142.053 45.189 160.638-68.112 29.013-150.015 21.053-212.768-27.882zm248.38 8.489c-2.171-12.886-13.446-74.897-41.152-151.033 66.38-10.626 124.7 6.768 131.947 9.055-9.442 58.941-43.273 109.844-90.795 141.978z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <span
                                                    class="block text-base font-semibold text-gray-900 truncate dark:text-white">
                                                    Dribbble account
                                                </span>
                                                <span
                                                    class="block text-sm font-normal text-gray-500 truncate dark:text-gray-400">
                                                    Not connected
                                                </span>
                                            </div>
                                            <div class="inline-flex items-center">
                                                <a href="#"
                                                    class="px-3 py-2 mb-3 mr-3 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Connect</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <?php 
                        $emailNotifs = $_SESSION['emailNotifs'];
                        ?>
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:mb-0">
                            <div class="flow-root">
                                <h3 class="text-xl font-semibold dark:text-white">Email Notifications</h3>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">You can set up
                                    your account to get email notifications </p>
                                <form action="../api/UpdateSettings.php" method="POST">
                                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <!-- Item 1 -->
                                        <div class="flex items-center justify-between py-4">
                                            <div class="flex flex-col flex-grow">
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Account Verify
                                                </div>
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                    You will receive an email when an Account needs verification.
                                                </div>
                                            </div>
                                            <label for="rating-reminders"
                                                class="relative flex items-center cursor-pointer">
                                                <input type="checkbox" id="rating-reminders" name="emailNotif[]"
                                                    value="Account_verify" class="sr-only"
                                                    <?php if(in_array("Account_verify", $emailNotifs)){echo "checked";}?>>
                                                <span
                                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                                            </label>
                                        </div>
                                        <!-- Item 2 -->
                                        <div class="flex items-center justify-between py-4">
                                            <div class="flex flex-col flex-grow">
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Resident Notifications
                                                </div>
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                    You will receive an email when a Resident was added, removed, or
                                                    updated.
                                                </div>
                                            </div>
                                            <label for="item-update" class="relative flex items-center cursor-pointer">
                                                <input type="checkbox" id="item-update" class="sr-only"
                                                    name="emailNotif[]" value="Resident_Notifications"
                                                    <?php if(in_array("Resident_Notifications", $emailNotifs)){echo "checked";}?>>
                                                <span
                                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                                            </label>
                                        </div>
                                        <!-- Item 3 -->
                                        <div class="flex items-center justify-between py-4">
                                            <div class="flex flex-col flex-grow">
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    System Notifications
                                                </div>
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">Send
                                                    me
                                                    an email when someone updates the system (eg. logo, descriptions,
                                                    etc...)</div>
                                            </div>
                                            <label for="item-comment" class="relative flex items-center cursor-pointer">
                                                <input type="checkbox" id="item-comment" class="sr-only"
                                                    name="emailNotif[]" value="System_Notifications"
                                                    <?php if(in_array("System_Notifications", $emailNotifs)){echo "checked";}?>>
                                                <span
                                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                                            </label>
                                        </div>
                                        <!-- Item 4 -->
                                        <div class="flex items-center justify-between pt-4">
                                            <div class="flex flex-col flex-grow">
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Backups Notifications
                                                </div>
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                    Send me email when a backup is created or restored.
                                                </div>
                                            </div>
                                            <label for="buyer-rev" class="relative flex items-center cursor-pointer">
                                                <input type="checkbox" id="buyer-rev" class="sr-only"
                                                    name="emailNotif[]" value="Backups_Notifications"
                                                    <?php if(in_array("Backups_Notifications", $emailNotifs)){echo "checked";}?>>
                                                <span
                                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <button type="submit" name="updateEmailNotif"
                                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save
                                            all</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="col-span-2">
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">Barangy Officers</h3>
                            <form action="../api/UpdateSettings.php" method="POST">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="Name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Fulle Name</label>
                                        <input type="text" name="Name" id="Name"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Bonnie" required="">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="Designation"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation</label>
                                        <input type="text" name="Designation" id="Designation"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Green" required="">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="Contact"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                                            Number</label>
                                        <input type="text" name="Contact" id="Contact"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="United States" required="">
                                    </div>

                                    <div class="col-span-6 sm:col-full">
                                        <button
                                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                            type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                            <!-- list the officers added here -->
                            <div class="grid grid-cols-1 gap-4">
                                <div class="bg-white rounded-lg shadow-sm dark:bg-gray-800">
                                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-full" src="../includes/images/bot.png"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                        Name</p>
                                                    <p class="text-sm font-medium text-primary-500">
                                                        Contact</p>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-bold text-lg text-gray-700 dark:text-white">
                                                        Designation</p>

                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <button type="button"
                                                    class="text-gray-400 focus:outline-none focus:text-gray-500">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">Password information</h3>
                            <form action="#">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="current-password"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current
                                            password</label>
                                        <input type="text" name="current-password" id="current-password"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="••••••••" required="">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                                            password</label>
                                        <input data-popover-target="popover-password" data-popover-placement="bottom"
                                            type="password" id="password"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="••••••••" required="">
                                        <div data-popover="" id="popover-password" role="tooltip"
                                            class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                                            style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1258.47px, -1387.47px);"
                                            data-popper-reference-hidden="" data-popper-placement="top"
                                            data-popper-escaped="">
                                            <div class="p-3 space-y-2">
                                                <h3 class="font-semibold text-gray-900 dark:text-white">Must have at
                                                    least 6 characters</h3>
                                                <div class="grid grid-cols-4 gap-2">
                                                    <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                                    <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                                    <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                                                    <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                                                </div>
                                                <p>It’s better to have:</p>
                                                <ul>
                                                    <li class="flex items-center mb-1">
                                                        <svg class="w-4 h-4 mr-2 text-green-400 dark:text-green-500"
                                                            aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Upper &amp; lower case letters
                                                    </li>
                                                    <li class="flex items-center mb-1">
                                                        <svg class="w-4 h-4 mr-2 text-gray-300 dark:text-gray-400"
                                                            aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        A symbol (#$&amp;)
                                                    </li>
                                                    <li class="flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-gray-300 dark:text-gray-400"
                                                            aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        A longer password (min. 12 chars.)
                                                    </li>
                                                </ul>
                                            </div>
                                            <div data-popper-arrow=""
                                                style="position: absolute; left: 0px; transform: translate(139.033px);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="confirm-password"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                            password</label>
                                        <input type="text" name="confirm-password" id="confirm-password"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="••••••••" required="">
                                    </div>
                                    <div class="col-span-6 sm:col-full">
                                        <button
                                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                            type="submit">Save all</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php 
                        $notifs = $_SESSION['notifications'];
                        ?>
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:mb-0">
                            <div class="flow-root">
                                <form action="../api/UpdateSettings.php" method="POST">
                                    <h3 class="text-xl font-semibold dark:text-white">Alerts &amp; Notifications</h3>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">You can set up
                                        Themesberg to get notifications</p>
                                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <!-- Item 1 -->
                                        <div class="flex items-center justify-between py-4">
                                            <div class="flex flex-col flex-grow">
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    New Resident Added
                                                </div>
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                    get notified when new resident added
                                                </div>
                                            </div>
                                            <label for="company-news" class="relative flex items-center cursor-pointer">
                                                <input type="checkbox" id="company-news" class="sr-only"
                                                    name="Pushnotif[]" value="Resident_Added"
                                                    <?php if(in_array("Resident_Added",$notifs)){echo "checked";}?>>
                                                <span
                                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                                            </label>
                                        </div>
                                        <!-- Item 2 -->
                                        <div class="flex items-center justify-between py-4">
                                            <div class="flex flex-col flex-grow">
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    A Resident was removed from the system
                                                </div>
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                    get notified when a resident was removed from the system
                                                </div>
                                            </div>
                                            <label for="account-activity"
                                                class="relative flex items-center cursor-pointer">
                                                <input type="checkbox" id="account-activity" class="sr-only"
                                                    name="Pushnotif[]" value="Resident_Removed"
                                                    <?php if(in_array("Resident_Removed",$notifs)){echo "checked";}?> />
                                                <span
                                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                                            </label>
                                        </div>
                                        <!-- Item 3 -->
                                        <div class="flex items-center justify-between py-4">
                                            <div class="flex flex-col flex-grow">
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Account activity
                                                </div>
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                    get notified when You Login or Logout from your account
                                                </div>
                                            </div>
                                            <label for="meetups" class="relative flex items-center cursor-pointer">
                                                <input type="checkbox" id="meetups" class="sr-only" name="Pushnotif[]"
                                                    value="Account_Activity"
                                                    <?php if(in_array("Account_Activity",$notifs)){echo "checked";}?> />
                                                <span
                                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                                            </label>
                                        </div>
                                        <?php if($_SESSION['role'] === 'admin'):?>
                                        <div class="flex items-center justify-between py-4">
                                            <div class="flex flex-col flex-grow">
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Account Verify
                                                </div>
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                    get notified when someone's Account need verification to the admin
                                                </div>
                                                <!-- add a warning that this is only available for admins only -->
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                    <span class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                        Only available for admins
                                                    </span>
                                                </div>
                                            </div>
                                            <label for="Account_verify"
                                                class="relative flex items-center cursor-pointer">
                                                <input type="checkbox" id="Account_verify" class="sr-only"
                                                    name="Pushnotif[]" value="Account_Verify"
                                                    <?php if(in_array("Account_Verify",$notifs)){echo "checked";}?> />
                                                <span
                                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                                            </label>
                                        </div>
                                        <?php endif;?>
                                        <!-- Item 4 -->
                                        <div class="flex items-center justify-between pt-4">
                                            <div class="flex flex-col flex-grow">
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    System updates
                                                </div>
                                                <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                    get notified when someone updated the system
                                                </div>
                                            </div>
                                            <label for="new-messages" class="relative flex items-center cursor-pointer">
                                                <input type="checkbox" id="new-messages" class="sr-only"
                                                    name="Pushnotif[]" value="System_Updates"
                                                    <?php if(in_array("System_Updates",$notifs)){echo "checked";}?> />
                                                <span
                                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <button type="submit" name="updatePushNotif"
                                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save
                                            all</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <?php if ($accountModel->verifyRole('superadmin')):?>
                    <h1 class="col-span-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">System
                        settings</h1>
                    <div class="col-span-full xl:col-auto">
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                                <img id="image_preview1" class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0"
                                    src="../includes/images/<?php echo $Settings->getLogo();?>"
                                    alt="<?php echo $Settings->getLogo();?>">
                                <div>
                                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">System Logo
                                    </h3>
                                    <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                                        JPG, GIF or PNG. Max size of 800K
                                    </div>
                                    <form action="../api/upload.php" method="post" enctype="multipart/form-data">
                                        <div class="flex items-center space-x-4">
                                            <input type="file"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                name="system_logo" id="system_logo" onchange="previewImage1();">
                                            <button type="submit" name="submit_logo"
                                                class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                Save
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <form action="../api/UpdateSettings.php" method="POST">>
                                <h3 class="mb-4 text-xl font-semibold dark:text-white">Set Title / Organization</h3>
                                <div class="mb-4">
                                    <label for="settings-language"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Organization / Title
                                    </label>
                                    <input type="text" id="settings-title" name="title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        value="<?php echo $Settings->get('name');?>">

                                </div>
                                <div class="mb-6">
                                    <label for="settings-timezone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Website / System Email
                                    </label>

                                    <input type="email" id="settings-email" name="webEmail"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        value="<?php echo $Settings->get('websiteEmail');?>" required>



                                </div>
                                <div>
                                    <button type="submit" name="updateTitle"
                                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save
                                        all</button>
                                </div>
                            </form>
                        </div>


                    </div>
                    <?php 
                                $smtp = $Settings->getSMTP();
                                $facebook = $Settings->getFacebookAPI();
                                $google = $Settings->getGoogleAPI();
                                
                                ?>
                    <div class="col-span-2">
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">SMTP configuration</h3>
                            <p class="mb-4 text-sm text-gray-500 dark:text-gray-400"> this is where you set the email
                                account that will be used for email notification and OTP</p>
                            <form action="../api/UpdateSettings.php" method="POST">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="host"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            HOST</label>
                                        <input type="text" name="host" id="host"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="smtp.gmail.com" required=""
                                            value='<?php echo $smtp['host'];?>' />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="port"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Port</label>
                                        <input type="number" id="port" name="port"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="465" required="" value='<?php echo $smtp['port'];?>' />

                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Email</label>
                                        <input type="text" name="email" id="email"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="example@gmail.com" required=""
                                            value='<?php echo $smtp['user'];?>' />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            password</label>
                                        <input type="text" name="password" id="password"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="••••••••" required=""
                                            value='<?php echo $smtp['password'];?>' />
                                    </div>
                                    <div class="col-span-6 sm:col-full">
                                        <button name="updateSMTP"
                                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                            type="submit">Save all</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">Facebook Auth configuration</h3>
                            <p class="mb-4 text-sm text-gray-500 dark:text-gray-400"> this is where you set the Facebook
                                API for connecting your account to facebook</p>
                            <form action="../api/UpdateSettings.php" method="POST">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="app_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Appp ID</label>
                                        <input type="text" name="fbAppId" id="app_id"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="smtp.gmail.com" required=""
                                            value='<?php echo $facebook['app_id'];?>' />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="app_secret"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            App Secret</label>
                                        <input type="number" id="app_secret" name="fbAppSecret"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" required="" value='<?php echo $facebook['app_secret'];?>' />

                                    </div>
                                    <div class="col-span-6 sm:col-full">
                                        <button name="updateFacebookAPI"
                                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                            type="submit">Save all</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">Google Auth configuration</h3>
                            <p class="mb-4 text-sm text-gray-500 dark:text-gray-400"> this is where you set the Google
                                API for connecting your account to Google account or Gmail</p>
                            <form action="../api/UpdateSettings.php" method="POST">

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="host"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            App ID</label>
                                        <input type="text" name="googleClientId" id="host"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="smtp.gmail.com" required=""
                                            value='<?php echo $google['app_id'];?>' />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="app_scret"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            App Secret</label>
                                        <input type="text" id="app_scret" name="googleClientSecret"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" required="" value='<?php echo $google['app_secret'];?>' />

                                    </div>
                                    <div class="col-span-6 sm:col-full">
                                        <button name="updateGoogleAPI"
                                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                            type="submit">Save all</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
                <!-- Included Footer.php -->
                <?php 
                    require_once "../includes/components/footer.php";
                ?>
            </main>
        </div>
    </div>
    <script>
    // JavaScript function to preview the image before uploading
    function previewImage() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image_preview').src = e.target.result;
        };
        reader.readAsDataURL(document.getElementById('profile_image').files[0]);
    }

    function previewImage1() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image_preview1').src = e.target.result;
        };
        reader.readAsDataURL(document.getElementById('system_logo').files[0]);
    }
    </script>
</body>

</html>