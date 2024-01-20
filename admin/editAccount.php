<?php 
require_once '../includes/components/header.php';
if(isset($_GET['edit'])) {
    $result = $accountModel->getAccount($_GET['edit']);
}

$permissions = array();
$permissions = $result['permissions'];
$permissionsJson = json_decode($permissions);



?>

<body class="bg-gray-50 dark:bg-gray-800">

    <?php require_once "../includes/components/nav.php";?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>

        <div id="main-content" class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

            <main>
                <div class="px-4 pt-6 pr-4">
                    <section class="bg-white dark:bg-gray-900">
                        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update Account</h2>
                            <form action="../api/updateAccount.php" method="POST" class="">
                                <input type="text" name="id" id="id" value="<?php echo $result['id']?>" hidden>
                                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                                    <div class="sm:col-span-2">
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Accoutn
                                            Username</label>
                                        <input type="text" name="username" id="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="<?php echo $result['username']?>" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="<?php echo $result['email']?>" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="price"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                            <select name="role" id="role"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected value="<?php echo $result['role']?>"><?php echo $result['role']?></option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                            </select>
                                        
                                    </div>

                                    <div>
                                        <label for="category"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permissions</label>
                                        <!-- check box permisions for accounts -->
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="flex items-center border border-gray-200 rounded ps-4 dark:border-gray-700">
                                                <input id="bordered-checkbox-1" name="permission[]" type="checkbox"  value="Manage_Accounts"
                                                    name="bordered-checkbox"  <?php if(in_array('Manage_Accounts', $permissionsJson)) { echo "checked"; }?>
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="bordered-checkbox-1"
                                                    class="w-full py-4 text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                                                Manage Accounts</label>
                                            </div>
                                            
                                            <div
                                                class="flex items-center border border-gray-200 rounded ps-4 dark:border-gray-700">
                                                <input id="bordered-checkbox-2" name="permission[]" type="checkbox"  value="Manage_Residents"
                                                    name="bordered-checkbox"  <?php if(in_array('Manage_Residents', $permissionsJson)) { echo "checked"; }?>
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="bordered-checkbox-2"
                                                    class="w-full py-4 text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                                                Manage Residents</label>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="flex items-center space-x-4">
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Update Account
                                    </button>
                                    <button type="submit"
                                        class="text-white bg-lime-700 hover:bg-lime-800 focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800">
                                        Change Password
                                    </button>
                                    <button type="button"
                                        class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </form>
                        </div>
                    </section>
                    <!-- Included Footer.php -->
                    <?php 
                    require_once "../includes/components/footer.php";
                ?>
            </main>
        </div>
    </div>
</body>

</html>