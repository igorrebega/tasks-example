<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ApiException extends Exception
{
    /** @var int Status */
    private int $httpStatusCode;

    /** @var string Type */
    private string $errorType;

    /** @var string|null Hint how to solve exception */
    private ?string $hint;

    /** @var array If there are additional rows to add */
    private array $additionalRows = [];

    /**
     * Throw a new exception.
     *
     * @param string      $message        Error message
     * @param int         $code           Error code
     * @param string      $errorType      Error type
     * @param int         $httpStatusCode HTTP status code to send (default = 400)
     * @param null|string $hint           A helper hint
     * @param array       $additionalRows Rows
     */
    public function __construct($message, $code, $errorType, $httpStatusCode = 400, $hint = null, $additionalRows = [])
    {
        parent::__construct($message, $code);

        $this->httpStatusCode = $httpStatusCode;
        $this->errorType = $errorType;
        $this->hint = $hint;
        $this->additionalRows = $additionalRows;
    }

    /**
     * @return ApiException
     */
    public static function cannotRegisterUser()
    {
        $errorMessage = 'Can`t register new user';
        $hint = 'Check with backend';

        return new static($errorMessage, 1, 'cannot_register_user', 400, $hint);
    }

    /**
     * @param $userId
     *
     * @return static
     */
    public static function userNotActivated($userId)
    {
        $errorMessage = 'User account is not activated';
        $hint = 'Please activate user first';
        $additionalRows = [
            'user_id' => $userId
        ];

        return new static($errorMessage, 2, 'account_inactive', 400, $hint, $additionalRows);
    }

    /**
     * @return static
     */
    public static function cantSendSms()
    {
        $errorMessage = 'Cant send sms';
        $hint = 'Please check sms service settings';

        return new static($errorMessage, 3, 'cant_send_sms', 400, $hint);
    }

    /**
     * @return static
     */
    public static function cannotFindUserById()
    {
        $errorMessage = 'Can\' find user';
        $hint = 'Check user id';

        return new static($errorMessage, 4, 'cant_find_user_by_id', 400, $hint);
    }

    /**
     * @return static
     */
    public static function userAlreadyConfirmed()
    {
        $errorMessage = 'User already confirmed';

        return new static($errorMessage, 5, 'user_already_confirmed', 400);
    }

    /**
     * @return static
     */
    public static function wrongConfirmationCode()
    {
        $errorMessage = 'Wrong confirmation code';

        return new static($errorMessage, 6, 'wrong_confirmation_code', 400);
    }

    /**
     * @return static
     */
    public static function cGetDataFromFacebook()
    {
        $errorMessage = 'Cannot get data from Facebook';
        $hint = 'Check request that app makes to Facebook API';

        return new static($errorMessage, 7, 'cannot_get_data_from_facebook', 400, $hint);
    }

    /**
     * @return static
     */
    public static function taskAlreadyTakenByUser()
    {
        $errorMessage = 'Task was already taken by current user';

        return new static($errorMessage, 8, 'task_already_taken_by_user', 400);
    }

    /**
     * @return static
     */
    public static function wrongTaskType()
    {
        $errorMessage = 'Task type is wrong';
        $hint = 'Try to use other endpoint';

        return new static($errorMessage, 9, 'task_type_is_wrong', 400, $hint);
    }

    /**
     * @return static
     */
    public static function currentUserDontWorkWithTaskTask()
    {
        $errorMessage = 'Current user don`t work with this task';
        $hint = 'Check task id';

        return new static($errorMessage, 10, 'current_user_dont_work_with_task', 400, $hint);
    }

    /**
     * @return static
     */
    public static function taskExecutionTimeIsOut()
    {
        $errorMessage = 'Task execution time is out';

        return new static($errorMessage, 11, 'task_execution_time_is_out', 400);
    }

    /**
     * @return static
     */
    public static function userDontMakeAnyActionsWithThisTask()
    {
        $errorMessage = 'User don\'t make any actions with this task';

        return new static($errorMessage, 12, 'user_dont_make_any_actions_with_task', 400);
    }


    /**
     * @return static
     */
    public static function userTooFarFromTaskLocation()
    {
        $errorMessage = 'User too far from task location';

        return new static($errorMessage, 13, 'user_too_far_from_task_location', 400);
    }

    /**
     * @return ApiException
     */
    public static function taskAlreadyRemovedForUser()
    {
        $errorMessage = 'Task was already removed for current user';

        return new static($errorMessage, 14, 'task_already_removed_for_user', 400);
    }


    /**
     * @return ApiException
     */
    public static function userCantTakeTask()
    {
        $errorMessage = 'User can\'t take task';

        return new static($errorMessage, 15, 'user_cant_take_task', 400);
    }


    /**
     * @return ApiException
     */
    public static function taskAlreadyRemoved()
    {
        $errorMessage = 'Task was already removed for current user';

        return new static($errorMessage, 16, 'task_already_removed_for_user', 400);
    }

    /**
     * @return ApiException
     */
    public static function invalidCode()
    {
        $errorMessage = 'Password recovery code was invalid';

        return new static($errorMessage, 17, 'password_recovery_code_was_invalid', 400);
    }

    /**
     * @return ApiException
     */
    public static function cannotUpdatePassword()
    {
        $errorMessage = 'Password update exception';

        return new static($errorMessage, 18, 'password_update_exception', 400);
    }


    /**
     * @return ApiException
     */
    public static function notEnoughMoney()
    {
        $errorMessage = 'Not enough money';

        return new static($errorMessage, 19, 'not_enough_money', 400);
    }

    /**
     * @return ApiException
     */
    public static function somethingWentWrong()
    {
        $errorMessage = 'Something went wrong';

        return new static($errorMessage, 20, 'something_went_wrong', 400);
    }


    /**
     * @return string
     */
    public function getErrorType()
    {
        return $this->errorType;
    }

    /**
     * Get all headers that have to be send with the error response.
     *
     * @return array Array with header values
     */
    public function getHttpHeaders()
    {
        return [
            'Content-type' => 'application/json',
        ];
    }

    /**
     * Returns the HTTP status code to send when the exceptions is output.
     *
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @return null|string
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * Response
     *
     * @return Response
     */
    public function generateHttpResponse()
    {
        $headers = $this->getHttpHeaders();

        $payload = [
            'error' => $this->getErrorType(),
            'message' => $this->getMessage(),
        ];

        if ($this->hint !== null) {
            $payload['hint'] = $this->hint;
        }
        $payload = array_merge($payload, $this->additionalRows);

        return response(json_encode($payload), $this->getHttpStatusCode(), $headers);
    }
}
