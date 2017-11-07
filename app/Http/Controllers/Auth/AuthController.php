<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

//TODO Throttles the login attempts (use Illuminate\Foundation\Auth\ThrottlesLogins;)
// use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
// use Validator;

/**
 * The AuthController handles new user registration and authentication.
 */
class AuthController extends Controller {
    // use AuthenticatesAndRegistersUsers, ThrottlesLogins; //FIXME Uncomment this and use those features

    public $apiTokenLength = 60;

    /**
     * Create a new authentication controller instance.
     */
    public function __construct() {
        // $this->middleware('guest', ['except' => 'getLogout']); //FIXME uncomment this and add a guest (anonymous) account
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, User::$rules);
    }

    /**
     * Register a new user with the given username and email address.
     * //TODO Create this user as a temporary one, and send a confirmation email to the user to validate its email address
     *
     * @param Request $request
     *
     * @return $this|\Illuminate\Database\Eloquent\Model|null
     */
    public function register(Request $request) {
        $dataJSON = $request->all();

        // First, check that the given username or email does not already exists in the User table
        $alreadyExistingUsers = User::where([['username', '=', $dataJSON['username']]])
            ->orWhere([['email', '=', $dataJSON['email']]])
            ->count();
        // If found, fail
        if ($alreadyExistingUsers !== 0) {
            return null;
        }

        // If not, create the new user and return the new user info (with the API token and all, like when login in)
        //TODO Manage the case where the creation fails
        $newUser = User::create([
            'username'  => $dataJSON['username'],
            'email'     => $dataJSON['email'],
            'password'  => Hash::make($dataJSON['password']),
            'api_token' => str_random($this->apiTokenLength),
        ]);
        unset($newUser->password);
        unset($newUser->created_at);
        unset($newUser->updated_at);

        return $newUser; // Then return the user data
    }

    /**
     * Check the username/password against the hash in the database, and if found send the user info (along with the API token) back to the client.
     * If the username/password does not match anything in the database, return `null`.
     *
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function login(Request $request) {
        //TODO Allow the user to use his email instead of his username
        $dataJSON = $request->all();

        // Get the user
        $user = User::where([
            ['username', '=', $dataJSON['username']],
        ])->first(['username', 'id', 'email', 'api_token', 'password']);

        if (is_null($user)) { // No such user has been found
            return null;
        }

        if ($user->username === 'Anonymous') {
            // Prevent the user Anonymous to login
            return null;
        }

        // Check the password
        $isPasswordOk = Hash::check($dataJSON['password'], $user->password);
        if (!is_null($user) && $isPasswordOk) {
            // Return the API token as well as the username, id and email info
            // Remove the password hash from what we are sending to the client
            unset($user->password);

            return $user; // Then return the user data
        } else {
            return null; // The password is wrong
        }
    }

    /**
     * Logout the given user by re-generating a new API token and saving it.
     * Return `null` if the given user cannot be found or the API token is incorrect (to prevent malicious user to force an API token regeneration for another user than themselves).
     *
     * @param Request $request
     *
     * @return null|string
     */
    public function logout(Request $request) {
        $dataJSON = $request->all();

        // Get the user
        $user = User::where([
            ['username', '=', $dataJSON['username']],
        ])->first(['api_token', 'id']); //XXX Here it's VERY important to retrieve the 'id' otherwise the `$user->save()` method just does not work silently (cf. https://github.com/laravel/framework/issues/21886)

        if (is_null($user) || $user->username === 'Anonymous') { // No such user has been found
            // Also prevent changing the API token for the Anonymous user
            return null;
        }

        // Check the API token
        if ($user->api_token === $dataJSON['apiToken']) {
            // Then the user can be logged out correctly
            // To do that, we generate a new API token to invalidate the previous one
            $apiToken = str_random($this->apiTokenLength);
            $user->api_token = $apiToken;
            $user->save();
            //TODO What happens if by a very slim chance the generated API token is not unique? Use a while loop with a try/catch

            return 'ok'; // Then return a success message
        } else {
            return null; // The API Token is wrong
        }
    }

    /**
     * Return `'ok'` if the given username and API token are found in the user table, `null` otherwise.
     *
     * @param Request $request
     *
     * @return null|string
     */
    public function checkAPIToken(Request $request) {
        $dataJSON = $request->all();

        // Get the user
        $user = User::where([
            ['username', '=', $dataJSON['username']],
            ['api_token', '=', $dataJSON['apiToken']],
        ])->get();

        if (is_null($user)) { // No such user has been found
            return null;
        } else {
            return 'ok'; // The user has been found and the API Token is therefore valid
        }
    }
}
