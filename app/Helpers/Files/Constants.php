<?php

// define link for uploads folders
define("LANGUAGE_PATH", 'language');
define("CATEGORY_PATH", 'category');
define("SUB_CATEGORY_PATH", 'subCategory');
define("PRODUCT_PATH", 'product');


// define validation
define('NULLABLE_VALIDATION', ['nullable']);
// String
define('REQUIRED_STRING_VALIDATION', ['required', 'string', 'max:191']);
define('NULLABLE_STRING_VALIDATION', ['nullable', 'string', 'max:191']);
define('REQUIRED_TEXT_VALIDATION', ['required', 'string']);
define('NULLABLE_TEXT_VALIDATION', ['nullable', 'string']);

// Integer
define('REQUIRED_INTEGER_VALIDATION', ['required', 'integer']);
define('NULLABLE_INTEGER_VALIDATION', ['nullable', 'integer']);
define('REQUIRED_NUMERIC_VALIDATION', ['required', 'numeric']);
define('NULLABLE_NUMERIC_VALIDATION', ['nullable', 'numeric']);

// Image
define('REQUIRED_IMAGE_VALIDATION', ['required', 'image', 'mimes:jpg,jpeg,png,gif,svg', 'max:1024']);
define('NULLABLE_IMAGE_VALIDATION', ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg', 'max:1024']);

// Array
define('ARRAY_VALIDATION', ['array']);

// Date
define('REQUIRED_DATE_VALIDATION', ['required', 'date']);
define('NULLABLE_DATE_VALIDATION', ['nullable', 'date']);

// Email
define('REQUIRED_EMAIL_VALIDATION', ['required', 'email', 'max:191']);
