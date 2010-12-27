<?php
include('utils/http.php');
ifNotModifiedSince(setLastModified()); // for pages with no data-dependency
//ifNotModifiedSince(setLastModified($data_modification_time)); // for data-dependent pages
include('utils/detectLanguage.php');
include('utils/detectMobile.php');
?>