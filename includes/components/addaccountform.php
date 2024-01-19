<section class="">
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    
                    <div
                        class="w-full bg-white rounded-lg shadow dark:border md:mt-0  xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1
                                class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Create An Account
                            </h1>
                            <form hx-post="/api/createAccount.php" hx-target="#success-message" hx-swap="innserHTML"
                                    hx-trigger="submit">
                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                        <div>
                                            <label for="name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                            <input type="text" name="username" id="name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Username" required="">
                                        </div>
                                        <div>
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder=" email" required="">
                                        </div>
                                        <div>
                                            <label for="password"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">password</label>
                                            <input type="password" name="password" id="password"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="******" required="">
                                        </div>
                                        <div>
                                            <label for="repassword"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Re
                                                Password</label>
                                            <input type="password" name="repassword" id="repassword"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="*****" required="">
                                        </div>
                                        <div>
                                            <label for="Roles"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                                a Role</label>
                                            <select id="Roles" name="role"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected>Choose a Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="others">others</option>
                                              
                                            </select>
                                        </div>
                                        <div class="col-span-2">
                                            <label for="category"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permissions</label>
                                            <!-- check box permisions for accounts -->
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                                    <input id="bordered-checkbox-1" name="permission[]" type="checkbox"
                                                        value="Manage_Accounts" name="bordered-checkbox"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="bordered-checkbox-1"
                                                        class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        Manage Accounts</label>
                                                </div>

                                                <div
                                                    class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                                    <input id="bordered-checkbox-2" name="permission[]" type="checkbox"
                                                        value="Manage_Residents" name="bordered-checkbox"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="bordered-checkbox-2"
                                                        class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        Manage Residents</label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit"
                                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Add new Account
                                    </button>
                                </form>
                        </div>
                    </div>
                </div>
            </section>