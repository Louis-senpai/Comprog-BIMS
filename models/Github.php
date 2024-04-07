<?php



class Github
{

    public $repository = 'https://github.com/Louis-senpai/Comprog-BIMS';
    public $user = 'Louis-senpai';
    private $accessToken = null; // Consider making this private
    public $version = null;
    public function __construct()
    {
        $config = new Settings($_SERVER['DOCUMENT_ROOT'] . '\settings.json');
        $this->version = $config->getVersion();
        // Ensure the access token is securely handled
        $this->accessToken =  $_ENV['GITHUB_TOKEN'];
        // Consider loading this from a secure location or environment variable
    }

    public function getCommits()
    {
        $repoUrl = "https://api.github.com/repos/Louis-senpai/Comprog-BIMS/commits";

        // Setup the CURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $repoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Accept: application/vnd.github+json",
            "Authorization: Bearer {$this->accessToken}",
            'User-Agent: PHP Script' // GitHub requires a user agent header
        ]);

        // Execute the CURL command
        $response = curl_exec($ch);

        // Check for errors before closing the session
        if (curl_errno($ch)) {
            // Log error or return an error message
            curl_close($ch);
            return null;
        }

        curl_close($ch);


        // Decode the response
        $commits = json_decode($response, true);

        if (curl_errno($ch)) {
            // Handle error; perhaps log it or return an error message
            return null;
        }

        return $commits;
    }
    public function getReleases()
    {

        $repoUrl = "https://api.github.com/repos/Louis-senpai/Comprog-BIMS/releases";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $repoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [

            "Accept: application/vnd.github+json",
            "Authorization: Bearer {$this->accessToken}",
            'User-Agent: PHP Script' // GitHub requires a user agent header

        ]);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            // Handle error; perhaps log it or return an error message
            return null;
        }
        curl_close($ch);
        $leases = json_decode($response, true);


        return $leases;
    }

    // Existing class properties and methods...

    public function checkForUpdates()
    {
        $currentVersion = $this->version;
        $releases = $this->getReleases();

        if (is_null($releases)) {
            return json_encode(['error' => 'Failed to fetch the releases.']);
        }

        $latestRelease = null;
        foreach ($releases as $release) {
            // Consider both prereleases and regular releases
            if ($release['prerelease'] || !$latestRelease) {
                $latestRelease = $release;
            }
        }

        if (is_null($latestRelease)) {
            return json_encode(['error' => 'No releases found.']);
        }

        $latestVersion = $latestRelease['name'];

        if (version_compare($currentVersion, $latestVersion, '<')) {
            // Current version is lower than the latest version
            return json_encode($latestRelease);
        } else {
            // Current version is up-to-date
            return json_encode(['message' => 'You are using the latest version.']);
        }
    }
    public function getTagList()
    {
        $repoUrl = "https://api.github.com/repos/{$this->user}/Comprog-BIMS/releases";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $repoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Accept: application/vnd.github+json",
            "Authorization: Bearer {$this->accessToken}",
            'User-Agent: PHP Script'
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return "Failed to fetch tags."; // Handle error
        }

        curl_close($ch);

        $tags = json_decode($response, true);

        if (empty($tags)) {
            return "No tags found."; // Handle empty list
        }

        $tagList = "<nav id='TableOfContents'>";
        $tagList .= "<ul>";
        $tagList .= "<li><a href='#changelog' class='!border-blue-700 !after:opacity-100 !text-blue-700 dark:!border-blue-500 dark:!text-blue-500'>Changelog</a>";
        $tagList .= "<ul>";

        foreach ($tags as $tag) {
            $tagName = $tag['name'];
            $tagList .= "<li><a href='#v$tagName'>v$tagName</a></li>";
        }

        $tagList .= "</ul>";
        $tagList .= "</li>";
        $tagList .= "</ul>";
        $tagList .= "</nav>";

        return $tagList;
    }




    public function getLatestRelease()
    {
        $repoUrl = "https://api.github.com/repos/{$this->user}/Comprog-BIMS/releases";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $repoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Accept: application/vnd.github+json",
            "Authorization: Bearer {$this->accessToken}",
            'User-Agent: PHP Script'
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            curl_close($ch);
            return null;
        }
        curl_close($ch);

        $latestRelease = json_decode($response, true);
        return $latestRelease;
    }
    public function downloadAndExtractLatestRelease()
{
    $latestRelease = $this->getLatestRelease();
    if (is_null($latestRelease) || empty($latestRelease[0]['assets'])) {
        return "No latest release found or no assets available.";
    }

    // Assuming the first asset is the zip file you want to download
    $zipUrl = $latestRelease[0]['assets'][0]['browser_download_url'];
    $zipFilePath = $_SERVER['DOCUMENT_ROOT'] . '/latest_release.zip';

    // Download the zip file
    file_put_contents($zipFilePath, fopen($zipUrl, 'r'));

    // Extract the zip file
    $zip = new ZipArchive;
    if ($zip->open($zipFilePath) === TRUE) {
        // Extract it to the root directory
        $zip->extractTo($_SERVER['DOCUMENT_ROOT']);
        $zip->close();
        // Optionally, delete the zip file after extraction
        unlink($zipFilePath);
        return "Latest release extracted successfully.";
    } else {
        return "Failed to open the zip file.";
    }
}
}
