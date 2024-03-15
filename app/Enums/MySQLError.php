<?php

namespace App\Enums;

class MySQLError
{
    const ER_DUP_ENTRY = 1062;
    const ER_BAD_NULL_ERROR = 1048;
    const ER_ACCESS_DENIED_ERROR = 1045;
    const ER_BAD_FIELD_ERROR = 1054;
    const ER_PARSE_ERROR = 1064;
    const ER_CANNOT_ADD_FOREIGN = 1215;
    const ER_NO_REFERENCED_ROW = 1452;
    const ER_NO_SUCH_TABLE = 1146;
    const ER_NO_DEFAULT_FOR_FIELD = 1364;
    const ER_TRUNCATED_WRONG_VALUE = 1366;

    public static function getMessage($code)
    {
        switch ($code) {
            case self::ER_DUP_ENTRY:
                return 'Duplicate entry violation for a unique key constraint';
            case self::ER_BAD_NULL_ERROR:
                return 'Column cannot be null and a null value is being inserted';
            case self::ER_ACCESS_DENIED_ERROR:
                return 'Access denied for a user to a particular database';
            case self::ER_BAD_FIELD_ERROR:
                return 'Unknown column in a query';
            case self::ER_PARSE_ERROR:
                return 'Syntax error in SQL query';
            case self::ER_CANNOT_ADD_FOREIGN:
                return 'Cannot add a foreign key constraint';
            case self::ER_NO_REFERENCED_ROW:
                return 'Cannot add or update a child row: foreign key constraint fails';
            case self::ER_NO_SUCH_TABLE:
                return 'Table does not exist';
            case self::ER_NO_DEFAULT_FOR_FIELD:
                return 'Field does not have a default value and is not nullable';
            case self::ER_TRUNCATED_WRONG_VALUE:
                return 'Incorrect integer value: a string is being inserted into an integer column';
            default:
                return null;
        }
    }
}
