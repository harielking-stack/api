<?php

require_once './config.php';

class Api extends Config
{
    use Mail;
    use Auth;
    use User;
    use Post;
    use Follower;
    use Essentials;
    use Notifications;
    use Groups;
    ///*********************************************\\\ 
    ///-----------  Route of the Project -----------\\\  
    ///**********************************************\\\  

    public function handleRequest()
    {
        
        try {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                
                $data = empty($_POST) ? json_decode(file_get_contents('php://input'), true) : $_POST;
                switch ($data['service'] ?? null) {
                    case 'generate_otp':
                        $this->generateOtp($data);
                        break;
                    case 'verify_otp':
                        $this->verifyOtp($data);
                        break;
                    case 'register':
                        $this->userRegisteration($data);
                        break;
                    case 'update_password':
                        $this->updatePassword($data);
                        break;
                    case 'login':
                        $this->userLogin($data);
                        break;
                    case 'google_signin':
                        $this->googleSignin($data);
                        break;
                    case 'get_user':
                        $this->getUser($data);
                        break;

                    case 'get_follow_details':
                        $this->getFollowDetails($data);
                        break;
                    case 'follow_user':
                        $this->followUser($data);
                        break;
                    case 'add_post':
                        $this->addPost($data);
                        break;
                    case 'add_event':
                        $this->addEvent($data);
                        break;
                    case 'view_post':
                        $this->viewPost($data);
                        break;
                    case 'view_serparate_post':
                        $this->viewSeparatePost($data);
                        break;
                    case 'view_event':
                        $this->viewEvent($data);
                        break;
                    case 'view_similar_post_event':
                        $this->viewSimilarPostsEvents($data);
                        break;
                    case 'get_comments':
                        $this->getComments($data);
                        break;
                    case 'post_like':
                        $this->postLike($data);
                        break;
                    case 'event_mark':
                        $this->eventMark($data);
                        break;
                    case 'post_comment':
                        $this->postComment($data);
                        break;
                    case 'post_comment_reply':
                        $this->postCommentReply($data);
                        break;
                    case 'delete_post':
                        $this->deletePost($data);
                        break;
                    case 'get_notifications':
                        $this->getNotifications($data);
                        break;
                    case 'group_creation':
                        $this->groupcreation($data);
                        break; 
                    case 'get_my_groups':
                        $this->getmygroups($data);
                        break;
                    case 'add_member_group':
                        $this->addMemberFunction($data);
                        break;
                    case 'unfollow_group':
                        $this->unfollowGroup($data);
                        break;
                    case 'group_details':
                        $this->viewGroupDetails($data);
                        break;                    
                    default:
                        // http_response_code(405);
                        echo json_encode(["status" => "true", "message" => "Service not found"]);
                        break;
                }
            }else{
                 echo json_encode(["status" => "true", "message" => "Server is running"]);
            }
        } catch (Exception $e) {
            // http_response_code(500);
            echo json_encode(["status" => "true", "message" => "Oops! Something went wrong. Please try again later."]);
        }
    }
}

$API = new Api();
$API->handleRequest();
