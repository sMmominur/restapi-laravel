<?php

namespace App\Enums;

class Messages
{
    const RETRIEVED_SUCCESSFULLY = 'Records retrieved successfully';
    const CREATED_SUCCESSFULLY = 'Record created successfully';
    const FETCHED_SUCCESSFULLY = 'Record fetched successfully';
    const UPDATED_SUCCESSFULLY = 'Record updated successfully';
    const TRASHED_SUCCESSFULLY = 'Record trashed successfully';
    const VALIDATION_FAILED = 'Validation failed';
    const NO_QUERY_RESULTS = 'No record found';
    const NON_NUMERIC_ID = 'Provided id is not numeric';
    const FORBIDDEN = 'Forbidden | Insufficient rights to access this resource';
    const UNAUTHORIZED = 'Unauthorized';
    const LOGGED_OUT_SUCCESSFULLY = 'Successfully logged out';
    const INTERNAL_SERVER_ERROR_MESSAGE = "Internal Server Error";
    const UNAUTHORIZED_DOMAIN_OR_IP = "Unauthorized domain or IP";
    const LOGIN_SUCCESSFUL = "Login successful";
    
}
