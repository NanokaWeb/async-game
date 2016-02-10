// ------------------------------------------------------------------------------------------
// General apiDoc documentation blocks and old history blocks.
// ------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------
// Current Success.
// ------------------------------------------------------------------------------------------


// ------------------------------------------------------------------------------------------
// Current Errors.
// ------------------------------------------------------------------------------------------
/**
 * @apiDefine UserNotFoundError
 * @apiError UserNotFound The <code>id</code> of the User was not found.
 * @apiErrorExample {json} UserNotFound - Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "message": "User not found.",
 *       "status_code": 404
 *     }
 */
/**
 * @apiDefine ApiLimitError
 * @apiError ApiLimit The user has exceeded API rate limit.
 * @apiErrorExample {json} ApiLimit - Error-Response:
 *     HTTP/1.1 403 Not Found
 *     {
 *       "message": "You have exceeded your rate limit.",
 *       "status_code": 403
 *     }
 */