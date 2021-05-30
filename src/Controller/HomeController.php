<?php

namespace App\Controller;

use App\Entity\Indirizzo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Biglietto;
use App\Entity\AlEc;
use App\Entity\BigliettoIndirizzo;
use DateTime;
use DateTimeZone;

class HomeController extends AbstractController
{
    private $serializer;
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }
    /**
     * @Route("/indirizzi", name="indirizzi")
     */

    public function indirizzi(Request $request): Response
    {

        $doctrine = $this->getDoctrine();
        $indirizzi = $this->getUser()->getBigliettoIndirizzos();
        $data = $this->getUser()->getDataBiglietto();

        $currentDate = new DateTime(null, new DateTimeZone("Europe/Rome"));
        if ($data->format('Y-m-d') != $currentDate->format('Y-m-d')) {
            throw $this->createAccessDeniedException("Biglietto con data non corrente");
        }

        $ids = [];
        foreach ($indirizzi as $i) {
            array_push($ids, $i->getID_indirizzo());
        }

        $result =  [
            "indirizzi" => $this->serializer->normalize($ids, 'json', ['groups' => ['default']]),
        ];

        return new JsonResponse($result, 200);
    }

    /**
     * @Route("/", name="home")
     */

    public function home(Request $request)
    {
        $data = $this->getUser()->getDataBiglietto();

        $currentDate = new DateTime(null, new DateTimeZone("Europe/Rome"));
        if ($data->format('Y-m-d') != $currentDate->format('Y-m-d')) {
            throw $this->createAccessDeniedException("Biglietto con data non corrente");
        }

        return $this->render("home/index.html.twig");
    }

    /**
     * @Route("/alec/{id}", name="home2")
     */

    public function home2(Request $request, int $id)
    {
        $alecID = intval($id);

        if (!is_int($id)) {
            throw $this->createAccessDeniedException("L'ID deve essere un valore numerico intero");
        }

        $alec = $this->getDoctrine()->getRepository(AlEc::class)->find($alecID);

        if (!$alec) {
            throw $this->createNotFoundException("Aula non trovata");
        }

        return $this->render("alec/index.html.twig", [
            "id" => $id,
        ]);
    }

    /**
     * @Route("/alec/data/{id}", name="alec")
     */

    public function AlEc(Request $request, int $id)
    {
        $alecID = intval($id);

        if (!is_int($id)) {
            throw $this->createAccessDeniedException("L'ID deve essere un valore numerico intero");
        }

        $alec = $this->getDoctrine()->getRepository(AlEc::class)->find($alecID);

        if (!$alec) {
            throw $this->createNotFoundException("Aula non trovata");
        }

        $biglietto = $alec->getIDIndirizzo()->getBigliettoIndirizzo();

        if ($biglietto) {
            if ($biglietto->getID_biglietto()->getId() == $this->getUser()->getId()) {
                $result =  [
                    "alec" => $this->serializer->normalize($alec, 'json', ['groups' => ['default']]),
                ];

                return new JsonResponse($result, 200);
            }
        }

        $arrayFiltrato = array_filter($alec->getCentenutoMultimediales()->getValues(), function ($v, $k) {
            return $v->getTipologia() == "immagine";
        }, ARRAY_FILTER_USE_BOTH);

        $arrayVideo = array_filter($alec->getCentenutoMultimediales()->getValues(), function ($v, $k) {
            return $v->getTipologia() == "video";
        }, ARRAY_FILTER_USE_BOTH);

        $array = array_slice($arrayFiltrato, 0, 3);
        $array2 = $this->serializer->normalize($array, 'json', ['groups' => ['default']]);
        $array3 = $this->serializer->normalize($arrayVideo, 'json', ['groups' => ['default']]);

        $result = [
            "alec" => [
                "id" => $alec->getId(),
                "descrizione" => $alec->getDescrizione(),
                "numero_aula" => $alec->getNumeroAula(),
                "centenutoMultimediales" => array_merge($array2, $array3),
            ]
        ];
        return new JsonResponse($result, 200);
    }

    /**
     * @Route("/login/creabiglietto", name="crea")
     */

    public function generateBiglietto(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $randomTipoGiro = rand(0, 2);
        $randomNome = $this->generateRandomString(6);
        $randomPassword = $this->generateRandomString(6);
        $Indirizzi = $this->getDoctrine()->getRepository(Indirizzo::class)->findAll();
        $IndirizziScelti = [];

        if ($randomTipoGiro == 0) {
            $randomTipoGiro = "base";
        } elseif ($randomTipoGiro == 1) {
            $randomTipoGiro = "medio";
            $randomIndirzzo = rand(0, count($Indirizzi));
            array_push($IndirizziScelti, $Indirizzi[$randomIndirzzo]);
        } else {
            $randomTipoGiro = "avanzato";
            for ($i = 0; $i < 3; $i++) {
                $randomIndirzzo = rand(0, count($Indirizzi) - 3);
                array_push($IndirizziScelti, $Indirizzi[$randomIndirzzo + $i]);
            }
        }

        $biglietto = new Biglietto();
        $biglietto->setTipoGiro($randomTipoGiro)
            ->setDataBiglietto(new DateTime(null, new DateTimeZone("Europe/Rome")))
            ->setUsername($randomNome);
        $password = $encoder->encodePassword($biglietto, $randomPassword);
        $biglietto->setPassword($password);

        $EntityManagere = $this->getDoctrine()->getManager();
        $EntityManagere->persist($biglietto);

        foreach ($IndirizziScelti as $indirizzo) {
            $bigliettoIndirizzo = new BigliettoIndirizzo();
            $bigliettoIndirizzo->setID_biglietto($biglietto)->setID_indirizzo($indirizzo);
            $EntityManagere->persist($bigliettoIndirizzo);
        }

        $EntityManagere->flush();
        $dati = [
            "user" => $randomNome,
            "psw" => $randomPassword,
            "tipo_giro" => $randomTipoGiro,
            "data" => $biglietto->getDataBiglietto(),
        ];


        return new JsonResponse($dati, 200);
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @Route("/login/dati", name="dati")
     */

    public function PrendiDati(Request $request)
    {
        $biglietti = $this->getDoctrine()->getRepository(Biglietto::class)->findAll();
        $parameters = json_decode($request->getContent(), true);
        $data = $parameters['data'];
        $arrayDati = [];

        if ($data) {
            foreach ($biglietti as $biglietto){
                if ($biglietto->getDataBiglietto()->format("Y")==$data){
                    array_push($arrayDati,$biglietto);
                }
            }
        }else{
            $arrayDati = $biglietti;
        }

        $stampaBiglietti = $this->serializer->normalize($arrayDati, 'json', ['groups' => ['data']]);

        return new JsonResponse($stampaBiglietti,200);
    }
}
