<?php
function renderPagination($totalPages, $currentPage, $maxPageNumbersToShow = 10) {
    // Ensure the current page is within bounds
    if ($currentPage < 1) {
        $currentPage = 1;
    } elseif ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    // Calculate the range of pages to display
    $startPage = max(1, $currentPage - floor($maxPageNumbersToShow / 2));
    $endPage = min($totalPages, $startPage + $maxPageNumbersToShow - 1);

    // Adjust startPage if endPage doesn't fill the maxPageNumbersToShow
    if ($endPage - $startPage + 1 < $maxPageNumbersToShow) {
        $startPage = max(1, $endPage - $maxPageNumbersToShow + 1);
    }

    // Generate pagination links
    echo '<div class="pagination">';

    // Previous button
    if ($currentPage > 1) {
        echo '<a href="?page=' . ($currentPage - 1) . '">&laquo; Previous</a>';
    } else {
        echo '<span class="disabled">&laquo; Previous</span>';
    }

    // Page number links
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            echo '<span class="current">' . $i . '</span>';
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
    }

    // Next button
    if ($currentPage < $totalPages) {
        echo '<a href="?page=' . ($currentPage + 1) . '">Next &raquo;</a>';
    } else {
        echo '<span class="disabled">Next &raquo;</span>';
    }

    echo '</div>';
}

// Example usage
$totalPages = 50;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
renderPagination($totalPages, $currentPage);
?>
