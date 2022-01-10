<?php

namespace App\Entity;

use App\Repository\RegisterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegisterRepository::class)
 *
 */
class Register
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", )
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $batch;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $input;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $key_found;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    /**
     * @ORM\Column(type="bigint")
     */
    private $attempts;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBatch(): ?\DateTimeInterface
    {
        return $this->batch;
    }

    public function setBatch(\DateTimeInterface $batch): self
    {
        $this->batch = $batch;

        return $this;
    }

    public function getInput(): ?string
    {
        return $this->input;
    }

    public function setInput(string $input): self
    {
        $this->input = $input;

        return $this;
    }

    public function getKeyFound(): ?string
    {
        return $this->key_found;
    }

    public function setKeyFound(string $key_found): self
    {
        $this->key_found = $key_found;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getAttempts(): ?string
    {
        return $this->attempts;
    }

    public function setAttempts(string $attempts): self
    {
        $this->attempts = $attempts;

        return $this;
    }

    protected function getKeyRandom(): ?string
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $var_size = strlen($chars);
        $random_str = null;
        for ($x = 0; $x < 8; $x++) {
            $random_str .= $chars[rand(0, $var_size - 1)];
        }
        return $random_str;
    }

    public function search(): Void
    {
        $str = $this->input;
        $pass = 0;
        $key_random = $this->getKeyRandom();
        do{
            $hash = md5($str . $key_random);
            if(substr($hash, 0, 4) === '0000'){
                $pass = 1;
                $this->key_found= $key_random;
                $this->hash = $hash;
            }
            $this->attempts++;
            $key_random = $this->getKeyRandom();
        } while ($pass === 0);
    }
}
