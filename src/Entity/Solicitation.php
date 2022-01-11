<?php

namespace App\Entity;

use App\Repository\SolicitationRepository;
use DateInterval;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SolicitationRepository::class)
 */
class Solicitation
{

    public function __construct(){
        date_default_timezone_set("America/Fortaleza");
    }


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $limitTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $Count;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $ip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLimitTime(): ?\DateTime
    {
        return $this->limitTime;
    }

    public function setLimitTime(): self
    {
        $dateTime = new DateTime('now', new \DateTimeZone('America/Fortaleza'));
        $hour = $dateTime->modify("+1 minutes");
        $this->limitTime = $hour;
        return $this;
    }

    public function getCount(): ?int
    {
        return $this->Count;
    }

    public function setCount(int $Count): self
    {
        $this->Count = $Count;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function isAllowed(){
        $now = new DateTime('now', new \DateTimeZone('America/Fortaleza'));
        $timeLimite = new DateTime($this->getLimitTime()->format("Y-m-d H:i:s"), new \DateTimeZone('America/Fortaleza'));
        if($this->getCount() >= 10 && $timeLimite < $now) {
            $this->setCount(1);
            $this->setLimitTime();
            return true;
        }
        if($this->getCount() >= 10 && $timeLimite > $now){
            return false;
        }
        $this->setCount($this->getCount()+1);
        return true;
    }
}
