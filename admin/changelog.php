<?php
require_once '../includes/components/header.php';
require_once '../models/Github.php';
// Fetch and display current officers' information
$sql = "SELECT * FROM officers";
$result = mysqli_query($conn, $sql);

$github = new Github();
$commits = $github->getCommits();
$releases = $github->getReleases();
$updates = $github->getLatestRelease();
$tagListHtml = $github->getTagList();
?>

<body class="bg-gray-50 dark:bg-gray-800">

    <?php require_once "../includes/components/nav.php"; ?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php'; ?>

        <div id="main-content" class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">


            <main id="content-wrapper" class="flex-auto w-full min-w-0 lg:static lg:max-h-full lg:overflow-visible">
                <div class="flex w-full">


                    <div class="flex-auto max-w-4xl min-w-0 pt-6 lg:px-8 lg:pt-8 pb:12 xl:pb-24 lg:pb-16">


                        <div class="pb-4 mb-8 border-b border-gray-200 dark:border-gray-800">
                            <h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white" id="content">BIMS - Changelog</h1>
                            <p class="mb-4 text-lg text-gray-600 dark:text-gray-400">Read more about the releases made for BIMS from the official changelog</p>
                        </div>



                        <div id="mainContent" class="space-y-4">
                            <h2 class="relative group dark:text-gray-100">Changelog
                                <span id="changelog" class="absolute -top-[140px]"></span> <a class="ml-2 text-blue-700 transition-opacity opacity-0 dark:text-blue-500 group-hover:opacity-100" href="#changelog" aria-label="Link to this section: Changelog">#</a>
                            </h2>
                            <p class="dark:text-gray-300">We strive to keep a good accountability of all of the version changes that we make</p>


                            <ol class="relative border-l border-gray-200 dark:border-gray-700">
                                <?php foreach ($releases as $release) : ?>
                                    <li class="mb-10 ml-4">
                                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?= date('F Y', strtotime($release['published_at'])) ?></time>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            <a href="<?= htmlspecialchars($release['html_url']) ?>" class="hover:underline"><?= htmlspecialchars($release['name']) ?></a>
                                            <?php if ($release['prerelease']) : ?>
                                                <span class="px-2 py-1 ml-2 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">Pre-release</span>
                                            <?php endif; ?>
                                        </h3>
                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Released by <?= htmlspecialchars($release['author']['login']) ?>. <?= nl2br(htmlspecialchars($release['body'])) ?></p>
                                        <a href="<?= htmlspecialchars($release['zipball_url']) ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Download ZIP</a>
                                        <a href="<?= htmlspecialchars($release['tarball_url']) ?>" class="inline-flex items-center px-4 py-2 ml-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Download TAR</a>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                    <?php

                    ?>

                    <div class="flex-none hidden w-64 pl-8 mr-8 xl:text-sm xl:block">

                        <div class="flex overflow-y-auto sticky top-28 flex-col justify-between pt-10 pb-6 h-[calc(100vh-5rem)]">
                            <div class="mb-8">
                                <h4 class="pl-2.5 mb-2 text-sm font-semibold tracking-wide text-gray-900 uppercase dark:text-white lg:text-xs">On this page</h4>
                                <?php
                                echo $tagListHtml;
                                ?>

                            </div>
                        </div>

                    </div>
                </div>

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