<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentTypeCms;
use App\Models\EntertainmentBanner;
use App\Models\Product;

/**
 * @group Product
 *
 * APIs for Prduct Listing
 */

class ProductController extends Controller
{
    /**
    * Show  Api
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    *   @response 200{
    *   "status": true,
    *   "statusCode": 200,
    *   "message": "Show details found successfully",
    *   "data": {
    *       "content": {
    *           "id": 1,
    *           "type": "show",
    *           "title": "Show",
    *           "description": "Show description",
    *           "image": "show.jpg",
    *           "created_at": "2021-08-25T06:00:00.000000Z",
    *           "updated_at": "2021-08-25T06:00:00.000000Z"
    *       },
    *       "banner": [
    *           {
    *               "id": 1,
    *               "banner_type": "Shows",
    *               "banner_image": "show1.jpg",
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           },
    *           {
    *               "id": 2,
    *               "banner_type": "Shows",
    *               "banner_image": "show2.jpg",
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           }
    *       ],
    *       "top_10_shows": [
    *           {
    *               "id": 1,
    *               "type": "shows",
    *               "title": "Show 1",
    *               "description": "Show 1 description",
    *               "image": "show1.jpg",
    *               "top_10_status": 1,
    *               "popular_status": 0,
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           },
    *       ],
    *       "popular_shows": [
    *           {
    *               "id": 2,
    *               "type": "shows",
    *               "title": "Show 2",
    *               "description": "Show 2 description",
    *               "image": "show2.jpg",
    *               "top_10_status": 0,
    *               "popular_status": 1,
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           }
    *       ]
    *   }
    * }
    * @response 200{
    *   "status": false,
    *   "statusCode": 200,
    *   "message": "No show found"
    * }
    * @response 500{
    *   "status": 500,
    *   "message": "Something went wrong",
    *   "error": "Error message"
    * }
    
    */
    public function showDetail(Request $request)
    {
        
        try{
            $show = ContentTypeCms::where('type', 'show')->first();
            $show_banner = EntertainmentBanner::where('banner_type','Shows')->orderBy('id','asc')->get();
            $top_10_shows = Product::where('top_10_status', 1)->where('type','shows')->get();
            $popular_shows = Product::where('popular_status', 1)->where('type','shows')->get();
            
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Show details found successfully',
                'data' => [
                    'content' => $show,
                    'banner' => $show_banner,
                    'top_10_shows' => $top_10_shows,
                    'popular_shows' => $popular_shows 
                ]
            ]);
            
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 401,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
    * Movie  Api
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    *   @response 200{
    *   "status": true,
    *   "statusCode": 200,
    *   "message": "Movie details found successfully",
    *   "data": {
    *       "content": {
    *           "id": 1,
    *           "type": "movie",
    *           "title": "Movie",
    *           "description": "Movie description",
    *           "image": "movie.jpg",
    *           "created_at": "2021-08-25T06:00:00.000000Z",
    *           "updated_at": "2021-08-25T06:00:00.000000Z"
    *       },
    *       "banner": [
    *           {
    *               "id": 1,
    *               "banner_type": "Movies",
    *               "banner_image": "movie1.jpg",
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           },
    *           {
    *               "id": 2,
    *               "banner_type": "Movies",
    *               "banner_image": "movie2.jpg",
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           }
    *       ],
    *       "top_10_movies": [
    *           {
    *               "id": 1,
    *               "type": "movie",
    *               "title": "Movie 1",
    *               "description": "Movie 1 description",
    *               "image": "movie1.jpg",
    *               "top_10_status": 1,
    *               "popular_status": 0,
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           },
    *       ],
    *       "popular_movies": [
    *           {
    *               "id": 2,
    *               "type": "movie",
    *               "title": "Movie 2",
    *               "description": "Movie 2 description",
    *               "image": "movie2.jpg",
    *               "top_10_status": 0,
    *               "popular_status": 1,
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           }
    *       ]
    *   }
    * }
    * @response 200{
    *   "status": false,
    *   "statusCode": 200,
    *   "message": "No movie found"
    * }
    * @response 500{
    *   "status": 500,
    *   "message": "Something went wrong",
    *   "error": "Error message"
    * }
    
    */

