// ------------------------------------------------------------------------------------------
// General apiDoc documentation blocks and old history blocks.
// ------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------
// Current Success.
// ------------------------------------------------------------------------------------------
/**
 * @apiDefine UserSuccess
 * @apiSuccess {Object} data                  User profile information.
 * @apiSuccess {Number} data.id               Id of the User.
 * @apiSuccess {String} data.first_name       Firstname of the User.
 * @apiSuccess {String} data.last_name        Lastname of the User.
 * @apiSuccess {Number} data.facebook_user_id Facebook id of the User.
 * @apiSuccess {String} data.picture          Profile picture url of the User.
 * @apiSuccess {Number} data.coins            Coins of the User.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "data": {
 *             "id": 4,
 *             "first_name": "John",
 *             "last_name": "Doe",
 *             "facebook_user_id": 122525564,
 *             "picture": "http:\/\/lorempixel.com\/200\/200\/?44520",
 *             "coins": "14"
 *         }
 *     }
 */

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