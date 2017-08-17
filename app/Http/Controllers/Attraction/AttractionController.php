<?php 

namespace App\Http\Controllers\Attraction;

use App\Http\Controllers\Controller;

use App\Models\Attraction\AttractionReview;

use App\Models\User\User;
use Auth;
use Redirect;
use Request;
use Validator;
use Config;
use Response;

use App\Models\Attraction\Attraction;

class AttractionController extends Controller
{
    /**
     * Index action
     *
     * @return object
     */
    public function index()
    {
        /*BEGIN CHECK PERMISSION*/
        if ($this->checkPermission('read') == false) {
            return redirect('/auth/logout');
        }
        /*END CHECK PERMISSION*/

        $user = Auth::User();

        $results = Attraction::all();

        return view("attraction.index", array(
            'results' => $results,
            'user' => $user
        ));
    }

    /**
     * Create action
     *
     * @return object
     */
    public function create()
    {

        /*BEGIN CHECK PERMISSION*/
        if($this->checkPermission('create') == false) {
            return redirect('/auth/logout');
        }
        /*END CHECK PERMISSION*/

        /*BEGIN POST*/
        if(Request::isMethod('post')) {

            $data = Request::input();

            $rules = Attraction::$rules;
            $messages = Attraction::$messages;

            $validator = Validator::make($data, $rules, $messages);

            if($validator->fails()) {
                return Redirect::action('Attraction\AttractionController@create', array())->withInput()->withErrors($validator);
            }

            Attraction::create($data);

            return Redirect::action('Attraction\AttractionController@index');
        }
        /*END POST*/

        return view("attraction.create", array(
        ));
    }

    /**
     * Edit action
     *
     * @return object
     */
    public function edit()
    {

        /*BEGIN CHECK PERMISSION*/
        if($this->checkPermission('update') == false) {
            return redirect('/auth/logout');
        }
        /*END CHECK PERMISSION*/

        $id = request()->get('id');

        try {
            $attraction = Attraction::findOrFail($id);
        }
        catch (\Exception $ex) {
            return redirect('/auth/logout');
        }

        /*BEGIN POST*/
        if(Request::isMethod('post')) {

            $data = Request::input();

            $rules = Attraction::$rules;
            $messages = Attraction::$messages;

            $validator = Validator::make($data, $rules, $messages);

            if($validator->fails()) {
                return Redirect::action('Attraction\AttractionController@create', array('id' => $id))->withInput()->withErrors($validator);
            }

            $attraction->update($data);

            return Redirect::action('Attraction\AttractionController@index');
        }
        /*END POST*/

        return view("attraction.edit", array(
            'result' => $attraction,

        ));
    }

    /**
     * Delete action
     *
     * @return object
     */
    public function delete()
    {

        /*BEGIN CHECK PERMISSION*/
        if($this->checkPermission('delete') == false) {
            return redirect('/auth/logout');
        }
        /*END CHECK PERMISSION*/

        $id = request()->get('id');

        try {
            $attraction = Attraction::findOrFail($id);
        }
        catch (\Exception $ex) {
            return redirect('/auth/logout');
        }

        try {
            $attraction->delete();

        }
        catch (\Exception $ex) {
                dump('Cannot be deleted because item is in use !');
        }

        return Redirect::action('Attraction\AttractionController@index');

    }

    /**
     * Top 5 attractions action
     *
     * @return object
     */
    public function topAttractions()
    {

        /*BEGIN CHECK PERMISSION*/
        if($this->checkPermission('read') == false) {
            return redirect('/auth/logout');
        }
        /*END CHECK PERMISSION*/


        /*Give me all attractions*/
        $attractions = Attraction::all();

        $average = array();
        foreach ($attractions as $key => $value){

            /*Find all five stars*/
            $five = AttractionReview::where('rating', 5)->where('attraction_id', $value->id)->where('isHidden', 0)->get();
            $four = AttractionReview::where('rating', 4)->where('attraction_id', $value->id)->where('isHidden', 0)->get();
            $three = AttractionReview::where('rating', 3)->where('attraction_id', $value->id)->where('isHidden', 0)->get();
            $two = AttractionReview::where('rating', 2)->where('attraction_id', $value->id)->where('isHidden', 0)->get();
            $one = AttractionReview::where('rating', 1)->where('attraction_id', $value->id)->where('isHidden', 0)->get();

            $x = 5 * count($five) + 4 * count($four) + 3 * count($three) + 2 * count($two) + 1 * count($one);
            $y = count($five) + count($four) + count($three) + count($two) + count($one);

            if($y >= 1){
                $average[$value->id] = $x / $y;
            }
            else{
                $average[$value->id] = 0;
            }

        }

        asort($average);

        return view("attraction.top-index", array(
            'results' => $attractions,
            'average' => $average
        ));

    }

