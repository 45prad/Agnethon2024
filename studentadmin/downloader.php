<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function downloadFile($url, $destination)
{
    $fileData = file_get_contents($url);

    if ($fileData !== false) {
        if (file_put_contents($destination, $fileData) !== false) {
            echo "File downloaded successfully: $url\n";
        } else {
            echo "Error writing file to destination: $destination\n";
        }
    } else {
        echo "Error downloading file: $url\n";
    }
}

function getFilenameFromUrl($url)
{
    // Extract the filename from the URL
    $filename = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_FILENAME);

    // Sanitize the filename to remove non-alphanumeric characters
    $filename = preg_replace('/[^a-zA-Z0-9_\-]/', '', $filename);

    // Decode URL-encoded characters
    $filename = urldecode($filename);

    // Ensure the filename has the .pdf extension
    $filename .= '.pdf';

    return $filename;
}

function downloadAndZipLinks($links, $zipFileName)
{
    $tempDir = __DIR__ . '/temp';
    if (!file_exists($tempDir)) {
        mkdir($tempDir);
    }

    foreach ($links as $index => $link) {
        $fileName = $tempDir . '/file' . $index;

        // Debugging information
        echo "Downloading file: $link to $fileName\n";

        downloadFile($link, $fileName);
    }

    // Add a delay (you can adjust the sleep duration based on your needs)
    sleep(2);

    $zip = new ZipArchive();
    if ($zip->open($zipFileName, ZipArchive::CREATE) === true) {
        $files = glob($tempDir . '/*');
        foreach ($files as $file) {
            // Exclude the script file from the ZIP archive
            if ($file !== __FILE__) {
                $url = $links[array_search($file, $files)];
                $filename = getFilenameFromUrl($url);

                // Debugging information
                echo "Adding file to zip: $file as $filename\n";

                $zip->addFile($file, $filename);
            }
        }

        $zip->close();  // Close the zip file

        // Clean up temporary files after download and zip
        foreach ($files as $file) {
            unlink($file);
        }

        // Send headers for download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
        header('Content-Length: ' . filesize($zipFileName));

        // Flush and close output buffers
        ob_end_clean();

        // Read and output the file content
        readfile($zipFileName);

        // Delete the zipped folder
        unlink($zipFileName);

        // Delete the temporary directory
        rmdir($tempDir);

        exit;
    } else {
        echo "Failed to create zip file.";
    }
}

// Retrieve URLs from the POST parameter
$urls = isset($_POST['urls']) ? json_decode($_POST['urls'], true) : array();

if (empty($urls)) {
    echo "No files to download.";
} else {
    // Call the downloadAndZipLinks function with the array of URLs
    downloadAndZipLinks($urls, 'downloaded_files.zip');
}
?>
