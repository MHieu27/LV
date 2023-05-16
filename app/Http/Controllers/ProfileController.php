<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use OpenCF\RecommenderService;
use Illuminate\Http\Response;
use Laudis\Neo4j\Basic\Session as BasicSession;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }

    public function index ()
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $queryMyProfile = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID})
        OPTIONAL MATCH (u)<-[:`Theo dõi`]-(follower:User)
        OPTIONAL MATCH (u) - [:`Đăng bài`] -> (p:Post)
        OPTIONAL MATCH (p) <- [:`Thích`] - (liked:User)
        RETURN  COUNT(follower) as totalFollower,u.Username as username, p.post_content as post_content, p.post_img as post_img, p.post_nowtime as post_nowtime, p.id as postID, count(liked) as liked
        CYPHER,
        [
            'myID' => $myID
        ]);
        $myProfiles = [];
        foreach($queryMyProfile as $value) {
            array_push($myProfiles,$value);
        }
        //return response($myProfiles);
        return view('profile',['user' => $user, 'myFollower' => $value['totalFollower'], 'myProfiles' => $myProfiles, 'id' => $user['id']]);
    }

    public function updateProfileView ()
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $id})
        RETURN u.id as id, u.Username as username, u.birthday as birthday, u.address as address, u.email as email
        CYPHER,[
            'id' => $myID
        ]);
        //return response($result['id']);
        return view('update-profile', ['myID' => $myID]);
    }

    public function updateProfile (Request $request) 
    {
        $update_profile = $request->all();
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $queryUpdateProfile = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID})
        SET u.Username = $username, u.birthday = $birthday, u.bio = $bio, u.gender = $gender, u.address = $address
        RETURN u.id as id, u.Username as username, u.birthday as birthday, u.address as address, u.email as email, u.gender as gender
        CYPHER,
        [
            'myID' => $myID,
            'username' => $update_profile['update_name'],
            'birthday' => $update_profile['update_birthday'],
            'bio' => $update_profile['update_bio'],
            'gender' => $update_profile['update_gender'],
            'address' => $update_profile['update_address']
        ]);

        // $updateProfiles = [];
        // foreach($queryUpdateProfile as $value)
        // {
        //     array_push($updateProfiles, $value);
        // }
        return redirect() -> route('profile');
    }

    public function updatePost (Request $request, $id)
    {
        $updatePost = $request->all();
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $postID = intval($id);
        $file = $request->update_file;
        $file_name = $file->getClientoriginalName();
        $file->move(public_path('uploads'), $file_name);
        $queryUpdatePost = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID}), (p:Post{id: $postID})
        OPTIONAL MATCH (u) -[:`Đăng bài`] -> (p)
        SET p.post_content = $update_content, p.post_img = $update_img
        CYPHER,
        [
            'myID' => $myID,
            'postID' => $postID,
            'update_content' => $updatePost['update_content'],
            'update_img' => $file_name
        ]);

        return redirect() -> route ('profile');

    }

    public function deletePost ($id)
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $postID = intval($id);
        $queryDeletePost = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID}), (p:Post{id: $postID})
        DETACH DELETE p
        CYPHER,
        [
            'myID' => $myID,
            'postID' => $postID,
        ]);
        return redirect() -> route ('profile');
    }

    public function profileOrderUser ($id)
    {
        //profile view
        $user = new UserResource(User::findOrFail(Auth::id()));
        $checkUser = Auth::id();
        $orderUserID = intval($id);
        $myID = intval($user->id);
        $result2 = $this->session->run(<<<'CYPHER'
        MATCH (n:User{id: $orderUserID})
        MATCH (u:User{id: $myID})
        OPTIONAL MATCH (n)<-[:`Theo dõi`]-(follower:User)
        OPTIONAL MATCH (u) -[rel:`Theo dõi`] -> (n)
        RETURN n.id as id, n.Username as username, n.birthday as birthday, n.address as address, n.email as email, n.gender as gender, rel as follow, COUNT(follower) as totalFollower
        CYPHER,
        [
            'orderUserID' => $orderUserID,
            'myID' => $myID
        ]);
        $profileUsers = [];
        foreach($result2 as $result) {
            array_push($profileUsers, $result);

        }
        if($checkUser == $result['id']){
            return redirect() -> route('profile');
        }
        //showcomment
        //post view
        $queryPostView = $this->session->run(<<<'CYPHER'
        MATCH (n:User{id: $orderUserID})
        MATCH (u:User{id: $myID})
        OPTIONAL MATCH (n) -[:`Đăng bài`] -> (p:Post)
        OPTIONAL MATCH (p:Post) <- [:`Thích`] - (liked:User)
        OPTIONAL MATCH (comment:User) - [rel:`Bình luận`] -> (p:Post)
        RETURN n.id as id, n.Username as username, p.post_content as post_content, p.post_img as post_img, p.post_nowtime as post_nowtime, p.id as postID, count(liked) as liked, count(comment) as totalComment, rel.content as comment
        CYPHER,
        [
            'orderUserID' => $orderUserID,
            'myID' => $myID
        ]);
        $array = [];
        $postViews = [];


            // foreach($queryPostView as $value){
            //     if(!isset($postViews[$value['postID']]))
            //     {
            //         $postViews[$value['postID']] = [$value];
            //     }
            //     $postViews[$value['postID']][] = [$value['comment']];
            //     // array_push($postViews, $value);
            // };
        foreach($queryPostView as $value)
        {
            array_push($postViews, $value);
        }

        //checklike
        $queryCheckLiked = $this->session->run(<<<'CYPHER'
        MATCH (n:User{id: $orderUserID})
        MATCH (u:User{id: $myID})
        OPTIONAL MATCH (n) -[:`Đăng bài`] -> (p:Post)
        OPTIONAL MATCH (u) - [rel:`Thích`] -> (p)
        RETURN rel as liked
        CYPHER,
        [
            'orderUserID' => $orderUserID,
            'myID' => $myID
        ]);

        foreach ($queryCheckLiked as $checkLiked)
        {

        }
        //dd($postViews);
        //return response($postViews);
        return view('profile2',['user' => $user, 'profileUsers' => $profileUsers, 'postViews' => $postViews, 'checkLiked' => $checkLiked['liked']]);

    }

    public function followUser ($id) 
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $orderUserID = intval($id);
        $myID = intval($user->id);

        $result = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID})
        MATCH (u2:User{id: $orderUserID})
        OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        WITH u, u2, rel
        WHERE rel IS NULL
        CREATE (u) - [r:`Theo dõi`] -> (u2)
        RETURN u, u2, r as follow;
        CYPHER,
        [
            'myID' => $myID,
            'orderUserID' => $orderUserID,
        ]);
        // MATCH (u:User{id: $myID})
        // MATCH (u2:User{id: $orderUserID})
        // OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        // WITH u, u2, rel
        // WHERE rel IS NULL
        // CREATE (u) - [r:`Theo dõi`] -> (u2)
        // RETURN u, u2, r as follow;

        // $checkFollow = [];
        // foreach($result as $value){
        //     array_push($checkFollow, $value);
        // }


        // MATCH (u:User {id: 9}),(u2:User {id: 2})
        // CALL {
        // OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        // WITH u, u2, rel
        // WHERE rel IS NULL
        // CREATE (u) - [r:`Theo dõi`] -> (u2)
        // }
        // CALL {
        // OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        // WITH u, u2, rel
        // WHERE rel IS NOT NULL
        // DELETE rel
        // }
        // RETURN u, u2;
        //return($result);
        return redirect() -> route('profile2', ['id' => $orderUserID]);
    }

    public function unFollowUser ($id)
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $orderUserID = intval($id);
        $myID = intval($user->id);

        $result = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID})
        MATCH (u2:User{id: $orderUserID})
        OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        WITH u, u2, rel
        WHERE rel IS NOT NULL
        DELETE rel
        RETURN u, u2
        CYPHER,
        [
            'myID' => $myID,
            'orderUserID' => $orderUserID,
        ]);

        return redirect() -> route('profile2', ['id' => $orderUserID]);
    }

    public function createPost (Request $request)
    {
        $contentPost = $request->all();
        // dd($contentPost);
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $file = $request->post_img;
        $file_name = $file->getClientoriginalName();
        $file->move(public_path('uploads'), $file_name);
        $queryCreatePost= $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID})
        CREATE (u)-[:`Đăng bài`]->(post:Post{post_content: $post_content, post_img: $post_img, post_nowtime: datetime()})
        SET post.id = id(post)
        RETURN post.id as postID, u.Username as username, post.post_content as post_content, post.post_img as post_img, post.post_nowtime as post_nowtime
        CYPHER,
        [
           'myID' => $myID,
           'post_content' => $contentPost['post_content'],
           'post_img' => $file_name,
        ]);

        // $updateProfiles = [];
        // foreach($queryUpdateProfile as $value)
        // {
        //     array_push($updateProfiles, $value);
        // }
        //return response($queryCreatePost);
        return redirect() -> route('profile');
    }

    public function like (Request $request)
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $postID = $request->postId;
        $postID = intval($postID);
        $this->session->run(<<<'CYPHER'
        MATCH (p:Post{id: $postID}), (u:User{id: $myID})
        MERGE (u)-[:`Thích`]->(p)
        RETURN u,p
        CYPHER,
        [
            'myID' => $myID,
            'postID' => $postID
        ]);

        $queryLikePost = $this->session->run(<<<'CYPHER'
        MATCH (p:Post{id: $postID}) <- [:`Thích`] - (liked:User)
        RETURN count(liked) as liked
        CYPHER,
        [
            'postID' => $postID
        ]);

        foreach($queryLikePost as $value)
        {

        }

        return response()->json(['success' => true, 'liked' => $value['liked']]);

    }

    public function unlike (Request $request)
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $postID = $request->postId;
        $postID = intval($postID);
        $this->session->run(<<<'CYPHER'
        MATCH (p:Post{id: $postID}), (u:User{id: $myID})
        OPTIONAL MATCH (u)-[rel:`Thích`]->(p)
        DELETE rel
        CYPHER,
        [
            'myID' => $myID,
            'postID' => $postID
        ]);
        
        $queryUnlikePost = $this->session->run(<<<'CYPHER'
        MATCH (p:Post{id: $postID}) <- [:`Thích`] - (liked:User)
        RETURN count(liked) as liked
        CYPHER,
        [
            'postID' => $postID
        ]);

        foreach($queryUnlikePost as $value)
        {

        }

        return response()->json(['success' => true, 'liked' => $value['liked']]);

    }

    public function comment (Request $request,$id)
    {
        $comment = $request->all();
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $postID = intval($id);
        $queryComment = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID}), (p:Post{id: $postID}) <- [:`Đăng bài`] - (u2:User)
        CREATE (u) - [rel:`Bình luận`{content: $content}] -> (p)
        RETURN rel.content as comment, u2.id as orderUserID, u2.Username as username
        CYPHER,
        [
            'myID' => $myID,
            'postID' => $postID,
            'content' => $comment['content_comment']
        ]);

        $showComments = [];
        foreach($queryComment as $showcomments)
        {
            array_push($showComments, $showcomments);
        }
        

        return redirect() -> route('profile2', ['id' => $showcomments['orderUserID'], 'showComments' => $showcomments['username']]);
    }


}