    /**
     * Reviews
     *
     * @return object
     */
    public function reviews()
    {

        /*BEGIN CHECK PERMISSION*/
        if($this->checkPermission('read') == false) {
            return redirect('/auth/logout');
        }
        /*END CHECK PERMISSION*/

        $id = request()->get('attraction_id');

        try {
            $attraction = Attraction::findOrFail($id);
        } catch (\Exception $ex) {
            return redirect('/auth/logout');
        }

        /*Get the reviews*/
        $results = AttractionReview::where('attraction_id', $attraction->id)->orderBy('created_at', 'DESC')->get();

        //dd($results);

        return view("attraction.reviews.index", array(
            'results' => $results,
            'attraction' => $attraction

        ));
    }


    /**
     * Change status action
     *
     * @return object
     */
    public function changeStatus()
    {

        /*Check attraction*/
        $attraction_id = request()->get('attraction_id');

        try {
            $attraction = Attraction::findOrFail($attraction_id);
        }
        catch (\Exception $ex) {
            return redirect('/auth/logout');
        }

        /**/
        $reviews_id = request()->get('reviews_id');

        try {
            $review = AttractionReview::findOrFail($reviews_id);
        }
        catch (\Exception $ex) {
            return redirect('/auth/logout');
        }

        if($review->isHidden == 0){
            $review->isHidden = 1;
        }
        else{
            $review->isHidden = 0;
        }

        $review->save();

        return Redirect::action('Attraction\AttractionController@reviews', array('attraction_id' => $attraction_id));

    }


    /**
     * Edit review action
     *
     * @return object
     */
    public function editReview()
    {

        /*BEGIN CHECK PERMISSION*/
        if($this->checkPermission('editReview') == false) {
            return redirect('/auth/logout');
        }
        /*END CHECK PERMISSION*/

        $id = request()->get('reviews_id');

        try {
            $review = AttractionReview::findOrFail($id);
        }
        catch (\Exception $ex) {
            return redirect('/auth/logout');
        }

        /*BEGIN POST*/
        if(Request::isMethod('post')) {

            $rating = Request::input('rating');

            $review->rating = $rating;

            $review->save();
        }
        /*END POST*/

        return view("attraction.reviews.edit", array(
            'result' => $review,

        ));


    }


    /**
     * Edit my review action
     *
     * @return object
     */
    public function editMyReview()
    {

        /*BEGIN CHECK PERMISSION*/
        if($this->checkPermission('editReview') == false) {
            return redirect('/auth/logout');
        }
        /*END CHECK PERMISSION*/

        $user_id = request()->get('user_id');

        try {
            $user = User::findOrFail($user_id);
        }
        catch (\Exception $ex) {
            return redirect('/auth/logout');
        }


        $attraction_id = request()->get('attraction_id');

        try {
            $review = AttractionReview::where('user_id', $user_id)->where('attraction_id', $attraction_id)->first();
        }
        catch (\Exception $ex) {
            return redirect('/auth/logout');
        }

        /*BEGIN POST*/
        if(Request::isMethod('post')) {

            $rating = Request::input('rating');

            $review->rating = $rating;

            $review->save();
        }
        /*END POST*/

        return view("attraction.reviews.edit_my_review", array(
            'result' => $review,
            'user' => $user,
            'attraction_id'=> $attraction_id


        ));


    }


    /**
     * Create review action
     *
     * @return object
     */
    public function createReview()
    {

        /*BEGIN CHECK PERMISSION*/
        if($this->checkPermission('createReview') == false) {
            return redirect('/auth/logout');
        }
        /*END CHECK PERMISSION*/

        /*Check attraction*/
        $attraction_id = request()->get('attraction_id');

        $user = Auth::User();

        /*If user - only one review*/
        $userReview = null;
        if($user->group->locked != 1){
            /*Check if review exists*/
            $userReview = AttractionReview::where('user_id', $user->id)->where('attraction_id', $attraction_id)->get();

            if(count($userReview) >= 1){
                dump('You are not allowed to review more than once');
            }
        }

        /*BEGIN POST*/
        if(Request::isMethod('post')) {

            $data = Request::input();

            $rules = AttractionReview::$rules;
            $messages = AttractionReview::$messages;

            unset($data['email']);
            unset($data['_token']);

            $validator = Validator::make($data, $rules, $messages);

            if($validator->fails()) {
                dump('validation failed');
            }

            AttractionReview::create($data);
            if($user->group->locked != 1){
                return Redirect::action('Attraction\AttractionController@reviews', array('attraction_id' => $attraction_id));

            }else{
                return Redirect::action('Attraction\AttractionController@reviews', array('attraction_id' => $attraction_id));

            }
        }
        /*END POST*/


        return view("attraction.reviews.create", array(
            'user'=> $user,
            'attraction_id'=> $attraction_id
        ));



    }

}