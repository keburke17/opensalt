<?php

namespace Salt\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CommentsController extends Controller
{
    /**
     * @Route("/comments/create", name="create_comment")
     */
    public function createCommentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $content = $request->request->get('content');
        var_export($content);die;
    }
}
