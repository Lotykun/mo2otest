<?php

namespace App\Controller;

use App\Object\BeerResponse;
use App\Object\SearchResponse;
use GuzzleHttp\Client;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Object\ApiErrorResponse;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/search", name="search_api", methods={"GET"})
     * @param Request $request
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBeerByFood(Request $request): Response
    {
        $data = array();

        try {
            $url = 'https://api.punkapi.com/v2/beers';
            $params = $request->query->all();
            if (isset($params['food']) && !empty($params['food'])){
                $client = new Client();
                $response = $client->request('GET', $url . '?food=' . $params['food']);

                $code = $response->getStatusCode();
                $beers = json_decode($response->getBody(), true);

                if ($code == Response::HTTP_OK){
                    if (count($beers) > 0){
                        foreach ($beers as $beer){
                            $data[] = new SearchResponse($beer);
                        }
                    } else {
                        $data = new ApiErrorResponse(404, 'No beers found by this search parameters');
                    }
                } else {
                    $data = new ApiErrorResponse($code, 'Error in punk api response');
                }
            } else {
                $data = new ApiErrorResponse(400, 'param food missing and required');
            }
        } catch (\Exception $e) {
            $data = new ApiErrorResponse(500, $e->getMessage());
        }

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($data, 'json', array_merge(['json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,]));

        return new JsonResponse($json, 200, array(), true);
    }

    /**
     * @param int $id
     * @Route("/api/beer/{id}", name="beer_api", methods={"GET"})
     * @param Request $request
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBeerById(int $id, Request $request): Response
    {
        $data = array();

        try {
            $url = 'https://api.punkapi.com/v2/beers';
            if ($id){
                $client = new Client();
                $response = $client->request('GET', $url . '/' . $id);

                $code = $response->getStatusCode();
                $beers = json_decode($response->getBody(), true);

                if ($code == Response::HTTP_OK){
                    if (count($beers) > 0){
                        $data = new BeerResponse($beers[0]);
                    } else {
                        $data = new ApiErrorResponse($code, 'Beer with id:' . $id . ' not found');
                    }
                } else {
                    $data = new ApiErrorResponse($code, 'Error in punk api response');
                }
            }
        } catch (\Exception $e) {
            $data = new ApiErrorResponse(500, $e->getMessage());
        }

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($data, 'json', array_merge(['json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,]));

        return new JsonResponse($json, 200, array(), true);
    }
}
