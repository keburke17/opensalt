<?php

namespace CftfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CftfBundle\Entity\Comment;

class CommentsController extends Controller
{
    /**
     * @Route("/comments/create", name="create_comment")
     * @Method("POST")
     */
    public function createCommentAction(Request $request)
    {
        $comment = new Comment();
        $comment->setContent($request->request->get('content'));
        $comment->setCommentId($request->request->get('id'));
        $comment->setParent($request->request->get('parent'));
        $comment->setFullname($request->request->get('fullname'));
        $comment->setCreatedByCurrentUser($request->request->get('createdByCurrentUser'));
        $comment->setUpvoteCount($request->request->get('upvoteCount'));
        $comment->setUserHasUpvoted($request->request->get('userHasUpvoted'));

        var_export($comment);die;
    }
}
