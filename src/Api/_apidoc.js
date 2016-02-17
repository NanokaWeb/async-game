// ------------------------------------------------------------------------------------------
// General apiDoc documentation blocks and old history blocks.
// ------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------
// Current Success.
// ------------------------------------------------------------------------------------------
/**
 * @apiDefine UserSuccess
 * @apiSuccess {Object} data                  User profile information.
 * @apiSuccess {String} data.id               Id of the User.
 * @apiSuccess {String} data.name             Name of the User.
 * @apiSuccess {String} data.first_name       Firstname of the User.
 * @apiSuccess {String} data.last_name        Lastname of the User.
 * @apiSuccess {String} data.picture          Profile picture url of the User.
 * @apiSuccess {Number} data.coins            Coins of the User.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "data": {
 *             "id": "rAKZeEDqBO",
 *             "name": "John Doe",
 *             "first_name": "John",
 *             "last_name": "Doe",
 *             "picture": "http:\/\/lorempixel.com\/200\/200\/?44520",
 *             "coins": "14"
 *         }
 *     }
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "data": {
 *             "id": "rDKZeEZqEO",
 *             "name": "Guest 52",
 *             "first_name": "",
 *             "last_name": "",
 *             "picture": "http:\/\/lorempixel.com\/200\/200\/?44520",
 *             "coins": "14"
 *         }
 *     }
 */
/**
 * @apiDefine GamesSuccess
 * @apiSuccess {Object[]} data                  Game information.
 * @apiSuccess {String}   data.id               Id of the Game.
 * @apiSuccess {Object}   data.data             Data of the Game (JSON Format).
 * @apiSuccess {Number}   data.score            Score of the Game.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *        "data":[
 *           {
 *              "id": "1nyWgDGREY",
 *              "data": {
 *                  "someData"
 *              },
 *              "score": 20
 *           },
 *           {
 *              "id": "kVZWl9GxvJ",
 *              "data": {
 *                  "someOtherData"
 *              },
 *              "score": 35
 *           }
 *        ]
 *     }
 */
/**
 * @apiDefine SeedsSuccess
 * @apiSuccess {Object[]} data                  Seed information.
 * @apiSuccess {String}   data.id               Id of the seed.
 * @apiSuccess {Number}   data.key              Key of the seed for the client generation.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "data": {
 *             "id": "kVvG29W8Rg",
 *             "key": "3"
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