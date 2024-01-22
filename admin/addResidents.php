<?php

require_once '../includes/components/header.php';
?>

<body class="bg-gray-50 dark:bg-gray-800">

    <?php require_once "../includes/components/nav.php";?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>

        <div id="main-content" class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

            <main>
                <div class="px-4 pt-6 pr-4">
                    <div class="mb-4">
                        <nav class="flex mb-5" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                                <li class="inline-flex items-center">
                                    <a href="home.php"
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
                                            class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Admin</a>
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
                                            aria-current="page"><?php echo $filename; ?></span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Add Residents
                        </h1>
                    </div>
                    <div id="response"></div>
                    <section class="bg-white dark:bg-gray-900">
                        <div class="px-4 py-8 mx-auto max-w-1xl lg:py-16">

                            <form action="../api/AddSurveyData.php" methd="post">
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 sm:gap-6">
                                    <div class="w-full">
                                        <label for="FirstName"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">FirstName</label>
                                        <input type="text" name="FirstName" id="FirstName"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder=" FirstName" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="LastName"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">LastName</label>
                                        <input type="text" name="LastName" id="LastName"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="LastName" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="MiddleInitial"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                                            Initial</label>
                                        <input type="text" name="MiddleInitial" id="MiddleInitial"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder=" MiddleInitial" required="">
                                    </div>
                                    <div class="w-full col-span-2">
                                        <label for="BirthPlace"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth
                                            Place</label>
                                        <input type="text" name="BirthPlace" id="BirthPlace"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Birth Place" required="">
                                    </div>
                                    <div>
                                        <label for="category"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth
                                            Date</label>
                                        <input type="date" name="BirthDate" id="BirthDate"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Birth Place" required="">
                                    </div>

                                    <div>
                                        <label for="Gender"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Gender</label>
                                        <select name="Gender" id="Gender"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="CivilStatus"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Civil Status</label>
                                        <select name="CivilStatus" id="CivilStatus"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Annulled">Annulled</option>
                                            <option value="Other">Other</option>

                                        </select>
                                    </div>
                                    <div>
                                        <label for="Religion"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Religion</label>
                                        <input type="text" name="Religion" id="Religion"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Religion" required="">
                                    </div>
                                    <div>
                                        <label for="Dialect"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Dialect</label>
                                        <input type="text" name="Dialect" id="Dialect"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Your Dialect" required="">
                                    </div>
                                    <div>
                                        <label for="Education"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Education</label>
                                        <input type="text" name="Education" id="Education"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Your Highest Education" required="">
                                    </div>

                                    <div>
                                        <label for="Job"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Job</label>
                                        <input type="text" name="Job" id="Job"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Your Job" required="">
                                    </div>

                                    <div>
                                        <label for="MonthlyIncome"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Monthly Income</label>
                                        <input type="text" name="MonthLyIncome" id="MonthlyIncome"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Your Monthly Income" required="">
                                    </div>
                                    <div>
                                        <label for="PhoneNumber"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Phone Number</label>
                                        <input type="text" name="PhoneNumber" id="PhoneNumber"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="YOur Phone Number" required="">
                                    </div>
                                    <div>
                                        <label for="Email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Email</label>
                                        <input type="email" name="Email" id="Email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Your Email" required="">
                                    </div>



                                    <div class="sm:col-span-2">
                                        <label for="Remarks"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                        <textarea id="Remarks" rows="8" name="Remarks"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Your Remarks here"></textarea>
                                    </div>
                                </div>
                                <button type="submit" name="Add_resident"
                                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                    Add resident
                                </button>
                            </form>
                        </div>
                    </section>
                </div>


        <!-- Included Footer.php -->
        <?php 
                    require_once "../includes/components/footer.php";
                    ?>
        </main>
    </div>
    </div>

    </div>


</body>

</html>