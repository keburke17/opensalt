<?php

namespace Salt\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Salt\SiteBundle\Entity\Comment;

class CommentsController extends Controller
{
    /**
     * @Route("/api/comments/create", name="create_comment")
     * @Method("POST")
     */
    public function createCommentAction(Request $request)
    {
        $comment = new Comment();
        $user = $this->getUser();

        $comment->setContent($request->request->get('content'));
        $comment->setCommentId($request->request->get('id'));
        $comment->setParent($request->request->get('parent'));
        $comment->setUserId($user->getId());
        $comment->setFullname($user->getUsername().' - '.$user->getOrg()->getName());
        $comment->setCreatedByCurrentUser($request->request->get('created_by_current_user'));
        $comment->setUpvoteCount($request->request->get('upvote_count'));
        $comment->setUserHasUpvoted(false);
        $comment->setItemId($request->request->get('itemId'));
        $comment->setCreatedAt(new \DateTime($request->request->get('created')));
        $comment->setUpdatedAt(new \DateTime($request->request->get('modified')));

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        return new Response('OK', Response::HTTP_OK);
    }

    /**
     * @Route("/comments", name="get_comments")
     * @Method("GET")
     */
    public function listCommentsAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('SaltSiteBundle:Comment')->findAll();
        $serializer = $this->get('jms_serializer');

        if ($user) {
            foreach ($comments as $comment){
                if ($comment->getUserId() == $user->getId()){
                    $comment->setCreatedByCurrentUser('true');
                } else {
                    $comment->setCreatedByCurrentUser('false');
                }
            }
        }

        $response = $serializer->serialize($comments,'json');

        return new Response($response);
    }
}
