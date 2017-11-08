<?php

namespace App\Http\Controllers;

use App\Snap;
use App\User;
use Illuminate\Http\Request;


class SnapController extends Controller
{
    /**
     * Show all the snaps
     */
    public function index ()
    {
        return Snap::with( 'user' )->orderByDesc( 'updated_at' )->get();
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Snap|array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function show ( $id )
    {
        try {
            return Snap::with( 'user' )->where( 'id', $id )->firstOrFail();
        } catch ( \Exception $error ) {
            return [
                'error'        => TRUE,
                'errorMessage' => 'Unable to find the snap [' . $id . ']',
            ];
        }
    }


    /**
     * @param Request $request
     *
     * @return array
     */
    public function create ( Request $request )
    {
        try {
            $this->validate( $request, [
                'title'   => 'required',
                'content' => 'required',
            ] );

            Snap::create( $request->all() );

            return [
                'error'   => FALSE,
                'message' => 'Creating the snap "' . $request->get( 'title' ) . '" was successful.',
            ];
        } catch ( \Exception $error ) {
            return [
                'error'        => TRUE,
                'errorMessage' => "Unable to create the Snap.",
            ];
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function update ( Request $request )
    {
        $dataJSON = $request->all();
        $username = $dataJSON[ 'username' ];
        $apiToken = $dataJSON[ 'apiToken' ];

        // Check that the user exist
        //FIXME Use a middleware instead of manually checking for the API token/username
        $user = User::where( [
            [ 'username', '=', $username ],
            [ 'api_token', '=', $apiToken ],
        ] )->first();

        if ( is_null( $user ) ) {
            return [
                'error'        => TRUE,
                'errorMessage' => "User unknown ; cannot update any Snap",
            ];
        }

        try {
            $snapToEdit = Snap::findOrFail( $snapData[ 'id' ] );

            // Then check that it's the same as the snap owner
            if ( $snapToEdit->user_id != $user->id ) { //XXX Compare the string '2' and number 2 with `!=` (and not `!==`)
                return [
                    'error'        => TRUE,
                    'errorMessage' => "You cannot edit a Snap that do not belong to you.",
                ];
            }

            // Everything is ok, update the Snap
            $snapToEdit->title       = $snapData[ 'title' ];
            $snapToEdit->content     = $snapData[ 'content' ];
            $snapToEdit->slug        = $snapData[ 'slug' ];
            $snapToEdit->favorite    = $snapData[ 'favorite' ];
            $snapToEdit->timesViewed = $snapData[ 'timesViewed' ];
            $snapToEdit->timesEdited = $snapData[ 'timesEdited' ];
            $snapToEdit->save();

            return [
                'error'   => FALSE,
                'message' => 'Updating the snap ' . $snapData[ 'id' ] . ' was successful.',
            ];
        } catch ( \Exception $error ) {
            return [
                'error'        => TRUE,
                'errorMessage' => "Unable to find the snap with id " . $snapData[ 'id' ] . ".",
            ];
        }
    }


    /**
     * Increment the view count for the given Snap id
     *
     * @param Request $request
     *
     * @return array
     */
    public function incrementViews ( Request $request )
    {
        $dataJSON = $request->all();
        $snapId   = $dataJSON[ 'snapId' ];

        try {
            // No check for a valid user is needed here
            $snapToEdit = Snap::findOrFail( $snapId );

            // Update the Snap view count
            $snapToEdit->timesViewed++;
            $snapToEdit->timestamps = FALSE; // This disables the updates of the timestamps (particularly `updated_at`)
            $snapToEdit->save();

            return [
                'error'   => FALSE,
                'message' => "Updating the snap $snapId was successful.",
            ];
        } catch ( \Exception $error ) {
            return [
                'error'        => TRUE,
                'errorMessage' => "Unable to find the snap with id $snapId.",
            ];
        }
    }

    /**
     * Delete the Snap with the given $id
     *
     * @param $id
     *
     * @return int
     */
    public function destroy ( $id )
    {
        return Snap::destroy( $id );
    }

    /**
     * Fool the browsers that send a pre-flight CORS request
     *
     * @param Request $request
     */
    public function cors ( Request $request )
    {
        // NOP command
        // ...just to fool the CORS checks
        // dd($request);
    }
}
