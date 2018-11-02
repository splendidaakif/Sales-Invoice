<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * invoice_iteams
 *
 * @ORM\Table(name="invoice_iteams")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\invoice_iteamsRepository")
 */
class invoice_iteams
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="Num", type="integer")
     */
    private $num;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=25)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantity", type="integer")
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="unitPrice", type="integer")
     */
    private $unitPrice;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set num
     *
     * @param integer $num
     *
     * @return invoice_iteams
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return int
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return invoice_iteams
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return invoice_iteams
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set unitPrice
     *
     * @param integer $unitPrice
     *
     * @return invoice_iteams
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get unitPrice
     *
     * @return int
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }
}