    public function movieDetail()
    {
        try{
            $movie = ContentTypeCms::where('type', 'movie')->first();
            $movie_banner = EntertainmentBanner::where('banner_type','Movies')->orderBy('id','asc')->get();
            $top_10_movies = Product::where('top_10_status', 1)->where('type','movie')->get();
            $popular_movies = Product::where('popular_status', 1)->where('type','movie')->get();
            
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Movie details found successfully',
                'data' => [
                    'content' => $movie,
                    'banner' => $movie_banner,
                    'top_10_movies' => $top_10_movies,
                    'popular_movies' => $popular_movies 
                ]
            ]);
           
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 401,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
    * Kid  Api
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    *   @response 200{
    *   "status": true,
    *   "statusCode": 200,
    *   "message": "Kid details found successfully",
    *   "data": {
    *       "content": {
    *           "id": 1,
    *           "type": "kid",
    *           "title": "Kid",
    *           "description": "Kid description",
    *           "image": "kid.jpg",
    *           "created_at": "2021-08-25T06:00:00.000000Z",
    *           "updated_at": "2021-08-25T06:00:00.000000Z"
    *       },
    *       "banner": [
    *           {
    *               "id": 1,
    *               "banner_type": "Kids",
    *               "banner_image": "kid1.jpg",
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           },
    *           {
    *               "id": 2,
    *               "banner_type": "Kids",
    *               "banner_image": "kid2.jpg",
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           }
    *       ],
    *       "top_10_kids": [
    *           {
    *               "id": 1,
    *               "type": "kid",
    *               "title": "Kid 1",
    *               "description": "Kid 1 description",
    *               "image": "kid1.jpg",
    *               "top_10_status": 1,
    *               "popular_status": 0,
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           },
    *       ],
    *       "popular_kids": [
    *           {
    *               "id": 2,
    *               "type": "kid",
    *               "title": "Kid 2",
    *               "description": "Kid 2 description",
    *               "image": "kid2.jpg",
    *               "top_10_status": 0,
    *               "popular_status": 1,
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           }
    *       ]
    *   }
    * }
    * @response 200{
    *   "status": false,
    *   "statusCode": 200,
    *   "message": "No kid found"
    * }
    * @response 500{
    *   "status": 500,
    *   "message": "Something went wrong",
    *   "error": "Error message"
    * }
    
    */
    

    public function kidDetail()
    {
        try{
            $kid = ContentTypeCms::where('type', 'kid')->first();
            $kid_banner = EntertainmentBanner::where('banner_type','Kids')->orderBy('id','asc')->get();
            $top_10_kids = Product::where('top_10_status', 1)->where('type','kids')->get();
            $popular_kids = Product::where('popular_status', 1)->where('type','kids')->get();
           
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Kid details found successfully',
                'data' => [
                    'content' => $kid,
                    'banner' => $kid_banner,
                    'top_10_kids' => $top_10_kids,
                    'popular_kids' => $popular_kids 
                ]
            ]);
            
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 401,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
    * Unbeatable-Variety  Api
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    *   @response 200{
    *   "status": true,
    *   "statusCode": 200,
    *   "message": "Unbeatable variety details found successfully",
    *   "data": {
    *       "content": [
    *           {
    *               "id": 1,
    *               "type": "unbeatable",
    *               "title": "Unbeatable",
    *               "description": "Unbeatable description",
    *               "image": "unbeatable.jpg",
    *               "unbeatable_status": 1,
    *               "created_at": "2021-08-25T06:00:00.000000Z",
    *               "updated_at": "2021-08-25T06:00:00.000000Z"
    *           }
    *       ]
    *   }
    * }
    * @response 200{
    *   "status": false,
    *   "statusCode": 200,
    *   "message": "No unbeatable variety found"
    * }
    * @response 500{
    *   "status": 500,
    *   "message": "Something went wrong",
    *   "error": "Error message"
    * }

    */

    public function unbeatableVariety(Request $request)
    {
        try{
            $unbeatable_variety = Product::where('unbeatable_status', 1)->get();
            if($unbeatable_variety->isEmpty()){
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No unbeatable variety found',
                ]);
            }
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Unbeatable variety details found successfully',
                'data' => [
                    'content' => $unbeatable_variety
                ]
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 401,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }

}
