<?php

namespace App\Controller;

use App\Entity\Register;
use App\Entity\Solicitation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/register", name="register_")
 */
class RegisterController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $attempts = $request->query->get('attempts');
        $data = $this->getDoctrine()->getRepository(Register::class);
        $data = $data->createQueryBuilder('r')
            ->select('r.batch, r.id, r.input, r.key_found')
            ->where('r.attempts < :attempts')
            ->setParameter('attempts', $attempts)
            ->orderBy('r.attempts', 'desc')
            ->getQuery()
            ->getResult();

        return $this->json([
            'data' => $data,
        ]);
    }

    /**
     * @Route("/", name="search", methods={"POST"})
     */
    public function search(Request $request): Response
    {
        $data = $request->request->all();
        $repository = $this->getDoctrine()->getRepository(Solicitation::class);
        $ip = $request->getClientIp();
        $solicitaion = $repository->findOneBy(['ip' => $ip]);
        if(is_null($solicitaion)){
            $solicitaion = new Solicitation();
            $solicitaion->setIp($request->getClientIp());
            $solicitaion->setCount(1);
            $solicitaion->setUpdateAt(new \DateTimeImmutable('now', new \DateTimeZone('America/Fortaleza')));
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($solicitaion);

            $doctrine->flush();
            $register = new Register();
            $register->setInput($data['name']);
            $register->search();
            return $this->json([
                'hash' => $register->getHash(),
                'key_found' => $register->getKeyFound(),
                'attempts' => $register->getAttempts(),
            ]);

        } else if($solicitaion->isAllowed()) {
            $solicitaion->setCount($solicitaion->getCount()+1);
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($solicitaion);
            $doctrine->flush();
            $register = new Register();
            $register->setBatch(new \DateTimeImmutable('now', new \DateTimeZone('America/Fortaleza')));
            $register->setInput($data['name']);
            $register->search();
            $doctrine->persist($register);
            $doctrine->flush();
            return $this->json([
                'hash' => $register->getHash(),
                'key_found' => $register->getKeyFound(),
                'attempts' => $register->getAttempts(),
            ]);
        }
        return $this->json([
            'code error' => '429',
            'message error' => 'Too Many Requests',
        ]);

    }
}
