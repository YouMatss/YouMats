<?php

return [
    'perPage' => env('NOVA_LOGS_PER_PAGE', 10),
    'regexForFiles' => env('NOVA_LOGS_REGEX_FOR_FILES', '/^laravel/'),
];
