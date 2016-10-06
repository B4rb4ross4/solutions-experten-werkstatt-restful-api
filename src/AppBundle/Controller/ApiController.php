<?php

namespace AppBundle\Controller;

use AppBundle\Shop\Book;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class ApiController
 * @package AppBundle\Controller
 *
 */
class ApiController extends Controller
{
  /**
   * @Route("/api/books/{isbn}.{_format}", name="book_show", defaults={"_format": "json"})
   * @Method("GET")
   */
  public function showBookAction($isbn, $_format)
  {
    $book = new Book("Meaning of life", "234-464742526");

    return new Response($this->get('jms_serializer')->serialize($book, $_format));
  }

  /**
   * @Route("/api/books", name="book_insert", defaults={"_format": "json"})
   * @Method("POST")
   */
  public function insertBook(Request $request, $_format)
  {
    $book = $this->get('jms_serializer')->deserialize($request->getContent(), Book::class, $_format);

    $response =  new Response();
    $response->setStatusCode(Response::HTTP_CREATED);
    $response->headers->set('Location', $this->generateUrl('book_show', ['isbn' => $book->getIsbn()]));

    return$response;
  }

  /**
   * @Route("/api/", name="api")
   * @Method("GET")
   */
  public function indexAction(Request $request)
  {
    // replace this example code with whatever you need
    return $this->render('default/api.html.twig', [
      'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
    ]);
  }
}
